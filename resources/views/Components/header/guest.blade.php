{{-- Header --}}
<header class="bg-white shadow-md relative z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            {{-- Logo --}}
            <div class="flex items-center space-x-2">
                <img src="{{ asset('Assets/logo-wastewise.svg') }}" alt="WasteWise Logo" class="h-12 w-12">
                <div>
                    <h1 class="font-bold text-[#3D8D7A] text-xl">WasteWise</h1>
                    <p class="text-xs text-black italic">"Ubah Sampah Jadi Berkah"</p>
                </div>
            </div>
            
            {{-- Navigasi Desktop --}}
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ route('landing-page') }}"
                class="{{ request()->routeIs('landing-page') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
                Beranda
                </a>
                
                <a href="{{ route('tentang-kami') }}"
                class="{{ request()->routeIs('tentang-kami') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
                Tentang Kami
                </a>

                <a href="{{ route('detail-layanan') }}"
                class="{{ request()->routeIs('detail-layanan') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
                Layanan
                </a>

                <a href="{{ route('daftar-artikel-guest') }}"
                class="{{ request()->routeIs('daftar-artikel-guest') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
                Artikel
                </a>

                <a href="{{ route('landing-page') }}#kontak"
                class="{{ request()->routeIs('landing-page') && request()->getRequestUri() === '/landing-page#kontak' ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
                Kontak
                </a>
            </nav>

            {{-- Tombol Login/Register Desktop --}}
            <div class="hidden md:flex items-center space-x-2">
                <a href="{{ route('login') }}" class="bg-[#3D8D7A] text-white px-6 py-2 rounded-md hover:bg-opacity-90 transition duration-300 font-medium">Masuk</a>
                <a href="{{ route('register') }}" class="bg-[#3D8D7A] text-white px-6 py-2 rounded-md hover:bg-opacity-90 transition duration-300 font-medium">Daftar</a>
            </div>
            
            {{-- Tombol Menu Mobile - Enhanced --}}
            <button 
                class="md:hidden min-h-[48px] min-w-[48px] flex items-center justify-center p-3 rounded-md text-slate-800 hover:text-slate-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#3D8D7A] active:bg-gray-200 transition-all duration-200" 
                id="mobile-menu-button"
                type="button"
                aria-expanded="false"
                aria-controls="mobile-menu"
                aria-label="Toggle navigation menu"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    
    {{-- Menu Navigasi Mobile (Dropdown) - Enhanced --}}
    <div class="md:hidden bg-white border-t border-gray-200 shadow-lg transition-all duration-300 ease-in-out transform origin-top scale-y-0 opacity-0" 
         id="mobile-menu" 
         style="max-height: 0; overflow: hidden;">
        <nav class="px-4 pt-2 pb-4 space-y-1">
            <a href="{{ route('landing-page') }}"
            class="{{ request()->routeIs('landing-page') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-4 py-3 rounded-md text-base font-medium hover:bg-gray-100 active:bg-gray-200 min-h-[48px] flex items-center transition-colors duration-200">
            Beranda
            </a>
            
            <a href="{{ route('tentang-kami') }}"
            class="{{ request()->routeIs('tentang-kami') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-4 py-3 rounded-md text-base font-medium hover:bg-gray-100 active:bg-gray-200 min-h-[48px] flex items-center transition-colors duration-200">
            Tentang Kami
            </a>

            <a href="{{ route('detail-layanan') }}"
            class="{{ request()->routeIs('detail-layanan') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-4 py-3 rounded-md text-base font-medium hover:bg-gray-100 active:bg-gray-200 min-h-[48px] flex items-center transition-colors duration-200">
            Layanan
            </a>

            <a href="{{ route('daftar-artikel-guest') }}"
            class="{{ request()->routeIs('daftar-artikel-guest') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-4 py-3 rounded-md text-base font-medium hover:bg-gray-100 active:bg-gray-200 min-h-[48px] flex items-center transition-colors duration-200">
            Artikel
            </a>

            <a href="{{ route('landing-page') }}#kontak"
            class="text-gray-700 block px-4 py-3 rounded-md text-base font-medium hover:bg-gray-100 active:bg-gray-200 min-h-[48px] flex items-center transition-colors duration-200">
            Kontak
            </a>

            <hr class="my-3 border-gray-300">
            
            {{-- Tombol Login/Register Mobile - Enhanced --}}
            <div class="space-y-3 pt-2">
                <a href="{{ route('login') }}" 
                   class="bg-[#3D8D7A] text-white block w-full text-center px-4 py-3 rounded-md text-base font-medium hover:bg-opacity-90 active:bg-opacity-80 transition-all duration-200 min-h-[48px] flex items-center justify-center">
                   Masuk
                </a>
                <a href="{{ route('register') }}" 
                   class="border-2 border-[#3D8D7A] text-[#3D8D7A] bg-white block w-full text-center px-4 py-3 rounded-md text-base font-medium hover:bg-[#3D8D7A] hover:text-white active:bg-opacity-80 transition-all duration-200 min-h-[48px] flex items-center justify-center">
                   Daftar
                </a>
            </div>
        </nav>
    </div>
