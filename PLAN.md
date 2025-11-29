# Victoria Tour Website Clone - Implementation Plan

## Project Overview

Clone the Victoria Tour website (https://victoriatour.com/) using:
- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Tailwind CSS 3 + Livewire 3 + Alpine.js
- **Admin Panel**: Filament 3
- **Database**: MySQL 8

### User Preferences
- **Languages**: English + Vietnamese (2 languages, expandable)
- **Booking System**: Inquiry form only (no payment integration)
- **Frontend Framework**: Livewire + Alpine.js for interactive components
- **Form Handling**: Store in database only (admin views in Filament)

---

## 1. Website Analysis Summary

### Pages to Implement
1. **Homepage** - Hero, inspirations carousel, differentiators, destinations grid, news, MICE
2. **About Us** - Company introduction, team, values
3. **Destinations Listing** - Grid of destination cards
4. **Destination Detail** - Tabs (Tours/Hotels/Visa/Policy), tour listings, city directory
5. **Tours Listing** - Tour cards with filtering
6. **Tour Detail** - Full itinerary, gallery, pricing, booking form
7. **Travel Blog Listing** - Article cards with categories
8. **Blog Detail** - Full article with sidebar
9. **Contact Us** - Contact form, map, info
10. **MICE** - Corporate services page

### Key Features
- **Multi-language**: English + Vietnamese (expandable to more)
- **Responsive Design**: Mobile-first approach
- **Search**: Global site search (Livewire-powered)
- **Newsletter**: Email subscription form
- **Carousels**: Swiper.js for tour/inspiration sliders
- **Interactive Filtering**: Livewire components for tour filtering

### Design System
- **Colors**: Navy blue (#1e3a5f), White, Teal accent (#0d9488)
- **Typography**: Inter/Poppins sans-serif
- **Components**: Cards, buttons, badges, carousels, modals

---

## 2. Database Schema

### Core Tables

```
destinations
├── id
├── name (translatable)
├── slug
├── description (translatable)
├── image
├── meta_title (translatable)
├── meta_description (translatable)
├── is_featured
├── order
├── is_active
└── timestamps

cities
├── id
├── destination_id (FK)
├── name (translatable)
├── slug
├── description (translatable)
├── image
├── tour_count (cached)
├── is_active
└── timestamps

tours
├── id
├── destination_id (FK)
├── city_id (FK, nullable)
├── title (translatable)
├── slug
├── excerpt (translatable)
├── description (translatable)
├── duration_days
├── price
├── price_type (enum: fixed, contact, from)
├── rating
├── gallery (JSON)
├── itinerary (JSON, translatable)
├── inclusions (translatable)
├── exclusions (translatable)
├── meta_title (translatable)
├── meta_description (translatable)
├── is_featured
├── is_active
├── order
└── timestamps

tour_categories
├── id
├── name (translatable)
├── slug
├── is_active
└── timestamps

tour_tour_category (pivot)
├── tour_id
└── tour_category_id

hotels
├── id
├── destination_id (FK)
├── city_id (FK)
├── name
├── slug
├── description (translatable)
├── star_rating
├── price_per_night
├── image
├── gallery (JSON)
├── amenities (JSON)
├── is_active
└── timestamps

blog_categories
├── id
├── name (translatable)
├── slug
├── is_active
└── timestamps

blog_posts
├── id
├── blog_category_id (FK)
├── title (translatable)
├── slug
├── excerpt (translatable)
├── content (translatable)
├── image
├── author
├── published_at
├── meta_title (translatable)
├── meta_description (translatable)
├── is_featured
├── is_active
└── timestamps

inquiries
├── id
├── type (enum: contact, tour_booking, newsletter)
├── tour_id (FK, nullable)
├── name
├── email
├── phone
├── message
├── status (enum: new, read, replied)
└── timestamps

pages
├── id
├── title (translatable)
├── slug
├── content (translatable)
├── meta_title (translatable)
├── meta_description (translatable)
├── template (enum: default, about, mice, contact)
├── is_active
└── timestamps

settings
├── id
├── group
├── key
├── value (JSON, translatable where needed)
└── timestamps

languages
├── id
├── code (en, vi, zh, etc.)
├── name
├── native_name
├── flag_icon
├── is_default
├── is_active
├── order
└── timestamps

sliders
├── id
├── title (translatable)
├── subtitle (translatable)
├── image
├── button_text (translatable)
├── button_url
├── order
├── is_active
└── timestamps

differentiators
├── id
├── title (translatable)
├── description (translatable)
├── icon
├── order
├── is_active
└── timestamps
```

---

## 3. Laravel Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── DestinationController.php
│   │   ├── TourController.php
│   │   ├── BlogController.php
│   │   ├── PageController.php
│   │   └── LanguageController.php
│   ├── Middleware/
│   │   └── SetLocale.php
│   └── Requests/
│       ├── ContactRequest.php
│       └── TourInquiryRequest.php
├── Livewire/
│   ├── ContactForm.php
│   ├── TourInquiryForm.php
│   ├── NewsletterForm.php
│   ├── TourFilter.php
│   ├── GlobalSearch.php
│   └── LanguageSwitcher.php
├── Models/
│   ├── Destination.php
│   ├── City.php
│   ├── Tour.php
│   ├── TourCategory.php
│   ├── Hotel.php
│   ├── BlogCategory.php
│   ├── BlogPost.php
│   ├── Inquiry.php
│   ├── Page.php
│   ├── Setting.php
│   ├── Language.php
│   ├── Slider.php
│   └── Differentiator.php
├── Services/
│   ├── SettingService.php
│   └── SearchService.php
└── View/
    └── Components/
        ├── Layout/
        │   ├── Header.php
        │   ├── Footer.php
        │   └── LanguageSwitcher.php
        ├── Cards/
        │   ├── DestinationCard.php
        │   ├── TourCard.php
        │   └── BlogCard.php
        └── Ui/
            ├── Carousel.php
            └── Rating.php

resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── components/
│   │   ├── layout/
│   │   ├── cards/
│   │   └── ui/
│   ├── pages/
│   │   ├── home.blade.php
│   │   ├── about.blade.php
│   │   ├── contact.blade.php
│   │   └── mice.blade.php
│   ├── destinations/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   ├── tours/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   ├── blog/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   └── partials/
│       ├── hero.blade.php
│       ├── inspirations.blade.php
│       ├── differentiators.blade.php
│       ├── destinations-grid.blade.php
│       ├── featured-news.blade.php
│       └── newsletter.blade.php
├── css/
│   └── app.css
└── js/
    └── app.js
```

---

## 4. Filament Admin Panel Structure

### Resources

```
app/Filament/Resources/
├── DestinationResource.php
├── CityResource.php
├── TourResource.php
├── TourCategoryResource.php
├── HotelResource.php
├── BlogCategoryResource.php
├── BlogPostResource.php
├── InquiryResource.php
├── PageResource.php
├── SliderResource.php
├── DifferentiatorResource.php
└── LanguageResource.php
```

### Custom Pages
```
app/Filament/Pages/
├── Dashboard.php
├── Settings.php
└── SiteSettings.php
```

### Widgets
```
app/Filament/Widgets/
├── StatsOverview.php (tours, inquiries, visitors)
├── LatestInquiries.php
└── PopularTours.php
```

### Admin Features
- **Translatable fields** using Filament Spatie Translatable plugin
- **Media management** with Filament Spatie Media Library
- **Rich text editor** for descriptions
- **Image cropping** for thumbnails
- **Drag-and-drop ordering** for sliders, differentiators
- **SEO fields** on all content types

---

## 5. Frontend Implementation

### Tailwind CSS Configuration

```js
// tailwind.config.js
module.exports = {
  content: ['./resources/**/*.blade.php', './resources/**/*.js'],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#eff6ff',
          500: '#1e3a5f',
          600: '#1a3354',
          700: '#162c49',
        },
        accent: {
          500: '#0d9488',
          600: '#0f766e',
        }
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        heading: ['Poppins', 'sans-serif'],
      }
    }
  }
}
```

### Frontend Stack
- **Livewire 3**: Server-side reactivity for forms, filtering, search
- **Alpine.js**: Client-side interactions (dropdowns, modals, toggles)
- **Swiper.js**: Carousels/sliders
- **AOS**: Scroll animations (optional)
- **Leaflet**: Contact page map

### Key Components

1. **Header** (sticky, transparent on homepage)
   - Logo
   - Navigation dropdown menus
   - Language switcher (12 flags)
   - Search icon + modal
   - Hotline phone number
   - Mobile hamburger menu

2. **Hero Section**
   - Full-width slider
   - Overlay text with animation
   - CTA button

3. **Destination Cards**
   - Image with overlay gradient
   - Title + brief description
   - Hover effect
   - "Discover more" link

4. **Tour Cards**
   - Image thumbnail
   - Duration badge
   - Location tag
   - Title
   - Price (or "Contact")
   - Star rating
   - Hover scale effect

5. **Blog Cards**
   - Image
   - Date + Category tag
   - Title
   - Excerpt

6. **Footer**
   - Logo + description
   - Address/contact info
   - Destinations links
   - Company links
   - Newsletter form
   - Social icons
   - Copyright

---

## 6. Routes Structure

```php
// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
Route::get('/mice', [PageController::class, 'mice'])->name('mice');

