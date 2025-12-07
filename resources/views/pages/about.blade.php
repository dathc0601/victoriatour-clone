@extends('layouts.app')

@section('title', $about->meta_title ?? __('About Us'))
@section('meta_description', $about->meta_description ?? 'Learn about Victoria Tour, your trusted travel partner since 2010.')

@section('content')
    {{-- ============================================
         SECTION 1: HERO - Typography-Forward
         ============================================ --}}
    <section class="about-hero">
        <div class="about-hero-content">
            {{-- Category Label with Line --}}
            @if($about->hero_category)
                <span class="about-hero-category">
                    {{ $about->hero_category }}
                </span>
            @endif

            {{-- Split Headline --}}
            <h1 class="about-hero-headline">
                @if($about->hero_line1)
                    <span class="about-hero-line about-hero-line-1">{{ $about->hero_line1 }}</span>
                @endif
                @if($about->hero_line2)
                    <span class="about-hero-line about-hero-line-2">{{ $about->hero_line2 }}</span>
                @endif
                @if($about->hero_line3)
                    <span class="about-hero-line about-hero-line-3">{{ $about->hero_line3 }}</span>
                @endif
            </h1>

            {{-- Subtitle --}}
            @if($about->hero_subtitle)
                <p class="about-hero-subtitle">
                    {{ $about->hero_subtitle }}
                </p>
            @endif

            {{-- Scroll Indicator --}}
            <div class="about-hero-scroll">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </div>

        {{-- Hero Image --}}
        <div class="about-hero-image">
            @if($about->getFirstMediaUrl('hero_image'))
                <img src="{{ $about->getFirstMediaUrl('hero_image') }}"
                     alt=""
                     width="1920"
                     height="1080"
                     loading="eager">
            @else
                <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=1920&q=80"
                     alt=""
                     width="1920"
                     height="1080"
                     loading="eager">
            @endif
        </div>
    </section>

    {{-- ============================================
         SECTION 2: COMPANY DESCRIPTION
         3 Alternating Rows (Story, Mission, Vision)
         ============================================ --}}

    {{-- Row 1: Our Story (Text Left, Image Right) --}}
    @if($about->story_title || $about->story_content)
    <section class="about-content-row about-content-row-normal">
        <div class="container mx-auto px-4">
            <div class="about-content-grid">
                {{-- Text Side --}}
                <div class="about-content-text">
                    @if($about->story_title)
                        <h2 class="about-content-title">
                            <span class="about-content-label">{{ $about->story_title }}</span>
                        </h2>
                    @endif
                    @if($about->story_content)
                        <div class="about-content-body prose prose-lg">
                            {!! clean($about->story_content) !!}
                        </div>
                    @endif
                </div>

                {{-- Image Side --}}
                <div class="about-content-image group">
                    @if($about->getFirstMediaUrl('story_image'))
                        <img src="{{ $about->getFirstMediaUrl('story_image') }}"
                             alt="{{ $about->story_title ?? __('Our Story') }}"
                             width="800"
                             height="600"
                             loading="lazy">
                    @else
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80"
                             alt="{{ $about->story_title ?? __('Our Story') }}"
                             width="800"
                             height="600"
                             loading="lazy">
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Row 2: Our Mission (Image Left, Text Right) --}}
    @if($about->mission_title || $about->mission_content)
    <section class="about-content-row about-content-row-reversed">
        <div class="container mx-auto px-4">
            <div class="about-content-grid about-content-grid-reversed">
                {{-- Image Side --}}
                <div class="about-content-image group">
                    @if($about->getFirstMediaUrl('mission_image'))
                        <img src="{{ $about->getFirstMediaUrl('mission_image') }}"
                             alt="{{ $about->mission_title ?? __('Our Mission') }}"
                             width="800"
                             height="600"
                             loading="lazy">
                    @else
                        <img src="https://images.unsplash.com/photo-1528127269322-539801943592?w=800&q=80"
                             alt="{{ $about->mission_title ?? __('Our Mission') }}"
                             width="800"
                             height="600"
                             loading="lazy">
                    @endif
                </div>

                {{-- Text Side --}}
                <div class="about-content-text">
                    @if($about->mission_title)
                        <h2 class="about-content-title">
                            <span class="about-content-label">{{ $about->mission_title }}</span>
                        </h2>
                    @endif
                    @if($about->mission_content)
                        <div class="about-content-body prose prose-lg">
                            {!! clean($about->mission_content) !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Row 3: Our Vision (Text Left, Image Right) --}}
    @if($about->vision_title || $about->vision_content)
    <section class="about-content-row about-content-row-normal">
        <div class="container mx-auto px-4">
            <div class="about-content-grid">
                {{-- Text Side --}}
                <div class="about-content-text">
                    @if($about->vision_title)
                        <h2 class="about-content-title">
                            <span class="about-content-label">{{ $about->vision_title }}</span>
                        </h2>
                    @endif
                    @if($about->vision_content)
                        <div class="about-content-body prose prose-lg">
                            {!! clean($about->vision_content) !!}
                        </div>
                    @endif
                </div>

                {{-- Image Side --}}
                <div class="about-content-image group">
                    @if($about->getFirstMediaUrl('vision_image'))
                        <img src="{{ $about->getFirstMediaUrl('vision_image') }}"
                             alt="{{ $about->vision_title ?? __('Our Vision') }}"
                             width="800"
                             height="600"
                             loading="lazy">
                    @else
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80"
                             alt="{{ $about->vision_title ?? __('Our Vision') }}"
                             width="800"
                             height="600"
                             loading="lazy">
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ============================================
         SECTION 3: STRENGTHS - Asymmetric Bento Grid
         ============================================ --}}
    @if($strengths->count() > 0)
    <section class="bento-section">
        {{-- Section Header --}}
        <div class="container mx-auto px-4">
            <div class="bento-header">
                <span class="bento-label">{{ __('Why Choose Us') }}</span>
            </div>
        </div>

        {{-- Bento Grid --}}
        <div class="container mx-auto px-4">
            <div class="bento-grid">
                {{-- Card 1: Hero (Dark, Large) --}}
                @if($strengths->get(0))
                <div class="bento-card bento-card-hero bento-card-dark">
                    <span class="bento-number">01</span>
                    {{-- Compass Icon --}}
                    <svg class="bento-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <circle cx="12" cy="12" r="10"/>
                        <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>
                    </svg>
                    <div class="bento-content">
                        <div class="bento-accent"></div>
                        <h3 class="bento-title">{{ $strengths->get(0)->title }}</h3>
                        @if($strengths->get(0)->description)
                        <p class="bento-desc">{{ $strengths->get(0)->description }}</p>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Card 2: Small (Light) --}}
                @if($strengths->get(1))
                <div class="bento-card bento-card-small bento-card-light">
                    <span class="bento-number">02</span>
                    {{-- Route Icon --}}
                    <svg class="bento-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <circle cx="6" cy="19" r="3"/>
                        <path d="M9 19h8.5a3.5 3.5 0 0 0 0-7h-11a3.5 3.5 0 0 1 0-7H15"/>
                        <circle cx="18" cy="5" r="3"/>
                    </svg>
                    <div class="bento-content">
                        <div class="bento-accent"></div>
                        <h3 class="bento-title">{{ $strengths->get(1)->title }}</h3>
                        @if($strengths->get(1)->description)
                        <p class="bento-desc">{{ $strengths->get(1)->description }}</p>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Card 3: Small (Light) --}}
                @if($strengths->get(2))
                <div class="bento-card bento-card-small bento-card-light">
                    <span class="bento-number">03</span>
                    {{-- Headset Icon --}}
                    <svg class="bento-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"/>
                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>
                    </svg>
                    <div class="bento-content">
                        <div class="bento-accent"></div>
                        <h3 class="bento-title">{{ $strengths->get(2)->title }}</h3>
                        @if($strengths->get(2)->description)
                        <p class="bento-desc">{{ $strengths->get(2)->description }}</p>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Card 4: Full Width (Light with accent) --}}
                @if($strengths->get(3))
                <div class="bento-card bento-card-wide bento-card-light">
                    <span class="bento-number">04</span>
                    {{-- Diamond Icon --}}
                    <svg class="bento-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M6 3h12l4 6-10 13L2 9z"/>
                        <path d="M11 3l1 6h9M2 9h20M12 22V9"/>
                    </svg>
                    <div class="bento-content">
                        <div class="bento-accent"></div>
                        <h3 class="bento-title">{{ $strengths->get(3)->title }}</h3>
                        @if($strengths->get(3)->description)
                        <p class="bento-desc">{{ $strengths->get(3)->description }}</p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- Stats Row --}}
    <div class="py-20 md:py-24 relative overflow-hidden bento-stats">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="bento-stats-content">
                @if($about->stat1_number && $about->stat1_label)
                    <div class="bento-stat">
                        <span class="bento-stat-number">{{ $about->stat1_number }}</span>
                        <span class="bento-stat-label">{{ $about->stat1_label }}</span>
                    </div>
                    <span class="bento-stat-divider">&bull;</span>
                @endif
                @if($about->stat2_number && $about->stat2_label)
                    <div class="bento-stat">
                        <span class="bento-stat-number">{{ $about->stat2_number }}</span>
                        <span class="bento-stat-label">{{ $about->stat2_label }}</span>
                    </div>
                    <span class="bento-stat-divider">&bull;</span>
                @endif
                @if($about->stat3_number && $about->stat3_label)
                    <div class="bento-stat">
                        <span class="bento-stat-number">{{ $about->stat3_number }}</span>
                        <span class="bento-stat-label">{{ $about->stat3_label }}</span>
                    </div>
                    <span class="bento-stat-divider">&bull;</span>
                @endif
                @if($about->stat4_number && $about->stat4_label)
                    <div class="bento-stat">
                        <span class="bento-stat-number">{{ $about->stat4_number }}</span>
                        <span class="bento-stat-label">{{ $about->stat4_label }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #header .nav-link,
        #header .hotline-number,
        #header .lang-text,
        #header .lang-chevron,
        #header .search-icon {
            color: #1b1b18;
        }

        #header .hotline-label {
            color: #878787;
        }

        #header .header-divider {
            background-color: #c3c3c3;
        }
    </style>
@endpush
