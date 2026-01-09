@php
    $phone = App\Models\Setting::get('contact_phone', '');
    $whatsapp = App\Models\Setting::get('whatsapp_number', '');
    $zalo = App\Models\Setting::get('zalo_number', '');
    $messenger = App\Models\Setting::get('messenger_username', '');

    // Format phone numbers for URLs (remove spaces, keep + for country code)
    $phoneUrl = preg_replace('/[^0-9+]/', '', $phone);
    $whatsappUrl = preg_replace('/[^0-9]/', '', $whatsapp); // WhatsApp needs numbers only
    $zaloUrl = preg_replace('/[^0-9]/', '', $zalo);
@endphp

<!-- Sticky Contact Buttons -->
<div class="sticky-contact-buttons fixed right-3 sm:right-4 top-2/3 -translate-y-1/2 z-50 flex flex-col gap-2.5 sm:gap-3">
    {{-- Phone Button --}}
    @if($phone)
        <a href="tel:{{ $phoneUrl }}"
           class="sticky-contact-btn sticky-contact-btn-phone"
           title="Call us"
           aria-label="Call us">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 0 0-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/>
            </svg>
        </a>
    @endif

    {{-- WhatsApp Button --}}
    @if($whatsapp)
        <a href="https://wa.me/{{ $whatsappUrl }}"
           target="_blank"
           rel="noopener noreferrer"
           class="sticky-contact-btn sticky-contact-btn-whatsapp"
           title="Chat on WhatsApp"
           aria-label="Chat on WhatsApp">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
            </svg>
        </a>
    @endif

    {{-- Zalo Button --}}
    @if($zalo)
        <a href="https://zalo.me/{{ $zaloUrl }}"
           target="_blank"
           rel="noopener noreferrer"
           class="sticky-contact-btn sticky-contact-btn-zalo"
           title="Chat on Zalo"
           aria-label="Chat on Zalo">
            <span class="text-xs sm:text-sm font-bold tracking-tight">Zalo</span>
        </a>
    @endif

    {{-- Messenger Button --}}
    @if($messenger)
        <a href="https://m.me/{{ $messenger }}"
           target="_blank"
           rel="noopener noreferrer"
           class="sticky-contact-btn sticky-contact-btn-messenger"
           title="Chat on Messenger"
           aria-label="Chat on Messenger">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0C5.373 0 0 4.974 0 11.111c0 3.498 1.744 6.614 4.469 8.654V24l4.088-2.242c1.092.3 2.246.464 3.443.464 6.627 0 12-4.975 12-11.111S18.627 0 12 0zm1.191 14.963l-3.055-3.26-5.963 3.26L10.732 8l3.131 3.259L19.752 8l-6.561 6.963z"/>
            </svg>
        </a>
    @endif
</div>
