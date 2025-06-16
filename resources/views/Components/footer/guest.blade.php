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
                    <li><a href="{{ route('landing-page') }}" class="hover:text-emerald-200">Halaman Beranda</a></li>
                    <li><a href="{{ route('tentang-kami') }}" class="hover:text-emerald-200">Tentang Kami</a></li>
                    <li><a href="{{ route('detail-layanan') }}" class="hover:text-emerald-200">Layanan</a></li>
                    <li><a href="{{ route('daftar-artikel-guest') }}" class="hover:text-emerald-200">Artikel</a></li>
                    <li><a href="{{ route('landing-page') }}#kontak" class="hover:text-emerald-200">Kontak Kami</a></li>
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