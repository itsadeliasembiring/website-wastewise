<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Setor Sampah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">

            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>


    <!-- Hero Section -->
    <section class="text-white py-14 px-7 mb-5" style="background-color: #3D8D7A;">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-7">
            <div>
                <h2 class="text-xl font-semibold mb-2">Setor Sampahmu Sekarang!</h2>
                <h1 class="text-4xl md:text-4xl font-bold leading-tight" style="color: #FFFFDD;">Ubah Sampah Jadi Berkah</h1>
                <p class="mt-5 text-base text-justify">
                    Yuk setor sampah kamu, ke Bank Sampah terdekat! sampah yang disetorkan akan diubah menjadi poin yang bisa ditukarkan dengan barang ramah lingkungan atau disalurkan sebagai donasi untuk yang membutuhkan.
                </p>
                <button class="bg-white text-teal-600 px-6 py-2 rounded text-sm font-medium hover:bg-gray-100 mt-6"  onclick="window.location.href='{{ route('setor-langsung') }}'">
                    Setor Sampah
                </button>
            </div>
            <div class="flex justify-center md:justify-end">
            <img src="{{ asset('assets/make-use-recycle.png') }}" alt="Recycle Illustration" class="w-80 md:w-90 lg:w-[450px]">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="w-full px-4 -mt-16 flex justify-center">
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
            <!-- Recycled Waste Card -->
            <div class="bg-white rounded-lg shadow-md p-6 w-full md:w-[380px] h-auto flex flex-col items-center justify-between text-center">
                <div class="flex items-center">
                    <img src="{{ asset('assets/icon-sampah/recycle.png') }}" alt="Recycle Icon" class="w-20 h-20 mb-3">
                    <div class="ml-4">
                        <h3 class="text-3xl font-extrabold text-[#016A70]">50 Kg</h3>
                        <p class="text-gray-600 text-xl">Sampah Terdaur Ulang</p>
                    </div>
                </div>
            </div>
            
            <!-- Points Card -->
            <div class="bg-white rounded-lg shadow-md p-6 w-full md:w-[380px] h-auto flex flex-col items-center justify-between text-center">
                <div class="flex items-center">
                    <img src="{{ asset('assets/coin.svg') }}" alt="Points Icon" class="w-20 h-20 mb-3">
                    <div class="ml-4">
                        <h3 class="text-3xl font-extrabold text-[#016A70]">929</h3>
                        <p class="text-gray-600 text-xl">Point Terkumpul</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Waste Types Section -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-4xl font-bold text-center mb-2 text-[#1F5E7F]">Jenis Sampah</h2>
        <p class="text-gray-600 text-center mb-8 max-w-2xl mx-auto">
            Kami menerima berbagai jenis sampah anorganik dan organik berdasarkan jenis dibawah ini.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            <!-- Plastic -->
            <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center h-52">
                <div class="bg-green-100 rounded-full p-3 mb-3 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/plastik.png') }}" alt="Plastic" class="w-13 h-13">
                </div>
                <h3 class="font-semibold text-xl mb-1">Plastik</h3>
                <p class="text-yellow-500 flex items-center font-medium">
                    <span class="bg-yellow-200 w-3 h-3 rounded-full mr-1"></span>
                    110 Poin/Kg
                </p>
            </div>
            
            <!-- Glass -->
            <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center h-52">
                <div class="bg-green-100 rounded-full p-3 mb-3 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/kaca.png') }}" alt="Glass" class="w-13 h-13">
                </div>
                <h3 class="font-semibold text-xl mb-1">Kaca</h3>
                <p class="text-yellow-500 flex items-center font-medium">
                    <span class="bg-yellow-200 w-3 h-3 rounded-full mr-1"></span>
                    120 Poin/Kg
                </p>
            </div>
            
            <!-- Cooking Oil -->
            <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center h-52">
                <div class="bg-green-100 rounded-full p-3 mb-3 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/minyak.png') }}" alt="Cooking Oil" class="w-13 h-13">
                </div>
                <h3 class="font-semibold text-xl mb-1">Minyak Jelantah</h3>
                <p class="text-yellow-500 flex items-center font-medium">
                    <span class="bg-yellow-200 w-3 h-3 rounded-full mr-1"></span>
                    100 Poin/Kg
                </p>
            </div>
            
            <!-- Food Waste -->
            <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center h-52">
                <div class="bg-green-100 rounded-full p-3 mb-3 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/organik.png') }}" alt="Food Waste" class="w-13 h-13">
                </div>
                <h3 class="font-semibold text-xl mb-1">Sampah Makanan</h3>
                <p class="text-yellow-500 flex items-center font-medium">
                    <span class="bg-yellow-200 w-3 h-3 rounded-full mr-1"></span>
                    80 Poin/Kg
                </p>
            </div>
            
            <!-- Paper -->
            <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center h-52">
                <div class="bg-green-100 rounded-full p-3 mb-3 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/kardus.png') }}" alt="Paper" class="w-13 h-13">
                </div>
                <h3 class="font-semibold text-xl mb-1">Kertas</h3>
                <p class="text-yellow-500 flex items-center font-medium">
                    <span class="bg-yellow-200 w-3 h-3 rounded-full mr-1"></span>
                    90 Poin/Kg
                </p>
            </div>
            
            <!-- Cans -->
            <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center h-52">
                <div class="bg-green-100 rounded-full p-3 mb-3 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('assets/icon-sampah/kaleng.png') }}" alt="Cans" class="w-13 h-13">
                </div>
                <h3 class="font-semibold text-xl mb-1">Kaleng</h3>
                <p class="text-yellow-500 flex items-center font-medium">
                    <span class="bg-yellow-200 w-3 h-3 rounded-full mr-1"></span>
                    150 Poin/Kg
                </p>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="container mx-auto px-4 py-12">
        <h2 class="text-4xl font-bold text-center mb-2 text-[#1F5E7F]">Alur Setor Sampah</h2>
        <p class="text-gray-600 text-lg text-center mb-8">
            Setor sampah dengan 3 langkah mudah, tanpa ribet!
        </p>
        
        <div class="bg-white rounded-2xl shadow-md p-12 max-w-4xl mx-auto">
        <!-- Wrapper untuk semua langkah -->
        <div class="flex flex-col gap-10">
            <!-- Step 1 -->
            <div class="flex items-start gap-10">
                <img src="{{ asset('assets/kemas.png') }}" alt="Kemas" class="w-24 h-24 flex-shrink-0">
                <div>
                    <div class="inline-block bg-teal-600 text-white text-base font-semibold px-3 py-1 rounded-md mb-2">1. Kemas</div>
                    <p class="text-gray-700 text-base">
                        Pastikan sampah telah dicuci dan dikeringkan dengan baik sebelum dikemas sesuai jenisnya.
                    </p>
                </div>
            </div>
            
            <!-- Step 2 -->
            <div class="flex items-start gap-10">
                <img src="{{ asset('assets/kirim.png') }}" alt="Send" class="w-24 h-24 flex-shrink-0">
                <div>
                    <div class="inline-block bg-teal-600 text-white text-base font-semibold px-3 py-1 rounded-md mb-2">2. Kirim</div>
                    <p class="text-gray-700 text-base">
                        Kirimkan sampah melalui layanan jemput atau setorkan langsung ke bank sampah terdekat.
                    </p>
                </div>
            </div>
            
            <!-- Step 3 -->
            <div class="flex items-start gap-10">
                <img src="{{ asset('assets/scan.png') }}" alt="Scan" class="w-24 h-24 flex-shrink-0">
                <div>
                    <div class="inline-block bg-teal-600 text-white text-base font-semibold px-3 py-1 rounded-md mb-2">3. Scan</div>
                    <p class="text-gray-700 text-base">
                        Scan barcode yang diberikan oleh petugas bank sampah untuk mendapatkan poin.
                    </p>
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