{{-- Header --}}
<header class="bg-white shadow-md">
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
            
            {{-- Tombol Menu Mobile --}}
            <button class="md:hidden text-slate-800" id="mobile-menu-button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    
    {{-- Menu Navigasi Mobile (Dropdown) --}}
    <div class="md:hidden hidden" id="mobile-menu">
        <nav class="px-2 pt-2 pb-4 space-y-1 sm:px-3">
            <a href="{{ route('landing-page') }}"
            class="{{ request()->routeIs('landing-page') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">
            Beranda
            </a>
            
            <a href="{{ route('tentang-kami') }}"
            class="{{ request()->routeIs('tentang-kami') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">
            Tentang Kami
            </a>

            <a href="{{ route('detail-layanan') }}"
            class="{{ request()->routeIs('detail-layanan') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">
            Layanan
            </a>

            <a href="{{ route('daftar-artikel-guest') }}"
            class="{{ request()->routeIs('daftar-artikel-guest') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">
            Artikel
            </a>

            <a href="{{ route('landing-page') }}#kontak"
            class="text-gray-700 block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">
            Kontak
            </a>

            <hr class="my-2">
            
            {{-- Tombol Login/Register Mobile --}}
            <div class="space-y-2">
                <a href="{{ route('login') }}" 
                   class="bg-[#3D8D7A] text-white block w-full text-center px-3 py-2 rounded-md text-base font-medium hover:bg-opacity-90 transition duration-300">
                   Masuk
                </a>
                <a href="{{ route('register') }}" 
                   class="bg-[#3D8D7A] text-white block w-full text-center px-3 py-2 rounded-md text-base font-medium hover:bg-opacity-90 transition duration-300">
                   Daftar
                </a>
            </div>
        </nav>
    </div>
</header>

{{-- JavaScript untuk Toggle Menu Mobile --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>