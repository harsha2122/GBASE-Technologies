<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InquiryResource\Pages;
use App\Models\Inquiry;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationGroup = 'Leads';

    protected static ?string $navigationLabel = 'Inquiries';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('is_handled', false)->count() ?: null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Contact Details')
                    ->columns(2)
                    ->schema([
                        TextInput::make('company')->required(),
                        TextInput::make('name')->required(),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('phone')->required(),
                        TextInput::make('city'),
                        TextInput::make('country'),
                        TextInput::make('website'),
                        TextInput::make('page_source')->label('Submitted From')->disabled(),
                    ]),
                Section::make('Requirement')
                    ->columns(2)
                    ->schema([
                        Textarea::make('message')->columnSpanFull()->rows(4)->required(),
                        TextInput::make('business_type'),
                        TextInput::make('production')->label('Estimated Production'),
                        TextInput::make('product_type'),
                        TextInput::make('equipment_interest'),
                        TextInput::make('referral')->label('How They Found Us'),
                    ]),
                Section::make('Equipment Selections')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('product_types')->label('Product Types')->disabled()->dehydrated(false)
                            ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state),
                        TextInput::make('pre_process')->label('Pre-Process')->disabled()->dehydrated(false)
                            ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state),
                        TextInput::make('freezing_equipment')->label('Freezing Equipment')->disabled()->dehydrated(false)
                            ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state),
                        TextInput::make('heating_equipment')->label('Heating Equipment')->disabled()->dehydrated(false)
                            ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state),
                        TextInput::make('equipment_options')->label('Sorting Options')->disabled()->dehydrated(false)
                            ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state),
                    ]),
                Section::make('Status')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_handled')->label('Marked as Handled'),
                        DateTimePicker::make('created_at')->label('Received At')->disabled(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->label('Received')->dateTime('d M Y, H:i')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('company')->searchable(),
                TextColumn::make('email')->searchable()->copyable(),
                TextColumn::make('phone')->copyable(),
                TextColumn::make('page_source')->label('Source')->badge(),
                TextColumn::make('message')->limit(40)->tooltip(fn ($record) => $record->message),
                IconColumn::make('is_handled')->label('Handled')->boolean()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('is_handled')->label('Handled'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageInquiries::route('/'),
        ];
    }
}
