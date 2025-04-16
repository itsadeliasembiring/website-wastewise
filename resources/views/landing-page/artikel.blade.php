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

    <!-- Artikel Section -->
    <section class="pt-10 py-16 px-6 bg-gray-100">
        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-[#3D8D7A] mb-4">Artikel</h2>
            <div class="w-24 h-1 bg-[#3D8D7A] mx-auto mb-6"></div>
        </div>

            <!-- Artikel 1 -->
            <div class="bg-white rounded-xl shadow-md flex flex-col md:flex-row overflow-hidden mb-6 h-64">
                <!-- Gambar -->
                <div class="md:w-1/3 h-full">
                    <img src="{{ asset('assets/waste-wise-artikel.png') }}" alt="WasteWise" class="object-cover w-full h-full">
                </div>
                <!-- Konten Artikel -->
                <div class="p-6 md:w-2/3 flex flex-col justify-between h-full">
                    <div class="flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800">WasteWise: Inovasi Aplikasi Bank Sampah untuk Lingkungan Lebih Bersih</h3>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed text-justify [text-align:justify]">
                            Surabaya - Inovasi teknologi terus berkembang untuk mendukung keberlanjutan lingkungan. 
                            Salah satu solusi terbaru yang hadir adalah WasteWise, sebuah aplikasi bank sampah digital yang dirancang untuk membantu masyarakat dalam mengelola sampah dengan lebih efektif dan efisien.
                            Dengan fitur-fitur canggih dan sistem insentif yang menarik, WasteWise diharapkan mampu meningkatkan kesadaran masyarakat dalam mendaur ......
                        </p>
                    </div>
                    <div class="text-right">
                        <a href="#" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                    </div>
                </div>
            </div>

            <!-- Artikel 2 -->
            <div class="bg-white rounded-xl shadow-md flex flex-col md:flex-row overflow-hidden mb-6 h-64">
                <!-- Gambar -->
                <div class="md:w-1/3 h-full">
                    <img src="{{ asset('assets/kura-kura.jpg') }}" alt="Sampah di Laut" class="object-cover w-full h-full">
                </div>
                <!-- Konten Artikel -->
                <div class="p-6 md:w-2/3 flex flex-col justify-between h-full">
                    <div class="flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800">Sampah Plastik di Laut Ancam Ekosistem dan Biota Laut</h3>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed text-justify [text-align:justify]">
                            Surabaya - Sampah plastik di laut semakin mengancam ekosistem perairan Indonesia. 
                            Berdasarkan laporan terbaru dari organisasi lingkungan hidup, Indonesia masih menjadi salah satu penyumbang sampah plastik terbesar di dunia. 
                            Sampah yang berakhir di lautan dapat membahayakan kehidupan biota laut, termasuk penyu, ikan, burung laut, dan mamalia laut yang sering kali menelan plastik secara tidak sengaja. 
                            Jika tidak segera ditangani, ......</p>
                    </div>    
                    <div class="text-right">
                        <a href="#" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                    </div>
                </div>
            </div>

            <!-- Artikel 3 -->
            <div class="bg-white rounded-xl shadow-md flex flex-col md:flex-row overflow-hidden mb-6 h-64">
                <!-- Gambar -->
                <div class="md:w-1/3 h-full">
                    <img src="{{ asset('assets/bersih-pantai.jpg') }}" alt="Aksi Bersih Sampah" class="object-cover w-full h-full">
                </div>
                <!-- Konten Artikel -->
                <div class="p-6 md:w-2/3 flex flex-col justify-between h-full">
                    <div class="flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800">Aksi Bersih Pantai di Surabaya: Warga dan Relawan Bersatu Demi Laut yang Lebih Bersih</h3>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed text-justify [text-align:justify]">
                            Surabaya - Ratusan warga dan relawan lingkungan hidup berkumpul di Pantai Kenjeran, Surabaya, untuk melakukan aksi bersih-bersih pantai. 
                            Kegiatan ini merupakan bagian dari gerakan peduli lingkungan yang bertujuan mengurangi pencemaran sampah di pesisir laut. 
                            Sampah plastik mendominasi temuan dalam aksi ini, mencerminkan masih kurangnya kesadaran masyarakat terhadap dampak buruk limbah terhadap ekosistem .....</p>
                    </div>
                    <div class="text-right">
                        <a href="#" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="relative bg-[#3D8D7A] text-white">
        <!-- Wave Decoration Top -->
        <div class="absolute top-0 left-0 right-0 transform rotate-180">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-full">
                <path fill="#ffffff" fill-opacity="1" d="M0,96L80,80C160,64,320,32,480,32C640,32,800,64,960,69.3C1120,75,1280,53,1360,42.7L1440,32L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>                </svg>
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
            </div>
        </div>
    </section>

</body>
</html>
