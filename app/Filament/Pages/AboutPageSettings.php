<?php

namespace App\Filament\Pages;

use App\Models\AboutPage;
use App\Models\AboutStrength;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class AboutPageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationGroup = 'Pages';
    protected static ?string $navigationLabel = 'About Page';
    protected static ?int $navigationSort = 2;
    protected static string $view = 'filament.pages.about-page-settings';

    public ?array $data = [];
    public ?array $strengthsData = [];

    public function mount(): void
    {
        $about = AboutPage::getContent();
        $strengths = AboutStrength::ordered()->get();

        $this->form->fill([
            // Hero Section
            'hero_category_en' => $about->getTranslation('hero_category', 'en', false) ?? '',
            'hero_category_vi' => $about->getTranslation('hero_category', 'vi', false) ?? '',
            'hero_line1_en' => $about->getTranslation('hero_line1', 'en', false) ?? '',
            'hero_line1_vi' => $about->getTranslation('hero_line1', 'vi', false) ?? '',
            'hero_line2_en' => $about->getTranslation('hero_line2', 'en', false) ?? '',
            'hero_line2_vi' => $about->getTranslation('hero_line2', 'vi', false) ?? '',
            'hero_line3_en' => $about->getTranslation('hero_line3', 'en', false) ?? '',
            'hero_line3_vi' => $about->getTranslation('hero_line3', 'vi', false) ?? '',
            'hero_subtitle_en' => $about->getTranslation('hero_subtitle', 'en', false) ?? '',
            'hero_subtitle_vi' => $about->getTranslation('hero_subtitle', 'vi', false) ?? '',

            // Story Section
            'story_title_en' => $about->getTranslation('story_title', 'en', false) ?? '',
            'story_title_vi' => $about->getTranslation('story_title', 'vi', false) ?? '',
            'story_content_en' => $about->getTranslation('story_content', 'en', false) ?? '',
            'story_content_vi' => $about->getTranslation('story_content', 'vi', false) ?? '',

            // Mission Section
            'mission_title_en' => $about->getTranslation('mission_title', 'en', false) ?? '',
            'mission_title_vi' => $about->getTranslation('mission_title', 'vi', false) ?? '',
            'mission_content_en' => $about->getTranslation('mission_content', 'en', false) ?? '',
            'mission_content_vi' => $about->getTranslation('mission_content', 'vi', false) ?? '',

            // Vision Section
            'vision_title_en' => $about->getTranslation('vision_title', 'en', false) ?? '',
            'vision_title_vi' => $about->getTranslation('vision_title', 'vi', false) ?? '',
            'vision_content_en' => $about->getTranslation('vision_content', 'en', false) ?? '',
            'vision_content_vi' => $about->getTranslation('vision_content', 'vi', false) ?? '',

            // Stats
            'stat1_number' => $about->stat1_number ?? '15+',
            'stat1_label_en' => $about->getTranslation('stat1_label', 'en', false) ?? '',
            'stat1_label_vi' => $about->getTranslation('stat1_label', 'vi', false) ?? '',
            'stat2_number' => $about->stat2_number ?? '5000+',
            'stat2_label_en' => $about->getTranslation('stat2_label', 'en', false) ?? '',
            'stat2_label_vi' => $about->getTranslation('stat2_label', 'vi', false) ?? '',
            'stat3_number' => $about->stat3_number ?? '50+',
            'stat3_label_en' => $about->getTranslation('stat3_label', 'en', false) ?? '',
            'stat3_label_vi' => $about->getTranslation('stat3_label', 'vi', false) ?? '',
            'stat4_number' => $about->stat4_number ?? '100%',
            'stat4_label_en' => $about->getTranslation('stat4_label', 'en', false) ?? '',
            'stat4_label_vi' => $about->getTranslation('stat4_label', 'vi', false) ?? '',

            // SEO
            'meta_title_en' => $about->getTranslation('meta_title', 'en', false) ?? '',
            'meta_title_vi' => $about->getTranslation('meta_title', 'vi', false) ?? '',
            'meta_description_en' => $about->getTranslation('meta_description', 'en', false) ?? '',
            'meta_description_vi' => $about->getTranslation('meta_description', 'vi', false) ?? '',

            // Strengths
            'strengths' => $strengths->map(fn ($s) => [
                'id' => $s->id,
                'title_en' => $s->getTranslation('title', 'en', false) ?? '',
                'title_vi' => $s->getTranslation('title', 'vi', false) ?? '',
                'description_en' => $s->getTranslation('description', 'en', false) ?? '',
                'description_vi' => $s->getTranslation('description', 'vi', false) ?? '',
                'is_active' => $s->is_active,
            ])->toArray(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('About Page')
                    ->tabs([
                        // Tab 1: Hero Section
                        Forms\Components\Tabs\Tab::make('Hero')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Hero Content')
                                    ->description('The main hero section at the top of the About page')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('hero_category_en')
                                                    ->label('Category Label (English)')
                                                    ->placeholder('About Victoria Tour'),
                                                Forms\Components\TextInput::make('hero_category_vi')
                                                    ->label('Category Label (Vietnamese)')
                                                    ->placeholder('Về Victoria Tour'),
                                            ]),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('hero_line1_en')
                                                    ->label('Headline Line 1 (English)')
                                                    ->placeholder('YOUR TRUSTED'),
                                                Forms\Components\TextInput::make('hero_line1_vi')
                                                    ->label('Headline Line 1 (Vietnamese)')
                                                    ->placeholder('ĐỐI TÁC DU LỊCH'),
                                            ]),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('hero_line2_en')
                                                    ->label('Headline Line 2 (English)')
                                                    ->placeholder('TRAVEL PARTNER'),
                                                Forms\Components\TextInput::make('hero_line2_vi')
                                                    ->label('Headline Line 2 (Vietnamese)')
                                                    ->placeholder('ĐÁNG TIN CẬY'),
                                            ]),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('hero_line3_en')
                                                    ->label('Headline Line 3 (English)')
                                                    ->placeholder('SINCE 2010'),
                                                Forms\Components\TextInput::make('hero_line3_vi')
                                                    ->label('Headline Line 3 (Vietnamese)')
                                                    ->placeholder('TỪ NĂM 2010'),
                                            ]),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Textarea::make('hero_subtitle_en')
                                                    ->label('Subtitle (English)')
                                                    ->rows(2)
                                                    ->placeholder('We create unforgettable journeys...'),
                                                Forms\Components\Textarea::make('hero_subtitle_vi')
                                                    ->label('Subtitle (Vietnamese)')
                                                    ->rows(2)
                                                    ->placeholder('Chúng tôi tạo nên những chuyến đi...'),
                                            ]),
                                    ]),
                                Forms\Components\Section::make('Hero Image')
                                    ->description('Full-width image displayed below the hero text')
                                    ->schema([
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('hero_image')
                                            ->collection('hero_image')
                                            ->model(fn () => AboutPage::firstOrCreate([]))
                                            ->image()
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('16:9')
                                            ->helperText('Recommended: 1920x1080 pixels. Will be displayed with a slight grayscale filter.'),
                                    ]),
                            ]),

                        // Tab 2: Story & Mission
                        Forms\Components\Tabs\Tab::make('Story & Mission')
                            ->icon('heroicon-o-book-open')
                            ->schema([
                                Forms\Components\Section::make('Our Story')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('story_title_en')
                                                    ->label('Title (English)')
                                                    ->placeholder('Our Story'),
                                                Forms\Components\TextInput::make('story_title_vi')
                                                    ->label('Title (Vietnamese)')
                                                    ->placeholder('Câu Chuyện Của Chúng Tôi'),
                                            ]),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\RichEditor::make('story_content_en')
                                                    ->label('Content (English)')
                                                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList']),
                                                Forms\Components\RichEditor::make('story_content_vi')
                                                    ->label('Content (Vietnamese)')
                                                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList']),
                                            ]),
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('story_image')
                                            ->collection('story_image')
                                            ->model(fn () => AboutPage::firstOrCreate([]))
                                            ->image()
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('4:3')
                                            ->helperText('Recommended: 800x600 pixels'),
                                    ]),
                                Forms\Components\Section::make('Our Mission')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('mission_title_en')
                                                    ->label('Title (English)')
                                                    ->placeholder('Our Mission'),
                                                Forms\Components\TextInput::make('mission_title_vi')
                                                    ->label('Title (Vietnamese)')
                                                    ->placeholder('Sứ Mệnh Của Chúng Tôi'),
                                            ]),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\RichEditor::make('mission_content_en')
                                                    ->label('Content (English)')
                                                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList']),
                                                Forms\Components\RichEditor::make('mission_content_vi')
                                                    ->label('Content (Vietnamese)')
                                                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList']),
                                            ]),
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('mission_image')
                                            ->collection('mission_image')
                                            ->model(fn () => AboutPage::firstOrCreate([]))
                                            ->image()
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('4:3')
                                            ->helperText('Recommended: 800x600 pixels'),
                                    ]),
                            ]),

                        // Tab 3: Vision
                        Forms\Components\Tabs\Tab::make('Vision')
                            ->icon('heroicon-o-eye')
                            ->schema([
                                Forms\Components\Section::make('Our Vision')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('vision_title_en')
                                                    ->label('Title (English)')
                                                    ->placeholder('Our Vision'),
                                                Forms\Components\TextInput::make('vision_title_vi')
                                                    ->label('Title (Vietnamese)')
                                                    ->placeholder('Tầm Nhìn Của Chúng Tôi'),
                                            ]),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\RichEditor::make('vision_content_en')
                                                    ->label('Content (English)')
                                                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList']),
                                                Forms\Components\RichEditor::make('vision_content_vi')
                                                    ->label('Content (Vietnamese)')
                                                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList']),
                                            ]),
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('vision_image')
                                            ->collection('vision_image')
                                            ->model(fn () => AboutPage::firstOrCreate([]))
                                            ->image()
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('4:3')
                                            ->helperText('Recommended: 800x600 pixels'),
                                    ]),
                            ]),

                        // Tab 4: Strengths
                        Forms\Components\Tabs\Tab::make('Strengths')
                            ->icon('heroicon-o-star')
                            ->schema([
                                Forms\Components\Section::make('Why Choose Us - Strengths')
                                    ->description('Add up to 4 key strengths that differentiate your company')
                                    ->schema([
                                        Forms\Components\Repeater::make('strengths')
                                            ->schema([
                                                Forms\Components\Grid::make(2)
                                                    ->schema([
                                                        Forms\Components\TextInput::make('title_en')
                                                            ->label('Title (English)')
                                                            ->required()
                                                            ->placeholder('Local Expertise'),
                                                        Forms\Components\TextInput::make('title_vi')
                                                            ->label('Title (Vietnamese)')
                                                            ->required()
                                                            ->placeholder('Chuyên Gia Địa Phương'),
                                                    ]),
                                                Forms\Components\Grid::make(2)
                                                    ->schema([
                                                        Forms\Components\Textarea::make('description_en')
                                                            ->label('Description (English)')
                                                            ->rows(2)
                                                            ->placeholder('Deep knowledge of Southeast Asia...'),
                                                        Forms\Components\Textarea::make('description_vi')
                                                            ->label('Description (Vietnamese)')
                                                            ->rows(2)
                                                            ->placeholder('Kiến thức sâu sắc về Đông Nam Á...'),
                                                    ]),
                                                Forms\Components\Toggle::make('is_active')
                                                    ->label('Active')
                                                    ->default(true),
                                                Forms\Components\Hidden::make('id'),
                                            ])
                                            ->columns(1)
                                            ->maxItems(4)
                                            ->reorderable()
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['title_en'] ?? null)
                                            ->defaultItems(0),
                                    ]),
                            ]),

                        // Tab 5: Stats
                        Forms\Components\Tabs\Tab::make('Stats')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Forms\Components\Section::make('Company Statistics')
                                    ->description('Key numbers that showcase your achievements')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('stat1_number')
                                                    ->label('Stat 1 Number')
                                                    ->placeholder('15+'),
                                                Forms\Components\TextInput::make('stat1_label_en')
                                                    ->label('Label (English)')
                                                    ->placeholder('Years Experience'),
                                                Forms\Components\TextInput::make('stat1_label_vi')
                                                    ->label('Label (Vietnamese)')
                                                    ->placeholder('Năm Kinh Nghiệm'),
                                            ]),
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('stat2_number')
                                                    ->label('Stat 2 Number')
                                                    ->placeholder('5000+'),
                                                Forms\Components\TextInput::make('stat2_label_en')
                                                    ->label('Label (English)')
                                                    ->placeholder('Happy Travelers'),
                                                Forms\Components\TextInput::make('stat2_label_vi')
                                                    ->label('Label (Vietnamese)')
                                                    ->placeholder('Khách Hàng Hài Lòng'),
                                            ]),
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('stat3_number')
                                                    ->label('Stat 3 Number')
                                                    ->placeholder('50+'),
                                                Forms\Components\TextInput::make('stat3_label_en')
                                                    ->label('Label (English)')
                                                    ->placeholder('Destinations'),
                                                Forms\Components\TextInput::make('stat3_label_vi')
                                                    ->label('Label (Vietnamese)')
                                                    ->placeholder('Điểm Đến'),
                                            ]),
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('stat4_number')
                                                    ->label('Stat 4 Number')
                                                    ->placeholder('100%'),
                                                Forms\Components\TextInput::make('stat4_label_en')
                                                    ->label('Label (English)')
                                                    ->placeholder('Satisfaction'),
                                                Forms\Components\TextInput::make('stat4_label_vi')
                                                    ->label('Label (Vietnamese)')
                                                    ->placeholder('Hài Lòng'),
                                            ]),
                                    ]),
                            ]),

                        // Tab 6: SEO
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Forms\Components\Section::make('SEO Settings')
                                    ->description('Meta tags for search engine optimization')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('meta_title_en')
                                                    ->label('Meta Title (English)')
                                                    ->maxLength(60)
                                                    ->helperText('Recommended: 50-60 characters'),
                                                Forms\Components\TextInput::make('meta_title_vi')
                                                    ->label('Meta Title (Vietnamese)')
                                                    ->maxLength(60),
                                            ]),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Textarea::make('meta_description_en')
                                                    ->label('Meta Description (English)')
                                                    ->rows(2)
                                                    ->maxLength(160)
                                                    ->helperText('Recommended: 150-160 characters'),
                                                Forms\Components\Textarea::make('meta_description_vi')
                                                    ->label('Meta Description (Vietnamese)')
                                                    ->rows(2)
                                                    ->maxLength(160),
                                            ]),
                                    ]),
                            ]),
                    ])
                    ->persistTabInQueryString(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Get or create the AboutPage record
        $about = AboutPage::getContent();

        // Save Hero Section
        $about->setTranslations('hero_category', [
            'en' => $data['hero_category_en'] ?? '',
            'vi' => $data['hero_category_vi'] ?? '',
        ]);
        $about->setTranslations('hero_line1', [
            'en' => $data['hero_line1_en'] ?? '',
            'vi' => $data['hero_line1_vi'] ?? '',
        ]);
        $about->setTranslations('hero_line2', [
            'en' => $data['hero_line2_en'] ?? '',
            'vi' => $data['hero_line2_vi'] ?? '',
        ]);
        $about->setTranslations('hero_line3', [
            'en' => $data['hero_line3_en'] ?? '',
            'vi' => $data['hero_line3_vi'] ?? '',
        ]);
        $about->setTranslations('hero_subtitle', [
            'en' => $data['hero_subtitle_en'] ?? '',
            'vi' => $data['hero_subtitle_vi'] ?? '',
        ]);

        // Save Story Section
        $about->setTranslations('story_title', [
            'en' => $data['story_title_en'] ?? '',
            'vi' => $data['story_title_vi'] ?? '',
        ]);
        $about->setTranslations('story_content', [
            'en' => $data['story_content_en'] ?? '',
            'vi' => $data['story_content_vi'] ?? '',
        ]);

        // Save Mission Section
        $about->setTranslations('mission_title', [
            'en' => $data['mission_title_en'] ?? '',
            'vi' => $data['mission_title_vi'] ?? '',
        ]);
        $about->setTranslations('mission_content', [
            'en' => $data['mission_content_en'] ?? '',
            'vi' => $data['mission_content_vi'] ?? '',
        ]);

        // Save Vision Section
        $about->setTranslations('vision_title', [
            'en' => $data['vision_title_en'] ?? '',
            'vi' => $data['vision_title_vi'] ?? '',
        ]);
        $about->setTranslations('vision_content', [
            'en' => $data['vision_content_en'] ?? '',
            'vi' => $data['vision_content_vi'] ?? '',
        ]);

        // Save Stats
        $about->stat1_number = $data['stat1_number'] ?? '15+';
        $about->setTranslations('stat1_label', [
            'en' => $data['stat1_label_en'] ?? '',
            'vi' => $data['stat1_label_vi'] ?? '',
        ]);
        $about->stat2_number = $data['stat2_number'] ?? '5000+';
        $about->setTranslations('stat2_label', [
            'en' => $data['stat2_label_en'] ?? '',
            'vi' => $data['stat2_label_vi'] ?? '',
        ]);
        $about->stat3_number = $data['stat3_number'] ?? '50+';
        $about->setTranslations('stat3_label', [
            'en' => $data['stat3_label_en'] ?? '',
            'vi' => $data['stat3_label_vi'] ?? '',
        ]);
        $about->stat4_number = $data['stat4_number'] ?? '100%';
        $about->setTranslations('stat4_label', [
            'en' => $data['stat4_label_en'] ?? '',
            'vi' => $data['stat4_label_vi'] ?? '',
        ]);

        // Save SEO
        $about->setTranslations('meta_title', [
            'en' => $data['meta_title_en'] ?? '',
            'vi' => $data['meta_title_vi'] ?? '',
        ]);
        $about->setTranslations('meta_description', [
            'en' => $data['meta_description_en'] ?? '',
            'vi' => $data['meta_description_vi'] ?? '',
        ]);

        $about->save();

        // Save Strengths
        $existingIds = [];
        $order = 1;
        foreach ($data['strengths'] ?? [] as $strengthData) {
            if (!empty($strengthData['id'])) {
                // Update existing
                $strength = AboutStrength::find($strengthData['id']);
                if ($strength) {
                    $strength->setTranslations('title', [
                        'en' => $strengthData['title_en'] ?? '',
                        'vi' => $strengthData['title_vi'] ?? '',
                    ]);
                    $strength->setTranslations('description', [
                        'en' => $strengthData['description_en'] ?? '',
                        'vi' => $strengthData['description_vi'] ?? '',
                    ]);
                    $strength->is_active = $strengthData['is_active'] ?? true;
                    $strength->order = $order;
                    $strength->save();
                    $existingIds[] = $strength->id;
                }
            } else {
                // Create new
                $strength = AboutStrength::create([
                    'title' => [
                        'en' => $strengthData['title_en'] ?? '',
                        'vi' => $strengthData['title_vi'] ?? '',
                    ],
                    'description' => [
                        'en' => $strengthData['description_en'] ?? '',
                        'vi' => $strengthData['description_vi'] ?? '',
                    ],
                    'is_active' => $strengthData['is_active'] ?? true,
                    'order' => $order,
                ]);
                $existingIds[] = $strength->id;
            }
            $order++;
        }

        // Delete removed strengths
        AboutStrength::whereNotIn('id', $existingIds)->delete();

        // Clear the cache
        AboutPage::clearCache();

        Notification::make()
            ->title('About page saved successfully')
            ->success()
            ->send();
    }

    protected function getFormModel(): AboutPage
    {
        return AboutPage::getContent();
    }
}
