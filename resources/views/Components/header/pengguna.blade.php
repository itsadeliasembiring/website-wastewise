{{-- Header --}}
<header class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            {{-- Logo --}}
            <a href="{{ route('setor-sampah') }}" class="flex items-center space-x-2">
                <img src="{{ asset('assets/logo-wastewise.svg') }}" alt="WasteWise Logo" class="h-12 w-12">
                <div>
                    <h1 class="font-bold text-[#3D8D7A] text-xl">WasteWise</h1>
                    <p class="text-xs text-black italic">"Ubah Sampah Jadi Berkah"</p>
                </div>
            </a>

            {{-- Navigasi Desktop --}}
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{ route('setor-sampah') }}"
                   class="{{ request()->routeIs('setor-sampah', 'setor-langsung', 'jemput-sampah') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
                   Setor Sampah
                </a>
                <a href="{{ route('beranda-edukasi') }}"
                   class="{{ request()->routeIs('beranda-edukasi') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
                   Edukasi
                </a>
                <a href="{{ route('tukar-poin') }}"
                   class="{{ request()->routeIs('tukar-poin') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
                   Tukar Poin
                </a>
                <a href="{{ route('pengguna-riwayat-setor-sampah') }}"
                   class="{{ request()->routeIs('pengguna-riwayat-setor-sampah') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
                   Riwayat
                </a>
                <a href="{{ route('ubah-profil') }}"
                   class="{{ request()->routeIs('ubah-profil','pengguna.ubah-password','ubah-profil') ? 'text-[#3D8D7A]' : 'text-[#393E46]' }} hover:text-[#3D8D7A] transition duration-300 font-medium">
                   Profil
                </a>
                {{-- Tombol Logout untuk Desktop --}}
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300 font-medium">
                    Logout
                    </button>
                </form>
            </nav>

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
            <a href="{{ route('setor-sampah') }}"
               class="{{ request()->routeIs('setor-sampah', 'setor-langsung', 'jemput-sampah') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">
                Setor Sampah
            </a>
            <a href="{{ route('beranda-edukasi') }}"
               class="{{ request()->routeIs('beranda-edukasi') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">
               Edukasi
            </a>
            <a href="{{ route('tukar-poin') }}"
               class="{{ request()->routeIs('tukar-poin') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">
               Tukar Poin
            </a>
            <a href="{{ route('pengguna-riwayat-setor-sampah') }}"
               class="{{ request()->routeIs('pengguna-riwayat-setor-sampah') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">
               Riwayat
            </a>
            <a href="{{ route('ubah-profil') }}"
               class="{{ request()->routeIs('ubah-profil','pengguna.ubah-password','ubah-profil') ? 'bg-[#3D8D7A] text-white' : 'text-gray-700' }} block px-3 py-2 rounded-md text-base font-medium hover:bg-gray-200">
               Profil
            </a>
            <hr class="my-2">
            {{-- Tombol Logout untuk Mobile --}}
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="bg-red-500 text-white block w-full text-center px-3 py-2 rounded-md text-base font-medium hover:bg-red-600 transition duration-300">
                    Logout
                </button>
            </form>
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