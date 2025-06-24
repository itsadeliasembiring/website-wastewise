<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Riwayat Setor Sampah</title>
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
                        yellow: { '500': '#f59e0b' },
                        green: { '600': '#3D8D7A' },
                        red: { '500': '#ef4444' },
                        gray: { '500': '#6b7280' }
                    }
                }
            }
        }
    </script>
    <style>
        .transaction-card { transition: all 0.3s ease; }
        .transaction-card:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .spinner { border-top-color: transparent; }

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

        [x-cloak] {
            display: none !important;
        }

    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>

    <main class="container mx-auto px-4 py-6 pb-20 md:pb-6 flex-grow">
        <div class="max-w-4xl mx-auto" 
             x-data="riwayatSetorData()">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-primary-700">Riwayat Setor Sampah</h2>
                <div class="bg-primary-100 rounded-full px-4 py-2 flex items-center gap-2">
                    <img src="{{ asset('Assets/coin.svg') }}" alt="Koin" class="h-5 w-5 text-yellow-500">
                    <span class="font-bold text-white">{{ $totalPoin ?? 0 }} Poin</span>
                </div>
            </div>
            
            <div class="mb-8 flex gap-3">
                <button class="bg-primary-600 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-primary-700 transition duration-200 flex-1 md:flex-none"
                        onclick="window.location.href='{{ route('pengguna-riwayat-setor-sampah') }}'">
                    Riwayat Setor Sampah
                </button>
                <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-50 transition duration-200 flex-1 md:flex-none"
                        onclick="window.location.href='{{ route('pengguna-riwayat-tukar-poin') }}'">
                    Riwayat Tukar Poin
                </button>
            </div>
            
            <div class="space-y-4">
                @forelse ($riwayatSetor as $setor)
                <div class="bg-white rounded-lg shadow-sm p-5 transaction-card">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div class="flex-grow">
                            <div class="flex items-start">
                                <div class="bg-primary-100 rounded-lg p-2 mr-4 hidden md:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">{{ $setor['bank_sampah_nama'] }}</h3>
                                    <div class="flex flex-wrap items-center text-sm text-gray-500 mt-1 gap-x-3 gap-y-1">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            {{ $setor['tanggal'] }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            {{ $setor['jam'] }}
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap mt-3 gap-x-6 gap-y-2">
                                        <div>
                                            <p class="text-xs text-gray-500">Total Berat</p>
                                            <p class="font-medium">{{ $setor['total_berat'] }} Kg</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Layanan</p>
                                            <p class="font-medium flex items-center">{{ $setor['layanan'] }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Status</p>
                                            <p class="font-medium {{ $setor['status_display']['color_class'] }} flex items-center">
                                                {{ $setor['status_display']['text'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-end justify-between gap-4">
                             @if($setor['status'] == 'selesai')
                                <span class="text-primary-600 font-medium bg-primary-50 px-3 py-1 rounded-full flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                    {{ $setor['total_poin'] }} Poin
                                </span>
                            @endif
                            <div class="flex space-x-2 mt-2 md:mt-0">
                                @if (in_array($setor['status'], ['diproses', 'menunggu konfirmasi']))
                                <button @click="showCode('{{ $setor['kode_verifikasi'] }}', '{{ $setor['bank_sampah_nama'] }}', '{{ $setor['status_display']['text'] }}')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
                                    Tunjukkan Kode
                                </button>
                                @endif
                                <button @click="fetchDetails('{{ $setor['id_setor'] }}')" class="bg-primary-600 hover:bg-primary-700 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white text-center rounded-lg shadow-sm p-8">
                    <img src="{{ asset('Assets/waduh.png') }}" alt="Riwayat Kosong" class="mx-auto h-40" id="emptyStateImage">
                    <h3 class="mt-4 text-xl font-medium text-gray-700">Belum Ada Riwayat</h3>
                    <p class="text-gray-500 mt-2">Anda belum pernah melakukan setor sampah. Yuk, mulai setor sampah dan dapatkan poinnya!</p>
                </div>
                @endforelse
            </div>

            <!-- Detail Modal -->
            <div x-show="openDetailModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" x-cloak>
                <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] flex flex-col" @click.away="openDetailModal = false">
                    <div class="bg-primary-600 text-white px-6 py-4 flex justify-between items-center">
                        <h3 class="text-lg font-bold" x-text="selectedTransaction?.title || 'Detail Transaksi'"></h3>
                        <button @click="openDetailModal = false" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
                    </div>
                    <div class="p-6 overflow-y-auto">
                        <template x-if="loading">
                            <div class="flex justify-center items-center h-64">
                                <div class="spinner w-12 h-12 rounded-full animate-spin border-4 border-solid border-primary-600 border-t-transparent"></div>
                            </div>
                        </template>
                        <template x-if="!loading && selectedTransaction">
                            <div>
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div><p class="text-sm text-gray-500">Tanggal Setor</p><p class="font-medium" x-text="selectedTransaction.date"></p></div>
                                    <div><p class="text-sm text-gray-500">Jam</p><p class="font-medium" x-text="selectedTransaction.time"></p></div>
                                    <div><p class="text-sm text-gray-500">Layanan</p><p class="font-medium" x-text="selectedTransaction.service"></p></div>
                                    <div><p class="text-sm text-gray-500">Status</p><p class="font-medium" :class="selectedTransaction.status?.color_class" x-text="selectedTransaction.status?.text"></p></div>
                                </div>
                                <div x-show="selectedTransaction.cancellation_reason" class="mb-4 bg-red-50 border border-red-200 rounded-md p-3">
                                    <p class="text-sm text-gray-700"><span class="font-medium">Alasan Pembatalan/Penolakan:</span> <span x-text="selectedTransaction.cancellation_reason"></span></p>
                                </div>
                                <div class="mb-4"><p class="text-sm text-gray-500">Alamat</p><p class="font-medium" x-text="selectedTransaction.address"></p></div>
                                <div class="mb-4" x-show="selectedTransaction.points > 0"><p class="text-sm text-gray-500">Poin yang Didapatkan</p><p class="font-medium text-[#3D8D7A]" x-text="'+ ' + selectedTransaction.points + ' Poin'"></p></div>
                                <div class="mb-6"><p class="text-sm text-gray-500">Catatan</p><p class="font-medium" x-text="selectedTransaction.notes || 'Tidak ada catatan'"></p></div>
                                
                                <div>
                                    <h4 class="font-bold mb-2">Daftar Sampah</h4>
                                    <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                                        <table class="w-full">
                                            <thead><tr class="text-left text-sm text-gray-500"><th class="pb-2">Jenis Sampah</th><th class="pb-2 text-right">Jumlah</th></tr></thead>
                                            <tbody>
                                                <template x-for="waste in selectedTransaction.waste_types" :key="waste.name">
                                                    <tr class="border-t border-gray-200"><td class="py-2" x-text="waste.name"></td><td class="py-2 text-right" x-text="`${waste.weight} ${waste.unit}`"></td></tr>
                                                </template>
                                                <tr class="border-t-2 border-gray-300 font-bold"><td class="pt-2">Total Berat</td><td class="pt-2 text-right" x-text="`${selectedTransaction.total_weight} Kg`"></td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-if="!loading && !selectedTransaction">
                            <div class="text-center py-8">
                                <p class="text-gray-500">Gagal memuat detail transaksi</p>
                            </div>
                        </template>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 flex justify-end"><button @click="openDetailModal = false" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition">Tutup</button></div>
                </div>
            </div>

            <!-- Code Modal -->
            <div x-show="openCodeModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" x-cloak>
                <div class="bg-white rounded-lg shadow-xl w-full max-w-sm text-center" @click.away="openCodeModal = false">
                    <div class="p-8">
                        <div>
                            <h3 class="text-lg font-medium text-gray-600">Kode Verifikasi Jemput</h3>
                            <p class="text-gray-500 text-sm mb-4">Berikan kode ini kepada petugas dari <strong x-text="verificationCodeData.bank_sampah"></strong></p>
                            <div class="bg-primary-50 border-2 border-dashed border-primary-300 rounded-lg py-4">
                                <p class="text-4xl font-bold tracking-widest text-primary-700" x-text="verificationCodeData.kode_verifikasi"></p>
                            </div>
                            <p class="text-xs text-gray-400 mt-4">Status saat ini: <span class="font-medium" x-text="verificationCodeData.status"></span></p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 flex justify-center"><button @click="openCodeModal = false" class="bg-primary-600 text-white px-6 py-2 rounded-md hover:bg-primary-700 transition">OK</button></div>
                </div>
            </div>

        </div> 
    </main>

    <!-- Kontak -->
    <x-footer.pengguna id="kontak" fill="#f9fafb"/>

    <script>
        function riwayatSetorData() {
            return {
                openDetailModal: false,
                openCodeModal: false,
                loading: false,
                selectedTransaction: null,
                verificationCodeData: null,
                
                async fetchDetails(id) {
                    console.log('Fetching details for ID:', id); // Debug log
                    this.loading = true;
                    this.openDetailModal = true;
                    this.selectedTransaction = null;
                    
                    try {
                        const response = await fetch(`/user/riwayat-setor-sampah/${id}/detail`);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        const data = await response.json();
                        console.log('Response data:', data); // Debug log
                        this.selectedTransaction = data;
                    } catch (error) {
                        console.error('Error fetching details:', error);
                        alert('Tidak dapat memuat detail transaksi. Silakan coba lagi.');
                        this.openDetailModal = false;
                    } finally {
                        this.loading = false;
                    }
                },

                showCode(kode_verifikasi, bank_sampah, status) {
                    console.log('Showing code:', kode_verifikasi); // Debug log
                    this.verificationCodeData = {
                        kode_verifikasi: kode_verifikasi,
                        bank_sampah: bank_sampah,
                        status: status
                    };
                    this.openCodeModal = true;
                }
            }
        }
    </script>

    
</body>
</html>