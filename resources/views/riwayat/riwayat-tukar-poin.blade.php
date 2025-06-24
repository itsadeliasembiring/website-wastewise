<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Riwayat Tukar Poin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: { '50': '#3D8D7A', '100': '#3D8D7A', '200': '#3D8D7A', '300': '#3D8D7A', '400': '#3D8D7A', '500': '#3D8D7A', '600': '#3D8D7A', '700': '#3D8D7A', '800': '#3D8D7A', '900': '#3D8D7A', '950': '#3D8D7A' },
                    }
                }
            }
        }
    </script>
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .transaction-card {
            transition: all 0.3s ease;
        }
        .transaction-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .pagination-btn {
            transition: all 0.2s ease;
        }
        .pagination-btn:hover {
            transform: scale(1.05);
        }

        #emptyStateImage {
            position: relative;
            animation: mymove 2.5s infinite;
        }

        @keyframes mymove {
            33% {
                top: 0px;
            }

            66% {
                top: 20px;
            }

            100% {
                top: 0px;
            }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>

    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white shadow-[0_-2px_10px_rgba(0,0,0,0.1)] z-50">
        <div class="flex justify-around items-center p-3">
            <a href="#" class="flex flex-col items-center text-gray-500 hover:text-primary-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="#" class="flex flex-col items-center text-gray-500 hover:text-primary-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="text-xs mt-1">Setor</span>
            </a>
            <a href="#" class="flex flex-col items-center text-gray-500 hover:text-primary-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="text-xs mt-1">Edukasi</span>
            </a>
            <a href="#" class="flex flex-col items-center text-primary-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="text-xs mt-1">Riwayat</span>
            </a>
        </div>
    </div>

    <main class="container mx-auto px-4 py-6 pb-20 md:pb-6 flex-grow">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-primary-700">Riwayat Tukar Poin</h2>
                <div class="bg-primary-100 rounded-full px-4 py-2 flex items-center gap-2">
                    <img src="{{ asset('Assets/coin.svg') }}" alt="Koin" class="h-5 w-5 text-yellow-500">
                    <span class="font-bold text-white">{{ number_format($totalPoin ?? 0) }} Poin</span>
                </div>
            </div>
        
            <div class="mb-8 flex gap-3">
                <button class="@if (Route::is('pengguna-riwayat-setor-sampah')) bg-primary-600 text-white @else bg-white border border-gray-300 text-gray-700 @endif px-4 py-2 rounded-lg font-medium shadow-md hover:bg-primary-700 transition duration-200 flex-1 md:flex-none"
                        onclick="window.location.href='{{ route('pengguna-riwayat-setor-sampah') }}'">
                    Riwayat Setor Sampah
                </button>

                <button class="@if (Route::is('pengguna-riwayat-tukar-poin')) bg-primary-600 text-white @else bg-white border border-gray-300 text-gray-700 @endif px-4 py-2 rounded-lg font-medium hover:bg-gray-50 transition duration-200 flex-1 md:flex-none"
                        onclick="window.location.href='{{ route('pengguna-riwayat-tukar-poin') }}'">
                    Riwayat Tukar Poin
                </button>
            </div>
        
            <div class="space-y-4" x-data="{
                showModal: false,
                currentTransaction: null,
                openTransactionDetail(type, title, date, time, points, details, redeemCode = null, status = null) {
                    this.currentTransaction = {
                        type: type,
                        title: title,
                        date: date,
                        time: time,
                        points: points,
                        details: details,
                        redeemCode: redeemCode,
                        status: status
                    };
                    this.showModal = true;
                }
            }">
                
                @if($riwayatTukarDonasi->isEmpty() && $riwayatTukarBarang->isEmpty())
                    <div class="text-center py-12">
                        <img src="{{ asset('Assets/waduh.png') }}" alt="Riwayat Kosong" class="mx-auto h-40" id="emptyStateImage">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Riwayat</h3>
                        <p class="text-gray-500">Anda belum melakukan penukaran poin</p>
                    </div>
                @else
                    @php
                        // Gabungkan semua transaksi dan urutkan berdasarkan waktu
                        $allTransactions = collect();
                        
                        // Tambahkan donasi
                        foreach($riwayatTukarDonasi as $donasi) {
                            $allTransactions->push([
                                'type' => 'donasi',
                                'data' => $donasi,
                                'waktu' => $donasi->waktu
                            ]);
                        }
                        
                        // Tambahkan barang
                        foreach($riwayatTukarBarang as $barang) {
                            $allTransactions->push([
                                'type' => 'barang',
                                'data' => $barang,
                                'waktu' => $barang->waktu
                            ]);
                        }
                        
                        // Urutkan berdasarkan waktu (terbaru dulu)
                        $allTransactions = $allTransactions->sortByDesc('waktu');
                    @endphp

                    @foreach($allTransactions as $transaction)
                        @if($transaction['type'] == 'donasi')
                            @php $item = $transaction['data']; @endphp
                            <div class="bg-white rounded-lg shadow-sm p-4 transaction-card">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-bold">Donasi</h3>
                                        <div class="flex items-center text-sm text-gray-500 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($item->waktu)->format('d F Y') }}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB
                                        </div>
                                        <div class="flex items-center mt-2 text-sm text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            {{ $item->donasi->nama_donasi ?? 'Donasi Tidak Ditemukan' }}
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="text-red-500 font-medium">- {{ number_format($item->jumlah_poin) }} Poin</span>
                                        <button 
                                            @click="openTransactionDetail(
                                                'Donasi', 
                                                '{{ $item->donasi->nama_donasi ?? 'Donasi Tidak Ditemukan' }}', 
                                                '{{ \Carbon\Carbon::parse($item->waktu)->format('d F Y') }}', 
                                                '{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB', 
                                                '{{ number_format($item->jumlah_poin) }}', 
                                                '{{ $item->donasi->deskripsi ?? 'Donasi untuk kebutuhan sosial' }}'
                                            )"
                                            class="mt-6 bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white px-3 py-1 rounded-md text-sm transition duration-200">
                                            Detail
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            @php $item = $transaction['data']; @endphp
                            <div class="bg-white rounded-lg shadow-sm p-4 transaction-card">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-bold">Barang Eco-Friendly</h3>
                                        <div class="flex items-center text-sm text-gray-500 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($item->waktu)->format('d F Y') }}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB
                                        </div>
                                        <div class="flex items-center mt-2 text-sm text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                            {{ $item->barang->nama_barang ?? 'Barang Tidak Ditemukan' }}
                                        </div>
                                        {{-- PERBAIKAN 1: Mengubah @if($item->status_redeem) menjadi @if(isset($item->status_redeem)) --}}
                                        @if(isset($item->status_redeem))
                                            <div class="flex items-center mt-2">
                                                @if($item->status_redeem == 0)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <svg class="mr-1.5 h-3 w-3 text-yellow-500" fill="currentColor" viewBox="0 0 8 8">
                                                            <circle cx="4" cy="4" r="3"/>
                                                        </svg>
                                                        Belum Diambil
                                                    </span>
                                                @elseif($item->status_redeem == 1)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-[#3D8D7A]">
                                                        <svg class="mr-1.5 h-3 w-3 text-[#3D8D7A]" fill="currentColor" viewBox="0 0 8 8">
                                                            <circle cx="4" cy="4" r="3"/>
                                                        </svg>
                                                        Sudah Diambil
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="text-red-500 font-medium">- {{ number_format($item->jumlah_poin) }} Poin</span>
                                        <button 
                                            @click="openTransactionDetail(
                                                'Barang Eco-Friendly', 
                                                '{{ $item->barang->nama_barang ?? 'Barang Tidak Ditemukan' }}', 
                                                '{{ \Carbon\Carbon::parse($item->waktu)->format('d F Y') }}', 
                                                '{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB', 
                                                '{{ number_format($item->jumlah_poin) }}', 
                                                '{{ addslashes($item->barang->deskripsi ?? 'Produk ramah lingkungan') }}',
                                                '{{ $item->kode_redeem }}',
                                                '{{ $item->status_redeem }}'
                                            )"
                                            class="mt-6 bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white px-3 py-1 rounded-md text-sm transition duration-200">
                                            Detail
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

                <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10" x-show="currentTransaction && currentTransaction.type === 'Donasi'">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#3D8D7A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </div>
                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10" x-show="currentTransaction && currentTransaction.type === 'Barang Eco-Friendly'">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#3D8D7A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="currentTransaction ? currentTransaction.type : ''"></h3>
                                        <div class="mt-4 space-y-4">
                                            <div>
                                                <h4 class="text-base font-medium text-gray-900" x-text="currentTransaction ? currentTransaction.title : ''"></h4>
                                                <p class="mt-1 text-sm text-gray-500" x-text="currentTransaction ? currentTransaction.details : ''"></p>
                                            </div>
                                            
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="flex justify-between items-center mb-2">
                                                    <span class="text-sm text-gray-600">Poin Ditukarkan:</span>
                                                    <span class="text-base font-medium text-red-500" x-text="currentTransaction ? '- ' + currentTransaction.points + ' Poin' : ''"></span>
                                                </div>
                                                <div class="flex justify-between items-center mb-2">
                                                    <span class="text-sm text-gray-600">Tanggal:</span>
                                                    <span class="text-sm" x-text="currentTransaction ? currentTransaction.date : ''"></span>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm text-gray-600">Waktu:</span>
                                                    <span class="text-sm" x-text="currentTransaction ? currentTransaction.time : ''"></span>
                                                </div>
                                            </div>
                                            
                                            <div x-show="currentTransaction && currentTransaction.redeemCode" class="bg-green-50 rounded-lg p-4 border border-green-200">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm font-medium text-[#3D8D7A]">Kode Redeem:</span>
                                                    <span class="text-base font-bold text-[#3D8D7A]" x-text="currentTransaction ? currentTransaction.redeemCode : ''"></span>
                                                </div>
                                                <div class="mt-2 text-xs text-[#3D8D7A]">
                                                    Tunjukkan kode ini saat mengambil barang Anda
                                                </div>
                                                
                                                <div x-show="currentTransaction && currentTransaction.status !== null && currentTransaction.status !== ''" class="mt-3 flex items-center">
                                                    <span class="text-sm text-gray-600 mr-2">Status:</span>
                                                    <template x-if="currentTransaction">
                                                        <div>
                                                            <span x-show="currentTransaction.status == '0'" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                Belum Diambil
                                                            </span>
                                                            <span x-show="currentTransaction.status == '1'" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-[#3D8D7A]">
                                                                Sudah Diambil
                                                            </span>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="button" @click="showModal = false" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#3D8D7A] text-base font-medium text-white hover:bg-[#3D8D7A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3D8D7A] sm:ml-3 sm:w-auto sm:text-sm">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Kontak -->
    <x-footer.pengguna id="kontak"/>

</body>
</html>