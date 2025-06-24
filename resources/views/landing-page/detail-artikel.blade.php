<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - {{ $artikel->judul_artikel ?? 'Detail Artikel' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.guest/>
    </header>

    <!-- Konten Artikel -->
    <main class="bg-gray-100 py-6">
        <div class="container mx-auto px-4">
            <!-- Gambar Utama -->
            @if($artikel->foto)
            <div>
                <div class="flex flex-col items-center justify-center py-18 mb-8">
                    <img src="{{ Storage::url('artikel/' . $artikel->foto) }}"
                         alt="{{ $artikel->judul_artikel }}" 
                         class="w-full max-w-5xl mx-auto rounded-xl object-cover">
                </div>
            </div>
            @else
            <div>
                <div class="flex flex-col items-center justify-center py-18 mb-8">
                    <img src="{{ asset('Assets/waste-wise-artikel.png') }}" 
                         alt="WasteWise Banner" 
                         class="w-full max-w-5xl mx-auto rounded-xl">
                </div>
            </div>
            @endif

            <div class="max-w-5xl mx-auto">
                <!-- Judul Artikel -->
                <h1 class="text-3xl md:text-3xl font-bold text-gray-900 mb-3 text-justify">
                    {{ $artikel->judul_artikel }}
                </h1>

                <!-- Meta Information -->
                <div class="flex items-center mb-6">
                    <div class="bg-gray-200 rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[#3D8D7A] font-semibold text-base">
                            {{ $artikel->kategori_artikel ?? 'Artikel WasteWise' }}
                        </p>
                        <p class="text-sm text-gray-500">
                            @if($artikel->created_at instanceof \Carbon\Carbon)
                                {{ $artikel->created_at->format('d M Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y') }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Isi Artikel -->
                <div class="text-base text-gray-700 leading-relaxed space-y-4 mb-12 text-justify [text-align:justify]">
                    {!! nl2br(e($artikel->detail_artikel)) !!}
                </div>

                <!-- Artikel Lainnya -->
                @if($artikelLainnya && $artikelLainnya->count() > 0)
                <h2 class="text-xl font-bold text-[#1C5EAC] mb-6">Baca Artikel Lainnya</h2>
                <div class="space-y-6">
                    @foreach($artikelLainnya as $item)
                    <div class="bg-white border border-gray-200 shadow-md rounded-xl overflow-hidden flex flex-col sm:flex-row h-[200px]">
                        @if($item->foto)
                        <img src="{{ Storage::url('artikel/' . $item->foto) }}" 
                             alt="{{ $item->judul_artikel }}" 
                             class="w-full sm:w-1/3 h-48 sm:h-full object-cover">
                        @else
                        <img src="{{ asset('Assets/waste-wise-artikel.png') }}" 
                             alt="{{ $item->judul_artikel }}" 
                             class="w-full sm:w-1/3 h-48 sm:h-full object-cover">
                        @endif
                        
                        <div class="p-4 flex flex-col justify-between sm:w-2/3">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ $item->judul_artikel }}
                                </h3>
                                <p class="text-xs text-gray-600 mt-2 leading-relaxed text-justify">
                                    {{ Str::limit(strip_tags($item->detail_artikel), 200) }}
                                </p>
                            </div>
                            <div class="text-right pt-2 mt-auto">
                                <a href="{{ route('detail-artikel-guest', $item->id_artikel) }}" 
                                   class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">
                                   Baca Selengkapnya »
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Contact Section -->
    <x-footer.guest id="kontak"/>

</body>
</html>