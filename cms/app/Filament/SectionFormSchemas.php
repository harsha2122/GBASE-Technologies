<?php

namespace App\Filament;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

/**
 * Builds the Filament form schema for each Home page section type.
 * Every image field uses Filament's own FileUpload preview, so seeded
 * default images are copied onto the `public` disk at seed time
 * (see HomePageSeeder) rather than left as raw theme asset paths -
 * FileUpload can only preview files it manages on its configured disk.
 *
 * Fields are named with the section's full state-path prefix
 * (e.g. "sections.hero.content.heading") rather than relying on
 * Tab-level statePath nesting, which Filament does not propagate
 * reliably to descendant fields.
 */
class SectionFormSchemas
{
    public static function forType(string $type, string $prefix): array
    {
        $c = fn (string $field) => "{$prefix}.content.{$field}";

        return match ($type) {
            'hero' => [
                TextInput::make($c('heading'))->label('Heading')->required(),
                Textarea::make($c('description'))->label('Description')->rows(2),
                static::imageField($c('image'), 'Hero Image'),
                TextInput::make($c('primary_button_text'))->label('Primary Button Text'),
                TextInput::make($c('primary_button_link'))->label('Primary Button Link'),
                TextInput::make($c('secondary_button_text'))->label('Secondary Button Text'),
                TextInput::make($c('secondary_button_link'))->label('Secondary Button Link'),
            ],

            'product_grid' => [
                TextInput::make($c('short_title'))->label('Small Label')->required(),
                TextInput::make($c('heading'))->label('Heading')->required(),
                Textarea::make($c('description'))->label('Description')->rows(2),
                TextInput::make($c('view_all_link'))->label('"View All" Button Link'),
                Repeater::make($c('items'))
                    ->label('Equipment Cards')
                    ->schema([
                        TextInput::make('title')->label('Title')->required(),
                        TextInput::make('subtitle')->label('Subtitle'),
                        static::imageField('image', 'Card Image'),
                        Textarea::make('quote')->label('Quote')->rows(2),
                        Textarea::make('caption')->label('Caption')->rows(2),
                        TextInput::make('link')->label('"Learn More" Link'),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->collapsed()
                    ->reorderable()
                    ->addActionLabel('Add Equipment Card'),
            ],

            'map_stats' => [
                TextInput::make($c('short_title'))->label('Small Label'),
                TextInput::make($c('heading'))->label('Heading')->required(),
                static::imageField($c('image'), 'Map Image'),
            ],

            'about' => [
                TextInput::make($c('short_title'))->label('Small Label'),
                TextInput::make($c('heading'))->label('Heading')->required(),
                Textarea::make($c('description'))->label('Description')->rows(4),
                static::imageField($c('image'), 'Main Image'),
                TextInput::make($c('badge_title'))->label('Badge Title (e.g. "20+ Years")'),
                Textarea::make($c('badge_description'))->label('Badge Description')->rows(2),
                Repeater::make($c('feature_cards'))
                    ->label('Feature Cards')
                    ->schema([
                        static::imageField('icon', 'Icon'),
                        TextInput::make('title')->label('Title')->required(),
                        Textarea::make('description')->label('Description')->rows(2),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->collapsed(),
            ],

            'contact_cta' => [
                TextInput::make($c('heading'))->label('Heading')->required(),
                static::imageField($c('image'), 'Image'),
            ],

            'page_header' => [
                TextInput::make($c('heading'))->label('Page Heading')->required(),
            ],

            'domain_scope_services' => [
                TextInput::make($c('domain_heading'))->label('Domain Card Heading')->required(),
                Repeater::make($c('domain_items'))
                    ->label('Domain Items')
                    ->schema([
                        TextInput::make('label')->label('Label')->required(),
                        TextInput::make('description')->label('Description')->required(),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                    ->collapsed(),

                TextInput::make($c('scope_heading'))->label('Scope Card Heading')->required(),
                Repeater::make($c('scope_paragraphs'))
                    ->label('Scope Paragraphs')
                    ->simple(
                        Textarea::make('text')->rows(2)->required()
                    ),

                TextInput::make($c('services_heading'))->label('Services Card Heading')->required(),
                Repeater::make($c('services'))
                    ->label('Services')
                    ->schema([
                        TextInput::make('title')->label('Title')->required(),
                        Textarea::make('description')->label('Description')->rows(2)->required(),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->collapsed()
                    ->reorderable()
                    ->addActionLabel('Add Service'),
            ],

            'logo_slider' => [
                TextInput::make($c('heading'))->label('Heading')->required(),
                Repeater::make($c('logos'))
                    ->label('Client Logos')
                    ->schema([
                        static::imageField('image', 'Logo'),
                    ])
                    ->itemLabel(function (array $state): string {
                        $image = $state['image'] ?? null;
                        $path = is_array($image) ? collect($image)->first() : $image;

                        return is_string($path) ? basename($path) : 'Logo';
                    })
                    ->collapsed()
                    ->reorderable()
                    ->addActionLabel('Add Logo')
                    ->grid(3),
            ],

            default => [],
        };
    }

    protected static function imageField(string $name, string $label): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->image()
            ->disk('public')
            ->directory('sections')
            ->imagePreviewHeight('120')
            ->visibility('public')
            ->downloadable()
            ->openable();
    }
}
