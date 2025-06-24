<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WasteWise - Ubah Sampah Jadi Berkah</title>
        <meta name="description" content="Platform berbasis bank sampah sekaligus media edukasi interaktif untuk mengatasi permasalahan pengelolaan sampah">
        
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <x-header.guest/>
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
                <img src="{{ asset('Assets/make-use-recycle.png') }}" alt="Recycle Illustration" class="w-80 md:w-90 lg:w-[450px]">
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
                        <img src="{{ asset('Assets/setor-manual.jpg') }}" alt="Setor Mandiri" class="w-46 h-45 mb-4 items-center mx-auto">
                        <p class="text-gray-600 text-base">"Bawa sampahmu sendiri ke bank sampah terdekat, jadi bagian dari perubahan mulai hari ini!"</p>
                    </div>
                </div>
            </div>
            
            <!-- Jemput Sampah Card -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-6 w-full md:w-[480px] h-auto flex flex-col items-center justify-between text-center">
                <div class="flex items-center">
                    <div class="ml-4">
                        <h3 class="text-3xl font-bold text-[#016A70]">Jemput Sampah</h3>
                        <img src="{{ asset('Assets/jemput-sampah.jpg') }}" alt="Jemput Sampah" class="w-80 h-45 mb-4 items-center mx-auto">
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
                    <img src="{{ asset('Assets/icon-sampah/plastik.png') }}" alt="Plastic" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Plastik</h3>
            </div>
            
            <!-- Glass -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('Assets/icon-sampah/kaca.png') }}" alt="Glass" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Kaca</h3>
            </div>
            
            <!-- Cooking Oil -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('Assets/icon-sampah/minyak.png') }}" alt="Cooking Oil" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Minyak Jelantah</h3>
            </div>
            
            <!-- Food Waste -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('Assets/icon-sampah/organik.png') }}" alt="Food Waste" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Sampah Makanan</h3>
            </div>
            
            <!-- Paper -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('Assets/icon-sampah/kardus.png') }}" alt="Paper" class="w-14 h-14">
                </div>
                <h3 class="font-semibold text-xl text-center text-gray-800">Kertas</h3>
            </div>
            
            <!-- Cans -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 flex flex-col items-center justify-center h-56">
                <div class="bg-green-100 rounded-full p-4 mb-4 w-24 h-24 flex items-center justify-center">
                    <img src="{{ asset('Assets/icon-sampah/kaleng.png') }}" alt="Cans" class="w-14 h-14">
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
                    <img src="{{ asset('Assets/kemas.png') }}" alt="Kemas" class="w-20 h-20 md:w-24 md:h-24 flex-shrink-0">
                <div>
                    <div class="inline-block bg-teal-600 text-white text-base font-semibold px-4 py-2 rounded-md mb-3">1. Kemas</div>
                    <p class="text-gray-700 text-base md:text-lg">
                        Pastikan sampah telah dicuci dan dikeringkan dengan baik sebelum dikemas sesuai jenisnya.
                    </p>
                </div>
                </div>
            
                <!-- Step 2 -->
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
                    <img src="{{ asset('Assets/kirim.png') }}" alt="Send" class="w-20 h-20 md:w-24 md:h-24 flex-shrink-0">
                <div>
                    <div class="inline-block bg-teal-600 text-white text-base font-semibold px-4 py-2 rounded-md mb-3">2. Kirim</div>
                    <p class="text-gray-700 text-base md:text-lg">
                        Kirimkan sampah melalui layanan jemput atau setorkan langsung ke bank sampah terdekat.
                    </p>
                </div>
                </div>
            
                <!-- Step 3 -->
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
                    <img src="{{ asset('Assets/scan.png') }}" alt="Verifikasi" class="w-20 h-20 md:w-24 md:h-24 flex-shrink-0">
                <div>
                    <div class="inline-block bg-teal-600 text-white text-base font-semibold px-4 py-2 rounded-md mb-3">3. Verifikasi</div>
                    <p class="text-gray-700 text-base md:text-lg">
                        Verifikasi sampah yang telah disetor untuk mendapatkan poin.
                    </p>
                </div>
                </div>
            </div>
        </div>
    </section>

          <x-footer.guest id="kontak" fill="#f3f4f6"/>

</body>
</html>