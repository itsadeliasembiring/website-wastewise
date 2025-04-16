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
    <section class="text-white py-14 px-7 mb-5" style="background-color: #3D8D7A;" id="beranda">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-7">
            <div>
                <h2 class="text-2xl font-semibold mb-1">Setor Sampahmu Sekarang!</h2>
                <h1 class="text-5xl md:text-5xl font-bold leading-tight" style="color: #FFFFDD;">Ubah Sampah Jadi Berkah</h1>
                <p class="mt-1 text-lg text-justify">
                    Yuk setor sampah kamu, ke Bank Sampah terdekat! sampah yang disetorkan akan diubah menjadi poin yang bisa ditukarkan dengan barang ramah lingkungan atau disalurkan sebagai donasi untuk yang membutuhkan.
                </p>
            </div>
            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('assets/make-use-recycle.png') }}" alt="Recycle Illustration" class="w-80 md:w-90 lg:w-[450px]">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="w-full px-4 -mt-16 flex justify-center">
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
            <!-- Setor Mandiri Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6 w-full md:w-[480px] h-auto flex flex-col items-center justify-between text-center">
                <div class="flex items-center">
                    <div class="ml-4">
                        <h3 class="text-3xl font-bold text-[#016A70]">Setor Mandiri</h3>
                        <img src="{{ asset('assets/setor-manual.jpg') }}" alt="Setor Mandiri" class="w-46 h-45 mb-4 items-center mx-auto">
                        <p class="text-gray-600 text-base">"Bawa sampahmu sendiri ke bank sampah terdekat, jadi bagian dari perubahan mulai hari ini!"</p>
                    </div>
                </div>
            </div>
            
            <!-- Jemput Sampah Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6 w-full md:w-[480px] h-auto flex flex-col items-center justify-between text-center">
                <div class="flex items-center">
                    <div class="ml-4">
                        <h3 class="text-3xl font-bold text-[#016A70]">Jemput Sampah</h3>
                        <img src="{{ asset('assets/jemput-sampah.jpg') }}" alt="Jemput Sampah" class="w-80 h-45 mb-4 items-center mx-auto">
                        <p class="text-gray-600 text-base">"Sampah menumpuk? Duduk santai saja, kami yang datang menjemput ke rumahmu!"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Waste Types Section -->
    <section class="container mx-auto px-6 py-12 mb-1">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-2 text-[#1F5E7F]">Jenis Sampah</h2>
            <p class="text-gray-600 text-lg text-center mb-8 max-w-2xl mx-auto">
                Kami menerima berbagai jenis sampah anorganik dan organik berdasarkan jenis dibawah ini.
            </p>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Plastic -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/plastik.png') }}" alt="Plastic" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Plastik</h3>
            </div>
            
            <!-- Glass -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/kaca.png') }}" alt="Glass" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Kaca</h3>
            </div>
            
            <!-- Cooking Oil -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/minyak.png') }}" alt="Cooking Oil" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Minyak Jelantah</h3>
            </div>
            
            <!-- Food Waste -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/organik.png') }}" alt="Food Waste" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Sampah Makanan</h3>
            </div>
            
            <!-- Paper -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/kardus.png') }}" alt="Paper" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Kertas</h3>
            </div>
            
            <!-- Cans -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/kaleng.png') }}" alt="Cans" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Kaleng</h3>
            </div>
        </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="container mx-auto px-4 py-14 mt-1" id="alur-setor">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl mb-2 font-bold text-center mb-3 text-[#1F5E7F]">Alur Setor Sampah</h2>
            <p class="text-gray-600 text-lg text-center mb-10 max-w-2xl mx-auto">
                Setor sampah dengan 3 langkah mudah, tanpa ribet!
            </p>
        
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
            <!-- Wrapper untuk semua langkah -->
            <div class="flex flex-col gap-12">
                <!-- Step 1 -->
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
                    <img src="{{ asset('assets/kemas.png') }}" alt="Kemas" class="w-20 h-20 md:w-24 md:h-24 flex-shrink-0">
                <div>
                    <div class="inline-block bg-teal-600 text-white text-base font-semibold px-4 py-2 rounded-md mb-3">1. Kemas</div>
                    <p class="text-gray-700 text-base md:text-lg">
                        Pastikan sampah telah dicuci dan dikeringkan dengan baik sebelum dikemas sesuai jenisnya.
                    </p>
                </div>
                </div>
            
                <!-- Step 2 -->
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
                    <img src="{{ asset('assets/kirim.png') }}" alt="Send" class="w-20 h-20 md:w-24 md:h-24 flex-shrink-0">
                <div>
                    <div class="inline-block bg-teal-600 text-white text-base font-semibold px-4 py-2 rounded-md mb-3">2. Kirim</div>
                    <p class="text-gray-700 text-base md:text-lg">
                        Kirimkan sampah melalui layanan jemput atau setorkan langsung ke bank sampah terdekat.
                    </p>
                </div>
                </div>
            
                <!-- Step 3 -->
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
                    <img src="{{ asset('assets/scan.png') }}" alt="Scan" class="w-20 h-20 md:w-24 md:h-24 flex-shrink-0">
                <div>
                    <div class="inline-block bg-teal-600 text-white text-base font-semibold px-4 py-2 rounded-md mb-3">3. Scan</div>
                    <p class="text-gray-700 text-base md:text-lg">
                        Scan barcode yang diberikan oleh petugas bank sampah untuk mendapatkan poin.
                    </p>
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