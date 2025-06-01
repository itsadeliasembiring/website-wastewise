<!DOCTYPE html>
<html lang="en" class="h-full bg-[#E6E6E6] dark:bg-[#E6E6E6]">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Penukaran Donasi</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full w-full">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 h-16 bg-white shadow-sm w-full">
        <x-header.admin/>
    </header>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-20 bottom-0 transition-all duration-300 bg-white">
        <x-sidebar.admin />
    </aside>

   <!-- Main Content -->
   <main class="min-h-screen pt-25 overflow-y-auto sm:pl-[70px] xl:pl-15 mt-2 mb-6">
        <div class="max-w-7xl px-5">
            <!-- Tab navigation -->
            <div class="flex border-b border-gray-200 mb-5">
                <button id="tabDonasi" class="px-6 py-3 font-medium text-[#3D8D7A] border-b-2 border-[#3D8D7A]">Data Donasi</button>
                <button id="tabRiwayat" class="px-6 py-3 font-medium text-gray-500 hover:text-[#3D8D7A]">Riwayat Penukaran</button>
            </div>

            <!-- Donasi Tab Content -->
            <div id="contentDonasi" class="block">
                <div class="flex justify-between items-center mb-3">
                    <h1 class="text-2xl font-semibold text-[#3D8D7A]">Kelola Data Donasi</h1>
                    <div class="flex space-x-4">
                        <div class="relative">
                            <input type="text" id="searchDonasi" placeholder="Search" class="text-black w-64 pl-10 pr-4 py-2 rounded-lg border bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                            <span class="absolute left-3 top-2.5 text-black">
                                <x-fas-search class="w-5 h-5 text-[#3D8D7A]" />
                            </span>
                        </div>
                        <button id="btnTambahDonasi" class="bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white px-4 py-2 rounded-lg flex items-center">
                            <x-fas-plus class="w-5 h-5 text-[#fff] mr-2"/> Tambah
                        </button>
                    </div>
                </div>

                <!-- Table Donasi -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-[#3D8D7A] text-white">
                                <th class="py-3 px-4 text-center">No</th>
                                <th class="py-3 px-4 text-center">ID Donasi</th>
                                <th class="py-3 px-4 text-center">Nama Donasi</th>
                                <th class="py-3 px-4 text-center">Total Donasi</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBodyDonasi">
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Donasi -->
                <div class="flex justify-end mt-4 space-x-2 mb-5">
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnPrevDonasi">Prev</button>
                    <button class="px-3 py-1 rounded bg-[#3D8D7A] text-white" id="pageDonasi1">1</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageDonasi2">2</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageDonasi3">3</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageDonasi4">4</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageDonasi5">5</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnNextDonasi">Next</button>
                </div>
            </div>

            <!-- Riwayat Penukaran Tab Content -->
            <div id="contentRiwayat" class="hidden">
                <div class="flex justify-between items-center mb-3">
                    <h1 class="text-2xl font-semibold text-[#3D8D7A]">Riwayat Penukaran Donasi</h1>
                    <div class="flex space-x-4">
                        <div class="flex items-center space-x-2">
                            <label class="text-gray-700">Filter Tanggal:</label>
                            <input type="date" id="filterTanggalMulai" class="text-black pl-4 pr-4 py-2 rounded-lg border bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                            <span class="text-gray-700">s/d</span>
                            <input type="date" id="filterTanggalSelesai" class="text-black pl-4 pr-4 py-2 rounded-lg border bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                            <button id="btnFilter" class="bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white px-4 py-2 rounded-lg">
                                Filter
                            </button>
                        </div>
                        <div class="relative">
                            <input type="text" id="searchRiwayat" placeholder="Search" class="text-black w-64 pl-10 pr-4 py-2 rounded-lg border bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                            <span class="absolute left-3 top-2.5 text-black">
                                <x-fas-search class="w-5 h-5 text-[#3D8D7A]" />
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Table Riwayat -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-[#3D8D7A] text-white">
                                <th class="py-3 px-4 text-center">No</th>
                                <th class="py-3 px-4 text-center">ID Penukaran</th>
                                <th class="py-3 px-4 text-center">Waktu</th>
                                <th class="py-3 px-4 text-center">Jumlah Poin</th>
                                <th class="py-3 px-4 text-center">ID Donasi</th>
                                <th class="py-3 px-4 text-center">Nama Donasi</th>
                                <th class="py-3 px-4 text-center">Nama Pengguna</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBodyRiwayat">
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Riwayat -->
                <div class="flex justify-end mt-4 space-x-2 mb-5">
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnPrevRiwayat">Prev</button>
                    <button class="px-3 py-1 rounded bg-[#3D8D7A] text-white" id="pageRiwayat1">1</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageRiwayat2">2</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageRiwayat3">3</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageRiwayat4">4</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageRiwayat5">5</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnNextRiwayat">Next</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Form Tambah Donasi -->
    <div id="modalTambahDonasi" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full px-6 py-10 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Form Tambah Donasi</h2>
                
                <form id="formTambahDonasi">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Donasi <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_donasi" placeholder="Masukkan Nama Donasi" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Deskripsi Donasi <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi_donasi" rows="4" placeholder="Masukkan Deskripsi Donasi" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto<span class="text-red-500">*</span></label>
                        <input type="file" name="foto" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanTambahDonasi" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                        <button type="submit" class="w-1/2 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Form Edit Donasi -->
    <div id="modalEditDonasi" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Edit Donasi</h2>
                <form id="formEditDonasi">
                    <input type="hidden" id="editIdDonasi">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Donasi <span class="text-red-500">*</span></label>
                        <input type="text" id="editNamaDonasi" placeholder="Masukkan Nama Donasi" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Deskripsi Donasi <span class="text-red-500">*</span></label>
                        <textarea id="editDeskripsiDonasi" rows="4" placeholder="Masukkan Deskripsi Donasi" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto</label>
                        <input type="file" id="editFotoDonasi" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto</p>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanEditDonasi" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                        <button type="submit" class="w-1/2 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="modalKonfirmasiHapus" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 text-center">
                <h2 class="text-xl font-bold mb-3 text-red-500">APAKAH ANDA YAKIN?</h2>
                <div class="flex justify-center mb-3 text-red-500">
                    <x-fas-trash class="w-15 h-15" />
                </div>
                <p class="text-gray-600 mb-6">Data yang terhapus tidak dapat kembali</p>
                
                <div class="flex justify-center space-x-4">
                    <button id="btnBatalkanHapus" class="px-6 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                    <button id="btnKonfirmasiHapus" class="px-8 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Ya</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Detail Donasi -->
    <div id="modalDetailDonasi" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Donasi</h2>
                    <button id="btnCloseDetailDonasi" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Utama -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">ID Donasi</p>
                            <p id="detailIdDonasi" class="text-black">DON001</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Nama Donasi</p>
                            <p id="detailNamaDonasi" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Deskripsi Donasi</p>
                            <p id="detailDeskripsiDonasi" class="text-black">-</p>
                        </div>
                        
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Total Donasi</p>
                            <p id="detailTotalDonasi" class="text-black">-</p>
                        </div>
                    </div>
                    
                    <!-- Foto Donasi -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Foto Donasi</p>
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img id="detailFotoDonasi" src="/api/placeholder/400/320" alt="Foto Donasi" class="max-h-full max-w-full rounded-lg object-cover text-black">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Riwayat Penukaran -->
    <div id="modalDetailRiwayat" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Riwayat Penukaran</h2>
                    <button id="btnCloseDetailRiwayat" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Utama -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">ID Penukaran</p>
                            <p id="detailIdPenukaran" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Waktu Penukaran</p>
                            <p id="detailWaktuPenukaran" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Jumlah Poin</p>
                            <p id="detailJumlahPoin" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">ID Donasi</p>
                            <p id="detailRiwayatIdDonasi" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Nama Donasi</p>
                            <p id="detailRiwayatNamaDonasi" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Nama Pengguna</p>
                            <p id="detailRiwayatNamaPengguna" class="text-black">-</p>
                        </div>
                    </div>
                    
                    <!-- Foto Donasi -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Foto Donasi</p>
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img id="detailRiwayatFotoDonasi" src="/api/placeholder/400/320" alt="Foto Donasi" class="max-h-full max-w-full rounded-lg object-cover text-black">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Success -->
    <div id="alertSuccess" class="fixed bottom-4 right-4 bg-green-100 border-l-4 border-green-500 text-[#3D8D7A] p-4 rounded shadow-md hidden">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3 text-green-500"></i>
            <div>
                <p class="font-bold">Berhasil!</p>
                <p id="alertSuccessMessage">Operasi berhasil dilakukan.</p>
            </div>
            <button class="ml-6 text-green-500 hover:text-[#3D8D7A]" id="btnCloseAlert">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <script>
        // Donation data structure
        const donasiData = [
            { 
                id: 1, 
                id_donasi: "DON001", 
                nama_donasi: "Donasi Bencana Alam",
                deskripsi_donasi: "Bantuan untuk korban bencana alam di Jawa Barat",
                total_donasi: 250000,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 2, 
                id_donasi: "DON002", 
                nama_donasi: "Donasi Pendidikan",
                deskripsi_donasi: "Bantuan pendidikan untuk anak-anak kurang mampu",
                total_donasi: 500000,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 3, 
                id_donasi: "DON003", 
                nama_donasi: "Donasi Kesehatan",
                deskripsi_donasi: "Bantuan kesehatan untuk lansia",
                total_donasi: 350000,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 4, 
                id_donasi: "DON004", 
                nama_donasi: "Donasi Yatim Piatu",
                deskripsi_donasi: "Bantuan untuk panti asuhan",
                total_donasi: 425000,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 5, 
                id_donasi: "DON005", 
                nama_donasi: "Donasi Pendidikan Anak",
                deskripsi_donasi: "Bantuan pendidikan untuk anak-anak kurang mampu di daerah terpencil",
                total_donasi: 300000,
                fotoUrl: "/api/placeholder/400/320"
            }
        ];

        // Riwayat Penukaran data structure
        const riwayatPenukaranData = [
            {
                id: 1,
                id_penukaran: "PEN001",
                waktu: "2023-03-15 08:30:00",
                jumlah_poin: 500,
                id_donasi: "DON001",
                nama_donasi: "Donasi Bencana Alam",
                nama_pengguna: "Andi Pratama",
                fotoUrl: "/api/placeholder/400/320"
            },
            {
                id: 2,
                id_penukaran: "PEN002",
                waktu: "2023-03-18 14:15:00",
                jumlah_poin: 750,
                id_donasi: "DON002",
                nama_donasi: "Donasi Pendidikan",
                nama_pengguna: "Budi Santoso",
                fotoUrl: "/api/placeholder/400/320"
            },
            {
                id: 3,
                id_penukaran: "PEN003",
                waktu: "2023-04-02 09:45:00",
                jumlah_poin: 600,
                id_donasi: "DON003",
                nama_donasi: "Donasi Kesehatan",
                nama_pengguna: "Siti Rahma",
                fotoUrl: "/api/placeholder/400/320"
            },
            {
                id: 4,
                id_penukaran: "PEN004",
                waktu: "2023-04-15 11:20:00",
                jumlah_poin: 850,
                id_donasi: "DON004",
                nama_donasi: "Donasi Yatim Piatu",
                nama_pengguna: "Dewi Anggraini",
                fotoUrl: "/api/placeholder/400/320"
            },
            {
                id: 5,
                id_penukaran: "PEN005",
                waktu: "2023-04-28 16:05:00",
                jumlah_poin: 450,
                id_donasi: "DON005",
                nama_donasi: "Donasi Pendidikan Anak",
                nama_pengguna: "Rudi Hermawan",
                fotoUrl: "/api/placeholder/400/320"
            }
        ];

        // Global variables
        let currentPageDonasi = 1;
        let currentPageRiwayat = 1;
        const rowsPerPage = 5;
        let deleteId = null;
        let activeTab = 'tabDonasi';

        // DOM Elements - Donasi Tab
        const tableBodyDonasi = document.getElementById('tableBodyDonasi');
        const tabDonasi = document.getElementById('tabDonasi');
        const tabRiwayat = document.getElementById('tabRiwayat');
        const contentDonasi = document.getElementById('contentDonasi');
        const contentRiwayat = document.getElementById('contentRiwayat');
        const modalTambahDonasi = document.getElementById('modalTambahDonasi');
        const modalEditDonasi = document.getElementById('modalEditDonasi');
        const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');
        const modalDetailDonasi = document.getElementById('modalDetailDonasi');
        const alertSuccess = document.getElementById('alertSuccess');
        const alertSuccessMessage = document.getElementById('alertSuccessMessage');

        // DOM Elements - Riwayat Tab
        const tableBodyRiwayat = document.getElementById('tableBodyRiwayat');
        const modalDetailRiwayat = document.getElementById('modalDetailRiwayat');

        // Tab switching functionality
        tabDonasi.addEventListener('click', function() {
            contentDonasi.classList.remove('hidden');
            contentDonasi.classList.add('block');
            contentRiwayat.classList.add('hidden');
            contentRiwayat.classList.remove('block');
            
            tabDonasi.classList.add('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
            tabDonasi.classList.remove('text-gray-500');
            
            tabRiwayat.classList.remove('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
            tabRiwayat.classList.add('text-gray-500');
            
            activeTab = 'tabDonasi';
        });

        tabRiwayat.addEventListener('click', function() {
            contentRiwayat.classList.remove('hidden');
            contentRiwayat.classList.add('block');
            contentDonasi.classList.add('hidden');
            contentDonasi.classList.remove('block');
            
            tabRiwayat.classList.add('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
            tabRiwayat.classList.remove('text-gray-500');
            
            tabDonasi.classList.remove('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
            tabDonasi.classList.add('text-gray-500');
            
            activeTab = 'tabRiwayat';
            renderTableRiwayat();
        });

        // Search functionality for Donasi tab
        function searchDonasi(query) {
            if (!query) {
                return donasiData;
            }
            
            query = query.toLowerCase();
            return donasiData.filter(item => 
                item.id_donasi.toLowerCase().includes(query) || 
                item.nama_donasi.toLowerCase().includes(query) || 
                item.deskripsi_donasi.toLowerCase().includes(query)
            );
        }

        // Search functionality for Riwayat tab
        function searchRiwayat(query, startDate = null, endDate = null) {
            let filteredData = riwayatPenukaranData;
            
            // Apply date filter if provided
            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                end.setHours(23, 59, 59);
                
                filteredData = filteredData.filter(item => {
                    const itemDate = new Date(item.waktu);
                    return itemDate >= start && itemDate <= end;
                });
            }
            
            // Apply search query if provided
            if (query) {
                query = query.toLowerCase();
                filteredData = filteredData.filter(item => 
                    item.id_penukaran.toLowerCase().includes(query) || 
                    item.id_donasi.toLowerCase().includes(query) || 
                    item.nama_donasi.toLowerCase().includes(query) || 
                    item.nama_pengguna.toLowerCase().includes(query)
                );
            }
            
            return filteredData;
        }

        // Render Donasi table
        function renderTableDonasi() {
            tableBodyDonasi.innerHTML = '';
            
            const searchQuery = document.getElementById('searchDonasi').value;
            const filteredData = searchDonasi(searchQuery);
            
            // Check if there's data to display
            if (filteredData.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="7" class="py-8 px-4 border-b border-gray-200 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-medium">Data tidak tersedia</p>
                            <p class="text-sm">Tidak ada data donasi yang sesuai dengan pencarian Anda</p>
                        </div>
                    </td>
                `;
                tableBodyDonasi.appendChild(emptyRow);
                return;
            }
            
            const start = (currentPageDonasi - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = filteredData.slice(start, end);
            
            paginatedData.forEach((item, index) => {
                const row = document.createElement('tr');
                row.className = index % 2 === 0 ? '' : 'bg-gray-50';
                row.innerHTML = `
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${start + index + 1}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.id_donasi}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.nama_donasi}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.total_donasi}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">
                        <div class="flex justify-center space-x-2">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 btnDetailDonasi" data-id="${item.id}">Detail</button>
                            <button class="bg-[#3D8D7A] text-white px-3 py-1 rounded-md hover:bg-[#2C6A5C] btnEditDonasi" data-id="${item.id}">Edit</button>
                            <button class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 btnHapusDonasi" data-id="${item.id}">Hapus</button>
                        </div>
                    </td>
                `;
                tableBodyDonasi.appendChild(row);
            });

            // Add event listeners for buttons
            document.querySelectorAll('.btnDetailDonasi').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openDetailDonasiModal(id);
                });
            });

            document.querySelectorAll('.btnEditDonasi').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openEditDonasiModal(id);
                });
            });

            document.querySelectorAll('.btnHapusDonasi').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openDeleteConfirmation(id);
                });
            });
            
            // Update pagination for filtered results
            updatePaginationDonasi(filteredData.length);
        }

        // Render Riwayat table
        function renderTableRiwayat() {
            tableBodyRiwayat.innerHTML = '';
            
            const searchQuery = document.getElementById('searchRiwayat').value;
            const startDate = document.getElementById('filterTanggalMulai').value;
            const endDate = document.getElementById('filterTanggalSelesai').value;
            
            const filteredData = searchRiwayat(searchQuery, startDate, endDate);
            
            // Check if there's data to display
            if (filteredData.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="8" class="py-8 px-4 border-b border-gray-200 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-medium">Data tidak tersedia</p>
                            <p class="text-sm">Tidak ada riwayat penukaran yang sesuai dengan filter Anda</p>
                        </div>
                    </td>
                `;
                tableBodyRiwayat.appendChild(emptyRow);
                return;
            }
            
            const start = (currentPageRiwayat - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = filteredData.slice(start, end);
            
            paginatedData.forEach((item, index) => {
                const row = document.createElement('tr');
                row.className = index % 2 === 0 ? '' : 'bg-gray-50';
                
                // Format date for display
                const formattedDate = formatDateTime(item.waktu);
                
                row.innerHTML = `
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${start + index + 1}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.id_penukaran}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${formattedDate}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.jumlah_poin}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.id_donasi}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.nama_donasi}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.nama_pengguna}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">
                        <button class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 btnDetailRiwayat" data-id="${item.id}">Detail</button>
                    </td>
                `;
                tableBodyRiwayat.appendChild(row);
            });

            // Add event listeners for detail buttons
            document.querySelectorAll('.btnDetailRiwayat').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openDetailRiwayatModal(id);
                });
            });
            
            // Update pagination for filtered results
            updatePaginationRiwayat(filteredData.length);
        }

        // Update pagination for Donasi tab
        function updatePaginationDonasi(totalItems) {
            const maxPage = Math.ceil(totalItems / rowsPerPage);
            
            // Adjust current page if it's beyond max page
            if (currentPageDonasi > maxPage && maxPage > 0) {
                currentPageDonasi = maxPage;
            }
            
            // Update pagination buttons visibility
            for (let i = 1; i <= 5; i++) {
                const pageBtn = document.getElementById(`pageDonasi${i}`);
                if (i <= maxPage) {
                    pageBtn.style.display = '';
                } else {
                    pageBtn.style.display = 'none';
                }
            }
            
            updateActivePaginationDonasi();
        }

        // Update pagination for Riwayat tab
        function updatePaginationRiwayat(totalItems) {
            const maxPage = Math.ceil(totalItems / rowsPerPage);
            
            // Adjust current page if it's beyond max page
            if (currentPageRiwayat > maxPage && maxPage > 0) {
                currentPageRiwayat = maxPage;
            }
            
            // Update pagination buttons visibility
            for (let i = 1; i <= 5; i++) {
                const pageBtn = document.getElementById(`pageRiwayat${i}`);
                if (i <= maxPage) {
                    pageBtn.style.display = '';
                } else {
                    pageBtn.style.display = 'none';
                }
            }
            
            updateActivePaginationRiwayat();
        }

        // Update active pagination button for Donasi tab
        function updateActivePaginationDonasi() {
            for (let i = 1; i <= 5; i++) {
                const pageBtn = document.getElementById(`pageDonasi${i}`);
                
                if (i === currentPageDonasi) {
                    pageBtn.classList.remove('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                    pageBtn.classList.add('bg-[#3D8D7A]', 'text-white');
                } else {
                    pageBtn.classList.remove('bg-[#3D8D7A]', 'text-white');
                    pageBtn.classList.add('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                }
            }
        }

        // Update active pagination button for Riwayat tab
        function updateActivePaginationRiwayat() {
            for (let i = 1; i <= 5; i++) {
                const pageBtn = document.getElementById(`pageRiwayat${i}`);
                
                if (i === currentPageRiwayat) {
                    pageBtn.classList.remove('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                    pageBtn.classList.add('bg-[#3D8D7A]', 'text-white');
                } else {
                    pageBtn.classList.remove('bg-[#3D8D7A]', 'text-white');
                    pageBtn.classList.add('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                }
            }
        }

        // Function to open detail donasi modal
        function openDetailDonasiModal(id) {
            const data = donasiData.find(item => item.id === id);
            if (data) {
                document.getElementById('detailIdDonasi').textContent = data.id_donasi;
                document.getElementById('detailNamaDonasi').textContent = data.nama_donasi;
                document.getElementById('detailDeskripsiDonasi').textContent = data.deskripsi_donasi;
                document.getElementById('detailTotalDonasi').textContent = data.total_donasi;
                document.getElementById('detailFotoDonasi').src = data.fotoUrl || '/api/placeholder/400/320';
                
                modalDetailDonasi.classList.remove('hidden');
            }
        }

        // Function to open detail riwayat modal
        function openDetailRiwayatModal(id) {
            const data = riwayatPenukaranData.find(item => item.id === id);
            if (data) {
                document.getElementById('detailIdPenukaran').textContent = data.id_penukaran;
                document.getElementById('detailWaktuPenukaran').textContent = formatDateTime(data.waktu);
                document.getElementById('detailJumlahPoin').textContent = data.jumlah_poin;
                document.getElementById('detailRiwayatIdDonasi').textContent = data.id_donasi;
                document.getElementById('detailRiwayatNamaDonasi').textContent = data.nama_donasi;
                document.getElementById('detailRiwayatNamaPengguna').textContent = data.nama_pengguna;
                document.getElementById('detailRiwayatFotoDonasi').src = data.fotoUrl || '/api/placeholder/400/320';
                
                modalDetailRiwayat.classList.remove('hidden');
            }
        }

        // Function to open edit donasi modal
        function openEditDonasiModal(id) {
            const data = donasiData.find(item => item.id === id);
            if (data) {
                document.getElementById('editIdDonasi').value = data.id;
                document.getElementById('editNamaDonasi').value = data.nama_donasi;
                document.getElementById('editDeskripsiDonasi').value = data.deskripsi_donasi;
                
                modalEditDonasi.classList.remove('hidden');
            }
        }

        // Function to open delete confirmation modal
        function openDeleteConfirmation(id) {
            deleteId = id;
            modalKonfirmasiHapus.classList.remove('hidden');
        }

        // Format currency
        function formatCurrency(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value);
        }

        // Format date and time
        function formatDateTime(dateTimeString) {
            const date = new Date(dateTimeString);
            
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            
            return `${day}-${month}-${year} ${hours}:${minutes}`;
        }

        // Show alert message
        function showAlert(message) {
            alertSuccessMessage.textContent = message;
            alertSuccess.classList.remove('hidden');
            
            setTimeout(() => {
                alertSuccess.classList.add('hidden');
            }, 3000);
        }

        // EVENT LISTENERS FOR DONASI TAB

        // Tambah Donasi button
        document.getElementById('btnTambahDonasi').addEventListener('click', function() {
            modalTambahDonasi.classList.remove('hidden');
        });

        // Close detail donasi modal
        document.getElementById('btnCloseDetailDonasi').addEventListener('click', function() {
            modalDetailDonasi.classList.add('hidden');
        });

        // Close edit donasi modal
        document.getElementById('btnBatalkanEditDonasi').addEventListener('click', function() {
            modalEditDonasi.classList.add('hidden');
        });

        // Close tambah donasi modal
        document.getElementById('btnBatalkanTambahDonasi').addEventListener('click', function() {
            modalTambahDonasi.classList.add('hidden');
            document.getElementById('formTambahDonasi').reset();
        });

        // Close delete confirmation modal
        document.getElementById('btnBatalkanHapus').addEventListener('click', function() {
            modalKonfirmasiHapus.classList.add('hidden');
            deleteId = null;
        });

        // Close alert
        document.getElementById('btnCloseAlert').addEventListener('click', function() {
            alertSuccess.classList.add('hidden');
        });

        // Form tambah donasi submit
        document.getElementById('formTambahDonasi').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nextId = donasiData.length > 0 ? Math.max(...donasiData.map(item => item.id)) + 1 : 1;
            const formElements = this.elements;
            
            const nama_donasi = formElements.nama_donasi.value;
            const deskripsi_donasi = formElements.deskripsi_donasi.value;
            // Generate random total donasi (in a real app would be calculated)
            const total_donasi = Math.floor(Math.random() * 500000) + 100000;
            
            // Handle file input
            const fotoFile = formElements.foto.files[0];
            const fotoUrl = fotoFile ? "/api/placeholder/400/320" : "";
            
            const newDonasi = {
                id: nextId,
                id_donasi: `DON${String(nextId).padStart(3, '0')}`,
                nama_donasi: nama_donasi,
                deskripsi_donasi: deskripsi_donasi,
                total_donasi: total_donasi,
                fotoUrl: fotoUrl
            };
            
            donasiData.push(newDonasi);
            renderTableDonasi();
            
            modalTambahDonasi.classList.add('hidden');
            this.reset();
            
            showAlert('Data donasi berhasil ditambahkan');
        });

        // Form edit donasi submit
        document.getElementById('formEditDonasi').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = parseInt(document.getElementById('editIdDonasi').value);
            const index = donasiData.findIndex(item => item.id === id);
            
            if (index !== -1) {
                const nama_donasi = document.getElementById('editNamaDonasi').value;
                const deskripsi_donasi = document.getElementById('editDeskripsiDonasi').value;
                
                // Handle file input
                const fotoFile = document.getElementById('editFotoDonasi').files[0];
                const fotoUrl = fotoFile ? "/api/placeholder/400/320" : donasiData[index].fotoUrl;
                
                donasiData[index] = {
                    ...donasiData[index],
                    nama_donasi: nama_donasi,
                    deskripsi_donasi: deskripsi_donasi,
                    fotoUrl: fotoUrl
                };
                
                renderTableDonasi();
                modalEditDonasi.classList.add('hidden');
                
                showAlert('Data donasi berhasil diperbarui');
            }
        });

        // Confirm delete donasi
        document.getElementById('btnKonfirmasiHapus').addEventListener('click', function() {
            if (deleteId !== null) {
                const index = donasiData.findIndex(item => item.id === deleteId);
                
                if (index !== -1) {
                    donasiData.splice(index, 1);
                    renderTableDonasi();
                    modalKonfirmasiHapus.classList.add('hidden');
                    deleteId = null;
                    
                    showAlert('Data donasi berhasil dihapus');
                }
            }
        });

        // EVENT LISTENERS FOR RIWAYAT TAB

        // Close detail riwayat modal
        document.getElementById('btnCloseDetailRiwayat').addEventListener('click', function() {
            modalDetailRiwayat.classList.add('hidden');
        });

        // Filter button for riwayat
        document.getElementById('btnFilter').addEventListener('click', function() {
            currentPageRiwayat = 1;
            renderTableRiwayat();
        });

        // PAGINATION EVENT LISTENERS FOR DONASI TAB
        // Previous page donasi
        document.getElementById('btnPrevDonasi').addEventListener('click', function() {
            if (currentPageDonasi > 1) {
                currentPageDonasi--;
                renderTableDonasi();
            }
        });

        // Next page donasi
        document.getElementById('btnNextDonasi').addEventListener('click', function() {
            const searchQuery = document.getElementById('searchDonasi').value;
            const filteredData = searchDonasi(searchQuery);
            const maxPage = Math.ceil(filteredData.length / rowsPerPage);
            
            if (currentPageDonasi < maxPage) {
                currentPageDonasi++;
                renderTableDonasi();
            }
        });

        // Page number clicks donasi
        for (let i = 1; i <= 5; i++) {
            document.getElementById(`pageDonasi${i}`).addEventListener('click', function() {
                currentPageDonasi = i;
                renderTableDonasi();
            });
        }

        // PAGINATION EVENT LISTENERS FOR RIWAYAT TAB

        // Previous page riwayat
        document.getElementById('btnPrevRiwayat').addEventListener('click', function() {
            if (currentPageRiwayat > 1) {
                currentPageRiwayat--;
                renderTableRiwayat();
            }
        });

        // Next page riwayat
        document.getElementById('btnNextRiwayat').addEventListener('click', function() {
            const searchQuery = document.getElementById('searchRiwayat').value;
            const startDate = document.getElementById('filterTanggalMulai').value;
            const endDate = document.getElementById('filterTanggalSelesai').value;
            const filteredData = searchRiwayat(searchQuery, startDate, endDate);
            const maxPage = Math.ceil(filteredData.length / rowsPerPage);
            
            if (currentPageRiwayat < maxPage) {
                currentPageRiwayat++;
                renderTableRiwayat();
            }
        });

        // Page number clicks riwayat
        for (let i = 1; i <= 5; i++) {
            document.getElementById(`pageRiwayat${i}`).addEventListener('click', function() {
                currentPageRiwayat = i;
                renderTableRiwayat();
            });
        }

        // SEARCH EVENT LISTENERS

        // Search donasi input
        document.getElementById('searchDonasi').addEventListener('input', function() {
            currentPageDonasi = 1;
            renderTableDonasi();
        });

        // Search riwayat input
        document.getElementById('searchRiwayat').addEventListener('input', function() {
            currentPageRiwayat = 1;
            renderTableRiwayat();
        });

        // Initial render for donasi table
        renderTableDonasi();

        // Initialize date inputs with current date range
        function initializeDateFilters() {
            const today = new Date();
            const lastMonth = new Date();
            lastMonth.setMonth(today.getMonth() - 1);
            
            const formatDate = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };
            
            document.getElementById('filterTanggalMulai').value = formatDate(lastMonth);
            document.getElementById('filterTanggalSelesai').value = formatDate(today);
        }

        // Call initialization functions
        initializeDateFilters();

        // Export functionality (if needed)
        document.getElementById('btnExportDonasi')?.addEventListener('click', function() {
            // Export functionality for donasi data would be implemented here
            alert('Export functionality will be implemented here');
        });

        document.getElementById('btnExportRiwayat')?.addEventListener('click', function() {
            // Export functionality for riwayat data would be implemented here
            alert('Export functionality will be implemented here');
        });

        // File preview for upload (for both add and edit forms)
        function setupFilePreview(inputId, previewId) {
            const fileInput = document.getElementById(inputId);
            const previewElement = document.getElementById(previewId);
            
            if (fileInput && previewElement) {
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewElement.src = e.target.result;
                            previewElement.classList.remove('hidden');
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }
        }

        // Setup file preview for add form if elements exist
        setupFilePreview('foto', 'previewFoto');
        setupFilePreview('editFotoDonasi', 'previewEditFoto');

        // Handle date range validation
        function validateDateRange() {
            const startDate = document.getElementById('filterTanggalMulai');
            const endDate = document.getElementById('filterTanggalSelesai');
            
            if (startDate && endDate) {
                endDate.addEventListener('change', function() {
                    if (startDate.value && this.value && new Date(this.value) < new Date(startDate.value)) {
                        alert('Tanggal akhir tidak boleh lebih awal dari tanggal mulai');
                        this.value = startDate.value;
                    }
                });
                
                startDate.addEventListener('change', function() {
                    if (endDate.value && this.value && new Date(this.value) > new Date(endDate.value)) {
                        endDate.value = this.value;
                    }
                });
            }
        }

        validateDateRange();

        // Function to export table data to CSV
        function exportTableToCSV(tableId, filename) {
            const table = document.getElementById(tableId);
            if (!table) return;
            
            let csvContent = "data:text/csv;charset=utf-8,";
            
            // Get headers
            const headers = Array.from(table.querySelectorAll('thead th'))
                .map(th => th.textContent.trim())
                .join(',');
            csvContent += headers + '\r\n';
            
            // Get rows
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const rowData = Array.from(row.querySelectorAll('td'))
                    .map(cell => {
                        // Skip the action column
                        if (cell.querySelector('button')) return '';
                        return '"' + cell.textContent.trim().replace(/"/g, '""') + '"';
                    })
                    .filter(text => text !== '') // Remove empty cells (action buttons)
                    .join(',');
                csvContent += rowData + '\r\n';
            });
            
            // Create download link
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", filename);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Add export buttons functionality if they exist
        const exportDonasiBtn = document.getElementById('btnExportDonasi');
        if (exportDonasiBtn) {
            exportDonasiBtn.addEventListener('click', function() {
                exportTableToCSV('tableDonasi', 'data_donasi.csv');
            });
        }

        const exportRiwayatBtn = document.getElementById('btnExportRiwayat');
        if (exportRiwayatBtn) {
            exportRiwayatBtn.addEventListener('click', function() {
                exportTableToCSV('tableRiwayat', 'riwayat_penukaran.csv');
            });
        }

        // Responsive behavior for modals
        function setupResponsiveModals() {
            const modals = [
                modalTambahDonasi,
                modalEditDonasi,
                modalKonfirmasiHapus,
                modalDetailDonasi,
                modalDetailRiwayat
            ];
            
            // Adjust modal position on window resize
            window.addEventListener('resize', function() {
                modals.forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        const modalContent = modal.querySelector('div > div:nth-child(2)');
                        if (modalContent) {
                            if (window.innerHeight < modalContent.offsetHeight) {
                                modalContent.style.height = '90vh';
                                modalContent.style.overflowY = 'auto';
                            } else {
                                modalContent.style.height = '';
                                modalContent.style.overflowY = '';
                            }
                        }
                    }
                });
            });
            
            // Close modals when clicking outside
            modals.forEach(modal => {
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal || e.target === modal.querySelector('div:first-child')) {
                            modal.classList.add('hidden');
                            if (modal === modalKonfirmasiHapus) {
                                deleteId = null;
                            }
                        }
                    });
                }
            });
        }

        setupResponsiveModals();

        // Add keyboard events for accessibility
        document.addEventListener('keydown', function(e) {
            // Close modal with Escape key
            if (e.key === 'Escape') {
                const visibleModals = [
                    modalTambahDonasi,
                    modalEditDonasi,
                    modalKonfirmasiHapus,
                    modalDetailDonasi,
                    modalDetailRiwayat
                ].filter(modal => !modal.classList.contains('hidden'));
                
                if (visibleModals.length > 0) {
                    visibleModals[0].classList.add('hidden');
                    if (visibleModals[0] === modalKonfirmasiHapus) {
                        deleteId = null;
                    }
                }
            }
        });

        // Load data when switching to riwayat tab
        tabRiwayat.addEventListener('click', function() {
            if (activeTab !== 'tabRiwayat') {
                currentPageRiwayat = 1;
            }
        });

        // Add form validation
        function validateForm(formId) {
            const form = document.getElementById(formId);
            if (!form) return true;
            
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('border-red-500');
                    isValid = false;
                    
                    // Add error message if not already present
                    let errorMsg = field.nextElementSibling;
                    if (!errorMsg || !errorMsg.classList.contains('error-message')) {
                        errorMsg = document.createElement('p');
                        errorMsg.classList.add('error-message', 'text-red-500', 'text-xs', 'mt-1');
                        errorMsg.textContent = 'Field ini harus diisi';
                        field.parentNode.insertBefore(errorMsg, field.nextSibling);
                    }
                    
                    // Remove error styling on input
                    field.addEventListener('input', function() {
                        if (this.value.trim()) {
                            this.classList.remove('border-red-500');
                            const errorMsg = this.nextElementSibling;
                            if (errorMsg && errorMsg.classList.contains('error-message')) {
                                errorMsg.remove();
                            }
                        }
                    });
                }
            });
            
            return isValid;
        }

        // Update form submit events with validation
        document.getElementById('formTambahDonasi').addEventListener('submit', function(e) {
            if (!validateForm('formTambahDonasi')) {
                e.preventDefault();
                return false;
            }
            
            // Original form submit code remains...
        });

        document.getElementById('formEditDonasi').addEventListener('submit', function(e) {
            if (!validateForm('formEditDonasi')) {
                e.preventDefault();
                return false;
            }
            
            // Original form submit code remains...
        });
    </script>
    </body>
</html>


