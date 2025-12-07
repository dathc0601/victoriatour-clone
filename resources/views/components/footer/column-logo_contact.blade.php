@props(['column'])

@php
    $footerLogo = App\Models\Setting::get('footer_logo');
    $contactPhone = App\Models\Setting::get('contact_phone', '+84 85 692 9229');
    $contactEmail = App\Models\Setting::get('contact_email', 'sale20@victoriatour.com.vn');
    $contactAddress = App\Models\Setting::get('contact_address', [
        'en' => 'No. 29, Pham Van Bach Street, Yen Hoa Ward, Cau Giay District',
        'vi' => 'Số 29, Phố Phạm Văn Bạch, Phường Yên Hòa, Quận Cầu Giấy'
    ]);
    $address = is_array($contactAddress) ? ($contactAddress[app()->getLocale()] ?? $contactAddress['en'] ?? '') : $contactAddress;
@endphp

<div class="space-y-4">
    {{-- Logo --}}
    <a href="{{ route('home') }}" class="inline-block group">
        @if($footerLogo)
            <img src="{{ Storage::url($footerLogo) }}" alt="{{ config('app.name') }}" class="h-10">
        @else
            <span class="text-2xl font-serif italic text-amber-400 tracking-wide">Victoria</span>
            <span class="text-xl font-sans font-light text-white ml-0.5">Tour</span>
        @endif
    </a>

    {{-- Company Name --}}
    <h2 class="text-base font-medium tracking-wide pt-2">
        {{ __('messages.footer.company_name') }}
    </h2>

    {{-- Contact Details --}}
    <div class="space-y-1.5 text-sm text-gray-300 font-light leading-relaxed">
        <p>{{ $address }}</p>
        <p>{{ __('messages.footer.phone_label') }}: {{ $contactPhone }}</p>
        <p>{{ __('messages.footer.email_label') }}: {{ $contactEmail }}</p>
    </div>
</div>
