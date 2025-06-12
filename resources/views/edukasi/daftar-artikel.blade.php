<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel - WasteWise</title>
    <meta name="description" content="Kumpulan artikel edukasi tentang pengelolaan sampah dan lingkungan hidup">
    
    @vite('resources/css/app.css')
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
<body class="font-sans bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-[#3D8D7A] to-[#2D6B5F] py-10 px-6">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#3D8D7A]">Artikel Edukasi</h1>
                <p class="text-lg md:text-xl opacity-90 text-black">Pelajari lebih lanjut tentang pengelolaan sampah dan lingkungan hidup</p>
            </div>
        </section>

        <!-- Search Section -->
        <section class="py-3 px-6">
            <div class="max-w-6xl mx-auto">
                <form method="GET" action="{{ route('daftar-artikel') }}" class="mb-8">
                    <div class="flex flex-col md:flex-row gap-4 items-center justify-center">
                        <div class="relative flex-1 max-w-md">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ $search ?? '' }}"
                                placeholder="Cari artikel..." 
                                class="w-full pl-10 pr-4 py-3 border text-black border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent"
                            >
                            <svg class="absolute left-3 top-[70%] transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <button 
                            type="submit"
                            class="bg-[#3D8D7A] text-white px-6 py-3 rounded-lg hover:bg-[#2D6B5F] transition-colors font-medium"
                        >
                            Cari Artikel
                        </button>
                        @if($search)
                            <a 
                                href="{{ route('daftar-artikel') }}"
                                class="text-gray-600 hover:text-[#3D8D7A] px-3 py-3 transition-colors"
                            >
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Search Results Info -->
                @if($search)
                    <div class="mb-6">
                        <p class="text-gray-600">
                            Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                            ({{ $artikel->total() }} artikel ditemukan)
                        </p>
                    </div>
                @endif
            </div>
        </section>

        <!-- Articles Section -->
        <section class="pb-16 px-6">
            <div class="max-w-6xl mx-auto">
                @if($artikel->count() > 0)
                    <div class="grid gap-8">
                        @foreach($artikel as $item)
                            <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                                <div class="flex flex-col md:flex-row h-auto md:h-64">
                                    <!-- Image -->
                                    <div class="md:w-1/3 h-48 md:h-full">
                                        @if($item->foto)
                                            <img 
                                                src="{{ asset('storage/' . $item->foto) }}" 
                                                alt="{{ $item->judul_artikel }}" 
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="p-6 md:w-2/3 flex flex-col justify-between">
                                        <div class="flex-grow">
                                            <div class="flex items-center mb-2">
                                                <svg class="h-4 w-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                                </span>
                                            </div>
                                            
                                            <h2 class="text-xl font-semibold text-gray-800 mb-3 hover:text-[#3D8D7A] transition-colors">
                                                <a href="{{ route('detail-artikel', $item->id_artikel) }}">
                                                    {{ $item->judul_artikel }}
                                                </a>
                                            </h2>
                                            
                                            <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                                {{ Str::limit(strip_tags($item->detail_artikel), 150) }}
                                            </p>
                                        </div>
                                        
                                        <div class="mt-4 flex items-center justify-between">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                <span>{{ Str::wordCount(strip_tags($item->detail_artikel)) }} kata</span>
                                            </div>
                                            
                                            <a 
                                                href="{{ route('detail-artikel', $item->id_artikel) }}" 
                                                class="inline-flex items-center text-[#3D8D7A] font-semibold hover:text-[#2D6B5F] transition-colors"
                                            >
                                                Baca Selengkapnya
                                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($artikel->hasPages())
                        <div class="mt-12 flex justify-center">
                            <nav class="flex items-center space-x-2">
                                {{-- Previous Page Link --}}
                                @if ($artikel->onFirstPage())
                                    <span class="px-3 py-2 text-gray-400 cursor-not-allowed">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </span>
                                @else
                                    <a href="{{ $artikel->appends(request()->query())->previousPageUrl() }}" 
                                       class="px-3 py-2 text-[#3D8D7A] hover:bg-[#3D8D7A] hover:text-white rounded-md transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($artikel->appends(request()->query())->getUrlRange(1, $artikel->lastPage()) as $page => $url)
                                    @if ($page == $artikel->currentPage())
                                        <span class="px-4 py-2 bg-[#3D8D7A] text-white rounded-md font-medium">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="px-4 py-2 text-[#3D8D7A] hover:bg-[#3D8D7A] hover:text-white rounded-md transition-colors">{{ $page }}</a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($artikel->hasMorePages())
                                    <a href="{{ $artikel->appends(request()->query())->nextPageUrl() }}" 
                                       class="px-3 py-2 text-[#3D8D7A] hover:bg-[#3D8D7A] hover:text-white rounded-md transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span class="px-3 py-2 text-gray-400 cursor-not-allowed">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                @endif
                            </nav>
                        </div>

                        <!-- Pagination Info -->
                        <div class="mt-4 text-center text-sm text-gray-600">
                            Menampilkan {{ $artikel->firstItem() ?? 0 }} - {{ $artikel->lastItem() ?? 0 }} dari {{ $artikel->total() }} artikel
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-xl font-medium text-gray-800 mb-2">
                            @if($search)
                                Tidak ada artikel yang ditemukan
                            @else
                                Belum ada artikel tersedia
                            @endif
                        </h3>
                        <p class="text-gray-600 mb-6">
                            @if($search)
                                Coba gunakan kata kunci yang berbeda untuk pencarian Anda.
                            @else
                                Artikel akan segera ditambahkan. Silakan kembali lagi nanti.
                            @endif
                        </p>
                        @if($search)
                            <a href="{{ route('daftar-artikel') }}" 
                               class="inline-flex items-center px-4 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#2D6B5F] transition-colors">
                                Lihat Semua Artikel
                            </a>
                        @else
                            <a href="{{ route('beranda-edukasi') }}" 
                               class="inline-flex items-center px-4 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#2D6B5F] transition-colors">
                                Kembali ke Beranda Edukasi
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    </main>

    <!-- Footer -->
    <x-footer.guest id="kontak"/>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>