<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WasteWise - Ubah Sampah Jadi Berkah</title>
        <meta name="description" content="Platform berbasis bank sampah sekaligus media edukasi interaktif untuk mengatasi permasalahan pengelolaan sampah">
        
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
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
                        <a href="#beranda" class="text-[#393E46] hover:text-[#3D8D7A] transition duration-300 font-medium">Beranda</a>
                        <a href="#tentangkami" class="text-[#393E46] hover:text-[#3D8D7A] transition duration-300 font-medium">Tentang Kami</a>
                        <a href="#layanan" class="text-[#393E46] hover:text-[#3D8D7A] transition duration-300 font-medium">Layanan</a>
                        <a href="#artikel" class="text-[#393E46] hover:text-[#3D8D7A] transition duration-300 font-medium">Artikel</a>
                        <a href="#kontak" class="text-[#393E46] hover:text-[#3D8D7A] transition duration-300 font-medium">Kontak</a>
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
                        <a href="#beranda" class="block text-slate-800 hover:text-[#3D8D7A] transition duration-300 py-1">Beranda</a>
                        <a href="#layanan" class="block text-slate-800 hover:text-[#3D8D7A] transition duration-300 py-1">Layanan</a>
                        <a href="#artikel" class="block text-slate-800 hover:text-[#3D8D7A] transition duration-300 py-1">Artikel</a>
                        <a href="#kontak" class="block text-slate-800 hover:text-[#3D8D7A] transition duration-300 py-1">Kontak</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section id="beranda" class="relative bg-slate-800 text-white overflow-hidden">
            <div class="absolute inset-0 z-0 opacity-30">
                <!-- <div class="absolute inset-0 bg-gradient-to-r from-slate-800 to-[#3D8D7A] opacity-90"></div> -->
                <img src="{{ asset('Assets/background-landing-page.png') }}" alt="Background" class="w-full h-full object-cover">
            </div>
            
            <div class="container mx-auto px-4 py-20 md:py-32 relative z-10">
                <div class="flex flex-col md:flex-row items-center">
                    <!-- <div class="md:w-1/2 mb-10 md:mb-0">
                        <img src="{{ asset('Assets/logo-wastewise.svg') }}" alt="WasteWise Mascot" class="w-64 mx-auto md:mx-0">
                    </div>
                    -->

                    <div class="md:w-1/2 flex justify-center">
                        <img src="{{ asset('Assets/logo-wastewise.svg') }}" alt="WasteWise Mascot" class="w-64">
                    </div>
                    <div class="md:w-1/2 text-center md:text-left">
                        <h2 class="text-2xl font-medium mb-2">Halo, WasteWarriors!</h2>
                        <h1 class="text-4xl md:text-5xl font-bold mb-6 text-emerald-200">WasteWise</h1>
                        <p class="mb-8">
                        WasteWise merupakan platform berbasis bank sampah sekaligus media edukasi interaktif yang dirancang sebagai solusi dalam mengatasi permasalahan pengelolaan sampah di Surabaya. WasteWise memiliki misi untuk mendorong pemanfaatan kembali sampah dengan cara yang lebih baik.
                        </p>
                        <a href="#" class="bg-[#3D8D7A] text-white px-6 py-2 rounded-md hover:bg-opacity-90 transition duration-300 inline-block">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            
            <!-- Wave -->
            <!-- <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-full">
                    <path fill="#ffffff" fill-opacity="1" d="M0,96L80,80C160,64,320,32,480,32C640,32,800,64,960,69.3C1120,75,1280,53,1360,42.7L1440,32L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
                </svg>
            </div> -->
        </section>

        <!-- Services Section -->
        <section id="layanan" class="py-16 bg-gray-50">
            <div class="container mx-auto px-13 md:px-20">
                <h2 class="text-3xl font-bold text-center text-[#1F5E7F] mb-12">Layanan</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Service 1 -->
                    <div class="bg-[#A3D1C6] px-5 py-10 rounded-[20px] flex flex-col items-center text-center h-full justify-center">
                        <div class="mb-4">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#3D8D7A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg> -->
                            <img src="{{ asset('Assets/icon/icon-jemput-sampah.svg') }}" alt="icon-jemput-sampah" class="h-16 w-16">
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-black">Jemput Sampah</h3>
                        <p class="text-black">Setor sampah lebih mudah tanpa perlu ke Bank Sampah

                        </p>
                    </div>
                    
                    <!-- Service 2 -->
                    <div class="bg-[#A3D1C6] px-5 py-10 rounded-[20px] flex flex-col items-center text-center h-full justify-center">
                        <div class="mb-4">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#3D8D7A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg> -->
                            <img src="{{ asset('Assets/icon/icon-edukasi.svg') }}" alt="icon-edukasi" class="h-16 w-16">
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-black">Edukasi Berbasis AI</h3>
                        <p class="text-black">Belajar kelola sampah dengan bantuan deteksi AI</p>
                    </div>
                    
                    <!-- Service 3 -->
                    <div class="bg-[#A3D1C6] px-5 py-10 rounded-[20px] flex flex-col items-center text-center h-full justify-center">
                        <div class="mb-4">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#3D8D7A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg> -->
                            <img src="{{ asset('Assets/icon/icon-poin.svg') }}" alt="icon-poin" class="h-16 w-16">
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-black">Sistem Poin</h3>
                        <p class="text-black">Kumpulkan poin dari setiap setoran dan tukar dengan hadiah menarik.</p>
                    </div>
                    
                    <!-- Service 4 -->
                    <div class="bg-[#A3D1C6] px-8 py-15 rounded-[20px] flex flex-col items-center text-center h-full justify-center">
                        <div class="mb-4">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#3D8D7A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg> -->
                            <img src="{{ asset('Assets/icon/icon-daur-ulang.svg') }}" alt="icon-daur-ulang" class="h-16 w-16">
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-black">Riwayat Setor Sampah</h3>
                        <p class="text-black">Pantau jejak penyetoran sampah dengan mudah.</p>
                    </div>
                </div>
                
            </div>
        </section>

        <!-- Articles Section -->
        <section id="artikel" class="py-16">
            <div class="container mx-auto px-13 md:px-20">
                <h2 class="text-3xl font-bold text-center text-[#1F5E7F] mb-12">Artikel</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Article 1 -->
                    <div class="bg-[#F2F3F7] rounded-md shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('Assets/waste-wise-artikel.png') }}" alt="WasteWise App" class="w-full h-full object-cover p-4">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <span class="text-xs text-gray-500">17/02/2025, 09:30 WIB | News Bank Sampah</span>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-slate-800">WasteWise: Inovasi Aplikasi Bank Sampah untuk Lingkungan Lebih Bersih</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                Surabaya - Inovasi teknologi terus berkembang guna mendukung keberlanjutan lingkungan. Salah satu solusi terbaru adalah WasteWise, aplikasi...
                            </p>
                            <a href="#" class="text-[#1E6397] font-medium hover:underline">Baca Selengkapnya</a>
                        </div>
                    </div>
                    
                    <!-- Article 2 -->
                    <div class="bg-[#F2F3F7] rounded-md shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('Assets/kura-kura.jpg') }}" alt="Plastic Waste" class="w-full h-full object-cover p-4">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <span class="text-xs text-gray-500">15/02/2025, 13:30 WIB | Berita Bank Sampah</span>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-slate-800">Sampah Plastik di Laut Ancam Ekosistem dan Biota Laut</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                Sampah plastik di laut semakin mengancam perairan Indonesia. Berdasarkan laporan terbaru dari organisasi lingkungan hidup, Indonesia menjadi salah satu...
                            </p>
                            <a href="#" class="text-[#1E6397] font-medium hover:underline">Baca Selengkapnya</a>
                        </div>
                    </div>
                    
                    <!-- Article 3 -->
                    <div class="bg-[#F2F3F7] rounded-md shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('Assets/bersih-pantai.jpg') }}" alt="Beach Cleanup" class="w-full h-full object-cover p-4">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <span class="text-xs text-gray-500">01/02/2025, 12:40 WIB | Aksi Bank Sampah</span>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-slate-800">Aksi Bersih Pantai di Surabaya: Warga dan Relawan Bersatu Demi Laut yang Lebih Bersih</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                Surabaya - Ratusan warga dan relawan lingkungan hidup, berkumpul di Pantai Kenjeran, Surabaya, untuk melakukan aksi bersih-bersih pantai. Kegia...
                            </p>
                            <a href="#" class="text-[#1E6397] font-medium hover:underline">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                
                <!-- Article Navigation -->
                <div class="flex justify-end mt-8">
                    <button class="p-2 rounded-full bg-emerald-100 text-[#3D8D7A] hover:bg-[#3D8D7A] hover:text-white transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="kontak" class="relative bg-[#3D8D7A] text-white">
            <!-- Wave Decoration Top -->
            <div class="absolute top-0 left-0 right-0 transform rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-full">
                    <path fill="#ffffff" fill-opacity="1" d="M0,96L80,80C160,64,320,32,480,32C640,32,800,64,960,69.3C1120,75,1280,53,1360,42.7L1440,32L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
                </svg>
            </div>
            
            <div class="container mx-auto px-4 py-16 pt-32">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="pl-15">
                        <img src="{{ asset('Assets/logo-wastewise.svg') }}" alt="WasteWise Logo" class="h-30 w-30">
                        <h2 class="text-2xl font-bold">WasteWise</h2>
                        <p class="text-[16px] text-white">"Ubah Sampah Jadi Berkah"</p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Fitur</h2>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-emerald-200">Halaman Beranda</a></li>
                            <li><a href="#" class="hover:text-emerald-200">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-emerald-200">Layanan</a></li>
                            <li><a href="#" class="hover:text-emerald-200">Artikel</a></li>
                            <li><a href="#" class="hover:text-emerald-200">Kontak Kami</a></li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Kontak Kami</h2>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21.714 3 15 3 8V5z" />
                                </svg>
                                <span>+62 812 005 2315</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>wastewisegyu53@gmail.com</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Jalan Pengabdi No. 101 G Rungkut, Surabaya, Indonesia 123456</span>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Column 3: Download App -->
                    <!-- <div>
                        <h2 class="text-2xl font-bold mb-4">Download Aplikasi</h2>
                        <div class="flex flex-col space-y-3">
                            <a href="#" class="bg-black rounded-md px-4 py-2 flex items-center hover:bg-opacity-80 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#3D8D7A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
    </body>
</html>