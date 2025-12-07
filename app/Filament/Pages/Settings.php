<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 2;
    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            // General
            'site_name' => Setting::get('site_name', ['en' => '', 'vi' => '']),
            'site_tagline' => Setting::get('site_tagline', ['en' => '', 'vi' => '']),
            // Contact
            'contact_phone' => Setting::get('contact_phone', ''),
            'contact_email' => Setting::get('contact_email', ''),
            'contact_address' => Setting::get('contact_address', ['en' => '', 'vi' => '']),
            // Social
            'facebook_url' => Setting::get('facebook_url', ''),
            'twitter_url' => Setting::get('twitter_url', ''),
            'instagram_url' => Setting::get('instagram_url', ''),
            'youtube_url' => Setting::get('youtube_url', ''),
            'tiktok_url' => Setting::get('tiktok_url', ''),
            // Branding
            'header_logo' => Setting::get('header_logo', ''),
            'footer_logo' => Setting::get('footer_logo', ''),
            'favicon' => Setting::get('favicon', ''),
            'og_image' => Setting::get('og_image', ''),
            // SEO
            'meta_title' => Setting::get('meta_title', ['en' => '', 'vi' => '']),
            'meta_description' => Setting::get('meta_description', ['en' => '', 'vi' => '']),
            // Analytics
            'google_analytics_id' => Setting::get('google_analytics_id', ''),
            'google_tag_manager_id' => Setting::get('google_tag_manager_id', ''),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section 1: General Settings
                Forms\Components\Section::make('General Settings')
                    ->description('Basic site information')
                    ->schema([
                        Forms\Components\TextInput::make('site_name.en')
                            ->label('Site Name (English)')
                            ->required(),
                        Forms\Components\TextInput::make('site_name.vi')
                            ->label('Site Name (Vietnamese)')
                            ->required(),
                        Forms\Components\TextInput::make('site_tagline.en')
                            ->label('Tagline (English)'),
                        Forms\Components\TextInput::make('site_tagline.vi')
                            ->label('Tagline (Vietnamese)'),
                    ])->columns(2),

                // Section 2: Contact Information
                Forms\Components\Section::make('Contact Information')
                    ->description('Contact details shown in header, footer, and contact page')
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

                // Section 3: Social Media
                Forms\Components\Section::make('Social Media')
                    ->description('Social media profile links')
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

                // Section 4: Branding & Media
                Forms\Components\Section::make('Branding & Media')
                    ->description('Upload site logos, favicon, and default images')
                    ->schema([
                        Forms\Components\FileUpload::make('header_logo')
                            ->label('Header Logo')
                            ->image()
                            ->directory('settings/logos')
                            ->visibility('public')
                            ->helperText('Recommended: PNG with transparency, max height 60px'),
                        Forms\Components\FileUpload::make('footer_logo')
                            ->label('Footer Logo')
                            ->image()
                            ->directory('settings/logos')
                            ->visibility('public')
                            ->helperText('White/light version for dark footer background'),
                        Forms\Components\FileUpload::make('favicon')
                            ->label('Favicon')
                            ->directory('settings/favicons')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/svg+xml'])
                            ->helperText('ICO, PNG, or SVG. Recommended: 32x32 or 180x180 pixels'),
                        Forms\Components\FileUpload::make('og_image')
                            ->label('Default OG Image')
                            ->image()
                            ->directory('settings/og-images')
                            ->visibility('public')
                            ->helperText('Recommended: 1200x630 pixels. Used when pages have no custom image.'),
                    ])->columns(2),

                // Section 5: SEO Settings
                Forms\Components\Section::make('SEO Settings')
                    ->description('Default SEO meta tags for pages without custom settings')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title.en')
                            ->label('Default Meta Title (English)')
                            ->maxLength(60)
                            ->helperText('Recommended: 50-60 characters'),
                        Forms\Components\TextInput::make('meta_title.vi')
                            ->label('Default Meta Title (Vietnamese)')
                            ->maxLength(60),
                        Forms\Components\Textarea::make('meta_description.en')
                            ->label('Default Meta Description (English)')
                            ->rows(2)
                            ->maxLength(160)
                            ->helperText('Recommended: 150-160 characters'),
                        Forms\Components\Textarea::make('meta_description.vi')
                            ->label('Default Meta Description (Vietnamese)')
                            ->rows(2)
                            ->maxLength(160),
                    ])->columns(2),

                // Section 5: Analytics
                Forms\Components\Section::make('Analytics & Tracking')
                    ->description('Google Analytics and Tag Manager integration')
                    ->schema([
                        Forms\Components\TextInput::make('google_analytics_id')
                            ->label('Google Analytics 4 Measurement ID')
                            ->placeholder('G-XXXXXXXXXX')
                            ->helperText('Found in GA4 > Admin > Data Streams'),
                        Forms\Components\TextInput::make('google_tag_manager_id')
                            ->label('Google Tag Manager ID')
                            ->placeholder('GTM-XXXXXXX')
                            ->helperText('Found in GTM > Admin > Container Settings'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // General
        Setting::set('site_name', $data['site_name'], 'general');
        Setting::set('site_tagline', $data['site_tagline'], 'general');

        // Contact
        Setting::set('contact_phone', $data['contact_phone'], 'contact');
        Setting::set('contact_email', $data['contact_email'], 'contact');
        Setting::set('contact_address', $data['contact_address'], 'contact');

        // Social
        Setting::set('facebook_url', $data['facebook_url'], 'social');
        Setting::set('twitter_url', $data['twitter_url'], 'social');
        Setting::set('instagram_url', $data['instagram_url'], 'social');
        Setting::set('youtube_url', $data['youtube_url'], 'social');
        Setting::set('tiktok_url', $data['tiktok_url'], 'social');

        // Branding
        Setting::set('header_logo', $data['header_logo'], 'branding');
        Setting::set('footer_logo', $data['footer_logo'], 'branding');
        Setting::set('favicon', $data['favicon'], 'branding');
        Setting::set('og_image', $data['og_image'], 'branding');

        // SEO
        Setting::set('meta_title', $data['meta_title'], 'seo');
        Setting::set('meta_description', $data['meta_description'], 'seo');

        // Analytics
        Setting::set('google_analytics_id', $data['google_analytics_id'], 'analytics');
        Setting::set('google_tag_manager_id', $data['google_tag_manager_id'], 'analytics');

        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }
}
