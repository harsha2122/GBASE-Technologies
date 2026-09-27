<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Pages';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')->required(),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            TextInput::make('meta_title')->label('SEO Title')->maxLength(255),
            Textarea::make('meta_description')->label('SEO Description')->rows(3),
            Toggle::make('is_published')->label('Published')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable(),
                TextColumn::make('slug')->badge(),
                TextColumn::make('sections_count')->counts('sections')->label('Sections'),
                IconColumn::make('is_published')->label('Published')->boolean(),
                TextColumn::make('updated_at')->dateTime()->label('Last Updated')->since(),
            ])
            ->actions([
                Action::make('editContent')
                    ->label('Edit Content')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->url(fn (Page $record): string => Pages\EditPageSections::getUrl(['record' => $record])),
                EditAction::make()->label('Page Settings'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
            'edit-sections' => Pages\EditPageSections::route('/{record}/sections'),
        ];
    }
}
