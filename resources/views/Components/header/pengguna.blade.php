
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
        <nav class="hidden md:flex space-x-8">
            <a href="{{ route('setor-sampah') }}"
            class="{{ request()->routeIs('setor-sampah') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
            Setor Sampah
            </a>

            <a href="{{ route('beranda-edukasi') }}"
            class="{{ request()->routeIs('beranda-edukasi') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
            Edukasi
            </a>

            <a href="{{ route('tukarpoin') }}"
            class="{{ request()->routeIs('tukarpoin') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
            Tukar Poin
            </a>

            <a href="{{ route('pengguna-riwayat-setor-sampah') }}"
            class="{{ request()->routeIs('pengguna-riwayat-setor-sampah') && request()->getRequestUri() === 'user/riwayat-setor-sampah' ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
            Riwayat
            </a>

            <a href="{{ route('ubah-profil') }}"
            class="{{ request()->routeIs('ubah-profil') && request()->getRequestUri() === '/ubah-profil' ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
            Profil
            </a>
        </nav>

        <img src="{{ Auth::user()->profile_photo_url }}" 
            class="h-11 w-11 bg-green-200 rounded-full object-cover" 
            alt="Profile Photo">
        <!-- Mobile -->
        <button class="md:hidden text-slate-800" id="mobile-menu-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
</div>