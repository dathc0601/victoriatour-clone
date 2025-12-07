<?php

namespace App\Filament\Pages;

use App\Models\Destination;
use App\Models\FooterColumn;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class FooterSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationLabel = 'Footer';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 3;
    protected static ?string $slug = 'footer';
    protected static string $view = 'filament.pages.footer-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            // Branding
            'footer_logo' => Setting::get('footer_logo', ''),
            'footer_copyright_text' => Setting::get('footer_copyright_text', [
                'en' => 'Victoria General Trading and Tourism Co., Ltd. All Rights Reserved.',
                'vi' => 'Công ty TNHH Victoria. Bản quyền thuộc về Victoria Tour.',
            ]),

            // Contact Info
            'contact_phone' => Setting::get('contact_phone', ''),
            'contact_email' => Setting::get('contact_email', ''),
            'contact_address' => Setting::get('contact_address', ['en' => '', 'vi' => '']),

            // Social Media
            'facebook_url' => Setting::get('facebook_url', ''),
            'twitter_url' => Setting::get('twitter_url', ''),
            'instagram_url' => Setting::get('instagram_url', ''),
            'youtube_url' => Setting::get('youtube_url', ''),
            'tiktok_url' => Setting::get('tiktok_url', ''),

            // Destinations
            'footer_selected_destinations' => Setting::get('footer_selected_destinations', []),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Footer Settings')
                    ->tabs([
                        // Tab 1: Branding
                        Forms\Components\Tabs\Tab::make('Branding')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Footer Logo')
                                    ->description('Upload the logo displayed in the footer')
                                    ->schema([
                                        Forms\Components\FileUpload::make('footer_logo')
                                            ->label('Footer Logo')
                                            ->image()
                                            ->directory('settings/logos')
                                            ->visibility('public')
                                            ->helperText('White/light version for dark footer background. Recommended: PNG with transparency.'),
                                    ]),

                                Forms\Components\Section::make('Copyright Text')
                                    ->description('Copyright notice shown at the bottom of the footer')
                                    ->schema([
                                        Forms\Components\TextInput::make('footer_copyright_text.en')
                                            ->label('Copyright Text (English)')
                                            ->maxLength(255)
                                            ->required(),
                                        Forms\Components\TextInput::make('footer_copyright_text.vi')
                                            ->label('Copyright Text (Vietnamese)')
                                            ->maxLength(255)
                                            ->required(),
                                    ])->columns(2),
                            ]),

                        // Tab 2: Contact Info
                        Forms\Components\Tabs\Tab::make('Contact Info')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\Section::make('Contact Details')
                                    ->description('Contact information displayed in the footer')
                                    ->schema([
                                        Forms\Components\TextInput::make('contact_phone')
                                            ->label('Phone Number')
                                            ->tel()
                                            ->required(),
                                        Forms\Components\TextInput::make('contact_email')
                                            ->label('Email Address')
                                            ->email()
                                            ->required(),
                                        Forms\Components\TextInput::make('contact_address.en')
                                            ->label('Address (English)')
                                            ->required(),
                                        Forms\Components\TextInput::make('contact_address.vi')
                                            ->label('Address (Vietnamese)')
                                            ->required(),
                                    ])->columns(2),
                            ]),

                        // Tab 3: Social Media
                        Forms\Components\Tabs\Tab::make('Social Media')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Forms\Components\Section::make('Social Media Links')
                                    ->description('Links to your social media profiles')
                                    ->schema([
                                        Forms\Components\TextInput::make('facebook_url')
                                            ->label('Facebook URL')
                                            ->url()
                                            ->placeholder('https://facebook.com/yourpage'),
                                        Forms\Components\TextInput::make('twitter_url')
                                            ->label('X (Twitter) URL')
                                            ->url()
                                            ->placeholder('https://x.com/yourhandle'),
                                        Forms\Components\TextInput::make('instagram_url')
                                            ->label('Instagram URL')
                                            ->url()
                                            ->placeholder('https://instagram.com/yourprofile'),
                                        Forms\Components\TextInput::make('youtube_url')
                                            ->label('YouTube URL')
                                            ->url()
                                            ->placeholder('https://youtube.com/@yourchannel'),
                                        Forms\Components\TextInput::make('tiktok_url')
                                            ->label('TikTok URL')
                                            ->url()
                                            ->placeholder('https://tiktok.com/@yourprofile'),
                                    ])->columns(2),
                            ]),

                        // Tab 4: Destinations
                        Forms\Components\Tabs\Tab::make('Destinations')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Forms\Components\Section::make('Footer Destinations')
                                    ->description('Select which destinations to display in the footer')
                                    ->schema([
                                        Forms\Components\Select::make('footer_selected_destinations')
                                            ->label('Select Destinations')
                                            ->multiple()
                                            ->options(fn () => Destination::active()->ordered()->pluck('name', 'id'))
                                            ->searchable()
                                            ->preload()
                                            ->helperText('Select destinations to show in footer. Leave empty to show none.'),
                                    ]),
                            ]),

                        // Tab 5: Column Layout
                        Forms\Components\Tabs\Tab::make('Column Layout')
                            ->icon('heroicon-o-view-columns')
                            ->schema([
                                Forms\Components\Placeholder::make('column_info')
                                    ->label('')
                                    ->content('Manage footer column layout below. Add, remove, and reorder columns as needed.'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Branding
        Setting::set('footer_logo', $data['footer_logo'], 'branding');
        Setting::set('footer_copyright_text', $data['footer_copyright_text'], 'footer');

        // Contact (also updates main Settings page)
        Setting::set('contact_phone', $data['contact_phone'], 'contact');
        Setting::set('contact_email', $data['contact_email'], 'contact');
        Setting::set('contact_address', $data['contact_address'], 'contact');

        // Social (also updates main Settings page)
        Setting::set('facebook_url', $data['facebook_url'], 'social');
        Setting::set('twitter_url', $data['twitter_url'], 'social');
        Setting::set('instagram_url', $data['instagram_url'], 'social');
        Setting::set('youtube_url', $data['youtube_url'], 'social');
        Setting::set('tiktok_url', $data['tiktok_url'], 'social');

        // Destinations
        Setting::set('footer_selected_destinations', $data['footer_selected_destinations'], 'footer');

        // Clear footer cache
        foreach (['en', 'vi'] as $locale) {
            cache()->forget("footer_columns_{$locale}");
        }

        Notification::make()
            ->title('Footer settings saved successfully')
            ->success()
            ->send();
    }
}
