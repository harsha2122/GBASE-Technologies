<?php

namespace Tests\Feature;

use App\Filament\Pages\ManageSettings;
use App\Models\Page;
use App\Models\Setting;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BrochureUploadTest extends TestCase
{
    use LazilyRefreshDatabase;

    private const PDF = "%PDF-1.4\n1 0 obj\n<< /Type /Catalog >>\nendobj\ntrailer\n<< /Root 1 0 R >>\n%%EOF\n";

    protected function setUp(): void
    {
        parent::setUp();
        config(['app.key' => 'base64:'.base64_encode(str_repeat('a', 32))]);
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    public function test_brochure_settings_require_the_existing_admin_login(): void
    {
        $this->get('/admin/manage-settings')->assertRedirect('/admin/login');
    }

    public function test_admin_can_replace_a_22_mb_brochure_without_changing_other_settings_or_deleting_the_old_pdf(): void
    {
        $this->actingAs(User::factory()->create());
        Storage::fake('local');
        Storage::disk('local')->put('brochures/original.pdf', self::PDF);
        $settings = Setting::current();
        $settings->update(['brochure_path' => 'brochures/original.pdf', 'topbar_email' => 'office@example.com']);
        Page::create(['slug' => 'home', 'title' => 'Home']);
        $contents = self::PDF.str_repeat(' ', 22 * 1024 * 1024);

        Livewire::test(ManageSettings::class)
            ->fillForm(['brochure_path' => null])
            ->fillForm(['brochure_path' => [UploadedFile::fake()->createWithContent('replacement.pdf', $contents)]])
            ->call('save')->assertHasNoFormErrors()->assertNotified('Settings updated');

        $settings->refresh();
        $this->assertNotSame('brochures/original.pdf', $settings->brochure_path);
        $this->assertStringStartsWith('brochures/', $settings->brochure_path);
        $this->assertSame($contents, Storage::disk('local')->get($settings->brochure_path));
        Storage::disk('local')->assertExists('brochures/original.pdf');
        $this->assertSame('office@example.com', $settings->topbar_email);
        $this->get(route('home'))->assertOk()->assertSee('href="'.route('brochure.download').'"', false);
        $response = $this->get(route('brochure.download'))->assertOk()
            ->assertDownload('GBASE-Brochure.pdf')->assertHeader('Content-Type', 'application/pdf')
            ->assertHeader('X-Content-Type-Options', 'nosniff');
        $this->assertSame($contents, $response->streamedContent());
        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
    }

    public function test_non_pdf_content_is_rejected_without_replacing_the_current_brochure(): void
    {
        $this->actingAs(User::factory()->create());
        Storage::fake('local');
        Storage::disk('local')->put('brochures/current.pdf', self::PDF);
        Setting::current()->update(['brochure_path' => 'brochures/current.pdf']);

        Livewire::test(ManageSettings::class)
            ->fillForm(['brochure_path' => null])
            ->fillForm(['brochure_path' => [UploadedFile::fake()->createWithContent('not-a-pdf.pdf', '<?php echo "not a PDF";')->mimeType('text/x-php')]])
            ->call('save')->assertHasFormErrors(['brochure_path'])
            ->assertSee(__('validation.mimetypes', ['attribute' => 'brochure PDF', 'values' => 'application/pdf']));

        $this->assertSame('brochures/current.pdf', Setting::current()->brochure_path);
        Storage::disk('local')->assertExists('brochures/current.pdf');
    }

    public function test_upload_above_30_mb_is_rejected_without_changing_the_current_brochure(): void
    {
        $this->actingAs(User::factory()->create());
        Storage::fake('local');
        Storage::disk('local')->put('brochures/current.pdf', self::PDF);
        Setting::current()->update(['brochure_path' => 'brochures/current.pdf']);
        $file = UploadedFile::fake()->createWithContent('too-large.pdf', self::PDF.str_repeat(' ', 31 * 1024 * 1024));

        Livewire::test(ManageSettings::class)->fillForm(['brochure_path' => [$file]])
            ->assertHasErrors([
                'data.brochure_path.0' => __('validation.max.file', ['attribute' => 'data.brochure_path.0', 'max' => 30720]),
            ]);

        $this->assertSame('brochures/current.pdf', Setting::current()->brochure_path);
        Storage::disk('local')->assertExists('brochures/current.pdf');
    }

    public function test_client_filename_is_not_used_as_the_stored_pdf_name(): void
    {
        $this->actingAs(User::factory()->create());
        Storage::fake('local');

        Livewire::test(ManageSettings::class)
            ->fillForm(['brochure_path' => [UploadedFile::fake()->createWithContent('my-brochure.pdf', self::PDF)]])
            ->call('save')->assertHasNoFormErrors();

        $path = Setting::current()->brochure_path;
        $this->assertStringStartsWith('brochures/', $path);
        $this->assertStringEndsWith('.pdf', $path);
        Storage::disk('local')->assertMissing('brochures/my-brochure.pdf');
        $this->assertSame(self::PDF, $this->get(route('brochure.download'))->assertOk()->streamedContent());
    }

    public function test_admin_can_remove_a_replacement_and_restore_the_original_download(): void
    {
        $this->actingAs(User::factory()->create());
        Storage::fake('local');
        Storage::disk('local')->put('brochures/replacement.pdf', self::PDF);
        Setting::current()->update(['brochure_path' => 'brochures/replacement.pdf']);
        $this->originalBrochure();

        Livewire::test(ManageSettings::class)->fillForm(['brochure_path' => null])
            ->call('save')->assertHasNoFormErrors();

        $this->assertNull(Setting::current()->brochure_path);
        Storage::disk('local')->assertExists('brochures/replacement.pdf');
        $this->get(route('brochure.download'))->assertOk()->assertDownload('GBASE-Brochure.pdf');
    }

    public function test_original_brochure_is_available_before_any_upload(): void
    {
        Storage::fake('local');
        $this->originalBrochure();

        $this->get(route('brochure.download'))->assertOk()->assertDownload('GBASE-Brochure.pdf');
    }

    public function test_missing_replacement_falls_back_to_the_original_brochure(): void
    {
        Storage::fake('local');
        $this->originalBrochure();
        Setting::current()->update(['brochure_path' => 'brochures/missing.pdf']);

        $this->get(route('brochure.download'))->assertOk()->assertDownload('GBASE-Brochure.pdf');
    }

    #[DataProvider('unsafePaths')]
    public function test_private_files_outside_the_brochure_directory_are_never_downloaded(string $path): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('secret.pdf', 'private information');
        Setting::current()->update(['brochure_path' => $path]);
        Storage::disk('local')->makeDirectory('empty-public');
        $this->app->usePublicPath(Storage::disk('local')->path('empty-public'));

        $this->get(route('brochure.download'))->assertNotFound();
    }

    public static function unsafePaths(): array
    {
        return ['outside directory' => ['secret.pdf'], 'traversal' => ['brochures/../secret.pdf']];
    }

    public function test_homepage_keeps_the_existing_hero_link_until_a_brochure_is_uploaded(): void
    {
        $page = Page::create(['slug' => 'home', 'title' => 'Home']);
        $page->sections()->create([
            'section_key' => 'hero', 'section_type' => 'hero', 'label' => 'Hero', 'is_active' => true,
            'content' => ['primary_button_link' => '/E-Brochure Final.pdf', 'primary_button_text' => 'Download Brochure'],
        ]);

        $this->get(route('home'))->assertOk()->assertSee('href="/E-Brochure Final.pdf"', false);
    }

    public function test_migration_preserves_existing_site_settings(): void
    {
        $settings = Setting::current();
        $settings->update(['topbar_email' => 'office@example.com', 'footer_about_text' => 'Existing company information']);
        $migration = require database_path('migrations/2026_11_05_122726_add_brochure_path_to_settings_table.php');
        $migration->down();

        $migration->up();

        $settings->refresh();
        $this->assertSame('office@example.com', $settings->topbar_email);
        $this->assertSame('Existing company information', $settings->footer_about_text);
        $this->assertNull($settings->brochure_path);
        $this->assertDatabaseCount('settings', 1);
    }

    private function originalBrochure(): void
    {
        Storage::disk('local')->put('original-public/E-Brochure Final.pdf', self::PDF);
        $this->app->usePublicPath(Storage::disk('local')->path('original-public'));
    }
}
