<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use App\Models\Page;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class InquiryProtectionTest extends TestCase
{
    use LazilyRefreshDatabase;

    private const VERIFY_URL = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    protected function setUp(): void
    {
        parent::setUp();
        config(['app.key' => 'base64:'.base64_encode(str_repeat('a', 32)), 'services.turnstile.enabled' => false]);
        Cache::flush();
        Http::preventStrayRequests();
    }

    public function test_genuine_enquiry_is_saved_without_enabling_unconfigured_turnstile(): void
    {
        $this->postJson(route('inquiries.store'), $this->payload())
            ->assertOk()->assertJsonPath('success', true);

        $this->assertDatabaseHas('inquiries', ['email' => 'customer@example.com', 'message' => 'Please send details about an IQF freezer.']);
        Http::assertNothingSent();
    }

    public function test_filled_honeypot_does_not_save_an_enquiry_or_call_turnstile(): void
    {
        $this->enableTurnstile();

        $this->postJson(route('inquiries.store'), $this->payload(['contact_fax' => 'spam']))
            ->assertOk()->assertJsonPath('success', true);

        $this->assertDatabaseCount('inquiries', 0);
        Http::assertNothingSent();
    }

    public function test_enabled_turnstile_rejects_direct_posts_without_a_token(): void
    {
        $this->enableTurnstile();

        $this->postJson(route('inquiries.store'), $this->payload())
            ->assertUnprocessable()->assertJsonValidationErrors('cf-turnstile-response');

        $this->assertDatabaseCount('inquiries', 0);
        Http::assertNothingSent();
    }

    public function test_successful_verification_saves_once_without_storing_the_token(): void
    {
        $this->enableTurnstile();
        Http::fake([self::VERIFY_URL => Http::response(['success' => true, 'hostname' => 'localhost', 'action' => 'inquiry'])]);

        $this->postJson(route('inquiries.store'), $this->payload(['cf-turnstile-response' => 'test-response']))
            ->assertOk()->assertJsonPath('success', true);

        $this->assertDatabaseCount('inquiries', 1);
        $this->assertArrayNotHasKey('cf-turnstile-response', Inquiry::sole()->getAttributes());
        Http::assertSent(fn ($request): bool => $request->url() === self::VERIFY_URL && $request['response'] === 'test-response' && $request['secret'] === 'test-secret');
    }

    #[DataProvider('rejectedVerifications')]
    public function test_invalid_expired_or_wrong_site_verifications_do_not_save(array $response): void
    {
        $this->enableTurnstile();
        Http::fake([self::VERIFY_URL => Http::response($response)]);

        $this->postJson(route('inquiries.store'), $this->payload(['cf-turnstile-response' => 'test-response']))
            ->assertUnprocessable()->assertJsonValidationErrors('cf-turnstile-response');

        $this->assertDatabaseCount('inquiries', 0);
        Http::assertSentCount(1);
    }

    public static function rejectedVerifications(): array
    {
        return [
            'failed challenge' => [['success' => false, 'error-codes' => ['invalid-input-response']]],
            'expired or reused' => [['success' => false, 'error-codes' => ['timeout-or-duplicate']]],
            'wrong hostname' => [['success' => true, 'hostname' => 'another.example', 'action' => 'inquiry']],
            'wrong action' => [['success' => true, 'hostname' => 'localhost', 'action' => 'login']],
            'missing metadata' => [['success' => true]],
        ];
    }

    public function test_network_failure_does_not_bypass_turnstile(): void
    {
        $this->enableTurnstile();
        Http::fake([self::VERIFY_URL => function (): never {
            throw new ConnectionException('Test connection failure');
        }]);

        $this->postJson(route('inquiries.store'), $this->payload(['cf-turnstile-response' => 'test-response']))
            ->assertServiceUnavailable();

        $this->assertDatabaseCount('inquiries', 0);
    }

    public function test_cloudflare_server_failure_returns_retryable_error_without_saving(): void
    {
        $this->enableTurnstile();
        Http::fake([self::VERIFY_URL => Http::response([], 503)]);

        $this->postJson(route('inquiries.store'), $this->payload(['cf-turnstile-response' => 'test-response']))
            ->assertServiceUnavailable();

        $this->assertDatabaseCount('inquiries', 0);
        Http::assertSentCount(1);
    }

    public function test_explicitly_enabled_but_missing_keys_does_not_silently_disable_verification(): void
    {
        config(['services.turnstile.enabled' => true, 'services.turnstile.site_key' => null, 'services.turnstile.secret_key' => null]);

        $this->postJson(route('inquiries.store'), $this->payload())->assertServiceUnavailable();

        $this->assertDatabaseCount('inquiries', 0);
        Http::assertNothingSent();
    }

    public function test_duplicate_posts_across_pages_create_only_one_enquiry(): void
    {
        $this->postJson(route('inquiries.store'), $this->payload())->assertOk();

        $this->postJson(route('inquiries.store'), $this->payload(['email' => 'CUSTOMER@example.com', 'page_source' => 'home', 'company' => null, 'product_types' => []]))
            ->assertOk()->assertJsonPath('message', 'We have already received this enquiry. There is no need to resend it.');

        $this->assertDatabaseCount('inquiries', 1);
    }

    public function test_same_customer_can_send_a_different_requirement(): void
    {
        $this->postJson(route('inquiries.store'), $this->payload())->assertOk();

        $this->postJson(route('inquiries.store'), $this->payload(['message' => 'Also send conveyor specifications.']))->assertOk();

        $this->assertDatabaseCount('inquiries', 2);
    }

    public function test_duplicate_window_expires_after_ten_minutes(): void
    {
        $this->freezeTime();
        $this->postJson(route('inquiries.store'), $this->payload())->assertOk();
        $this->travel(11)->minutes();

        $this->postJson(route('inquiries.store'), $this->payload())->assertOk();

        $this->assertDatabaseCount('inquiries', 2);
    }

    public function test_sixth_attempt_within_ten_minutes_returns_429_before_saving(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->postJson(route('inquiries.store'), $this->payload(['message' => 'Requirement '.$i]))->assertOk();
        }

        $this->postJson(route('inquiries.store'), $this->payload(['message' => 'Sixth requirement']))
            ->assertTooManyRequests()->assertHeader('Retry-After');

        $this->assertDatabaseCount('inquiries', 5);
    }

    public function test_hourly_limit_applies_even_when_burst_windows_have_expired(): void
    {
        $this->freezeTime();
        for ($batch = 0; $batch < 4; $batch++) {
            for ($i = 0; $i < 5; $i++) {
                $this->postJson(route('inquiries.store'), $this->payload(['message' => 'Requirement '.$batch.'-'.$i]))->assertOk();
            }
            $this->travel(11)->minutes();
        }

        $this->postJson(route('inquiries.store'), $this->payload(['message' => 'Twenty first']))->assertTooManyRequests();

        $this->assertDatabaseCount('inquiries', 20);
    }

    public function test_spare_parts_request_without_message_is_preserved_when_part_details_are_provided(): void
    {
        $payload = $this->payload(['page_source' => 'spare_parts.html', 'message' => null, 'part_serial_no' => ['PART-123'], 'quantity_required' => ['2']]);

        $this->postJson(route('inquiries.store'), $payload)->assertOk()->assertJsonPath('success', true);

        $this->assertSame([['serial_no' => 'PART-123', 'quantity' => '2']], Inquiry::sole()->part_lines);
    }

    public function test_empty_requirement_is_rejected_without_saving(): void
    {
        $this->postJson(route('inquiries.store'), $this->payload(['message' => '']))
            ->assertUnprocessable()->assertJsonValidationErrors('message');

        $this->assertDatabaseCount('inquiries', 0);
    }

    public function test_rejected_spam_does_not_change_existing_enquiries(): void
    {
        $existing = Inquiry::create($this->payload());

        $this->postJson(route('inquiries.store'), $this->payload(['contact_fax' => 'spam']))->assertOk();

        $this->assertDatabaseCount('inquiries', 1);
        $this->assertSame('Please send details about an IQF freezer.', $existing->fresh()->message);
    }

    public function test_native_form_failures_preserve_customer_input(): void
    {
        $this->enableTurnstile();

        Http::fake([self::VERIFY_URL => Http::response(['success' => false])]);

        $this->from('/contact.html')->post(route('inquiries.store'), $this->payload(['cf-turnstile-response' => 'expired-token']))
            ->assertRedirect('/contact.html')->assertSessionHasErrors('cf-turnstile-response')
            ->assertSessionHasInput('email', 'customer@example.com')->assertSessionMissing('_old_input.cf-turnstile-response');

        $this->assertDatabaseCount('inquiries', 0);
    }

    #[DataProvider('formPages')]
    public function test_all_form_variants_render_honeypot_and_configured_turnstile(string $slug, string $path): void
    {
        $this->enableTurnstile();
        Page::create(['slug' => $slug, 'title' => 'GBASE']);

        $this->get($path)->assertOk()->assertSee('data-inquiry-form', false)->assertSee('name="contact_fax"', false)
            ->assertSee('data-inquiry-turnstile', false)->assertSee('data-sitekey="test-site"', false)->assertDontSee('test-secret');
    }

    public static function formPages(): array
    {
        return ['home' => ['home', '/'], 'contact' => ['contact', '/contact.html'], 'parts' => ['spare-parts', '/spare_parts.html']];
    }

    private function enableTurnstile(): void
    {
        config(['services.turnstile.enabled' => true, 'services.turnstile.site_key' => 'test-site', 'services.turnstile.secret_key' => 'test-secret']);
    }

    private function payload(array $overrides = []): array
    {
        return array_replace(['page_source' => 'contact.html', 'name' => 'Customer', 'email' => 'customer@example.com', 'message' => 'Please send details about an IQF freezer.'], $overrides);
    }
}
