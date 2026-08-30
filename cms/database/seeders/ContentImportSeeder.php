<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\Page;
use Illuminate\Database\Seeder;

/**
 * Imports the word-for-word content extracted from the original 30
 * static HTML pages (see cms/scripts/extract_content.py and
 * content_import.json in this directory) into pages + page_sections +
 * forms + form_fields. Body content is stored as raw HTML in a single
 * "rich_text" section per page to guarantee zero content drift --
 * decomposing it into individual cards is a follow-up refinement, not
 * a requirement for this import to be correct.
 */
class ContentImportSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = __DIR__ . '/content_import.json';
        if (!file_exists($jsonPath)) {
            $this->command->error('content_import.json not found. Run scripts/extract_content.py first.');
            return;
        }

        $pages = json_decode(file_get_contents($jsonPath), true);

        foreach ($pages as $data) {
            $page = Page::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'meta_description' => $data['meta_description'],
                    'template' => 'default',
                    'custom_scripts' => $data['extra_scripts_html'] ?: null,
                    'is_published' => true,
                ]
            );

            $page->sections()->delete();
            $page->sections()->create([
                'key' => 'main',
                'type' => 'rich_text',
                'body' => $data['body_html'],
                'sort_order' => 1,
            ]);

            if (!empty($data['has_form']) && !empty($data['form_fields'])) {
                $formKey = str_replace('/', '-', $data['slug']) . '-enquiry';
                $form = Form::updateOrCreate(
                    ['key' => $formKey],
                    [
                        'name' => $data['title'] . ' Enquiry',
                        'page_id' => $page->id,
                        'notify_email' => 'gbasetechnologies.info@gmail.com',
                        'submit_button_text' => 'Submit',
                        'before_html' => $data['contact_before_html'] ?: null,
                        'after_html' => $data['contact_after_html'] ?: null,
                    ]
                );

                $form->fields()->delete();
                foreach ($data['form_fields'] as $field) {
                    $form->fields()->create([
                        'name' => $field['name'],
                        'label' => $field['label'],
                        'type' => $field['type'],
                        'options' => $field['options'],
                        'is_required' => $field['is_required'],
                        'sort_order' => $field['sort_order'],
                    ]);
                }
            }

            $this->command->info("Imported: {$data['slug']}");
        }
    }
}
