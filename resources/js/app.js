import './bootstrap';

// Alpine.js with plugins
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

// Swiper (for carousels)
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, Thumbs } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/thumbs';
window.Swiper = Swiper;
window.SwiperModules = { Navigation, Pagination, Autoplay, Thumbs };

// GLightbox (for image gallery lightbox)
import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';
window.GLightbox = GLightbox;

// AOS (Animate On Scroll)
import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init({
    duration: 800,
    once: true,
});
