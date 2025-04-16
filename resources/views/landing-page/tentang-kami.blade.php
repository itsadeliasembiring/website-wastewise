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

        <!-- Tentang Kami Section -->
        <section id="tentangkami" class="py-16 bg-gradient-to-b from-white to-gray-50">
            <div class="container mx-auto px-4">
                <!-- Heading -->
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#3D8D7A] mb-4">Tentang Kami</h2>
                    <div class="w-24 h-1 bg-[#3D8D7A] mx-auto mb-6"></div>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">Misi kami adalah menjadikan Surabaya lebih bersih dengan pendekatan inovatif terhadap pengelolaan sampah.</p>
                </div>
                
                <!-- Content -->
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <!-- Image -->
                    <div class="lg:w-1/2">
                        <div class="rounded-lg overflow-hidden shadow-xl">
                            <img src="{{ asset('assets/logo-wastewise.svg') }}" alt="Tim WasteWise" class="w-full h-auto object-cover"/>
                        </div>
                    </div>
                    
                    <!-- Text Content -->
                    <div class="lg:w-1/2">
                        <h3 class="text-3xl font-bold text-[#3D8D7A] mb-4">WasteWise: Ubah Sampah Jadi Berkah</h3>
                        <p class="text-gray-700 text-base mb-4 text-justify">
                            WasteWise merupakan platform berbasis bank sampah sekaligus media edukasi interaktif yang dirancang sebagai solusi dalam mengatasi permasalahan pengelolaan sampah di Surabaya.
                        </p>
                        <p class="text-gray-700 mb-6 text-justify">
                            Kami berkomitmen untuk mendorong kebiasaan baru dalam mengelola sampah secara bijak, melalui pendekatan yang mudah, menyenangkan, dan berdampak positif. Dengan mengusung misi mengurangi pencemaran lingkungan dan meningkatkan kesadaran masyarakat, WasteWise menyediakan berbagai fitur unggulan.
                        </p>
                        
                        <!-- Features -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-[#3D8D7A] rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Layanan Jemput Sampah</h4>
                                    <p class="text-sm text-gray-600">Kemudahan dalam menyetor sampah</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-[#3D8D7A] rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Pencatatan Riwayat</h4>
                                    <p class="text-sm text-gray-600">Dokumentasi lengkap setoran sampah</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-[#3D8D7A] rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Edukasi Berbasis AI</h4>
                                    <p class="text-sm text-gray-600">Pemahaman mendalam tentang pengolahan sampah</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-[#3D8D7A] rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Sistem Poin Rewards</h4>
                                    <p class="text-sm text-gray-600">Tukar poin atau donasikan untuk lingkungan</p>
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 mb-6 text-justify">
                            Melalui WasteWise, kami percaya bahwa perubahan besar bisa dimulai dari langkah kecil. Bersama, mari wujudkan Surabaya yang lebih bersih, hijau, dan berkelanjutan.
                        </p>
                        
                        <div class="flex space-x-4">
                            <a href="#layanan" class="bg-[#3D8D7A] text-white px-6 py-3 rounded-md hover:bg-opacity-90 transition duration-300 inline-flex items-center">
                                <span>Layanan Kami</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#kontak" class="border-2 border-[#3D8D7A] text-[#3D8D7A] px-6 py-3 rounded-md hover:bg-gray-50 transition duration-300">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
                
                <!-- Stats -->
                <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-lg shadow-md text-center">
                        <div class="text-[#3D8D7A] text-4xl font-bold mb-2">50+</div>
                        <div class="text-gray-600 font-medium">Pengguna Aktif</div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-lg shadow-md text-center">
                        <div class="text-[#3D8D7A] text-4xl font-bold mb-2">1.5 ton</div>
                        <div class="text-gray-600 font-medium">Sampah Terkelola</div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-lg shadow-md text-center">
                        <div class="text-[#3D8D7A] text-4xl font-bold mb-2">10+</div>
                        <div class="text-gray-600 font-medium">Komunitas Mitra</div>
                    </div>
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
                </div>
            </div>
        </section>
    </body>
</html>