Route::get('/destination', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destination/{destination:slug}', [DestinationController::class, 'show'])->name('destinations.show');

Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/tour/{tour:slug}', [TourController::class, 'show'])->name('tours.show');
Route::post('/tour/{tour}/inquiry', [TourController::class, 'inquiry'])->name('tours.inquiry');

Route::get('/travel-blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/travel-blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/search', [SearchController::class, 'index'])->name('search');

// Language switching
Route::get('/language/{code}', [LanguageController::class, 'switch'])->name('language.switch');

// Note: Contact form, newsletter, and tour inquiry are handled by Livewire components
```

---

## 7. Implementation Phases

### Phase 1: Project Setup
1. Create Laravel 11 project
2. Install and configure Livewire 3
3. Install and configure Filament 3
4. Install Tailwind CSS 3 + Alpine.js
5. Set up database migrations
6. Configure multi-language with spatie/laravel-translatable
7. Set up media library with spatie/laravel-medialibrary

### Phase 2: Database & Models
1. Create all migrations
2. Create Eloquent models with relationships
3. Add translatable traits
4. Create factories and seeders

### Phase 3: Admin Panel (Filament)
1. Create all Filament resources
2. Set up translatable form fields
3. Configure media uploads
4. Create settings page
5. Build dashboard with widgets
6. Set up admin navigation

### Phase 4: Frontend Layout
1. Create base layout (app.blade.php)
2. Build header component with navigation
3. Build footer component
4. Create language switcher
5. Set up responsive breakpoints

### Phase 5: Homepage
1. Hero slider section
2. Inspirations carousel
3. Differentiators section
4. Destinations grid
5. Featured news section
6. MICE preview section
7. Newsletter section

### Phase 6: Destinations & Tours
1. Destinations listing page
2. Destination detail page with tabs
3. Tours listing page
4. Tour detail page with itinerary
5. Livewire TourFilter component
6. Livewire TourInquiryForm component

### Phase 7: Blog & Pages
1. Blog listing page
2. Blog detail page with sidebar
3. About Us page
4. Contact page with Livewire ContactForm
5. MICE page

### Phase 8: Livewire Components
1. GlobalSearch component (header search modal)
2. NewsletterForm component (footer)
3. LanguageSwitcher component
4. ContactForm component
5. TourInquiryForm component

### Phase 9: Features & Polish
1. SEO optimization (meta tags, sitemap)
2. Performance optimization (caching, lazy loading)
3. Mobile responsiveness testing
4. Cross-browser testing

---

## 8. Required Packages

```json
{
  "require": {
    "php": "^8.2",
    "laravel/framework": "^11.0",
    "livewire/livewire": "^3.0",
    "filament/filament": "^3.0",
    "filament/spatie-laravel-media-library-plugin": "^3.0",
    "filament/spatie-laravel-translatable-plugin": "^3.0",
    "spatie/laravel-translatable": "^6.0",
    "spatie/laravel-medialibrary": "^11.0",
    "spatie/laravel-sitemap": "^7.0",
    "spatie/laravel-sluggable": "^3.0"
  },
  "require-dev": {
    "barryvdh/laravel-debugbar": "^3.0"
  }
}
```

### NPM Packages
```json
{
  "devDependencies": {
    "tailwindcss": "^3.4",
    "@tailwindcss/forms": "^0.5",
    "@tailwindcss/typography": "^0.5",
    "autoprefixer": "^10.4",
    "postcss": "^8.4"
  },
  "dependencies": {
    "alpinejs": "^3.13",
    "swiper": "^11.0",
    "aos": "^2.3"
  }
}
```

---

## 9. Key Technical Decisions

1. **Translation System**: Using spatie/laravel-translatable for database-stored translations with JSON columns
2. **Media Handling**: spatie/laravel-medialibrary for image uploads with automatic conversions
3. **Admin Panel**: Filament 3 for rapid admin development with built-in translatable support
4. **Frontend Interactivity**: Alpine.js for lightweight reactivity without heavy JS framework
5. **Carousel**: Swiper.js for touch-friendly, responsive carousels
6. **SEO**: Custom meta tags system with translatable SEO fields per model

---

## 10. Estimated File Count

- **Migrations**: ~15 files
- **Models**: ~12 files
- **Controllers**: ~6 files
- **Livewire Components**: ~6 files
- **Filament Resources**: ~12 files
- **Blade Views**: ~35 files
- **Blade Components**: ~15 files
- **CSS/JS**: ~5 files

**Total**: ~110 files

---

## 11. Quick Start Commands

```bash
# Create Laravel project
composer create-project laravel/laravel victoriatour

# Install core packages
composer require livewire/livewire filament/filament:"^3.0" \
  spatie/laravel-translatable spatie/laravel-medialibrary \
  spatie/laravel-sluggable

# Install Filament plugins
composer require filament/spatie-laravel-media-library-plugin:"^3.0" \
  filament/spatie-laravel-translatable-plugin:"^3.0"

# Install Filament panel
php artisan filament:install --panels

# Install frontend dependencies
npm install -D tailwindcss postcss autoprefixer @tailwindcss/forms @tailwindcss/typography
npm install alpinejs swiper

# Initialize Tailwind
npx tailwindcss init -p

# Run migrations
php artisan migrate

# Create admin user
php artisan make:filament-user
```
