<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Setting::current()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Branding')
                    ->description('The logo shown in the site header, footer, and admin sidebar.')
                    ->schema([
                        FileUpload::make('site_logo')
                            ->label('Site Logo')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->imagePreviewHeight('80'),
                    ]),

                Section::make('Contact Details')
                    ->description('Shown in the top bar, floating buttons, and mobile menu on every page.')
                    ->schema([
                        TextInput::make('topbar_phone')->label('Displayed Phone Number'),
                        TextInput::make('topbar_email')->label('Displayed Email')->email(),
                        TextInput::make('whatsapp_number')->label('WhatsApp Number (digits only, with country code)'),
                        TextInput::make('float_call_number')->label('Floating "Call" Button Number'),
                    ])
                    ->columns(2),

                Section::make('Social Links')
                    ->schema([
                        TextInput::make('facebook_url')->label('Facebook URL')->url(),
                        TextInput::make('instagram_url')->label('Instagram URL')->url(),
                        TextInput::make('youtube_url')->label('YouTube URL')->url(),
                        TextInput::make('linkedin_url')->label('LinkedIn URL')->url(),
                    ])
                    ->columns(2),

                Section::make('Footer')
                    ->schema([
                        Textarea::make('footer_about_text')->label('About Text')->rows(3)->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        Setting::current()->update($this->form->getState());

        Notification::make()
            ->title('Settings updated')
            ->success()
            ->send();
    }
}
