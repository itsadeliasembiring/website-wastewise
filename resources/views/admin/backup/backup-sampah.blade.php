<!DOCTYPE html>
<html lang="en" class="h-full bg-[#E6E6E6] dark:bg-[#E6E6E6]">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Kelola Sampah</title>
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
                <button id="tabSampah" class="px-6 py-3 font-medium text-[#3D8D7A] border-b-2 border-[#3D8D7A]">Data Sampah</button>
                <button id="tabJenisSampah" class="px-6 py-3 font-medium text-gray-500 hover:text-[#3D8D7A]">Jenis Sampah</button>
            </div>

            <!-- Sampah Tab Content -->
            <div id="contentSampah" class="block">
                <div class="flex justify-between items-center mb-3">
                    <h1 class="text-2xl font-semibold text-[#3D8D7A]">Kelola Data Sampah</h1>
                    <div class="flex space-x-4">
                        <div class="relative">
                            <input type="text" id="searchSampah" placeholder="Search" class="text-black w-64 pl-10 pr-4 py-2 rounded-lg border bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                            <span class="absolute left-3 top-2.5 text-black">
                                <x-fas-search class="w-5 h-5 text-[#3D8D7A]" />
                            </span>
                        </div>
                        <button id="btnTambahSampah" class="bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white px-4 py-2 rounded-lg flex items-center">
                            <x-fas-plus class="w-5 h-5 text-[#fff] mr-2"/> Tambah
                        </button>
                    </div>
                </div>

                <!-- Table Sampah -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-[#3D8D7A] text-white">
                                <th class="py-3 px-4 text-center">No</th>
                                <th class="py-3 px-4 text-center">ID Sampah</th>
                                <th class="py-3 px-4 text-center">Nama Sampah</th>
                                <th class="py-3 px-4 text-center">Bobot Poin</th>
                                <th class="py-3 px-4 text-center">Jenis Sampah</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBodySampah">
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Sampah -->
                <div class="flex justify-end mt-4 space-x-2 mb-5">
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnPrevSampah">Prev</button>
                    <button class="px-3 py-1 rounded bg-[#3D8D7A] text-white" id="pageSampah1">1</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageSampah2">2</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageSampah3">3</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageSampah4">4</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageSampah5">5</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnNextSampah">Next</button>
                </div>
            </div>

            <!-- Jenis Sampah Tab Content -->
            <div id="contentJenisSampah" class="hidden">
                <div class="flex justify-between items-center mb-3">
                    <h1 class="text-2xl font-semibold text-[#3D8D7A]">Kelola Jenis Sampah</h1>
                    <div class="flex space-x-4">
                        <div class="relative">
                            <input type="text" id="searchJenisSampah" placeholder="Search" class="text-black w-64 pl-10 pr-4 py-2 rounded-lg border bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                            <span class="absolute left-3 top-2.5 text-black">
                                <x-fas-search class="w-5 h-5 text-[#3D8D7A]" />
                            </span>
                        </div>
                        <button id="btnTambahJenisSampah" class="bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white px-4 py-2 rounded-lg flex items-center">
                            <x-fas-plus class="w-5 h-5 text-[#fff] mr-2"/> Tambah
                        </button>
                    </div>
                </div>

                <!-- Table Jenis Sampah -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-[#3D8D7A] text-white">
                                <th class="py-3 px-4 text-center">No</th>
                                <th class="py-3 px-4 text-center">ID Jenis Sampah</th>
                                <th class="py-3 px-4 text-center">Nama Jenis Sampah</th>
                                <th class="py-3 px-4 text-center">Warna Tempat Sampah</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBodyJenisSampah">
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Jenis Sampah -->
                <div class="flex justify-end mt-4 space-x-2 mb-5">
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnPrevJenisSampah">Prev</button>
                    <button class="px-3 py-1 rounded bg-[#3D8D7A] text-white" id="pageJenisSampah1">1</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageJenisSampah2">2</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageJenisSampah3">3</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageJenisSampah4">4</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="pageJenisSampah5">5</button>
                    <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnNextJenisSampah">Next</button>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Form Tambah Sampah -->
    <div id="modalTambahSampah" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full px-6 py-10 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Form Tambah Sampah</h2>
                
                <form id="formTambahSampah">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Sampah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_sampah" placeholder="Masukkan Nama Sampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Jenis Sampah <span class="text-red-500">*</span></label>
                        <select name="id_jenis_sampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Jenis Sampah</option>
                            <!-- Options will be loaded dynamically -->
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Detail Ciri <span class="text-red-500">*</span></label>
                        <textarea name="detail_ciri" rows="3" placeholder="Masukkan Detail Ciri Sampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Detail Manfaat <span class="text-red-500">*</span></label>
                        <textarea name="detail_manfaat" rows="3" placeholder="Masukkan Detail Manfaat Sampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Bobot Poin <span class="text-red-500">*</span></label>
                        <input type="number" name="bobot_poin" placeholder="Masukkan Bobot Poin" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto<span class="text-red-500">*</span></label>
                        <input type="file" name="foto" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanTambahSampah" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                        <button type="submit" class="w-1/2 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Form Edit Sampah -->
    <div id="modalEditSampah" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Edit Sampah</h2>
                <form id="formEditSampah">
                    <input type="hidden" id="editIdSampah">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Sampah <span class="text-red-500">*</span></label>
                        <input type="text" id="editNamaSampah" placeholder="Masukkan Nama Sampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Jenis Sampah <span class="text-red-500">*</span></label>
                        <select id="editJenisSampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Jenis Sampah</option>
                            <!-- Options will be loaded dynamically -->
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Detail Ciri <span class="text-red-500">*</span></label>
                        <textarea id="editDetailCiri" rows="3" placeholder="Masukkan Detail Ciri Sampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Detail Manfaat <span class="text-red-500">*</span></label>
                        <textarea id="editDetailManfaat" rows="3" placeholder="Masukkan Detail Manfaat Sampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Bobot Poin <span class="text-red-500">*</span></label>
                        <input type="number" id="editBobotPoin" placeholder="Masukkan Bobot Poin" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto</label>
                        <input type="file" id="editFotoSampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto</p>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanEditSampah" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                        <button type="submit" class="w-1/2 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah Jenis Sampah -->
    <div id="modalTambahJenisSampah" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full px-6 py-10 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Form Tambah Jenis Sampah</h2>
                
                <form id="formTambahJenisSampah">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Jenis Sampah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_jenis_sampah" placeholder="Masukkan Nama Jenis Sampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Warna Tempat Sampah <span class="text-red-500">*</span></label>
                        <input type="color" name="warna_tempat_sampah" class="w-full h-12 px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanTambahJenisSampah" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                        <button type="submit" class="w-1/2 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Form Edit Jenis Sampah -->
    <div id="modalEditJenisSampah" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Edit Jenis Sampah</h2>
                <form id="formEditJenisSampah">
                    <input type="hidden" id="editIdJenisSampah">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Jenis Sampah <span class="text-red-500">*</span></label>
                        <input type="text" id="editNamaJenisSampah" placeholder="Masukkan Nama Jenis Sampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Warna Tempat Sampah <span class="text-red-500">*</span></label>
                        <input type="color" id="editWarnaTempat" class="w-full h-12 px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanEditJenisSampah" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
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
                <input type="hidden" id="deleteId">
                <input type="hidden" id="deleteType">
                
                <div class="flex justify-center space-x-4">
                    <button id="btnBatalkanHapus" class="px-6 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                    <button id="btnKonfirmasiHapus" class="px-8 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Ya</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Detail Sampah -->
    <div id="modalDetailSampah" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Sampah</h2>
                    <button id="btnCloseDetailSampah" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Utama -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">ID Sampah</p>
                            <p id="detailIdSampah" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Nama Sampah</p>
                            <p id="detailNamaSampah" class="text-black">-</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Jenis Sampah</p>
                            <p id="detailJenisSampah" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Detail Ciri</p>
                            <p id="detailCiriSampah" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Detail Manfaat</p>
                            <p id="detailManfaatSampah" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Bobot Poin</p>
                            <p id="detailBobotPoin" class="text-black">-</p>
                        </div>
                    </div>
                    
                    <!-- Foto Sampah -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Foto Sampah</p>
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img id="detailFotoSampah" src="/api/placeholder/400/320" alt="Foto Sampah" class="max-h-full max-w-full rounded-lg object-cover text-black">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Jenis Sampah -->
    <div id="modalDetailJenisSampah" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Jenis Sampah</h2>
                    <button id="btnCloseDetailJenisSampah" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">ID Jenis Sampah</p>
                        <p id="detailIdJenisSampah" class="text-black">-</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500">Nama Jenis Sampah</p>
                        <p id="detailNamaJenisSampah" class="text-black">-</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-500">Warna Tempat Sampah</p>
                        <div class="flex items-center">
                            <div id="detailWarnaTempat" class="w-8 h-8 rounded-full mr-2"></div>
                            <p id="detailKodeWarna" class="text-black">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk mengelola interaksi UI -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab navigation
            const tabSampah = document.getElementById('tabSampah');
            const tabJenisSampah = document.getElementById('tabJenisSampah');
            const contentSampah = document.getElementById('contentSampah');
            const contentJenisSampah = document.getElementById('contentJenisSampah');

            tabSampah.addEventListener('click', function() {
                contentSampah.classList.remove('hidden');
                contentSampah.classList.add('block');
                contentJenisSampah.classList.remove('block');
                contentJenisSampah.classList.add('hidden');
                
                tabSampah.classList.add('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
                tabSampah.classList.remove('text-gray-500');
                tabJenisSampah.classList.add('text-gray-500');
                tabJenisSampah.classList.remove('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
            });

            tabJenisSampah.addEventListener('click', function() {
                contentJenisSampah.classList.remove('hidden');
                contentJenisSampah.classList.add('block');
                contentSampah.classList.remove('block');
                contentSampah.classList.add('hidden');
                
                tabJenisSampah.classList.add('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
                tabJenisSampah.classList.remove('text-gray-500');
                tabSampah.classList.add('text-gray-500');
                tabSampah.classList.remove('text-[#3D8D7A]', 'border-b-2', 'border-[#3D8D7A]');
            });

            // Modal Tambah Sampah
            const btnTambahSampah = document.getElementById('btnTambahSampah');
            const modalTambahSampah = document.getElementById('modalTambahSampah');
            const btnBatalkanTambahSampah = document.getElementById('btnBatalkanTambahSampah');

            btnTambahSampah.addEventListener('click', function() {
                modalTambahSampah.classList.remove('hidden');
                // Load jenis sampah options
                loadJenisSampahOptions();
            });

            btnBatalkanTambahSampah.addEventListener('click', function() {
                modalTambahSampah.classList.add('hidden');
                document.getElementById('formTambahSampah').reset();
            });

            // Modal Edit Sampah
            const modalEditSampah = document.getElementById('modalEditSampah');
            const btnBatalkanEditSampah = document.getElementById('btnBatalkanEditSampah');

            btnBatalkanEditSampah.addEventListener('click', function() {
                modalEditSampah.classList.add('hidden');
            });

            // Modal Tambah Jenis Sampah
            const btnTambahJenisSampah = document.getElementById('btnTambahJenisSampah');
            const modalTambahJenisSampah = document.getElementById('modalTambahJenisSampah');
            const btnBatalkanTambahJenisSampah = document.getElementById('btnBatalkanTambahJenisSampah');

            btnTambahJenisSampah.addEventListener('click', function() {
                modalTambahJenisSampah.classList.remove('hidden');
            });

            btnBatalkanTambahJenisSampah.addEventListener('click', function() {
                modalTambahJenisSampah.classList.add('hidden');
                document.getElementById('formTambahJenisSampah').reset();
            });

            // Modal Edit Jenis Sampah
            const modalEditJenisSampah = document.getElementById('modalEditJenisSampah');
            const btnBatalkanEditJenisSampah = document.getElementById('btnBatalkanEditJenisSampah');

            btnBatalkanEditJenisSampah.addEventListener('click', function() {
                modalEditJenisSampah.classList.add('hidden');
            });

            // Modal Konfirmasi Hapus
            const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');
            const btnBatalkanHapus = document.getElementById('btnBatalkanHapus');
            const btnKonfirmasiHapus = document.getElementById('btnKonfirmasiHapus');

            btnBatalkanHapus.addEventListener('click', function() {
                modalKonfirmasiHapus.classList.add('hidden');
            });

            btnKonfirmasiHapus.addEventListener('click', function() {
                const deleteId = document.getElementById('deleteId').value;
                const deleteType = document.getElementById('deleteType').value;
                
                if (deleteType === 'sampah') {
                    deleteSampah(deleteId);
                } else if (deleteType === 'jenisSampah') {
                    deleteJenisSampah(deleteId);
                }
                
                modalKonfirmasiHapus.classList.add('hidden');
            });

            // Modal Detail Sampah
            const modalDetailSampah = document.getElementById('modalDetailSampah');
            const btnCloseDetailSampah = document.getElementById('btnCloseDetailSampah');

            btnCloseDetailSampah.addEventListener('click', function() {
                modalDetailSampah.classList.add('hidden');
            });

            // Modal Detail Jenis Sampah
            const modalDetailJenisSampah = document.getElementById('modalDetailJenisSampah');
            const btnCloseDetailJenisSampah = document.getElementById('btnCloseDetailJenisSampah');

            btnCloseDetailJenisSampah.addEventListener('click', function() {
                modalDetailJenisSampah.classList.add('hidden');
            });

            // Load Data Functions
            loadSampahData();
            loadJenisSampahData();

            // Form Submit Handlers
            document.getElementById('formTambahSampah').addEventListener('submit', function(e) {
                e.preventDefault();
                tambahSampah(this);
            });

            document.getElementById('formEditSampah').addEventListener('submit', function(e) {
                e.preventDefault();
                updateSampah();
            });

            document.getElementById('formTambahJenisSampah').addEventListener('submit', function(e) {
                e.preventDefault();
                tambahJenisSampah(this);
            });

            document.getElementById('formEditJenisSampah').addEventListener('submit', function(e) {
                e.preventDefault();
                updateJenisSampah();
            });

            // Search functionality
            document.getElementById('searchSampah').addEventListener('keyup', function() {
                searchSampah(this.value);
            });

            document.getElementById('searchJenisSampah').addEventListener('keyup', function() {
                searchJenisSampah(this.value);
            });

            // Pagination handlers
            document.getElementById('btnPrevSampah').addEventListener('click', function() {
                prevPageSampah();
            });

            document.getElementById('btnNextSampah').addEventListener('click', function() {
                nextPageSampah();
            });

            document.getElementById('btnPrevJenisSampah').addEventListener('click', function() {
                prevPageJenisSampah();
            });

            document.getElementById('btnNextJenisSampah').addEventListener('click', function() {
                nextPageJenisSampah();
            });
        });

        // Current page variables
        let currentPageSampah = 1;
        let currentPageJenisSampah = 1;
        let totalPagesSampah = 1;
        let totalPagesJenisSampah = 1;

        // Sample data arrays (replace with your API calls)
        const sampahData = [
            { id_sampah: 'S001', nama_sampah: 'Botol Plastik', detail_ciri: 'Botol dari plastik PET', detail_manfaat: 'Dapat didaur ulang menjadi bahan tekstil', bobot_poin: 5, foto: 'botol_plastik.jpg', id_jenis_sampah: 'JS001', jenis_sampah: 'Plastik' },
            { id_sampah: 'S002', nama_sampah: 'Kertas HVS', detail_ciri: 'Kertas putih tipis', detail_manfaat: 'Dapat didaur ulang menjadi kertas baru', bobot_poin: 3, foto: 'kertas_hvs.jpg', id_jenis_sampah: 'JS002', jenis_sampah: 'Kertas' },
            { id_sampah: 'S003', nama_sampah: 'Kaleng Minuman', detail_ciri: 'Kaleng aluminium', detail_manfaat: 'Dapat didaur ulang menjadi produk berbahan aluminium', bobot_poin: 4, foto: 'kaleng_minuman.jpg', id_jenis_sampah: 'JS003', jenis_sampah: 'Logam' }
        ];

        const jenisSampahData = [
            { id_jenis_sampah: 'JS001', nama_jenis_sampah: 'Plastik', warna_tempat_sampah: '#0066FF' },
            { id_jenis_sampah: 'JS002', nama_jenis_sampah: 'Kertas', warna_tempat_sampah: '#FFCC00' },
            { id_jenis_sampah: 'JS003', nama_jenis_sampah: 'Logam', warna_tempat_sampah: '#FF3300' }
        ];

        // Function to load data sampah
        function loadSampahData() {
            // Here you would normally fetch data from your API
            // For now, we'll use the sample data
            renderSampahTable(sampahData);
        }

        // Function to load data jenis sampah
        function loadJenisSampahData() {
            // Here you would normally fetch data from your API
            // For now, we'll use the sample data
            renderJenisSampahTable(jenisSampahData);
        }

        // Function to render sampah table
        function renderSampahTable(data) {
            const tableBody = document.getElementById('tableBodySampah');
            tableBody.innerHTML = '';
            
            data.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="text-black py-3 px-4 text-center">${index + 1}</td>
                    <td class="text-black py-3 px-4 text-center">${item.id_sampah}</td>
                    <td class="text-black py-3 px-4">${item.nama_sampah}</td>
                    <td class="text-black py-3 px-4 text-center">${item.bobot_poin}</td>
                    <td class="text-black py-3 px-4">${item.jenis_sampah}</td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 btnDetail" onclick="showDetailSampah('${item.id_sampah}')">Detail</button>
                            <button class="bg-[#3D8D7A] text-white px-3 py-1 rounded-md hover:bg-[#2C6A5C] btnEdit" onclick="showEditSampah('${item.id_sampah}')">Edit</button>
                            <button class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 btnHapus" onclick="showDeleteConfirmation('${item.id_sampah}', 'sampah')">Hapus</button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Function to render jenis sampah table
        function renderJenisSampahTable(data) {
            const tableBody = document.getElementById('tableBodyJenisSampah');
            tableBody.innerHTML = '';
            
            data.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="text-black py-3 px-4 text-center">${index + 1}</td>
                    <td class="text-black py-3 px-4 text-center">${item.id_jenis_sampah}</td>
                    <td class="text-black py-3 px-4">${item.nama_jenis_sampah}</td>
                    <td class="text-black py-3 px-4">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full mr-2" style="background-color: ${item.warna_tempat_sampah}"></div>
                            <span>${item.warna_tempat_sampah}</span>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex justify-center space-x-2">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 btnDetail" onclick="showDetailJenisSampah('${item.id_jenis_sampah}')">Detail</button>
                            <button class="bg-[#3D8D7A] text-white px-3 py-1 rounded-md hover:bg-[#2C6A5C] btnEdit" onclick="showEditJenisSampah('${item.id_jenis_sampah}')">Edit</button>
                            <button class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 btnHapus" onclick="showDeleteConfirmation('${item.id_jenis_sampah}', 'jenisSampah')">Hapus</button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Function to show delete confirmation
        function showDeleteConfirmation(id, type) {
            document.getElementById('deleteId').value = id;
            document.getElementById('deleteType').value = type;
            document.getElementById('modalKonfirmasiHapus').classList.remove('hidden');
        }

        // Function to delete sampah
        function deleteSampah(id) {
            // Here you would normally call your API to delete the data
            // For now, we'll just filter the local array
            const index = sampahData.findIndex(item => item.id_sampah === id);
            if (index !== -1) {
                sampahData.splice(index, 1);
                renderSampahTable(sampahData);
                showNotification('Data sampah berhasil dihapus');
            }
        }

        // Function to delete jenis sampah
        function deleteJenisSampah(id) {
            // Here you would normally call your API to delete the data
            // For now, we'll just filter the local array
            const index = jenisSampahData.findIndex(item => item.id_jenis_sampah === id);
            if (index !== -1) {
                jenisSampahData.splice(index, 1);
                renderJenisSampahTable(jenisSampahData);
                showNotification('Data jenis sampah berhasil dihapus');
            }
        }

        // Function to show detail sampah
        function showDetailSampah(id) {
            const sampah = sampahData.find(item => item.id_sampah === id);
            if (sampah) {
                document.getElementById('detailIdSampah').textContent = sampah.id_sampah;
                document.getElementById('detailNamaSampah').textContent = sampah.nama_sampah;
                document.getElementById('detailJenisSampah').textContent = sampah.jenis_sampah;
                document.getElementById('detailCiriSampah').textContent = sampah.detail_ciri;
                document.getElementById('detailManfaatSampah').textContent = sampah.detail_manfaat;
                document.getElementById('detailBobotPoin').textContent = sampah.bobot_poin;
                // In a real app, you would set the actual image URL
                document.getElementById('detailFotoSampah').src = '/api/placeholder/400/320';
                
                document.getElementById('modalDetailSampah').classList.remove('hidden');
            }
        }

        // Function to show detail jenis sampah
        function showDetailJenisSampah(id) {
            const jenisSampah = jenisSampahData.find(item => item.id_jenis_sampah === id);
            if (jenisSampah) {
                document.getElementById('detailIdJenisSampah').textContent = jenisSampah.id_jenis_sampah;
                document.getElementById('detailNamaJenisSampah').textContent = jenisSampah.nama_jenis_sampah;
                document.getElementById('detailWarnaTempat').style.backgroundColor = jenisSampah.warna_tempat_sampah;
                document.getElementById('detailKodeWarna').textContent = jenisSampah.warna_tempat_sampah;
                
                document.getElementById('modalDetailJenisSampah').classList.remove('hidden');
            }
        }

        // Function to show edit sampah form
        function showEditSampah(id) {
            const sampah = sampahData.find(item => item.id_sampah === id);
            if (sampah) {
                document.getElementById('editIdSampah').value = sampah.id_sampah;
                document.getElementById('editNamaSampah').value = sampah.nama_sampah;
                document.getElementById('editDetailCiri').value = sampah.detail_ciri;
                document.getElementById('editDetailManfaat').value = sampah.detail_manfaat;
                document.getElementById('editBobotPoin').value = sampah.bobot_poin;
                
                // Load jenis sampah options and select the correct one
                loadJenisSampahOptions(sampah.id_jenis_sampah);
                
                document.getElementById('modalEditSampah').classList.remove('hidden');
            }
        }

        // Function to show edit jenis sampah form
        function showEditJenisSampah(id) {
            const jenisSampah = jenisSampahData.find(item => item.id_jenis_sampah === id);
            if (jenisSampah) {
                document.getElementById('editIdJenisSampah').value = jenisSampah.id_jenis_sampah;
                document.getElementById('editNamaJenisSampah').value = jenisSampah.nama_jenis_sampah;
                document.getElementById('editWarnaTempat').value = jenisSampah.warna_tempat_sampah;
                
                document.getElementById('modalEditJenisSampah').classList.remove('hidden');
            }
        }

        // Function to update sampah
        function updateSampah() {
            const id = document.getElementById('editIdSampah').value;
            const index = sampahData.findIndex(item => item.id_sampah === id);
            
            if (index !== -1) {
                const jenisSampahId = document.getElementById('editJenisSampah').value;
                const jenisSampah = jenisSampahData.find(item => item.id_jenis_sampah === jenisSampahId);
                
                sampahData[index] = {
                    ...sampahData[index],
                    nama_sampah: document.getElementById('editNamaSampah').value,
                    detail_ciri: document.getElementById('editDetailCiri').value,
                    detail_manfaat: document.getElementById('editDetailManfaat').value,
                    bobot_poin: parseInt(document.getElementById('editBobotPoin').value),
                    id_jenis_sampah: jenisSampahId,
                    jenis_sampah: jenisSampah ? jenisSampah.nama_jenis_sampah : ''
                };
                
                renderSampahTable(sampahData);
                document.getElementById('modalEditSampah').classList.add('hidden');
                showNotification('Data sampah berhasil diupdate');
            }
        }

        // Function to update jenis sampah
        function updateJenisSampah() {
            const id = document.getElementById('editIdJenisSampah').value;
            const index = jenisSampahData.findIndex(item => item.id_jenis_sampah === id);
            
            if (index !== -1) {
                jenisSampahData[index] = {
                    ...jenisSampahData[index],
                    nama_jenis_sampah: document.getElementById('editNamaJenisSampah').value,
                    warna_tempat_sampah: document.getElementById('editWarnaTempat').value
                };
                
                renderJenisSampahTable(jenisSampahData);
                document.getElementById('modalEditJenisSampah').classList.add('hidden');
                showNotification('Data jenis sampah berhasil diupdate');
                
                // Update related sampah items
                sampahData.forEach(item => {
                    if (item.id_jenis_sampah === id) {
                        item.jenis_sampah = jenisSampahData[index].nama_jenis_sampah;
                    }
                });
                renderSampahTable(sampahData);
            }
        }

        // Function to add new sampah
        function tambahSampah(form) {
            const formData = new FormData(form);
            
            // Generate a new ID
            const newId = 'S' + String(sampahData.length + 1).padStart(3, '0');
            
            const jenisSampahId = formData.get('id_jenis_sampah');
            const jenisSampah = jenisSampahData.find(item => item.id_jenis_sampah === jenisSampahId);
            
            // Create new sampah object
            const newSampah = {
                id_sampah: newId,
                nama_sampah: formData.get('nama_sampah'),
                detail_ciri: formData.get('detail_ciri'),
                detail_manfaat: formData.get('detail_manfaat'),
                bobot_poin: parseInt(formData.get('bobot_poin')),
                foto: 'foto_sampah.jpg', // In a real app, you would handle file upload
                id_jenis_sampah: jenisSampahId,
                jenis_sampah: jenisSampah ? jenisSampah.nama_jenis_sampah : ''
            };
            
            // Add to array
            sampahData.push(newSampah);
            
            // Update table
            renderSampahTable(sampahData);
            
            // Close modal and reset form
            document.getElementById('modalTambahSampah').classList.add('hidden');
            form.reset();
            
            showNotification('Data sampah berhasil ditambahkan');
        }

        // Function to add new jenis sampah
        function tambahJenisSampah(form) {
            const formData = new FormData(form);
            
            // Generate a new ID
            const newId = 'JS' + String(jenisSampahData.length + 1).padStart(3, '0');
            
            // Create new jenis sampah object
            const newJenisSampah = {
                id_jenis_sampah: newId,
                nama_jenis_sampah: formData.get('nama_jenis_sampah'),
                warna_tempat_sampah: formData.get('warna_tempat_sampah')
            };
            
            // Add to array
            jenisSampahData.push(newJenisSampah);
            
            // Update table
            renderJenisSampahTable(jenisSampahData);
            
            // Close modal and reset form
            document.getElementById('modalTambahJenisSampah').classList.add('hidden');
            form.reset();
            
            showNotification('Data jenis sampah berhasil ditambahkan');
        }

        // Function to load jenis sampah options
        function loadJenisSampahOptions(selectedId = '') {
            const selects = [
                document.querySelector('select[name="id_jenis_sampah"]'), 
                document.getElementById('editJenisSampah')
            ];
            
            selects.forEach(select => {
                if (select) {
                    // Clear existing options except the first one
                    while (select.options.length > 1) {
                        select.remove(1);
                    }
                    
                    // Add options
                    jenisSampahData.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id_jenis_sampah;
                        option.textContent = item.nama_jenis_sampah;
                        select.appendChild(option);
                    });
                    
                    // Set selected value if provided
                    if (selectedId) {
                        select.value = selectedId;
                    }
                }
            });
        }

        // Function to search sampah
        function searchSampah(query) {
            if (query.trim() === '') {
                renderSampahTable(sampahData);
                return;
            }
            
            const filtered = sampahData.filter(item => 
                item.id_sampah.toLowerCase().includes(query.toLowerCase()) ||
                item.nama_sampah.toLowerCase().includes(query.toLowerCase()) ||
                item.jenis_sampah.toLowerCase().includes(query.toLowerCase())
        );
            
            const filteredData = filtered.length > 0
                ? filtered 
                : [{id_sampah: '', nama_sampah: 'Data tidak ditemukan', jenis_sampah: '', bobot_poin: '', detail_ciri: '', detail_manfaat: '', foto: ''}];
            
            renderSampahTable(filteredData);
        }

        // Function to search jenis sampah
        function searchJenisSampah(query) {
            if (query.trim() === '') {
                renderJenisSampahTable(jenisSampahData);
                return;
            }
            
            const filtered = jenisSampahData.filter(item => 
                item.id_jenis_sampah.toLowerCase().includes(query.toLowerCase()) ||
                item.nama_jenis_sampah.toLowerCase().includes(query.toLowerCase())
            );
            
            const filteredData = filtered.length > 0
                ? filtered 
                : [{id_jenis_sampah: '', nama_jenis_sampah: 'Data tidak ditemukan', warna_tempat_sampah: '#CCCCCC'}];
            
            renderJenisSampahTable(filteredData);
        }

        // Function to show notification
        function showNotification(message) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 animate-fade-in-up';
            notification.textContent = message;
            
            // Add to DOM
            document.body.appendChild(notification);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('animate-fade-out-down');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Pagination Functions for Sampah
        function prevPageSampah() {
            if (currentPageSampah > 1) {
                currentPageSampah--;
                loadSampahPage(currentPageSampah);
                updatePaginationSampah();
            }
        }

        function nextPageSampah() {
            if (currentPageSampah < totalPagesSampah) {
                currentPageSampah++;
                loadSampahPage(currentPageSampah);
                updatePaginationSampah();
            }
        }

        function loadSampahPage(page) {
            // In a real app, this would be an API call with page parameters
            // For demonstration, we'll just use the same data
            const itemsPerPage = 10;
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageData = sampahData.slice(startIndex, endIndex);
            
            // Calculate total pages
            totalPagesSampah = Math.ceil(sampahData.length / itemsPerPage);
            
            renderSampahTable(pageData);
        }

        function updatePaginationSampah() {
            // Update pagination buttons
            const pageButtons = [
                document.getElementById('pageSampah1'),
                document.getElementById('pageSampah2'),
                document.getElementById('pageSampah3'),
                document.getElementById('pageSampah4'),
                document.getElementById('pageSampah5')
            ];
            
            // Determine start page for pagination
            let startPage = Math.max(1, currentPageSampah - 2);
            if (startPage + 4 > totalPagesSampah) {
                startPage = Math.max(1, totalPagesSampah - 4);
            }
            
            // Update page numbers and styles
            pageButtons.forEach((button, index) => {
                const pageNum = startPage + index;
                button.textContent = pageNum;
                
                if (pageNum === currentPageSampah) {
                    button.classList.add('bg-[#3D8D7A]', 'text-white');
                    button.classList.remove('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                } else if (pageNum <= totalPagesSampah) {
                    button.classList.remove('bg-[#3D8D7A]', 'text-white');
                    button.classList.add('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                    
                    // Add click event listener to page buttons
                    button.onclick = function() {
                        currentPageSampah = pageNum;
                        loadSampahPage(currentPageSampah);
                        updatePaginationSampah();
                    };
                } else {
                    button.style.display = 'none';
                }
            });
            
            // Enable/disable prev/next buttons
            document.getElementById('btnPrevSampah').disabled = currentPageSampah === 1;
            document.getElementById('btnNextSampah').disabled = currentPageSampah === totalPagesSampah;
        }

        // Pagination Functions for Jenis Sampah
        function prevPageJenisSampah() {
            if (currentPageJenisSampah > 1) {
                currentPageJenisSampah--;
                loadJenisSampahPage(currentPageJenisSampah);
                updatePaginationJenisSampah();
            }
        }

        function nextPageJenisSampah() {
            if (currentPageJenisSampah < totalPagesJenisSampah) {
                currentPageJenisSampah++;
                loadJenisSampahPage(currentPageJenisSampah);
                updatePaginationJenisSampah();
            }
        }

        function loadJenisSampahPage(page) {
            // In a real app, this would be an API call with page parameters
            // For demonstration, we'll just use the same data
            const itemsPerPage = 10;
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageData = jenisSampahData.slice(startIndex, endIndex);
            
            // Calculate total pages
            totalPagesJenisSampah = Math.ceil(jenisSampahData.length / itemsPerPage);
            
            renderJenisSampahTable(pageData);
        }

        function updatePaginationJenisSampah() {
            // Update pagination buttons
            const pageButtons = [
                document.getElementById('pageJenisSampah1'),
                document.getElementById('pageJenisSampah2'),
                document.getElementById('pageJenisSampah3'),
                document.getElementById('pageJenisSampah4'),
                document.getElementById('pageJenisSampah5')
            ];
            
            // Determine start page for pagination
            let startPage = Math.max(1, currentPageJenisSampah - 2);
            if (startPage + 4 > totalPagesJenisSampah) {
                startPage = Math.max(1, totalPagesJenisSampah - 4);
            }
            
            // Update page numbers and styles
            pageButtons.forEach((button, index) => {
                const pageNum = startPage + index;
                button.textContent = pageNum;
                
                if (pageNum === currentPageJenisSampah) {
                    button.classList.add('bg-[#3D8D7A]', 'text-white');
                    button.classList.remove('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                } else if (pageNum <= totalPagesJenisSampah) {
                    button.classList.remove('bg-[#3D8D7A]', 'text-white');
                    button.classList.add('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                    
                    // Add click event listener to page buttons
                    button.onclick = function() {
                        currentPageJenisSampah = pageNum;
                        loadJenisSampahPage(currentPageJenisSampah);
                        updatePaginationJenisSampah();
                    };
                } else {
                    button.style.display = 'none';
                }
            });
            
            // Enable/disable prev/next buttons
            document.getElementById('btnPrevJenisSampah').disabled = currentPageJenisSampah === 1;
            document.getElementById('btnNextJenisSampah').disabled = currentPageJenisSampah === totalPagesJenisSampah;
        }

        // Initialize pagination on load
        function initPagination() {
            // Initialize for Sampah
            const itemsPerPageSampah = 10;
            totalPagesSampah = Math.ceil(sampahData.length / itemsPerPageSampah);
            loadSampahPage(currentPageSampah);
            updatePaginationSampah();
            
            // Initialize for Jenis Sampah
            const itemsPerPageJenisSampah = 10;
            totalPagesJenisSampah = Math.ceil(jenisSampahData.length / itemsPerPageJenisSampah);
            loadJenisSampahPage(currentPageJenisSampah);
            updatePaginationJenisSampah();
            
            // Add click event listeners to pagination buttons
            document.querySelectorAll('[id^="pageSampah"]').forEach((button, index) => {
                button.addEventListener('click', function() {
                    currentPageSampah = index + 1;
                    loadSampahPage(currentPageSampah);
                    updatePaginationSampah();
                });
            });
            
            document.querySelectorAll('[id^="pageJenisSampah"]').forEach((button, index) => {
                button.addEventListener('click', function() {
                    currentPageJenisSampah = index + 1;
                    loadJenisSampahPage(currentPageJenisSampah);
                    updatePaginationJenisSampah();
                });
            });
        }

        // Initialize CSS animations
        const styleElement = document.createElement('style');
        styleElement.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes fadeOutDown {
                from {
                    opacity: 1;
                    transform: translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateY(20px);
                }
            }
            
            .animate-fade-in-up {
                animation: fadeInUp 0.3s ease-out forwards;
            }
            
            .animate-fade-out-down {
                animation: fadeOutDown 0.3s ease-in forwards;
            }
        `;
        document.head.appendChild(styleElement);

        // Call initPagination after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initPagination();
        });

        // Function to handle the visibility of page buttons based on total pages
        function updatePageButtonsVisibility() {
            // For Sampah
            const pageButtonsSampah = [
                document.getElementById('pageSampah1'),
                document.getElementById('pageSampah2'),
                document.getElementById('pageSampah3'),
                document.getElementById('pageSampah4'),
                document.getElementById('pageSampah5')
            ];
            
            pageButtonsSampah.forEach((button, index) => {
                const pageNum = index + 1;
                if (pageNum <= totalPagesSampah) {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });
            
            // For Jenis Sampah
            const pageButtonsJenisSampah = [
                document.getElementById('pageJenisSampah1'),
                document.getElementById('pageJenisSampah2'),
                document.getElementById('pageJenisSampah3'),
                document.getElementById('pageJenisSampah4'),
                document.getElementById('pageJenisSampah5')
            ];
            
            pageButtonsJenisSampah.forEach((button, index) => {
                const pageNum = index + 1;
                if (pageNum <= totalPagesJenisSampah) {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });
        }

        // Call updatePageButtonsVisibility after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            updatePageButtonsVisibility();
        });

        // Add event listeners for the page buttons
        document.addEventListener('DOMContentLoaded', function() {
            // For Sampah
            for (let i = 1; i <= 5; i++) {
                const pageButton = document.getElementById(`pageSampah${i}`);
                pageButton.addEventListener('click', function() {
                    currentPageSampah = parseInt(this.textContent);
                    loadSampahPage(currentPageSampah);
                    updatePaginationSampah();
                });
            }
            
            // For Jenis Sampah
            for (let i = 1; i <= 5; i++) {
                const pageButton = document.getElementById(`pageJenisSampah${i}`);
                pageButton.addEventListener('click', function() {
                    currentPageJenisSampah = parseInt(this.textContent);
                    loadJenisSampahPage(currentPageJenisSampah);
                    updatePaginationJenisSampah();
                });
            }
        });

        // Validate forms before submission
        function validateSampahForm(form) {
            const namaSampah = form.querySelector('[name="nama_sampah"]').value;
            const jenisSampah = form.querySelector('[name="id_jenis_sampah"]').value;
            const bobotPoin = form.querySelector('[name="bobot_poin"]').value;
            
            if (!namaSampah || !jenisSampah || !bobotPoin) {
                showNotification('Silakan lengkapi semua field yang wajib diisi');
                return false;
            }
            
            return true;
        }

        function validateJenisSampahForm(form) {
            const namaJenisSampah = form.querySelector('[name="nama_jenis_sampah"]').value;
            const warnaTempat = form.querySelector('[name="warna_tempat_sampah"]').value;
            
            if (!namaJenisSampah || !warnaTempat) {
                showNotification('Silakan lengkapi semua field yang wajib diisi');
                return false;
            }
            
            return true;
        }

        // Update form validation on submit
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('formTambahSampah').addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateSampahForm(this)) {
                    tambahSampah(this);
                }
            });
            
            document.getElementById('formEditSampah').addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateSampahForm(this)) {
                    updateSampah();
                }
            });
            
            document.getElementById('formTambahJenisSampah').addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateJenisSampahForm(this)) {
                    tambahJenisSampah(this);
                }
            });
            
            document.getElementById('formEditJenisSampah').addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateJenisSampahForm(this)) {
                    updateJenisSampah();
                }
            });
        });
    </script>
    </body>
</html>