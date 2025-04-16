
<div class="container mx-auto px-4 py-3">
    <div class="ml-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="hidden md:flex items-center space-x-2">
            <img src="{{ asset('Assets/logo-wastewise.svg') }}" alt="WasteWise Logo" class="h-12 w-12">
            <div>
                <h1 class="font-bold text-[#3D8D7A] text-xl">WasteWise</h1>
                <p class="text-xs text-black italic">"Ubah Sampah Jadi Berkah"</p>
            </div>
        </div>
        
        <!-- Navigasi -->
        <nav class="hidden md:flex space-x-8 pl-14">
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

            <a href="{{ route('artikel') }}"
            class="{{ request()->routeIs('artikel') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
            Artikel
            </a>

            <a href="{{ route('landing-page') }}#kontak"
            class="{{ request()->routeIs('landing-page') && request()->getRequestUri() === '/landing-page#kontak' ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
            Kontak
        </nav>


        <div class="hidden md:flex space-x-2">
            <a href="{{ route('login') }}" class="bg-[#3D8D7A] text-white px-6 py-2 rounded-md hover:bg-opacity-90 transition duration-300">Masuk</a>

            <a href="{{ route('register') }}" class="bg-[#3D8D7A] text-white px-6 py-2 rounded-md hover:bg-opacity-90 transition duration-300">Daftar</a>
        </div>
        
        <!-- Mobile -->
        <button class="md:hidden text-slate-800" id="mobile-menu-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="py-2 space-y-3">
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

            <a href="{{ route('artikel') }}"
            class="{{ request()->routeIs('artikel') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
            Artikel
            </a>

            <a href="{{ route('landing-page') }}#kontak"
            class="text-[#393E46] hover:text-[#3D8D7A] transition duration-300 font-medium">
            Kontak
            </a>
        </div>
    </div>
</div>