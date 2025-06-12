<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Tukar Poin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: { '50': '#eefbf4', '100': '#d6f5e3', '200': '#b0eac8', '300': '#7fdaa7', '400': '#4cc283', '500': '#26a866', '600': '#1a8a53', '700': '#166e44', '800': '#155738', '900': '#134830', '950': '#092819' },
                        yellow: { '500': '#f59e0b' },
                        green: { '600': '#16a34a' },
                        red: { '500': '#ef4444' },
                        gray: { '500': '#6b7280' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-7">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-primary-700">Donasi</h2>
            <div class="flex items-center gap-4">
                <!-- Kolom Total Poin + Riwayat -->
                <div class="flex flex-col items-end gap-1 mt-[0.25px]">
                        <div class="bg-primary-100 rounded-full px-4 py-2 flex items-center gap-2">
                            <img src="{{ asset('Assets/coin.svg') }}" alt="Koin" class="h-5 w-5 text-yellow-500">
                            <span class="font-bold text-primary-900">{{ $pengguna->total_poin ?? 0 }} Poin</span>
                        </div>
                    <!-- Link Riwayat -->
                    <a href="{{ route('pengguna-riwayat-tukar-poin') }}" class="text-gray-500 text-sm font-medium underline hover:text-gray-700 mb-5">Lihat Riwayat Tukar Poin</a>
                </div>
            </div>
        </div>

        <!-- Kartu Donasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-7 mb-12">
            @foreach($donasis as $donasi)
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <img src="{{ asset('Assets/rumah-donasi.jpeg') }}" class="w-full object-cover h-46" alt="{{ $donasi->nama_donasi }}">
                <div class="p-5">
                    <h3 class="mt-[0.25px] text-xl font-bold mb-1">{{ $donasi->nama_donasi }}</h3>
                    <p class="text-sm text-gray-500 mb-4">{{ $donasi->deskripsi_donasi ?? 'Deskripsi Tidak Tersedia' }}</p>
                    <button onclick="openDonasiModal('{{ $donasi->id_donasi }}', '{{ $donasi->nama_donasi }}')" 
                            class="border border-teal-500 text-teal-600 px-4 py-2 rounded-lg hover:bg-teal-50 transition duration-300">
                        Donasi
                    </button>
                </div>
            </div>
            @endforeach

            @if($donasis->isEmpty())
            <div class="col-span-2 text-center py-8">
                <p class="text-gray-500">Belum ada program donasi tersedia</p>
            </div>
            @endif
        </div>

        <!-- Barang Ramah Lingkungan -->
        <h2 class="text-3xl font-bold text-teal-700 text-center mb-8">Barang Ramah Lingkungan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($barangs as $barang)
            <!-- Produk {{ $loop->iteration }} -->
            <div class="bg-white shadow-sm rounded-xl p-4 text-center">
                <img src="{{ $barang->gambar ? asset('storage/' . $barang->gambar) : asset('Assets/default-product.jpg') }}" 
                     class="mx-auto h-36 w-36 object-cover mb-4 rounded-lg" 
                     alt="{{ $barang->nama_barang }}">
                <h3 class="font-semibold text-base">{{ $barang->nama_barang }}</h3>
                <p class="text-base text-gray-500 mb-3">{{ $barang->bobot_poin }} poin</p>
                <p class="text-sm text-gray-400 mb-3">Stok: {{ $barang->stok }}</p>
                <button onclick="tukarBarang('{{ $barang->id_barang }}', '{{ $barang->nama_barang }}', {{ $barang->bobot_poin }})" 
                        class="w-full border border-teal-500 text-teal-600 py-2 rounded-lg hover:bg-teal-50 transition duration-300 {{ $barang->stok <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $barang->stok <= 0 ? 'disabled' : '' }}>
                    {{ $barang->stok <= 0 ? 'Stok Habis' : 'Tukar' }}
                </button>
            </div>
            @endforeach

            @if($barangs->isEmpty())
            <div class="col-span-4 text-center py-8">
                <p class="text-gray-500">Belum ada barang tersedia untuk ditukar</p>
            </div>
            @endif
        </div>
    </main>

    <!-- Modal Donasi -->
    <div id="donasiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl p-6 w-96 max-w-[90%] mx-4">
            <h3 class="text-xl font-bold text-teal-700 mb-4">Donasi Poin</h3>
            <div id="donasiContent">
                <p class="text-gray-600 mb-4">Masukkan jumlah poin yang ingin Anda donasikan:</p>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Program Donasi</label>
                    <p id="namaDonasiText" class="text-teal-700 font-semibold"></p>
                </div>
                <div class="mb-4">
                    <label for="jumlah_poin" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Poin</label>
                    <input type="number" 
                           id="jumlah_poin" 
                           name="jumlah_poin" 
                           min="1" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                           placeholder="Masukkan jumlah poin">
                    <p class="text-sm text-gray-500 mt-1">Poin tersedia: <span id="poinTersedia">{{ $pengguna->total_poin ?? 0 }}</span></p>
                </div>
            </div>
            <div class="flex gap-3 justify-end">
                <button onclick="closeDonasiModal()" 
                        class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <button onclick="confirmDonasi()" 
                        class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                    Donasi
                </button>
            </div>
        </div>
    </div>

    <!-- Kontak -->
    <x-footer.pengguna id="kontak"/>

    <script>
        // Set up CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Global variables for donation modal
        let currentDonasiId = null;
        let currentDonasiName = null;

        // Function to open donation modal
        function openDonasiModal(idDonasi, namaDonasi) {
            currentDonasiId = idDonasi;
            currentDonasiName = namaDonasi;
            
            document.getElementById('namaDonasiText').textContent = namaDonasi;
            document.getElementById('jumlah_poin').value = '';
            document.getElementById('donasiModal').classList.remove('hidden');
        }

        // Function to close donation modal
        function closeDonasiModal() {
            document.getElementById('donasiModal').classList.add('hidden');
            currentDonasiId = null;
            currentDonasiName = null;
        }

        // Function to confirm donation
        function confirmDonasi() {
            const jumlahPoin = parseInt(document.getElementById('jumlah_poin').value);
            const poinTersedia = parseInt(document.getElementById('poinTersedia').textContent);
            
            if (!jumlahPoin || jumlahPoin <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Masukkan jumlah poin yang valid!'
                });
                return;
            }
            
            if (jumlahPoin > poinTersedia) {
                Swal.fire({
                    icon: 'error',
                    title: 'Poin Tidak Cukup',
                    text: 'Poin Anda tidak mencukupi untuk donasi sebanyak ini!'
                });
                return;
            }

            // Show loading
            Swal.fire({
                title: 'Memproses...',
                text: 'Sedang memproses donasi Anda',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send AJAX request
            fetch('{{ route("tukar.donasi") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    id_donasi: currentDonasiId,
                    jumlah_poin: jumlahPoin
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update total poin di UI
                    document.getElementById('total-poin').textContent = data.data.sisa_poin;
                    document.getElementById('poinTersedia').textContent = data.data.sisa_poin;
                    
                    closeDonasiModal();
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Donasi Berhasil!',
                        html: `
                            <p><strong>Program:</strong> ${data.data.nama_donasi}</p>
                            <p><strong>Poin Digunakan:</strong> ${data.data.poin_digunakan}</p>
                            <p><strong>Sisa Poin:</strong> ${data.data.sisa_poin}</p>
                        `
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message || 'Terjadi kesalahan saat melakukan donasi'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan sistem'
                });
            });
        }

        // Function to exchange items
        function tukarBarang(idBarang, namaBarang, hargaPoin) {
            const poinTersedia = parseInt(document.getElementById('total-poin').textContent);
            
            if (hargaPoin > poinTersedia) {
                Swal.fire({
                    icon: 'error',
                    title: 'Poin Tidak Cukup',
                    text: `Anda memerlukan ${hargaPoin} poin untuk menukar ${namaBarang}, tetapi Anda hanya memiliki ${poinTersedia} poin.`
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Penukaran',
                html: `
                    <p>Apakah Anda yakin ingin menukar:</p>
                    <p><strong>${namaBarang}</strong></p>
                    <p>dengan <strong>${hargaPoin} poin</strong>?</p>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d9488',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Tukar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Sedang memproses penukaran Anda',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Send AJAX request
                    fetch('{{ route("tukar.barang") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            id_barang: idBarang
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update total poin di UI
                            document.getElementById('total-poin').textContent = data.data.sisa_poin;
                            document.getElementById('poinTersedia').textContent = data.data.sisa_poin;
                            
                            Swal.fire({
                                icon: 'success',
                                title: 'Penukaran Berhasil!',
                                html: `
                                    <p><strong>Barang:</strong> ${data.data.nama_barang}</p>
                                    <p><strong>Kode Redeem:</strong> <span style="font-family: monospace; font-weight: bold; color: #0d9488;">${data.data.kode_redeem}</span></p>
                                    <p><strong>Poin Digunakan:</strong> ${data.data.poin_digunakan}</p>
                                    <p><strong>Sisa Poin:</strong> ${data.data.sisa_poin}</p>
                                    <hr style="margin: 10px 0;">
                                    <p style="font-size: 12px; color: #6b7280;">Simpan kode redeem untuk mengambil barang Anda!</p>
                                `
                            }).then(() => {
                                // Refresh page to update stock
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || 'Terjadi kesalahan saat menukar barang'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan sistem'
                        });
                    });
                }
            });
        }

        // Close modal when clicking outside
        document.getElementById('donasiModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDonasiModal();
            }
        });

        // Handle Enter key in donation input
        document.getElementById('jumlah_poin').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                confirmDonasi();
            }
        });
    </script>
</body>
</html>