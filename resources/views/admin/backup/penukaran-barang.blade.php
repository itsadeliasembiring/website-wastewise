<!DOCTYPE html>
<html lang="en" class="h-full bg-[#E6E6E6] dark:bg-[#E6E6E6]">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Penukaran Barang Eco-Friendly</title>
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
                <button id="tabBarang" class="px-6 py-3 font-medium text-[#3D8D7A] border-b-2 border-[#3D8D7A]">Data Barang Eco-Friendly</button>
                <button id="tabRiwayat" class="px-6 py-3 font-medium text-gray-500 hover:text-[#3D8D7A]">Riwayat Penukaran</button>
            </div>

            <!-- Barang Tab Content -->
            <div id="contentBarang" class="block">
                <div class="flex justify-between items-center mb-3">
                    <h1 class="text-2xl font-semibold text-[#3D8D7A]">Kelola Data Barang Eco-Friendly</h1>
                    <div class="flex space-x-4">
                        <div class="relative">
                            <input type="text" id="searchBarang" placeholder="Search" class="text-black w-64 pl-10 pr-4 py-2 rounded-lg border bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                            <span class="absolute left-3 top-2.5 text-black">
                                <x-fas-search class="w-5 h-5 text-[#3D8D7A]" />
                            </span>
                        </div>
                        <button id="btnTambahBarang" class="bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white px-4 py-2 rounded-lg flex items-center">
                            <x-fas-plus class="w-5 h-5 text-[#fff] mr-2"/> Tambah
                        </button>
                    </div>
                </div>

                <!-- Table Barang -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-[#3D8D7A] text-white">
                                <th class="py-3 px-4 text-center">No</th>
                                <th class="py-3 px-4 text-center">ID Barang</th>
                                <th class="py-3 px-4 text-center">Nama Barang</th>
                                <th class="py-3 px-4 text-center">Bobot Poin</th>
                                <th class="py-3 px-4 text-center">Stok</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBodyBarang">
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Barang -->
                <div class="flex justify-end mt-4 space-x-2 mb-5">
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnPrevBarang">Prev</button>
                    <button class="px-3 py-1 rounded bg-[#3D8D7A] text-white" id="pageBarang1">1</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageBarang2">2</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageBarang3">3</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageBarang4">4</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageBarang5">5</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnNextBarang">Next</button>
                </div>
            </div>

            <!-- Riwayat Penukaran Tab Content -->
            <div id="contentRiwayat" class="hidden">
                <div class="flex justify-between items-center mb-3">
                    <h1 class="text-2xl font-semibold text-[#3D8D7A]">Riwayat Penukaran Barang</h1>
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
                                <th class="py-3 px-4 text-center">ID Barang</th>
                                <th class="py-3 px-4 text-center">ID Pengguna</th>
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

    <!-- Modal Form Tambah Barang -->
    <div id="modalTambahBarang" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full px-6 py-10 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Form Tambah Barang Eco-Friendly</h2>
                
                <form id="formTambahBarang">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Barang <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Bobot Poin <span class="text-red-500">*</span></label>
                        <input type="number" name="bobot_poin" placeholder="Masukkan Bobot Poin" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Stok <span class="text-red-500">*</span></label>
                        <input type="number" name="stok" placeholder="Masukkan Jumlah Stok" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Deskripsi Barang <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi_barang" rows="4" placeholder="Masukkan Deskripsi Barang" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto<span class="text-red-500">*</span></label>
                        <input type="file" name="foto" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanTambahBarang" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                        <button type="submit" class="w-1/2 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Form Edit Barang -->
    <div id="modalEditBarang" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Edit Barang Eco-Friendly</h2>
                <form id="formEditBarang">
                    <input type="hidden" id="editIdBarang">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Barang <span class="text-red-500">*</span></label>
                        <input type="text" id="editNamaBarang" placeholder="Masukkan Nama Barang" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Bobot Poin <span class="text-red-500">*</span></label>
                        <input type="number" id="editBobotPoin" placeholder="Masukkan Bobot Poin" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Stok <span class="text-red-500">*</span></label>
                        <input type="number" id="editStok" placeholder="Masukkan Jumlah Stok" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Deskripsi Barang <span class="text-red-500">*</span></label>
                        <textarea id="editDeskripsiBarang" rows="4" placeholder="Masukkan Deskripsi Barang" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto</label>
                        <input type="file" id="editFotoBarang" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto</p>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanEditBarang" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
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
    
    <!-- Modal Detail Barang -->
    <div id="modalDetailBarang" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Barang Eco-Friendly</h2>
                    <button id="btnCloseDetailBarang" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Utama -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">ID Barang</p>
                            <p id="detailIdBarang" class="text-black">BRG001</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Nama Barang</p>
                            <p id="detailNamaBarang" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Bobot Poin</p>
                            <p id="detailBobotPoin" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Stok</p>
                            <p id="detailStok" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Deskripsi Barang</p>
                            <p id="detailDeskripsiBarang" class="text-black">-</p>
                        </div>
                    </div>
                    
                    <!-- Foto Barang -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Foto Barang</p>
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img id="detailFotoBarang" src="/api/placeholder/400/320" alt="Foto Barang" class="max-h-full max-w-full rounded-lg object-cover text-black">
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
                            <p class="text-sm text-gray-500">ID Barang</p>
                            <p id="detailRiwayatIdBarang" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">ID Pengguna</p>
                            <p id="detailRiwayatIdPengguna" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Nama Pengguna</p>
                            <p id="detailRiwayatNamaPengguna" class="text-black">-</p>
                        </div>
                    </div>
                    
                    <!-- Foto Barang -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Foto Barang</p>
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img id="detailRiwayatFotoBarang" src="/api/placeholder/400/320" alt="Foto Barang" class="max-h-full max-w-full rounded-lg object-cover text-black">
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
    </body>

    <script>
        // Barang data structure
        const barangData = [
            { 
                id: 1, 
                id_barang: "BRG001", 
                nama_barang: "Tumbler Eco-Friendly",
                deskripsi_barang: "Tumbler ramah lingkungan terbuat dari bahan daur ulang",
                bobot_poin: 250,
                stok: 50,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 2, 
                id_barang: "BRG002", 
                nama_barang: "Tas Belanja Lipat",
                deskripsi_barang: "Tas belanja yang dapat dilipat untuk mengurangi penggunaan kantong plastik",
                bobot_poin: 150,
                stok: 75,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 3, 
                id_barang: "BRG003", 
                nama_barang: "Sedotan Stainless",
                deskripsi_barang: "Sedotan stainless steel yang dapat digunakan berulang kali",
                bobot_poin: 100,
                stok: 120,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 4, 
                id_barang: "BRG004", 
                nama_barang: "Cutlery Set Bambu",
                deskripsi_barang: "Set alat makan dari bambu yang ramah lingkungan",
                bobot_poin: 200,
                stok: 35,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 5, 
                id_barang: "BRG005", 
                nama_barang: "Kotak Makan Fiber",
                deskripsi_barang: "Kotak makan terbuat dari serat tanaman yang mudah terurai",
                bobot_poin: 180,
                stok: 60,
                fotoUrl: "/api/placeholder/400/320"
            }
        ];

        // Riwayat Penukaran data structure
        const riwayatPenukaranData = [
            {
                id: 1,
                id_penukaran: "PEN001",
                waktu: "2023-03-15 08:30:00",
                jumlah_poin: 250,
                id_barang: "BRG001",
                id_pengguna: "USR003",
                nama_pengguna: "Andi Pratama",
                fotoUrl: "/api/placeholder/400/320"
            },
            {
                id: 2,
                id_penukaran: "PEN002",
                waktu: "2023-03-18 14:15:00",
                jumlah_poin: 150,
                id_barang: "BRG002",
                id_pengguna: "USR001",
                nama_pengguna: "Budi Santoso",
                fotoUrl: "/api/placeholder/400/320"
            },
            {
                id: 3,
                id_penukaran: "PEN003",
                waktu: "2023-04-02 09:45:00",
                jumlah_poin: 100,
                id_barang: "BRG003",
                id_pengguna: "USR002",
                nama_pengguna: "Siti Rahma",
                fotoUrl: "/api/placeholder/400/320"
            },
            {
                id: 4,
                id_penukaran: "PEN004",
                waktu: "2023-04-15 11:20:00",
                jumlah_poin: 200,
                id_barang: "BRG004",
                id_pengguna: "USR004",
                nama_pengguna: "Dewi Anggraini",
                fotoUrl: "/api/placeholder/400/320"
            },
            {
                id: 5,
                id_penukaran: "PEN005",
                waktu: "2023-04-28 16:05:00",
                jumlah_poin: 180,
                id_barang: "BRG005",
                id_pengguna: "USR005",
                nama_pengguna: "Rudi Hermawan",
                fotoUrl: "/api/placeholder/400/320"
            }
        ];

        // Global variables
        let currentPageBarang = 1;
        let currentPageRiwayat = 1;
        const rowsPerPage = 5;
        let deleteId = null;
        let activeTab = 'tabBarang';

        // DOM Elements - Barang Tab
        const tableBodyBarang = document.getElementById('tableBodyBarang');
        const tabBarang = document.getElementById('tabBarang');
        const tabRiwayat = document.getElementById('tabRiwayat');
        const contentBarang = document.getElementById('contentBarang');
        const contentRiwayat = document.getElementById('contentRiwayat');
        const modalTambahBarang = document.getElementById('modalTambahBarang');
        const modalEditBarang = document.getElementById('modalEditBarang');
        const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');
        const modalDetailBarang = document.getElementById('modalDetailBarang');
        const alertSuccess = document.getElementById('alertSuccess');
        const alertSuccessMessage = document.getElementById('alertSuccessMessage');

        // DOM Elements - Riwayat Tab
        const tableBodyRiwayat = document.getElementById('tableBodyRiwayat');
        const modalDetailRiwayat = document.getElementById('modalDetailRiwayat');

        // Tab switching functionality
        tabBarang.addEventListener('click', function() {
            contentBarang.classList.remove('hidden');
            contentBarang.classList.add('block');
            contentRiwayat.classList.add('hidden');
            contentRiwayat.classList.remove('block');
            
            tabBarang.classList.add('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
            tabBarang.classList.remove('text-gray-500');
            
            tabRiwayat.classList.remove('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
            tabRiwayat.classList.add('text-gray-500');
            
            activeTab = 'tabBarang';
        });

        tabRiwayat.addEventListener('click', function() {
            contentRiwayat.classList.remove('hidden');
            contentRiwayat.classList.add('block');
            contentBarang.classList.add('hidden');
            contentBarang.classList.remove('block');
            
            tabRiwayat.classList.add('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
            tabRiwayat.classList.remove('text-gray-500');
            
            tabBarang.classList.remove('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
            tabBarang.classList.add('text-gray-500');
            
            activeTab = 'tabRiwayat';
            renderTableRiwayat();
        });

        // Search functionality for Barang tab
        function searchBarang(query) {
            if (!query) {
                return barangData;
            }
            
            query = query.toLowerCase();
            return barangData.filter(item => 
                item.id_barang.toLowerCase().includes(query) || 
                item.nama_barang.toLowerCase().includes(query) || 
                item.deskripsi_barang.toLowerCase().includes(query) || 
                item.bobot_poin.toString().includes(query) || 
                item.stok.toString().includes(query)
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
                    item.id_barang.toLowerCase().includes(query) || 
                    item.id_pengguna.toLowerCase().includes(query) || 
                    item.nama_pengguna.toLowerCase().includes(query) ||
                    item.jumlah_poin.toString().includes(query)
                );
            }
            
            return filteredData;
        }

        // Render Barang table
        function renderTableBarang() {
            tableBodyBarang.innerHTML = '';
            
            const searchQuery = document.getElementById('searchBarang').value;
            const filteredData = searchBarang(searchQuery);
            
            // Check if there's data to display
            if (filteredData.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="6" class="py-8 px-4 border-b border-gray-200 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-medium">Data tidak tersedia</p>
                            <p class="text-sm">Tidak ada data barang yang sesuai dengan pencarian Anda</p>
                        </div>
                    </td>
                `;
                tableBodyBarang.appendChild(emptyRow);
                return;
            }
            
            const start = (currentPageBarang - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = filteredData.slice(start, end);
            
            paginatedData.forEach((item, index) => {
                const row = document.createElement('tr');
                row.className = index % 2 === 0 ? '' : 'bg-gray-50';
                row.innerHTML = `
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${start + index + 1}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.id_barang}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.nama_barang}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.bobot_poin}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.stok}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">
                        <div class="flex justify-center space-x-2">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 btnDetailBarang" data-id="${item.id}">Detail</button>
                            <button class="bg-[#3D8D7A] text-white px-3 py-1 rounded-md hover:bg-[#2C6A5C] btnEditBarang" data-id="${item.id}">Edit</button>
                            <button class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 btnHapusBarang" data-id="${item.id}">Hapus</button>
                        </div>
                    </td>
                `;
                tableBodyBarang.appendChild(row);
            });

            // Add event listeners for buttons
            document.querySelectorAll('.btnDetailBarang').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openDetailBarangModal(id);
                });
            });

            document.querySelectorAll('.btnEditBarang').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openEditBarangModal(id);
                });
            });

            document.querySelectorAll('.btnHapusBarang').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openDeleteConfirmation(id);
                });
            });
            
            // Update pagination for filtered results
            updatePaginationBarang(filteredData.length);
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
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.id_barang}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.id_pengguna}</td>
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

        // Update pagination for Barang tab
        function updatePaginationBarang(totalItems) {
            const maxPage = Math.ceil(totalItems / rowsPerPage);
            
            // Adjust current page if it's beyond max page
            if (currentPageBarang > maxPage && maxPage > 0) {
                currentPageBarang = maxPage;
            }
            
            // Update pagination buttons visibility
            for (let i = 1; i <= 5; i++) {
                const pageBtn = document.getElementById(`pageBarang${i}`);
                if (i <= maxPage) {
                    pageBtn.style.display = '';
                } else {
                    pageBtn.style.display = 'none';
                }
            }
            
            updateActivePaginationBarang();
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

        // Update active pagination button for Barang tab
        function updateActivePaginationBarang() {
            for (let i = 1; i <= 5; i++) {
                const pageBtn = document.getElementById(`pageBarang${i}`);
                
                if (i === currentPageBarang) {
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

        // Function to open detail barang modal
        function openDetailBarangModal(id) {
            const data = barangData.find(item => item.id === id);
            if (data) {
                document.getElementById('detailIdBarang').textContent = data.id_barang;
                document.getElementById('detailNamaBarang').textContent = data.nama_barang;
                document.getElementById('detailBobotPoin').textContent = data.bobot_poin;
                document.getElementById('detailStok').textContent = data.stok;
                document.getElementById('detailDeskripsiBarang').textContent = data.deskripsi_barang;
                document.getElementById('detailFotoBarang').src = data.fotoUrl || '/api/placeholder/400/320';
                
                modalDetailBarang.classList.remove('hidden');
            }
        }

        // Function to open detail riwayat modal
        function openDetailRiwayatModal(id) {
            const data = riwayatPenukaranData.find(item => item.id === id);
            if (data) {
                document.getElementById('detailIdPenukaran').textContent = data.id_penukaran;
                document.getElementById('detailWaktuPenukaran').textContent = formatDateTime(data.waktu);
                document.getElementById('detailJumlahPoin').textContent = data.jumlah_poin;
                document.getElementById('detailRiwayatIdBarang').textContent = data.id_barang;
                document.getElementById('detailRiwayatIdPengguna').textContent = data.id_pengguna;
                document.getElementById('detailRiwayatNamaPengguna').textContent = data.nama_pengguna;
                document.getElementById('detailRiwayatFotoBarang').src = data.fotoUrl || '/api/placeholder/400/320';
                
                modalDetailRiwayat.classList.remove('hidden');
            }
        }

        // Function to open edit barang modal
        function openEditBarangModal(id) {
            const data = barangData.find(item => item.id === id);
            if (data) {
                document.getElementById('editIdBarang').value = data.id;
                document.getElementById('editNamaBarang').value = data.nama_barang;
                document.getElementById('editBobotPoin').value = data.bobot_poin;
                document.getElementById('editStok').value = data.stok;
                document.getElementById('editDeskripsiBarang').value = data.deskripsi_barang;
                
                modalEditBarang.classList.remove('hidden');
            }
        }

        // Function to open delete confirmation modal
        function openDeleteConfirmation(id) {
            deleteId = id;
            modalKonfirmasiHapus.classList.remove('hidden');
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

        // EVENT LISTENERS FOR BARANG TAB

        // Tambah Barang button
        document.getElementById('btnTambahBarang').addEventListener('click', function() {
            modalTambahBarang.classList.remove('hidden');
        });

        // Close detail barang modal
        document.getElementById('btnCloseDetailBarang').addEventListener('click', function() {
            modalDetailBarang.classList.add('hidden');
        });

        // Close edit barang modal
        document.getElementById('btnBatalkanEditBarang').addEventListener('click', function() {
            modalEditBarang.classList.add('hidden');
        });

        // Close tambah barang modal
        document.getElementById('btnBatalkanTambahBarang').addEventListener('click', function() {
            modalTambahBarang.classList.add('hidden');
            document.getElementById('formTambahBarang').reset();
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

        // Form tambah barang submit
        document.getElementById('formTambahBarang').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nextId = barangData.length > 0 ? Math.max(...barangData.map(item => item.id)) + 1 : 1;
            const formElements = this.elements;
            
            const nama_barang = formElements.nama_barang.value;
            const bobot_poin = parseInt(formElements.bobot_poin.value);
            const stok = parseInt(formElements.stok.value);
            const deskripsi_barang = formElements.deskripsi_barang.value;
            
            // Handle file input
            const fotoFile = formElements.foto.files[0];
            const fotoUrl = fotoFile ? "/api/placeholder/400/320" : "";
            
            const newBarang = {
                id: nextId,
                id_barang: `BRG${String(nextId).padStart(3, '0')}`,
                nama_barang: nama_barang,
                deskripsi_barang: deskripsi_barang,
                bobot_poin: bobot_poin,
                stok: stok,
                fotoUrl: fotoUrl
            };
            
            barangData.push(newBarang);
            renderTableBarang();
            
            modalTambahBarang.classList.add('hidden');
            this.reset();
            
            showAlert('Data barang berhasil ditambahkan');
        });

        // Form edit barang submit
        document.getElementById('formEditBarang').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = parseInt(document.getElementById('editIdBarang').value);
            const index = barangData.findIndex(item => item.id === id);
            
            if (index !== -1) {
                const nama_barang = document.getElementById('editNamaBarang').value;
                const bobot_poin = parseInt(document.getElementById('editBobotPoin').value);
                const stok = parseInt(document.getElementById('editStok').value);
                const deskripsi_barang = document.getElementById('editDeskripsiBarang').value;
                
                // Handle file input
                const fotoFile = document.getElementById('editFotoBarang').files[0];
                const fotoUrl = fotoFile ? "/api/placeholder/400/320" : barangData[index].fotoUrl;
                
                barangData[index] = {
                    ...barangData[index],
                    nama_barang: nama_barang,
                    deskripsi_barang: deskripsi_barang,
                    bobot_poin: bobot_poin,
                    stok: stok,
                    fotoUrl: fotoUrl
                };
                
                renderTableBarang();
                modalEditBarang.classList.add('hidden');
                
                showAlert('Data barang berhasil diperbarui');
            }
        });

        // Confirm delete barang
        document.getElementById('btnKonfirmasiHapus').addEventListener('click', function() {
            if (deleteId !== null) {
                const index = barangData.findIndex(item => item.id === deleteId);
                
                if (index !== -1) {
                    barangData.splice(index, 1);
                    renderTableBarang();
                    modalKonfirmasiHapus.classList.add('hidden');
                    deleteId = null;
                    
                    showAlert('Data barang berhasil dihapus');
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

        // PAGINATION EVENT LISTENERS FOR BARANG TAB
        document.getElementById('btnPrevBarang').addEventListener('click', function() {
            if (currentPageBarang > 1) {
                currentPageBarang--;
                renderTableBarang();
            }
        });

        document.getElementById('btnNextBarang').addEventListener('click', function() {
            const filteredData = searchBarang(document.getElementById('searchBarang').value);
            const maxPage = Math.ceil(filteredData.length / rowsPerPage);
            
            if (currentPageBarang < maxPage) {
                currentPageBarang++;
                renderTableBarang();
            }
        });

        // Add event listeners for each page button
        for (let i = 1; i <= 5; i++) {
            document.getElementById(`pageBarang${i}`).addEventListener('click', function() {
                currentPageBarang = i;
                renderTableBarang();
            });
        }

        // PAGINATION EVENT LISTENERS FOR RIWAYAT TAB
        document.getElementById('btnPrevRiwayat').addEventListener('click', function() {
            if (currentPageRiwayat > 1) {
                currentPageRiwayat--;
                renderTableRiwayat();
            }
        });

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

        // Add event listeners for each page button
        for (let i = 1; i <= 5; i++) {
            document.getElementById(`pageRiwayat${i}`).addEventListener('click', function() {
                currentPageRiwayat = i;
                renderTableRiwayat();
            });
        }

        // SEARCH EVENT LISTENERS
        document.getElementById('searchBarang').addEventListener('input', function() {
            currentPageBarang = 1;
            renderTableBarang();
        });

        document.getElementById('searchRiwayat').addEventListener('input', function() {
            currentPageRiwayat = 1;
            renderTableRiwayat();
        });

        // Initialize the application
        window.addEventListener('DOMContentLoaded', function() {
            // Set initial active tab
            activeTab = 'tabBarang';
            
            // Initial render
            renderTableBarang();
            
            // Set current date values for date filters
            const today = new Date();
            const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            
            const formattedToday = today.toISOString().split('T')[0];
            const formattedFirstDay = firstDayOfMonth.toISOString().split('T')[0];
            
            document.getElementById('filterTanggalMulai').value = formattedFirstDay;
            document.getElementById('filterTanggalSelesai').value = formattedToday;
        });

        // Function to handle escape key to close modals
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close any open modals
                modalTambahBarang.classList.add('hidden');
                modalEditBarang.classList.add('hidden');
                modalKonfirmasiHapus.classList.add('hidden');
                modalDetailBarang.classList.add('hidden');
                modalDetailRiwayat.classList.add('hidden');
            }
        });

        // Add click event listeners to close modals when clicking outside
        document.querySelectorAll('#modalTambahBarang, #modalEditBarang, #modalKonfirmasiHapus, #modalDetailBarang, #modalDetailRiwayat').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this.querySelector('div:first-child')) {
                    this.classList.add('hidden');
                    if (this.id === 'modalKonfirmasiHapus') {
                        deleteId = null;
                    }
                }
            });
        });

        // Add validation to form inputs
        function validateNumberInput(input) {
            const value = parseInt(input.value);
            if (value < 0) {
                input.value = 0;
            }
        }

        // Add validation to numeric inputs
        document.getElementById('editBobotPoin').addEventListener('input', function() {
            validateNumberInput(this);
        });

        document.getElementById('editStok').addEventListener('input', function() {
            validateNumberInput(this);
        });

        // Add similar validation for the add form
        document.querySelector('[name="bobot_poin"]').addEventListener('input', function() {
            validateNumberInput(this);
        });

        document.querySelector('[name="stok"]').addEventListener('input', function() {
            validateNumberInput(this);
        });

        // Export data functionality
        function exportDataToCSV(dataType) {
            let data;
            let headers;
            let fileName;
            
            if (dataType === 'barang') {
                data = barangData;
                headers = ['ID Barang', 'Nama Barang', 'Deskripsi', 'Bobot Poin', 'Stok'];
                fileName = 'data_barang_eco_friendly.csv';
                
                // Map data to array format
                data = data.map(item => [
                    item.id_barang,
                    item.nama_barang,
                    item.deskripsi_barang,
                    item.bobot_poin,
                    item.stok
                ]);
            } else {
                data = riwayatPenukaranData;
                headers = ['ID Penukaran', 'Waktu', 'Jumlah Poin', 'ID Barang', 'ID Pengguna', 'Nama Pengguna'];
                fileName = 'riwayat_penukaran_eco_friendly.csv';
                
                // Map data to array format
                data = data.map(item => [
                    item.id_penukaran,
                    item.waktu,
                    item.jumlah_poin,
                    item.id_barang,
                    item.id_pengguna,
                    item.nama_pengguna
                ]);
            }
            
            // Create CSV content
            let csvContent = headers.join(',') + '\n';
            
            data.forEach(row => {
                csvContent += row.map(cell => {
                    // Handle commas and quotes in data
                    if (cell === null || cell === undefined) {
                        return '';
                    }
                    cell = String(cell);
                    if (cell.includes(',')) {
                        return `"${cell.replace(/"/g, '""')}"`;
                    }
                    return cell;
                }).join(',') + '\n';
            });
            
            // Create download link
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', fileName);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Add export buttons functionality if needed
        // You can add these buttons to the HTML and connect them to the exportDataToCSV function

        // Image preview functionality for the add form
        document.querySelector('[name="foto"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    // In a real app, you would handle the uploaded image
                    // For this demo, we're just using placeholder images
                };
                reader.readAsDataURL(file);
            }
        });

        // Image preview functionality for the edit form
        document.getElementById('editFotoBarang').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    // In a real app, you would handle the uploaded image
                    // For this demo, we're just using placeholder images
                };
                reader.readAsDataURL(file);
            }
        });

        // Initialize the application
        renderTableBarang();

    </script>
</html>