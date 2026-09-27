<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Filament\SectionFormSchemas;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page as ResourcePage;
use Illuminate\Contracts\Support\Htmlable;

class EditPageSections extends ResourcePage implements HasForms
{
    use InteractsWithForms;
    use InteractsWithRecord;

    protected static string $resource = PageResource::class;

    protected static string $view = 'filament.resources.page-resource.pages.edit-page-sections';

    public ?array $data = [];

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->form->fill([
            'sections' => $this->record->sections()
                ->orderBy('sort_order')
                ->get()
                ->mapWithKeys(fn ($section) => [
                    $section->section_key => ['content' => $section->content ?? []],
                ])
                ->toArray(),
        ]);
    }

    public function getTitle(): string|Htmlable
    {
        return 'Edit Content: '.$this->record->title;
    }

    public function form(Form $form): Form
    {
        $sections = $this->record->sections()->orderBy('sort_order')->get();

        return $form
            ->schema([
                Tabs::make('Sections')
                    ->tabs(
                        $sections->map(
                            fn ($section) => Tab::make($section->label)
                                ->schema(SectionFormSchemas::forType(
                                    $section->section_type,
                                    "sections.{$section->section_key}"
                                ))
                        )->toArray()
                    )
                    ->persistTabInQueryString(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ($state['sections'] ?? [] as $key => $sectionData) {
            $this->record->sections()
                ->where('section_key', $key)
                ->update(['content' => $sectionData['content'] ?? []]);
        }

        Notification::make()
            ->title('Home page updated')
            ->success()
            ->send();
    }
}
