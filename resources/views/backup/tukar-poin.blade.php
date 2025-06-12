<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WasteWise - Tukar Poin</title>
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

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10">
        <!-- Header Section with Total Poin -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-teal-700">Tukar Poin</h2>
            <div class="flex items-center gap-4">
                <!-- Kolom Total Poin + Riwayat -->
                <div class="flex flex-col items-end gap-1">
                    <!-- Box Total Poin -->
                    <div class="px-3 py-2 rounded-2xl flex items-center gap-2 max-w-[250px]" style="background-color: #A3D1C6;">
                        <!-- Coin Icon -->
                        <div class="bg-yellow-400 p-1 rounded-full">
                            <img src="{{ asset('Assets/coin.svg') }}" alt="Coin Icon" class="h-11 w-11">
                        </div>
                        <!-- Text Total Poin -->
                        <div class="ml-2">
                            <p class="text-base font-bold text-black-700">Total Poin</p>
                            <p class="text-3xl font-extrabold text-teal-700" id="total-poin">{{ $pengguna->total_poin ?? 0 }}</p>
                        </div>
                    </div>
                    <!-- Link Riwayat -->
                    <a href="{{ route('riwayat.poin') }}" class="text-gray-500 text-sm font-medium underline hover:text-gray-700 mb-5">Riwayat Poin</a>
                </div>
            </div>
        </div>

        <!-- Barang Ramah Lingkungan Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-teal-700 text-center mb-8">Barang Ramah Lingkungan</h2>
            
            @if($barangs->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($barangs as $barang)
                <!-- Produk {{ $loop->iteration }} -->
                <div class="bg-white shadow-lg rounded-xl p-4 text-center hover:shadow-xl transition-shadow duration-300">
                    @if($barang->gambar)
                        <img src="{{ asset('storage/' . $barang->gambar) }}" class="mx-auto h-36 w-36 object-cover mb-4 rounded-lg" alt="{{ $barang->nama_barang }}">
                    @else
                        <img src="{{ asset('Assets/default-product.jpg') }}" class="mx-auto h-36 w-36 object-cover mb-4 rounded-lg" alt="{{ $barang->nama_barang }}">
                    @endif
                    <h3 class="font-semibold text-base mb-2">{{ $barang->nama_barang }}</h3>
                    <p class="text-lg font-bold text-teal-600 mb-3">{{ number_format($barang->harga_poin) }} poin</p>
                    @if($barang->stok > 0)
                        <button 
                            class="w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 transition duration-300 btn-tukar-barang"
                            data-id-barang="{{ $barang->id_barang }}"
                            data-nama-barang="{{ $barang->nama_barang }}"
                            data-harga-poin="{{ $barang->harga_poin }}">
                            Tukar
                        </button>
                    @else
                        <button class="w-full bg-gray-300 text-gray-500 py-2 rounded-lg cursor-not-allowed" disabled>
                            Stok Habis
                        </button>
                    @endif
                    <p class="text-xs text-gray-400 mt-2">Stok: {{ $barang->stok }}</p>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <img src="{{ asset('Assets/empty-box.svg') }}" alt="Tidak ada barang" class="mx-auto h-24 w-24 mb-4 opacity-50">
                    <p class="text-gray-500 text-lg">Belum ada barang yang tersedia untuk ditukar</p>
                </div>
            </div>
            @endif
        </section>

        <!-- Donasi Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-teal-700 text-center mb-8">Program Donasi</h2>
            
            @if($donasis->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                @foreach($donasis as $donasi)
                <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    @if($donasi->gambar)
                        <img src="{{ asset('storage/' . $donasi->gambar) }}" class="w-full object-cover h-48" alt="{{ $donasi->nama_donasi }}">
                    @else
                        <img src="{{ asset('Assets/rumah-donasi.jpeg') }}" class="w-full object-cover h-48" alt="{{ $donasi->nama_donasi }}">
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $donasi->nama_donasi }}</h3>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                            {{ $donasi->deskripsi ?? 'Program donasi untuk membantu sesama dan lingkungan.' }}
                        </p>
                        @if($donasi->alamat)
                            <p class="text-xs text-gray-500 mb-4">
                                <i class="fas fa-map-marker-alt mr-1"></i>{{ $donasi->alamat }}
                            </p>
                        @endif
                        <button 
                            class="w-full bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition duration-300 font-medium btn-donasi"
                            data-id-donasi="{{ $donasi->id_donasi }}"
                            data-nama-donasi="{{ $donasi->nama_donasi }}">
                            <i class="fas fa-heart mr-2"></i>Donasi Sekarang
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <img src="{{ asset('Assets/donation.svg') }}" alt="Tidak ada donasi" class="mx-auto h-24 w-24 mb-4 opacity-50">
                    <p class="text-gray-500 text-lg">Belum ada program donasi yang tersedia</p>
                </div>
            </div>
            @endif
        </section>

        <!-- Tombol Cek Status Redeem -->
        <div class="text-center">
            <button 
                id="btn-cek-status"
                class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-medium shadow-lg">
                <i class="fas fa-search mr-2"></i>Cek Status Redeem
            </button>
        </div>
    </main>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 flex items-center gap-3 shadow-xl">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-teal-600"></div>
            <span class="font-medium">Memproses...</span>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div id="success-message" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        <div class="flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="error-message" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        <div class="flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        // Configuration
        const CONFIG = {
            routes: {
                tukarBarang: '{{ route("tukar.barang") }}',
                tukarDonasi: '{{ route("tukar.donasi") }}',
                cekStatusRedeem: '{{ route("cek.status.redeem") }}',
                login: '{{ route("login") }}'
            },
            csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        };

        // Utility functions
        const Utils = {
            showLoading: () => {
                document.getElementById('loading-overlay').classList.remove('hidden');
            },
            
            hideLoading: () => {
                document.getElementById('loading-overlay').classList.add('hidden');
            },
            
            updateTotalPoin: (sisaPoin) => {
                const totalPoinElement = document.getElementById('total-poin');
                if (totalPoinElement) {
                    totalPoinElement.textContent = number_format(sisaPoin);
                }
            },
            
            getCurrentPoin: () => {
                const totalPoinElement = document.getElementById('total-poin');
                return totalPoinElement ? parseInt(totalPoinElement.textContent.replace(/[^0-9]/g, '')) : 0;
            },
            
            showNotification: (message, type = 'info') => {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 text-white ${type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'}`;
                notification.innerHTML = `
                    <div class="flex items-center gap-2">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                        <span>${message}</span>
                    </div>
                `;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.remove();
                }, 5000);
            },

            showAlert: (message) => {
                alert(message);
            },
            
            showConfirm: (message) => {
                return confirm(message);
            },
            
            showPrompt: (message, defaultValue = '') => {
                return prompt(message, defaultValue);
            }
        };

        // Number formatting
        function number_format(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        // API functions
        const API = {
            async makeRequest(url, data = {}) {
                try {
                    Utils.showLoading();
                    
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CONFIG.csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(data)
                    });

                    // Check for redirect (302 status or redirect response)
                    if (response.redirected || response.status === 302) {
                        Utils.hideLoading();
                        Utils.showNotification('Sesi Anda telah berakhir. Silakan login kembali.', 'error');
                        setTimeout(() => {
                            window.location.href = CONFIG.routes.login;
                        }, 2000);
                        return null;
                    }

                    // Check for authentication errors
                    if (response.status === 401) {
                        Utils.hideLoading();
                        Utils.showNotification('Anda tidak memiliki akses. Silakan login kembali.', 'error');
                        setTimeout(() => {
                            window.location.href = CONFIG.routes.login;
                        }, 2000);
                        return null;
                    }

                    // Check for other HTTP errors
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }

                    const result = await response.json();
                    Utils.hideLoading();
                    return result;

                } catch (error) {
                    Utils.hideLoading();
                    console.error('API Error:', error);
                    
                    if (error.name === 'TypeError' && error.message.includes('Failed to fetch')) {
                        Utils.showNotification('Koneksi bermasalah. Silakan cek koneksi internet Anda.', 'error');
                    } else {
                        Utils.showNotification('Terjadi kesalahan: ' + error.message, 'error');
                    }
                    return null;
                }
            }
        };

        // Main functions
        const TukarPoin = {
            async tukarBarang(idBarang, namaBarang, hargaPoin) {
                // Validasi poin
                const currentPoin = Utils.getCurrentPoin();
                if (currentPoin < hargaPoin) {
                    Utils.showNotification('Poin Anda tidak mencukupi untuk menukar barang ini.', 'error');
                    return;
                }

                if (!Utils.showConfirm(`Apakah Anda yakin ingin menukar ${namaBarang} dengan ${number_format(hargaPoin)} poin?`)) {
                    return;
                }

                const result = await API.makeRequest(CONFIG.routes.tukarBarang, {
                    id_barang: idBarang
                });

                if (result) {
                    if (result.success) {
                        Utils.showNotification(result.message, 'success');
                        Utils.showAlert(`Penukaran berhasil!\n\nBarang: ${result.data.nama_barang}\nKode Redeem: ${result.data.kode_redeem}\n\nSimpan kode redeem Anda dengan baik!`);
                        Utils.updateTotalPoin(result.data.sisa_poin);
                        
                        // Reload halaman untuk update data
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        Utils.showNotification(result.message, 'error');
                    }
                }
            },

            async tukarDonasi(idDonasi, namaDonasi) {
                const jumlahPoinStr = Utils.showPrompt(`Masukkan jumlah poin yang ingin Anda donasikan untuk ${namaDonasi}:`, '1000');
                
                if (jumlahPoinStr === null || jumlahPoinStr === '') {
                    return;
                }

                const jumlahPoin = parseInt(jumlahPoinStr);
                
                if (isNaN(jumlahPoin) || jumlahPoin <= 0) {
                    Utils.showNotification('Masukkan jumlah poin yang valid (angka positif)', 'error');
                    return;
                }
                
                // Validasi poin
                const currentPoin = Utils.getCurrentPoin();
                if (jumlahPoin > currentPoin) {
                    Utils.showNotification('Poin Anda tidak mencukupi', 'error');
                    return;
                }
                
                if (!Utils.showConfirm(`Apakah Anda yakin ingin mendonasikan ${number_format(jumlahPoin)} poin untuk ${namaDonasi}?`)) {
                    return;
                }

                const result = await API.makeRequest(CONFIG.routes.tukarDonasi, {
                    id_donasi: idDonasi,
                    jumlah_poin: jumlahPoin
                });

                if (result) {
                    if (result.success) {
                        Utils.showNotification(result.message, 'success');
                        Utils.showAlert(`Donasi berhasil!\n\nProgram: ${result.data.nama_donasi}\nJumlah: ${number_format(result.data.poin_digunakan)} poin\n\nTerima kasih atas kebaikan Anda!`);
                        Utils.updateTotalPoin(result.data.sisa_poin);
                        
                        // Reload halaman untuk update data
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        Utils.showNotification(result.message, 'error');
                    }
                }
            },

            async cekStatusRedeem() {
                const kodeRedeem = Utils.showPrompt('Masukkan kode redeem Anda:', 'RDM');
                
                if (kodeRedeem === null || kodeRedeem === '') {
                    return;
                }

                const result = await API.makeRequest(CONFIG.routes.cekStatusRedeem, {
                    kode_redeem: kodeRedeem.trim().toUpperCase()
                });

                if (result) {
                    if (result.success) {
                        const info = result.data;
                        const waktu = new Date(info.waktu_penukaran).toLocaleString('id-ID');
                        const statusColor = info.status === 'Pending' ? '🟡' : info.status === 'Selesai' ? '✅' : '❌';
                        
                        Utils.showAlert(`${statusColor} Status Redeem\n\n` +
                            `Kode: ${info.kode_redeem}\n` +
                            `Barang: ${info.nama_barang}\n` +
                            `Status: ${info.status}\n` +
                            `Poin Digunakan: ${number_format(info.poin_digunakan)}\n` +
                            `Waktu Penukaran: ${waktu}`);
                    } else {
                        Utils.showNotification(result.message, 'error');
                    }
                }
            }
        };

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Cek CSRF token
            if (!CONFIG.csrfToken) {
                console.error('CSRF token not found');
                Utils.showNotification('Error: CSRF token tidak ditemukan. Silakan refresh halaman.', 'error');
                return;
            }

            // Event listeners untuk tombol tukar barang
            document.querySelectorAll('.btn-tukar-barang').forEach(button => {
                button.addEventListener('click', function() {
                    const idBarang = this.getAttribute('data-id-barang');
                    const namaBarang = this.getAttribute('data-nama-barang');
                    const hargaPoin = parseInt(this.getAttribute('data-harga-poin'));
                    TukarPoin.tukarBarang(idBarang, namaBarang, hargaPoin);
                });
            });
            
            // Event listeners untuk tombol donasi
            document.querySelectorAll('.btn-donasi').forEach(button => {
                button.addEventListener('click', function() {
                    const idDonasi = this.getAttribute('data-id-donasi');
                    const namaDonasi = this.getAttribute('data-nama-donasi');
                    TukarPoin.tukarDonasi(idDonasi, namaDonasi);
                });
            });

            // Event listener untuk tombol cek status redeem
            document.getElementById('btn-cek-status').addEventListener('click', function() {
                TukarPoin.cekStatusRedeem();
            });

            // Auto-hide session messages
            setTimeout(() => {
                const successMsg = document.getElementById('success-message');
                const errorMsg = document.getElementById('error-message');
                if (successMsg) successMsg.remove();
                if (errorMsg) errorMsg.remove();
            }, 5000);
        });

        // Handle page visibility change (detect when user comes back to tab)
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                // Refresh CSRF token when page becomes visible
                const metaTag = document.querySelector('meta[name="csrf-token"]');
                if (metaTag) {
                    CONFIG.csrfToken = metaTag.getAttribute('content');
                }
            }
        });
    </script>
</body>
</html>