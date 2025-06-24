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
                <img src="{{ asset('Assets/make-use-recycle.png') }}" alt="Recycle Illustration" class="w-80 md:w-90 lg:w-[450px]">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="w-full px-4 -mt-16 flex justify-center">
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-8">
            <!-- Recycled Waste Card -->
            <div class="bg-white rounded-lg shadow-md p-6 w-full md:w-[380px] h-auto flex flex-col items-center justify-between text-center">
                <div class="flex items-center">
                    <img src="{{ asset('Assets/icon-sampah/recycle.png') }}" alt="Recycle Icon" class="w-20 h-20 mb-3">
                    <div class="ml-4">
                        <h3 class="text-3xl font-extrabold text-[#016A70]">{{ number_format($userStats['total_berat'], 2) }}  Kg</h3>
                        <p class="text-gray-600 text-xl">Sampah Terdaur Ulang</p>
                    </div>
                </div>
            </div>
            
            <!-- Points Card -->
            <div class="bg-white rounded-lg shadow-md p-6 w-full md:w-[380px] h-auto flex flex-col items-center justify-between text-center">
                <div class="flex items-center">
                    <img src="{{ asset('Assets/coin.svg') }}" alt="Points Icon" class="w-20 h-20 mb-3">
                    <div class="ml-4">
                        <h3 class="text-3xl font-extrabold text-[#016A70]">{{ number_format($userStats['total_poin']) }} </h3>
                        <p class="text-gray-600 text-xl">Poin Terkumpul</p>
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
            @forelse($jenisSampah as $sampah)
            <div class="bg-white rounded-lg shadow-sm p-4 flex flex-col items-center h-52">
                <div class="bg-green-100 rounded-full p-3 mb-3 w-24 h-24 flex items-center justify-center">
                    @if($sampah->foto)
                        <img src="{{ asset('storage/sampah/'.$sampah->foto) }}" alt="{{ $sampah->nama_sampah }}" class="w-13 h-13">
                    @else
                        <!-- Default icon if no icon is provided -->
                        <img src="{{ asset('Assets/icon-sampah/default.png') }}" alt="{{ $sampah->nama_sampah }}" class="w-13 h-13">
                    @endif
                </div>
                <h3 class="font-semibold text-xl mb-1">{{ $sampah->nama_sampah }}</h3>
                <p class="text-yellow-500 flex items-center font-medium">
                    <span class="bg-yellow-200 w-3 h-3 rounded-full mr-1"></span>
                    {{ number_format($sampah->bobot_poin, 0, ',', '.') }} Poin/Kg
                </p>
            </div>
            @empty
            <!-- Fallback if no data from database -->
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500 text-lg">Belum ada jenis sampah yang tersedia.</p>
            </div>
            @endforelse
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
                    <img src="{{ asset('Assets/kemas.png') }}" alt="Kemas" class="w-24 h-24 flex-shrink-0">
                    <div>
                        <div class="inline-block bg-teal-600 text-white text-base font-semibold px-3 py-1 rounded-md mb-2">1. Kemas</div>
                        <p class="text-gray-700 text-base">
                            Pastikan sampah telah dicuci dan dikeringkan dengan baik sebelum dikemas sesuai jenisnya.
                        </p>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="flex items-start gap-10">
                    <img src="{{ asset('Assets/kirim.png') }}" alt="Send" class="w-24 h-24 flex-shrink-0">
                    <div>
                        <div class="inline-block bg-teal-600 text-white text-base font-semibold px-3 py-1 rounded-md mb-2">2. Kirim</div>
                        <p class="text-gray-700 text-base">
                            Kirimkan sampah melalui layanan jemput atau setorkan langsung ke bank sampah terdekat.
                        </p>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="flex items-start gap-10">
                    <img src="{{ asset('Assets/scan.png') }}" alt="Scan" class="w-24 h-24 flex-shrink-0">
                    <div>
                        <div class="inline-block bg-teal-600 text-white text-base font-semibold px-3 py-1 rounded-md mb-2">3. Verifikasi</div>
                        <p class="text-gray-700 text-base">
                            Petugas akan memverifikasi jenis dan berat sampah, lalu poin akan otomatis masuk ke akun kamu!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <x-footer.pengguna id="kontak" fill="#f9fafb"/>


</body>
</html>