</header>

{{-- Enhanced CSS untuk Mobile Menu --}}
<style>
    /* Ensure proper touch targets on mobile */
    @media (max-width: 768px) {
        .mobile-touch-target {
            min-height: 48px;
            min-width: 48px;
        }
        
        /* Prevent text selection on button */
        #mobile-menu-button {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }
        
        /* Smooth mobile menu animation */
        #mobile-menu.show {
            max-height: 500px !important;
            opacity: 1;
            transform: scaleY(1);
        }
        
        /* Prevent body scroll when menu is open */
        body.menu-open {
            overflow: hidden;
        }
        
        /* iOS specific fixes */
        #mobile-menu a {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1);
        }
    }
    
    /* Prevent zoom on iOS inputs */
    input, select, textarea {
        font-size: 16px !important;
    }
</style>

{{-- Enhanced JavaScript untuk Toggle Menu Mobile --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM loaded, initializing mobile menu...');
    
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const body = document.body;
    let isMenuOpen = false;

    // Check if elements exist
    if (!mobileMenuButton || !mobileMenu) {
        console.error('Mobile menu elements not found!');
        return;
    }

    console.log('Mobile menu elements found, setting up event listeners...');

    function toggleMenu() {
        console.log('Toggle menu called, current state:', isMenuOpen);
        
        if (isMenuOpen) {
            // Close menu
            mobileMenu.style.maxHeight = '0px';
            mobileMenu.style.opacity = '0';
            mobileMenu.style.transform = 'scaleY(0)';
            mobileMenu.classList.remove('show');
            mobileMenuButton.setAttribute('aria-expanded', 'false');
            body.classList.remove('menu-open');
            isMenuOpen = false;
            console.log('Menu closed');
        } else {
            // Open menu
            mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
            mobileMenu.style.opacity = '1';
            mobileMenu.style.transform = 'scaleY(1)';
            mobileMenu.classList.add('show');
            mobileMenuButton.setAttribute('aria-expanded', 'true');
            body.classList.add('menu-open');
            isMenuOpen = true;
            console.log('Menu opened');
        }
    }

    // Multiple event listeners for better mobile support
    mobileMenuButton.addEventListener('click', function(e) {
        console.log('Click event triggered');
        e.preventDefault();
        e.stopPropagation();
        toggleMenu();
    });

    // Touch events for better mobile support
    mobileMenuButton.addEventListener('touchstart', function(e) {
        console.log('Touch start event triggered');
    }, { passive: true });

    mobileMenuButton.addEventListener('touchend', function(e) {
        console.log('Touch end event triggered');
        e.preventDefault();
        e.stopPropagation();
        toggleMenu();
    });

    // Prevent double-tap zoom on iOS
    let lastTouchEnd = 0;
    mobileMenuButton.addEventListener('touchend', function(e) {
        const now = (new Date()).getTime();
        if (now - lastTouchEnd <= 300) {
            e.preventDefault();
        }
        lastTouchEnd = now;
    }, false);

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (isMenuOpen && !mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
            console.log('Clicking outside, closing menu');
            toggleMenu();
        }
    });

    // Close menu when clicking on menu items
    const menuItems = mobileMenu.querySelectorAll('a');
    menuItems.forEach(function(item) {
        item.addEventListener('click', function(e) {
            console.log('Menu item clicked:', this.textContent.trim());
            if (isMenuOpen) {
                // Small delay to show the click effect
                setTimeout(function() {
                    toggleMenu();
                }, 150);
            }
        });
    });

    // Handle escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            console.log('Escape key pressed, closing menu');
            toggleMenu();
        }
    });

    // Resize handler to close menu when switching to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768 && isMenuOpen) {
            console.log('Switched to desktop view, closing menu');
            toggleMenu();
        }
    });

    // Debug: Log screen size and touch capabilities
    console.log('Screen width:', window.innerWidth);
    console.log('Touch support:', 'ontouchstart' in window || navigator.maxTouchPoints > 0);
    console.log('User agent:', navigator.userAgent);
});

// Global error handler for debugging
window.addEventListener('error', function(e) {
    console.error('JavaScript error:', e.error, 'at', e.filename, ':', e.lineno);
});

// Additional debugging for touch events
window.addEventListener('load', function() {
    console.log('Page fully loaded');
    
    // Test touch capability
    const button = document.getElementById('mobile-menu-button');
    if (button) {
        console.log('Button element:', button);
        console.log('Button computed style:', window.getComputedStyle(button));
    }
});

// Service Worker registration check (can affect click events)
if ('serviceWorker' in navigator) {
    console.log('Service Worker is supported');
} else {
    console.log('Service Worker is not supported');
}
</script>