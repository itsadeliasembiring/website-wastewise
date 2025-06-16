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
            <x-header.guest/>
        </header>

        <!-- Artikel Section -->
        <main class="pt-10 py-16 px-6 bg-gray-100">
            <!-- Heading -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-[#3D8D7A] mb-4">Artikel</h2>
                <div class="w-24 h-1 bg-[#3D8D7A] mx-auto mb-6"></div>
            </div>

            <div class="max-w-6xl mx-auto">
                @if($artikel->count() > 0)
                    @foreach($artikel as $index => $item)
                        <!-- Artikel {{ $index + 1 }} -->
                        <div class="bg-white rounded-xl shadow-md flex flex-col md:flex-row overflow-hidden mb-6 h-64">
                            <!-- Gambar -->
                            <div class="md:w-1/3 h-full">
                                @if($item->foto)
                                    <img src="{{ Storage::url('artikel/' . $item->foto) }}"
                                         alt="{{ $item->judul_artikel }}" 
                                         class="object-cover w-full h-full">
                                @else
                                    <!-- Default image jika tidak ada gambar -->
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <!-- Konten Artikel -->
                            <div class="p-6 md:w-2/3 flex flex-col justify-between h-full">
                                <div class="flex-grow">
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $item->judul_artikel }}</h3>
                                    <p class="text-sm text-gray-600 mt-2 leading-relaxed text-justify [text-align:justify]">
                                        {{ Str::limit(strip_tags($item->detail_artikel), 250, '...') }}
                                    </p>
                                    @if($item->kategori_artikel)
                                        <span class="inline-block bg-[#3D8D7A] text-white text-xs px-2 py-1 rounded mt-2">
                                            {{ $item->kategori_artikel }}
                                        </span>
                                    @endif
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <div class="text-xs text-gray-500">
                                        @if($item->created_at instanceof \Carbon\Carbon)
                                            {{ $item->created_at->format('d M Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                        @endif

                                    </div>
                                    <a href="{{ route('detail-artikel-guest', $item->id_artikel) }}" 
                                       class="text-teal-700 text-sm font-semibold hover:underline">
                                        Baca Selengkapnya »
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Jika tidak ada artikel -->
                    <div class="text-center py-12">
                        <div class="text-gray-400 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-600 mb-2">Belum Ada Artikel</h3>
                        <p class="text-gray-500">Artikel akan segera hadir untuk Anda!</p>
                    </div>
                @endif

                <!-- Tombol Lihat Semua Artikel
                @if($artikel->count() > 0)
                    <div class="text-center mt-8">
                        <a href="{{ route('daftar-artikel-guest') }}" 
                           class="inline-block bg-[#3D8D7A] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#2d6b5d] transition duration-300">
                            Lihat Semua Artikel
                        </a>
                    </div>
                @endif -->
            </div>
        </main>

        <!-- Contact Section -->
        <x-footer.guest id="kontak"/>
    </body>
</html>