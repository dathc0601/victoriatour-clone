@props(['model', 'locale' => app()->getLocale()])

@php
    $shouldShow = $model->shouldShowTranslationPendingNotice();
    $sourceLocale = $model->source_locale ?? 'en';
    $sourceLangName = \App\Models\Language::where('code', $sourceLocale)->first()?->name ?? 'English';
@endphp

@if($shouldShow)
    <div {{ $attributes->merge(['class' => 'translation-pending-notice']) }}>
        <div class="relative overflow-hidden bg-gradient-to-r from-amber-50 via-orange-50 to-amber-50 border border-amber-200/60 rounded-xl px-5 py-4 mb-8 shadow-sm">
            {{-- Decorative background pattern --}}
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23000000' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;);"></div>

            <div class="relative flex items-start gap-4">
                {{-- Animated globe icon --}}
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shadow-lg shadow-amber-200/50">
                    <svg class="w-5 h-5 text-white animate-[spin_8s_linear_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                </div>

                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <h4 class="text-sm font-semibold text-amber-900 tracking-tight">
                            {{ __('translation.pending_title') }}
                        </h4>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium uppercase tracking-wider bg-amber-200/60 text-amber-800">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            {{ __('translation.processing') }}
                        </span>
                    </div>
                    <p class="text-sm text-amber-800/80 leading-relaxed">
                        {{ __('translation.pending_message', ['language' => $sourceLangName]) }}
                    </p>
                </div>

                {{-- Source language indicator --}}
                <div class="hidden sm:flex flex-col items-center gap-1 px-3 py-2 rounded-lg bg-white/60 border border-amber-100">
                    <img src="{{ asset('images/flags/' . $sourceLocale . '.svg') }}"
                         alt="{{ $sourceLangName }}"
                         class="w-6 h-4 rounded-sm object-cover shadow-sm">
                    <span class="text-[10px] font-medium text-amber-700 uppercase tracking-wide">
                        {{ strtoupper($sourceLocale) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes subtle-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(251, 191, 36, 0); }
            50% { box-shadow: 0 0 20px 0 rgba(251, 191, 36, 0.15); }
        }
        .translation-pending-notice > div {
            animation: subtle-glow 3s ease-in-out infinite;
        }
    </style>
@endif
