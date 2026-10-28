<?php

namespace Tests\Feature;

use App\Mail\FormSubmissionReceived;
use App\Models\Admin;
use App\Models\Form;
use App\Models\Page;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SubmissionPageTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.key' => 'base64:'.base64_encode(str_repeat('a', 32))]);
    }

    #[DataProvider('submissionSources')]
    public function test_records_page_source_and_sends_notification_when_enquiry_is_submitted(?string $source, ?string $referer, ?string $pageSlug, ?string $expected): void
    {
        Mail::fake();
        $form = $this->enquiryForm($pageSlug);
        $form->fields()->create(['name' => 'email', 'label' => 'Email', 'type' => 'email', 'is_required' => true]);
        $headers = $referer ? ['Referer' => $referer] : [];

        $this->postJson(route('forms.submit', $form), ['email' => 'visitor@example.com', 'page_source' => $source], $headers)
            ->assertOk()->assertJsonPath('success', true);

        $this->assertDatabaseHas('form_submissions', ['form_id' => $form->id, 'page_source' => $expected, 'email_sent' => true]);
        $this->assertDatabaseHas('form_submission_values', ['value' => 'visitor@example.com']);
        Mail::assertSent(FormSubmissionReceived::class, 1);
    }

    public static function submissionSources(): array
    {
        return [
            'shared form preserves submitted page over linked page' => ['/process/washing.html?utm_source=mail', null, 'contact', 'process/washing'],
            'same-site referer without hidden source' => [null, 'http://localhost/heating/grill?campaign=one', 'contact', 'heating/grill'],
            'linked page without source or referer' => [null, null, 'spare_parts', 'spare_parts'],
            'foreign referer is ignored' => [null, 'https://other.example/process/washing', 'contact', 'contact'],
            'home path is preserved' => ['/', null, 'contact', 'home'],
            'no evidence remains unknown' => [null, null, null, null],
            'legacy unknown source falls back' => ['Unknown page', null, 'contact', 'contact'],
        ];
    }

    #[DataProvider('invalidSources')]
    public function test_returns_422_without_saving_or_emailing_when_source_is_invalid(mixed $source): void
    {
        Mail::fake();
        $form = $this->enquiryForm('contact');

        $this->postJson(route('forms.submit', $form), ['page_source' => $source])
            ->assertUnprocessable()->assertJsonValidationErrors('page_source');

        $this->assertDatabaseCount('form_submissions', 0);
        Mail::assertNothingSent();
    }

    public static function invalidSources(): array
    {
        return ['array input' => [['contact']], 'oversized input' => [str_repeat('a', 256)]];
    }

    public function test_admin_sees_readable_source_and_path_on_dashboard_list_and_detail(): void
    {
        $form = $this->enquiryForm('contact');
        $submission = $form->submissions()->create(['page_source' => '/process/washing.html']);
        $this->actingAs(Admin::create(['email' => 'admin@example.com', 'password' => 'unused']), 'admin');

        $this->get(route('admin.forms.submissions.index', $form))->assertOk()
            ->assertSee('Process / Washing')->assertSee('http://localhost/process/washing');
        $this->get(route('admin.forms.submissions.show', [$form, $submission]))->assertOk()
            ->assertSee('Process / Washing')->assertSee('http://localhost/process/washing');
        $this->get(route('admin.dashboard'))->assertOk()
            ->assertSee('Source page')->assertSee('Process / Washing');
    }

    public function test_old_blank_source_shows_linked_page_with_inference_notice_without_rewriting_history(): void
    {
        $form = $this->enquiryForm('service/online-support');
        $submission = $form->submissions()->create(['page_source' => null]);
        $this->actingAs(Admin::create(['email' => 'admin@example.com', 'password' => 'unused']), 'admin');

        $this->get(route('admin.forms.submissions.show', [$form, $submission]))->assertOk()
            ->assertSee('Service / Online Support')->assertSee('/service/online-support')
            ->assertSee("From form's linked page; original source not recorded.", false);

        $this->assertNull($submission->fresh()->page_source);
    }

    public function test_unsafe_legacy_source_without_linked_page_displays_unknown_without_a_link(): void
    {
        $form = $this->enquiryForm(null);
        $submission = $form->submissions()->create(['page_source' => '<script>alert(1)</script>']);
        $this->actingAs(Admin::create(['email' => 'admin@example.com', 'password' => 'unused']), 'admin');

        $this->get(route('admin.forms.submissions.show', [$form, $submission]))->assertOk()
            ->assertSee('Unknown page')->assertDontSee('<script>alert(1)</script>', false)
            ->assertDontSee('original source not recorded.');
    }

    public function test_email_uses_the_same_page_name_and_path_as_admin(): void
    {
        $submission = $this->enquiryForm('contact')->submissions()->create(['page_source' => 'sorting/conveyors.html']);
        $mail = new FormSubmissionReceived($submission);

        $mail->assertHasSubject('GBASE Enquiry [Sorting / Conveyors] — Enquiry');
        $mail->assertSeeInHtml('Sorting / Conveyors');
        $mail->assertSeeInHtml('/sorting/conveyors');
    }

    public function test_public_form_includes_page_source_without_javascript(): void
    {
        $this->enquiryForm('heating/grill');

        $this->get('/heating/grill')->assertOk()
            ->assertSee('name="page_source" value="heating/grill"', false);
    }

    public function test_submission_details_still_require_admin_login(): void
    {
        $form = $this->enquiryForm('contact');
        $submission = $form->submissions()->create(['page_source' => 'contact']);

        $this->get(route('admin.forms.submissions.show', [$form, $submission]))
            ->assertRedirect(route('admin.login'));
    }

    private function enquiryForm(?string $pageSlug): Form
    {
        $page = $pageSlug === null ? null : Page::create(['slug' => $pageSlug, 'title' => 'GBASE', 'is_published' => true]);

        return Form::create([
            'key' => 'test-enquiry', 'name' => 'Enquiry', 'page_id' => $page?->id,
            'notify_email' => 'team@example.com', 'submit_button_text' => 'Send',
        ]);
    }
}
