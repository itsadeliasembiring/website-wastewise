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
                <p class="mt-4 text-base text-justify">Yuk manfaatkan fitur ini untuk mengenal lebih jauh tentang sampah yang kamu hasilkan. Cukup pindai sampah yang ingin kamu ketahui dan dapatkan informasi lengkapnya.</p>
                
                <!-- Tombol untuk membuka modal -->
                <button 
                    onclick="document.getElementById('kenaliModal').style.display='flex'"
                    class="mt-6 inline-block font-semibold px-5 py-2 border-2 border-white rounded-md hover:bg-white hover:text-[#3D8D7A] transition">
                    Kenali Sekarang
                </button>
            </div>
            <div class="flex justify-center md:justify-end">
                <img src="{{ asset('Assets/make-use-recycle.png') }}" alt="Ilustrasi Edukasi" class="w-62">
            </div>
        </div>
    </section>

    <!-- Modal Overlay -->
    <div id="kenaliModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
        <!-- Modal Content -->
        <div class="bg-white rounded-2xl p-6 w-[90%] max-w-md shadow-lg relative">
            <!-- Tombol Close -->
            <button 
                onclick="document.getElementById('kenaliModal').style.display='none'"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            
            <!-- Judul -->
            <h2 class="text-center text-xl font-semibold mb-4">Kenali Sampah</h2>

            <!-- Toggle Input Mode -->
            <div class="flex justify-center mb-6 gap-4">
                <button 
                    onclick="setMode('upload')"
                    id="uploadBtn"
                    class="px-4 py-2 rounded-lg font-medium transition duration-300 bg-gray-100 text-gray-700">
                    Upload Foto
                </button>
                <button 
                    onclick="setMode('manual')"
                    id="manualBtn"
                    class="px-4 py-2 rounded-lg font-medium transition duration-300 bg-[#3D8D7A] text-white">
                    Input Manual
                </button>
            </div>

            <!-- Upload Section -->
            <div id="uploadSection" class="hidden bg-gray-100 rounded-lg py-10 flex flex-col items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#3D8D7A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4m0 0l4 4m-4-4v12" />
                </svg>
                <label class="text-[#3D8D7A] font-medium mt-2 cursor-pointer">
                    Upload Gambar
                    <input type="file" class="hidden" />
                </label>
            </div>

            <!-- Manual Input Section -->
            <div id="manualSection" class="block">
                <!-- Jenis Sampah -->
                <div class="mb-4">
                    <label class="block text-sm text-gray-700 font-medium mb-1">Jenis Sampah</label>
                    <select class="w-full rounded-lg border px-4 py-2 bg-gray-100 text-gray-800">
                        <option>Plastik</option>
                        <option>Kaca</option>
                        <option>Kaleng</option>
                        <option>Sampah Makanan</option>
                        <option>Minyak Jelantah</option>
                        <option>Kertas</option>
                    </select>
                </div>

                <!-- Detail Sampah -->
                <div class="mb-4">
                    <label class="block text-sm text-gray-700 font-medium mb-1">Detail Sampah</label>
                    <input type="text" placeholder="Contoh: Botol plastik" class="w-full rounded-lg border px-4 py-2 bg-gray-100 text-gray-800" />
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-center mt-6">
                <button
                    class="bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white px-6 py-2 rounded-lg font-semibold w-full"
                    onclick="window.location.href='{{ route('kenali-sampah') }}'"
                    >
                    Submit
                </button>
            </div>
        </div>
    </div>

    <script>
        function setMode(mode) {
            // Update button styles
            if (mode === 'upload') {
                document.getElementById('uploadBtn').className = 'px-4 py-2 rounded-lg font-medium transition duration-300 bg-[#3D8D7A] text-white';
                document.getElementById('manualBtn').className = 'px-4 py-2 rounded-lg font-medium transition duration-300 bg-gray-100 text-gray-700';
                document.getElementById('uploadSection').style.display = 'flex';
                document.getElementById('manualSection').style.display = 'none';
            } else {
                document.getElementById('manualBtn').className = 'px-4 py-2 rounded-lg font-medium transition duration-300 bg-[#3D8D7A] text-white';
                document.getElementById('uploadBtn').className = 'px-4 py-2 rounded-lg font-medium transition duration-300 bg-gray-100 text-gray-700';
                document.getElementById('uploadSection').style.display = 'none';
                document.getElementById('manualSection').style.display = 'block';
            }
        }
    </script>

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