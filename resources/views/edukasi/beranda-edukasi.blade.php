<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Beranda Edukasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
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
    <section class="text-white py-14 px-7" style="background-color: #3D8D7A;">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-7">
            <div>
                <h2 class="text-xl font-semibold mb-2">Kenali Sampahmu Sekarang!</h2>
                <h1 class="text-4xl md:text-4xl font-bold leading-tight" style="color: #FFFFDD;">Kenali dan Kelola Jadi Manfaat</h1>
                <p class="mt-4 text-base text-justify">
                    Bingung ini sampah organik atau anorganik? Yuk, tanya langsung ke <strong>Wastewise Chatbot</strong>! 
                    Kamu bisa kirim pertanyaan lewat teks, suara, atau unggah gambar. Dapatkan informasi lengkap 
                    soal jenis dan cara mengelola sampahmu dengan mudah dan cepat.
                </p>
                <a 
                    href="{{ route('kenali-sampah') }}"
                    class="mt-6 inline-block font-semibold px-5 py-2 border-2 border-white rounded-md hover:bg-white hover:text-[#3D8D7A] transition">
                    Gunakan Wastewise Chatbot
                </a>
            </div>
            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('Assets/maskot.gif')}}" alt="Ilustrasi Edukasi" class="w-80 md:w-90 lg:w-[450px]">
            </div>
        </div>
    </section>


    <!-- Artikel Section -->
    <section class="py-16 px-6 bg-gray-100">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-teal-700">Artikel Terbaru</h2>
                <a href="{{ route('daftar-artikel') }}" class="text-teal-700 hover:text-teal-800 font-semibold">
                    Lihat Semua Artikel →
                </a>
            </div>

            @if($artikel->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada artikel yang tersedia.</p>
                </div>
            @else
                <!-- Loop Artikel dari Database -->
                @foreach($artikel as $item)
                <div class="bg-white rounded-xl shadow-md flex flex-col md:flex-row overflow-hidden mb-6 h-64">
                    <div class="md:w-1/3 h-full">
                        @if($item->foto)
                            <img src="{{ Storage::url('artikel/' . $item->foto) }}"alt="{{ $item->judul_artikel }}" class="object-cover w-full h-full">
                        @else
                            <div class="bg-gray-200 w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 md:w-2/3 flex flex-col justify-between h-full">
                        <div class="flex-grow">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $item->judul_artikel }}</h3>
                            <p class="text-sm text-gray-600 mt-2 leading-relaxed text-justify">
                                {{ \Str::limit(strip_tags($item->detail_artikel), 150) }}
                            </p>
                            <p class="text-xs text-gray-500 mt-2">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }} WIB
                            </p>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('detail-artikel', $item->id_artikel) }}" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </section>

    <!-- Kontak -->
    <x-footer.pengguna id="kontak" fill="#f3f4f6"/>

</body>
</html>