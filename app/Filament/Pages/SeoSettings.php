<?php

namespace App\Filament\Pages;

use App\Models\SeoPageOverride;
use App\Models\SeoRedirect;
use App\Models\Setting;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SeoSettings extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass';
    protected static ?int $navigationSort = 4;
    protected static ?string $slug = 'seo';
    protected static string $view = 'filament.pages.seo-settings';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav_groups.settings');
    }

    public static function getNavigationLabel(): string
    {
        return 'Cài đặt SEO';
    }

    public function getTitle(): string
    {
        return 'Cài đặt SEO';
    }

    public ?array $data = [];
    public string $activeTab = 'global';

    public function mount(): void
    {
        $this->form->fill([
            // Search Engine Settings
            'seo_robots_txt' => Setting::get('seo_robots_txt', "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml')),
            'seo_google_verification' => Setting::get('seo_google_verification', ''),
            'seo_bing_verification' => Setting::get('seo_bing_verification', ''),

            // Social Media
            'seo_facebook_app_id' => Setting::get('seo_facebook_app_id', ''),
            'seo_twitter_site' => Setting::get('seo_twitter_site', ''),

            // Schema.org
            'seo_schema_org_name' => Setting::get('seo_schema_org_name', ''),
            'seo_schema_org_logo' => Setting::get('seo_schema_org_logo', ''),
            'seo_schema_type' => Setting::get('seo_schema_type', 'Organization'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Search Engine Settings
                Forms\Components\Section::make('Cài đặt công cụ tìm kiếm')
                    ->description('Cấu hình robots.txt và mã xác minh công cụ tìm kiếm')
                    ->schema([
                        Forms\Components\Textarea::make('seo_robots_txt')
                            ->label('Nội dung Robots.txt')
                            ->rows(8)
                            ->helperText('Nội dung này sẽ được hiển thị tại /robots.txt'),

                        Forms\Components\TextInput::make('seo_google_verification')
                            ->label('Xác minh Google')
                            ->placeholder('Giá trị content của google-site-verification')
                            ->helperText('Giá trị content từ thẻ meta xác minh Google Search Console'),

                        Forms\Components\TextInput::make('seo_bing_verification')
                            ->label('Xác minh Bing')
                            ->placeholder('Giá trị content của msvalidate.01')
                            ->helperText('Giá trị content từ thẻ meta xác minh Bing Webmaster Tools'),
                    ])->columns(1),

                // Social Media
                Forms\Components\Section::make('SEO mạng xã hội')
                    ->description('Cấu hình tích hợp mạng xã hội để chia sẻ tốt hơn')
                    ->schema([
                        Forms\Components\TextInput::make('seo_facebook_app_id')
                            ->label('Facebook App ID')
                            ->placeholder('1234567890')
                            ->helperText('Facebook App ID để tối ưu thẻ OG'),

                        Forms\Components\TextInput::make('seo_twitter_site')
                            ->label('Tài khoản Twitter')
                            ->placeholder('@taikhoan')
                            ->helperText('Tài khoản Twitter/X cho Twitter Cards'),
                    ])->columns(2),

                // Schema.org
                Forms\Components\Section::make('Cài đặt Schema.org')
                    ->description('Cấu hình dữ liệu có cấu trúc cho công cụ tìm kiếm')
                    ->schema([
                        Forms\Components\Select::make('seo_schema_type')
                            ->label('Loại tổ chức')
                            ->options([
                                'Organization' => 'Tổ chức',
                                'LocalBusiness' => 'Doanh nghiệp địa phương',
                                'TravelAgency' => 'Đại lý du lịch',
                            ])
                            ->default('Organization'),

                        Forms\Components\TextInput::make('seo_schema_org_name')
                            ->label('Tên tổ chức')
                            ->placeholder('Tên công ty của bạn')
                            ->helperText('Tên sử dụng trong dữ liệu JSON-LD'),

                        Forms\Components\FileUpload::make('seo_schema_org_logo')
                            ->label('Logo tổ chức')
                            ->image()
                            ->disk(config('filesystems.default'))
                            ->directory('settings/seo')
                            ->visibility('public')
                            ->helperText('Logo sử dụng trong dữ liệu JSON-LD'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(SeoPageOverride::query())
            ->columns([
                Tables\Columns\TextColumn::make('url_path')
                    ->label('Đường dẫn URL')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->limit(30)
                    ->getStateUsing(fn ($record) => $record->getTranslation('title', 'en') ?? '-'),
                Tables\Columns\IconColumn::make('is_wildcard')
                    ->label('Ký tự đại diện')
                    ->boolean()
                    ->trueIcon('heroicon-o-sparkles')
                    ->falseIcon('heroicon-o-minus'),
                Tables\Columns\TextColumn::make('priority')
                    ->label('Ưu tiên')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Kích hoạt'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_wildcard')
                    ->label('Loại')
                    ->placeholder('Tất cả')
                    ->trueLabel('Chỉ ký tự đại diện')
                    ->falseLabel('Chỉ chính xác'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Trạng thái')
                    ->placeholder('Tất cả')
                    ->trueLabel('Chỉ đang hoạt động')
                    ->falseLabel('Chỉ không hoạt động'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Sửa')
                    ->form($this->getPageOverrideFormSchema())
                    ->modalHeading('Chỉnh sửa ghi đè SEO trang'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Thêm ghi đè trang')
                    ->form($this->getPageOverrideFormSchema())
                    ->modalHeading('Tạo ghi đè SEO trang')
                    ->using(function (array $data): SeoPageOverride {
                        // Auto-detect if wildcard
                        $data['is_wildcard'] = str_contains($data['url_path'], '*');
                        return SeoPageOverride::create($data);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa'),
                ]),
            ])
            ->defaultSort('priority', 'desc')
            ->emptyStateHeading('Chưa có ghi đè trang')
            ->emptyStateDescription('Tạo ghi đè SEO trang đầu tiên để tùy chỉnh metadata cho các trang cụ thể.');
    }

    protected function getPageOverrideFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('url_path')
                ->label('Đường dẫn URL')
                ->required()
                ->placeholder('/destinations hoặc /tours/*')
                ->helperText('Sử dụng * cho ký tự đại diện (ví dụ: /tours/* khớp với tất cả trang tour)')
                ->maxLength(255),

            Forms\Components\TextInput::make('priority')
                ->label('Mức ưu tiên')
                ->numeric()
                ->default(0)
                ->helperText('Mức ưu tiên cao hơn sẽ được áp dụng khi có nhiều mẫu khớp'),

            Forms\Components\Tabs::make('Translations')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Tiếng Anh')
                        ->schema([
                            Forms\Components\TextInput::make('title.en')
                                ->label('Tiêu đề trang')
                                ->maxLength(60)
                                ->helperText('Khuyến nghị: 50-60 ký tự'),
                            Forms\Components\TextInput::make('meta_title.en')
                                ->label('Meta Title')
                                ->maxLength(60),
                            Forms\Components\Textarea::make('meta_description.en')
                                ->label('Meta Description')
                                ->rows(2)
                                ->maxLength(160)
                                ->helperText('Khuyến nghị: 150-160 ký tự'),
                            Forms\Components\TextInput::make('og_title.en')
                                ->label('OG Title')
                                ->maxLength(95),
                            Forms\Components\Textarea::make('og_description.en')
                                ->label('OG Description')
                                ->rows(2)
                                ->maxLength(200),
                        ]),
                    Forms\Components\Tabs\Tab::make('Tiếng Việt')
                        ->schema([
                            Forms\Components\TextInput::make('title.vi')
                                ->label('Tiêu đề trang')
                                ->maxLength(60),
                            Forms\Components\TextInput::make('meta_title.vi')
                                ->label('Meta Title')
                                ->maxLength(60),
                            Forms\Components\Textarea::make('meta_description.vi')
                                ->label('Meta Description')
                                ->rows(2)
                                ->maxLength(160),
                            Forms\Components\TextInput::make('og_title.vi')
                                ->label('OG Title')
                                ->maxLength(95),
                            Forms\Components\Textarea::make('og_description.vi')
                                ->label('OG Description')
                                ->rows(2)
                                ->maxLength(200),
                        ]),
                ])
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('og_image')
                ->label('Hình ảnh OG')
                ->image()
                ->disk(config('filesystems.default'))
                ->directory('seo/og-images')
                ->visibility('public')
                ->helperText('Khuyến nghị: 1200x630 pixels'),

            Forms\Components\Select::make('meta_robots')
                ->label('Meta Robots')
                ->options([
                    '' => 'Mặc định (index, follow)',
                    'noindex' => 'noindex',
                    'nofollow' => 'nofollow',
                    'noindex, nofollow' => 'noindex, nofollow',
                    'noarchive' => 'noarchive',
                ])
                ->placeholder('Mặc định (index, follow)'),

            Forms\Components\TextInput::make('canonical_url')
                ->label('URL chuẩn')
                ->url()
                ->placeholder('https://example.com/page')
                ->helperText('Để trống để sử dụng URL của trang'),

            Forms\Components\Toggle::make('is_active')
                ->label('Kích hoạt')
                ->default(true),
        ];
    }

    public function saveGlobalSettings(): void
    {
        $data = $this->form->getState();

        // Search Engine Settings
        Setting::set('seo_robots_txt', $data['seo_robots_txt'], 'seo');
        Setting::set('seo_google_verification', $data['seo_google_verification'], 'seo');
        Setting::set('seo_bing_verification', $data['seo_bing_verification'], 'seo');

        // Social Media
        Setting::set('seo_facebook_app_id', $data['seo_facebook_app_id'], 'seo');
        Setting::set('seo_twitter_site', $data['seo_twitter_site'], 'seo');

        // Schema.org
        Setting::set('seo_schema_org_name', $data['seo_schema_org_name'], 'seo');
        Setting::set('seo_schema_org_logo', $data['seo_schema_org_logo'], 'seo');
        Setting::set('seo_schema_type', $data['seo_schema_type'], 'seo');

        Notification::make()
            ->title('Đã lưu cài đặt SEO toàn cục thành công')
            ->success()
            ->send();
    }

    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
    }
}
