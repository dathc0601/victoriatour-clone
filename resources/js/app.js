import './bootstrap';

// Alpine.js plugins (Alpine is provided by Livewire)
import collapse from '@alpinejs/collapse';

// Register Alpine components and plugins when Alpine initializes
document.addEventListener('alpine:init', () => {
    // Register collapse plugin
    window.Alpine.plugin(collapse);

    // Header Controller - handles scroll behavior, sidenav, and search modal
    window.Alpine.data('headerController', () => ({
        scrolled: false,
        hidden: false,
        lastScrollY: 0,
        sidenavOpen: false,
        searchOpen: false,
        ticking: false,

        init() {
            // Check initial scroll position
            this.checkScroll();

            // Add scroll listener with throttling
            window.addEventListener('scroll', () => {
                if (!this.ticking) {
                    window.requestAnimationFrame(() => {
                        this.handleScroll();
                        this.ticking = false;
                    });
                    this.ticking = true;
                }
            }, { passive: true });

            // Prevent body scroll when sidenav or search is open
            this.$watch('sidenavOpen', (open) => {
                document.body.style.overflow = open ? 'hidden' : '';
            });

            this.$watch('searchOpen', (open) => {
                document.body.style.overflow = open ? 'hidden' : '';
            });
        },

        checkScroll() {
            const heroSlider = document.querySelector('.hero-slider, .hero-section, [data-hero]');
            const heroHeight = heroSlider?.offsetHeight || 500;
            this.scrolled = window.scrollY > heroHeight * 0.3;
        },

        handleScroll() {
            const currentScrollY = window.scrollY;
            const heroSlider = document.querySelector('.hero-slider, .hero-section, [data-hero]');
            const heroHeight = heroSlider?.offsetHeight || 500;

            // Determine if we've scrolled past the hero section
            this.scrolled = currentScrollY > heroHeight * 0.3;

            // Determine hide/show based on scroll direction
            // Only hide if scrolled past 150px and scrolling down
            if (currentScrollY > 150) {
                if (currentScrollY > this.lastScrollY && currentScrollY - this.lastScrollY > 10) {
                    // Scrolling down - hide header
                    this.hidden = true;
                } else if (this.lastScrollY - currentScrollY > 10) {
                    // Scrolling up - show header
                    this.hidden = false;
                }
            } else {
                // At top of page - always show
                this.hidden = false;
            }

            this.lastScrollY = currentScrollY;
        },

        openSidenav() {
            this.sidenavOpen = true;
        },

        closeSidenav() {
            this.sidenavOpen = false;
        },

        openSearch() {
            this.searchOpen = true;
            // Focus the search input after opening
            this.$nextTick(() => {
                const searchInput = document.querySelector('.search-modal-content input');
                if (searchInput) {
                    searchInput.focus();
                }
            });
        },

        closeSearch() {
            this.searchOpen = false;
        }
    }));

    // Sticky Tabs Controller - for destination show page
    window.Alpine.data('stickyTabs', () => ({
        tabs: [
            {
                id: 'section-destination',
                label: 'Destination',
                icon: '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M32 8C24 8 16 16 16 24c0 12 16 32 16 32s16-20 16-32c0-8-8-16-16-16zm0 22a6 6 0 110-12 6 6 0 010 12z" stroke="currentColor" stroke-width="2" fill="none"/></svg>'
            },
            {
                id: 'section-tours',
                label: 'Travel',
                icon: '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="32" r="24" stroke="currentColor" stroke-width="2"/><path d="M32 8v48M8 32h48M14 18l36 28M14 46l36-28" stroke="currentColor" stroke-width="1.5"/></svg>'
            },
            {
                id: 'section-hotels',
                label: 'Stay',
                icon: '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="8" y="20" width="48" height="36" rx="2" stroke="currentColor" stroke-width="2"/><path d="M8 32h48M20 20v-8h24v8M28 44h8v12h-8z" stroke="currentColor" stroke-width="2"/></svg>'
            },
            {
                id: 'section-visa',
                label: 'Visa',
                icon: '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="8" y="12" width="48" height="40" rx="4" stroke="currentColor" stroke-width="2"/><circle cx="24" cy="32" r="8" stroke="currentColor" stroke-width="2"/><path d="M36 28h12M36 36h8" stroke="currentColor" stroke-width="2"/></svg>'
            },
            {
                id: 'section-policy',
                label: 'Policy',
                icon: '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 8h32v48H16z" stroke="currentColor" stroke-width="2"/><path d="M24 20h16M24 28h16M24 36h12" stroke="currentColor" stroke-width="2"/><path d="M40 40l6 6 10-10" stroke="currentColor" stroke-width="2"/></svg>'
            },
        ],
        activeTab: 'section-destination',
        isSticky: false,

        init() {
            this.setupIntersectionObserver();
            this.setupStickyObserver();
        },

        setupIntersectionObserver() {
            const options = {
                root: null,
                rootMargin: '-40% 0px -40% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.activeTab = entry.target.id;
                    }
                });
            }, options);

            this.tabs.forEach(tab => {
                const section = document.getElementById(tab.id);
                if (section) observer.observe(section);
            });
        },

        setupStickyObserver() {
            const heroSection = document.querySelector('[data-hero]');

            if (heroSection) {
                const observer = new IntersectionObserver((entries) => {
                    this.isSticky = !entries[0].isIntersecting;
                }, { threshold: 0 });

                observer.observe(heroSection);
            }
        },

        scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                const headerOffset = 160;
                const elementPosition = section.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }
    }));

    // Tour Detail Tabs Controller - for tour show page
    window.Alpine.data('tourDetailTabs', () => ({
        tabs: [
            {
                id: 'section-overview',
                label: 'Overview',
                icon: '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="8" y="8" width="48" height="48" rx="4" stroke="currentColor" stroke-width="2"/><path d="M16 20h32M16 32h24M16 44h28" stroke="currentColor" stroke-width="2"/></svg>'
            },
            {
                id: 'section-gallery',
                label: 'Gallery',
                icon: '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="8" y="12" width="48" height="40" rx="4" stroke="currentColor" stroke-width="2"/><circle cx="24" cy="28" r="6" stroke="currentColor" stroke-width="2"/><path d="M8 44l16-12 12 8 20-16" stroke="currentColor" stroke-width="2"/></svg>'
            },
            {
                id: 'section-itinerary',
                label: 'Itinerary',
                icon: '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 8h32v48H16z" stroke="currentColor" stroke-width="2"/><path d="M24 20h16M24 28h16M24 36h12M24 44h8" stroke="currentColor" stroke-width="2"/><circle cx="20" cy="20" r="2" fill="currentColor"/><circle cx="20" cy="28" r="2" fill="currentColor"/><circle cx="20" cy="36" r="2" fill="currentColor"/><circle cx="20" cy="44" r="2" fill="currentColor"/></svg>'
            },
            {
                id: 'section-details',
                label: 'Details',
                icon: '<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="32" cy="32" r="24" stroke="currentColor" stroke-width="2"/><path d="M32 20v24M32 44v4" stroke="currentColor" stroke-width="3"/><circle cx="32" cy="18" r="3" fill="currentColor"/></svg>'
            },
        ],
        activeTab: 'section-overview',
        isSticky: false,
        showMobileBooking: false,

        init() {
            this.setupIntersectionObserver();
            this.setupStickyObserver();
            this.setupMobileBookingObserver();
        },

        setupIntersectionObserver() {
            const options = {
                root: null,
                rootMargin: '-40% 0px -40% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.activeTab = entry.target.id;
                    }
                });
            }, options);

            this.tabs.forEach(tab => {
                const section = document.getElementById(tab.id);
                if (section) observer.observe(section);
            });
        },

        setupStickyObserver() {
            const heroSection = document.querySelector('[data-hero]');

            if (heroSection) {
                const observer = new IntersectionObserver((entries) => {
                    this.isSticky = !entries[0].isIntersecting;
                }, { threshold: 0 });

                observer.observe(heroSection);
            }
        },

        setupMobileBookingObserver() {
            const heroSection = document.querySelector('[data-hero]');

            if (heroSection) {
                const observer = new IntersectionObserver((entries) => {
                    this.showMobileBooking = !entries[0].isIntersecting;
                }, { threshold: 0.1 });

                observer.observe(heroSection);
            }
        },

        scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                const headerOffset = 160;
                const elementPosition = section.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }
    }));
});

// Swiper (for carousels)
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, Thumbs, Scrollbar } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/thumbs';
import 'swiper/css/scrollbar';
window.Swiper = Swiper;
window.SwiperModules = { Navigation, Pagination, Autoplay, Thumbs, Scrollbar };

// GLightbox (for image gallery lightbox)
import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';
window.GLightbox = GLightbox;
