<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artikel->judul_artikel }} - WasteWise</title>
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

    <!-- Konten Artikel -->
    <main class="bg-gray-45 py-6">
        <div class="container mx-auto px-4">

            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li><a href="{{ route('beranda-edukasi') }}" class="hover:text-teal-700">Beranda Edukasi</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('daftar-artikel') }}" class="hover:text-teal-700">Artikel</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-gray-400">{{ \Str::limit($artikel->judul_artikel, 50) }}</li>
                </ol>
            </nav>

            <!-- Gambar Utama -->
            <div class="mt-3">
                <div class="flex flex-col items-center justify-center py-18 mb-8">
                    @if($artikel->foto)
                        <img src="{{ Storage::url('artikel/' . $artikel->foto) }}" alt="{{ $artikel->judul_artikel }}" 
                             class="w-full max-w-5xl mx-auto rounded-xl object-cover h-[300px]">
                    @else
                        <div class="w-full max-w-5xl mx-auto h-96 bg-gray-200 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <div class="max-w-5xl mx-auto">
                <!-- Judul Artikel -->
                <h1 class="text-3xl md:text-3xl font-bold text-gray-900 mb-3 text-justify">
                    {{ $artikel->judul_artikel }}
                </h1>

                <!-- Meta -->
                <div class="flex items-center mb-6">
                    <div class="bg-gray-200 rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[#3D8D7A] font-semibold text-base">WasteWise Admin</p>
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($artikel->created_at)->format('d/m/Y, H:i') }} WIB</p>
                    </div>
                </div>

                <!-- Isi Artikel -->
                <div class="text-base text-gray-700 leading-relaxed space-y-4 mb-12 text-justify [text-align:justify]">
                    {!! nl2br(e($artikel->detail_artikel)) !!}
                </div>

                <!-- Tombol Kembali -->
                <div class="mb-8">
                    <a href="{{ route('daftar-artikel') }}" 
                       class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar Artikel
                    </a>
                </div>

                @if($artikelLainnya->isNotEmpty())
                <!-- Artikel Lainnya -->
                <h2 class="text-xl font-bold text-[#1C5EAC] mb-6">Baca Artikel Lainnya</h2>
                <div class="space-y-6">
                    @foreach($artikelLainnya as $item)
                    <!-- Artikel Terkait -->
                    <div class="bg-white border border-gray-200 shadow-md rounded-xl overflow-hidden flex flex-col sm:flex-row h-[200px]">
                        <div class="w-full sm:w-1/3 h-48 sm:h-full">
                            @if($item->foto)
                                <img src="{{ Storage::url('artikel/' . $item->foto) }}" alt="{{ $item->judul_artikel }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="bg-gray-200 w-full h-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 flex flex-col justify-between sm:w-2/3">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $item->judul_artikel }}</h3>
                                <p class="text-xs text-gray-600 mt-2 leading-relaxed text-justify">
                                    {{ \Str::limit(strip_tags($item->detail_artikel), 200) }}
                                </p>
                                <p class="text-xs text-gray-500 mt-2">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }} WIB
                                </p>
                            </div>
                            <div class="text-right pt-2 mt-auto">
                                <a href="{{ route('detail-artikel', $item->id_artikel) }}" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </main>
    
    <!-- Kontak -->
    <x-footer.pengguna id="kontak"/>

</body>
</html>