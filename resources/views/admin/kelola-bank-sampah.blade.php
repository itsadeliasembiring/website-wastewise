<!DOCTYPE html>
<html lang="en" class="h-full bg-[#E6E6E6] dark:bg-[#E6E6E6]">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
            <div class="flex justify-between items-center mb-3">
                <h1 class="text-2xl font-semibold text-[#3D8D7A]">Kelola Bank Sampah</h1>
                <div class="flex space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search" class="text-black w-64 pl-10 pr-4 py-2 rounded-lg border bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                        <span class="absolute left-3 top-2.5 text-black">
                            <x-fas-search class="w-5 h-5 text-[#3D8D7A]" />
                        </span>
                    </div>
                    <button id="btnTambah" class="bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white px-4 py-2 rounded-lg flex items-center">
                        <x-fas-plus class="w-5 h-5 text-[#fff] mr-2"/> Tambah
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-[#3D8D7A] text-white">
                            <th class="py-3 px-4 text-center">No</th>
                            <th class="py-3 px-4 text-center">Nama Bank</th>
                            <th class="py-3 px-4 text-center">Tanggal Berdiri</th>
                            <th class="py-3 px-4 text-center">Kontak</th>
                            <th class="py-3 px-4 text-center">Alamat</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-end mt-4 space-x-2 mb-5">
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnPrev">Prev</button>
                <button class="px-3 py-1 rounded bg-[#3D8D7A] text-white" id="page1">1</button>
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="page2">2</button>
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="page3">3</button>
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="page4">4</button>
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="page5">5</button>
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnNext">Next</button>
            </div>
        </div>
    </main>

    <!-- Modal Form Tambah -->
    <div id="modalTambah" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full px-6 py-10 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Form Bank Sampah</h2>
                
                <form id="formTambah">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Bank Sampah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" placeholder="Masukkan Nama" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="form-control w-full mb-4">
                        <label class="label mb-1">
                            <span class="label-text text-gray-700">Tanggal Berdiri <span class="text-red-500">*</span></span>
                        </label>
                        <input 
                            type="date" 
                            name="tanggal"
                            placeholder="Pilih Tanggal" 
                             class="input input-bordered w-[100%] border border-gray-300 bg-white text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]"
                            required
                        />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nomor Telepon (Kontak) <span class="text-red-500">*</span></label>
                        <input type="tel" name="kontak" placeholder="Masukkan Kontak" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <!-- Alamat fields -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Provinsi <span class="text-red-500">*</span></label>
                        <select name="provinsi" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Provinsi</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="DKI Jakarta">DKI Jakarta</option>
                            <option value="Bali">Bali</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Kota/Kabupaten <span class="text-red-500">*</span></label>
                        <select name="kota" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Kota/Kabupaten</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Malang">Malang</option>
                            <option value="Sidoarjo">Sidoarjo</option>
                            <option value="Gresik">Gresik</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Kecamatan <span class="text-red-500">*</span></label>
                        <select name="kecamatan" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Kecamatan</option>
                            <option value="Rungkut">Rungkut</option>
                            <option value="Gubeng">Gubeng</option>
                            <option value="Wonokromo">Wonokromo</option>
                            <option value="Sukolilo">Sukolilo</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Kelurahan <span class="text-red-500">*</span></label>
                        <select name="kelurahan" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Kelurahan</option>
                            <option value="Kalirungkut - 60293">Kalirungkut - 60293</option>
                            <option value="Rungkut Kidul - 60293">Rungkut Kidul - 60293</option>
                            <option value="Medokan Ayu - 60295">Medokan Ayu - 60295</option>
                            <option value="Wonorejo - 60296">Wonorejo - 60296</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Detail Alamat <span class="text-red-500">*</span></label>
                        <textarea name="detailAlamat" placeholder="Masukkan Detail Alamat (Jalan, Gang, No. Rumah, RT/RW, dll)" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Upload Surat Legalitas<span class="text-red-500">*</span></label>
                        <input type="file" name="suratLegalitas" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto Bank Sampah<span class="text-red-500">*</span></label>
                        <input type="file" name="fotoBankSampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanTambah" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                        <button type="submit" class="w-1/2 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Form Edit -->
    <div id="modalEdit" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Edit Bank Sampah</h2>
                <form id="formEdit">
                    <input type="hidden" id="editId">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Bank Sampah <span class="text-red-500">*</span></label>
                        <input type="text" id="editNama" placeholder="Masukkan Nama" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Tanggal Berdiri <span class="text-red-500">*</span></label>
                        <input type="date" id="editTanggal" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nomor Telepon (Kontak) <span class="text-red-500">*</span></label>
                        <input type="tel" id="editKontak" placeholder="Masukkan Kontak" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <!-- Alamat fields -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Provinsi <span class="text-red-500">*</span></label>
                        <select id="editProvinsi" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Provinsi</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="DKI Jakarta">DKI Jakarta</option>
                            <option value="Bali">Bali</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Kota/Kabupaten <span class="text-red-500">*</span></label>
                        <select id="editKota" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Kota/Kabupaten</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Malang">Malang</option>
                            <option value="Sidoarjo">Sidoarjo</option>
                            <option value="Gresik">Gresik</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Kecamatan <span class="text-red-500">*</span></label>
                        <select id="editKecamatan" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Kecamatan</option>
                            <option value="Rungkut">Rungkut</option>
                            <option value="Gubeng">Gubeng</option>
                            <option value="Wonokromo">Wonokromo</option>
                            <option value="Sukolilo">Sukolilo</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Kelurahan <span class="text-red-500">*</span></label>
                        <select id="editKelurahan" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Kelurahan</option>
                            <option value="Kalirungkut - 60293">Kalirungkut - 60293</option>
                            <option value="Rungkut Kidul - 60293">Rungkut Kidul - 60293</option>
                            <option value="Medokan Ayu - 60295">Medokan Ayu - 60295</option>
                            <option value="Wonorejo - 60296">Wonorejo - 60296</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Detail Alamat <span class="text-red-500">*</span></label>
                        <textarea id="editDetailAlamat" placeholder="Masukkan Detail Alamat (Jalan, Gang, No. Rumah, RT/RW, dll)" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Upload Surat Legalitas<span class="text-red-500">*</span></label>
                        <input type="file" id="editSurat" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto Bank Sampah<span class="text-red-500">*</span></label>
                        <input type="file" id="editFoto" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah</p>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanEdit" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
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
    
    <!-- Modal Detail Bank Sampah -->
    <div id="modalDetail" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Bank Sampah</h2>
                    <button id="btnCloseDetail" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Utama -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">ID Bank Sampah</p>
                            <p id="detailId" class="text-black">BS001</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Nama Bank Sampah</p>
                            <p id="detailNama" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Tanggal Berdiri</p>
                            <p id="detailTanggal" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Kontak</p>
                            <p id="detailKontak" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Alamat Lengkap</p>
                            <p id="detailAlamat" class="text-black">-</p>
                        </div>
                    </div>
                    
                    <!-- Dokumen & Foto -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Foto Bank Sampah</p>
                            <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img id="detailFoto" src="/api/placeholder/400/320" alt="Foto Bank Sampah" class="max-h-full max-w-full rounded-lg object-cover text-black">
                            </div>
                        </div>
                        
                        <div class="border border-gray-300 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#3D8D7A] mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <div>
                                    <p id="detailSuratNama" class="font-medium text-black">Surat Legalitas.pdf</p>
                                    <p class="text-xs text-gray-500">PDF Document</p>
                                </div>
                            </div>
                            <a href="/path/to/Surat%20Legalitas.pdf" download class="text-[#3D8D7A] hover:text-[#2C6A5C]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
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
        // Extended data structure to include address details and files
        const bankSampahData = [
            { 
                id: 1, 
                nama: "Bank Sampah Hijau Lestari", 
                tanggal: "15-03-2022", 
                kontak: "081234567890", 
                provinsi: "Jawa Timur",
                kota: "Surabaya",
                kecamatan: "Rungkut",
                kelurahan: "Kalirungkut - 60293",
                detailAlamat: "Jl. Raya Mangrove No. 123",
                alamat: "Jl. Raya Mangrove No. 123, Kalirungkut, Rungkut, Surabaya, Jawa Timur",
                fotoUrl: "/api/placeholder/400/320",
                suratUrl: "surat-legalitas-1.pdf"
            },
            { 
                id: 2, 
                nama: "Bank Sampah Bersih Bersama", 
                tanggal: "22-05-2022", 
                kontak: "081298765432", 
                provinsi: "Jawa Timur",
                kota: "Surabaya",
                kecamatan: "Wonokromo",
                kelurahan: "Wonokromo - 60244",
                detailAlamat: "Jl. Siwalankerto No. 45",
                alamat: "Jl. Siwalankerto No. 45, Wonokromo, Surabaya, Jawa Timur",
                fotoUrl: "/api/placeholder/400/320",
                suratUrl: "surat-legalitas-2.pdf"
            },
            { 
                id: 3, 
                nama: "Bank Sampah Peduli Lingkungan", 
                tanggal: "04-06-2022", 
                kontak: "085678901234", 
                provinsi: "Jawa Timur",
                kota: "Surabaya",
                kecamatan: "Gubeng",
                kelurahan: "Gubeng - 60222",
                detailAlamat: "Jl. Ahmad Yani No. 78",
                alamat: "Jl. Ahmad Yani No. 78, Gubeng, Surabaya, Jawa Timur",
                fotoUrl: "/api/placeholder/400/320",
                suratUrl: "surat-legalitas-3.pdf"
            },
            { 
                id: 4, 
                nama: "Bank Sampah Mandiri Sejahtera", 
                tanggal: "17-08-2022", 
                kontak: "082345678901", 
                provinsi: "Jawa Timur",
                kota: "Surabaya",
                kecamatan: "Gubeng",
                kelurahan: "Gubeng - 60222",
                detailAlamat: "Jl. Diponegoro No. 210",
                alamat: "Jl. Diponegoro No. 210, Gubeng, Surabaya, Jawa Timur",
                fotoUrl: "/api/placeholder/400/320",
                suratUrl: "surat-legalitas-4.pdf"
            },
            { 
                id: 5, 
                nama: "Bank Sampah Bumi Sehat", 
                tanggal: "29-09-2022", 
                kontak: "087654321098", 
                provinsi: "Jawa Timur",
                kota: "Surabaya",
                kecamatan: "Sukolilo",
                kelurahan: "Sukolilo - 60111",
                detailAlamat: "Jl. Darmo Permai No. 56",
                alamat: "Jl. Darmo Permai No. 56, Sukolilo, Surabaya, Jawa Timur",
                fotoUrl: "/api/placeholder/400/320",
                suratUrl: "surat-legalitas-5.pdf"
            },
            { 
                id: 6, 
                nama: "Bank Sampah Recycle ID", 
                tanggal: "10-11-2022", 
                kontak: "089012345678", 
                provinsi: "Jawa Timur",
                kota: "Surabaya",
                kecamatan: "Wonokromo",
                kelurahan: "Wonokromo - 60244",
                detailAlamat: "Jl. Ngagel Jaya No. 32",
                alamat: "Jl. Ngagel Jaya No. 32, Wonokromo, Surabaya, Jawa Timur",
                fotoUrl: "/api/placeholder/400/320",
                suratUrl: "surat-legalitas-6.pdf"
            },
            { 
                id: 7, 
                nama: "Bank Sampah Ciputra Peduli", 
                tanggal: "24-12-2022", 
                kontak: "081234987650", 
                provinsi: "Jawa Timur",
                kota: "Surabaya",
                kecamatan: "Rungkut",
                kelurahan: "Kalirungkut - 60293",
                detailAlamat: "Jl. Citraland No. 15",
                alamat: "Jl. Citraland No. 15, Kalirungkut, Rungkut, Surabaya, Jawa Timur",
                fotoUrl: "/api/placeholder/400/320",
                suratUrl: "surat-legalitas-7.pdf"
            },
            { 
                id: 8, 
                nama: "Bank Sampah Guyub Rukun", 
                tanggal: "05-01-2023", 
                kontak: "082156789012", 
                provinsi: "Jawa Timur",
                kota: "Surabaya",
                kecamatan: "Rungkut",
                kelurahan: "Rungkut Kidul - 60293",
                detailAlamat: "Jl. Rungkut Asri No. 89",
                alamat: "Jl. Rungkut Asri No. 89, Rungkut Kidul, Rungkut, Surabaya, Jawa Timur",
                fotoUrl: "/api/placeholder/400/320",
                suratUrl: "surat-legalitas-8.pdf"
            },
            { 
                id: 9, 
                nama: "Bank Sampah Griya Bersih", 
                tanggal: "19-02-2023", 
                kontak: "083456789012", 
                provinsi: "Jawa Timur",
                kota: "Gresik",
                kecamatan: "Kebomas",
                kelurahan: "Kebomas - 61121",
                detailAlamat: "Jl. Kenjeran No. 121",
                alamat: "Jl. Kenjeran No. 121, Kebomas, Gresik, Jawa Timur",
                fotoUrl: "/api/placeholder/400/320",
                suratUrl: "surat-legalitas-9.pdf"
            }
        ];

        let currentPage = 1;
        const rowsPerPage = 9;
        let deleteId = null;

        const tableBody = document.getElementById('tableBody');
        const modalTambah = document.getElementById('modalTambah');
        const modalEdit = document.getElementById('modalEdit');
        const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');
        const modalDetail = document.getElementById('modalDetail');
        const alertSuccess = document.getElementById('alertSuccess');
        const alertSuccessMessage = document.getElementById('alertSuccessMessage');

        // Function to search through bankSampahData
        function searchBankSampah(query) {
            if (!query) {
                return bankSampahData; // Return all data if query is empty
            }
            
            query = query.toLowerCase();
            return bankSampahData.filter(item => 
                item.nama.toLowerCase().includes(query) || 
                item.tanggal.toLowerCase().includes(query) || 
                item.kontak.toLowerCase().includes(query) || 
                item.alamat.toLowerCase().includes(query) ||
                item.provinsi.toLowerCase().includes(query) ||
                item.kota.toLowerCase().includes(query) ||
                item.kecamatan.toLowerCase().includes(query) ||
                item.kelurahan.toLowerCase().includes(query)
            );
        }

        function renderTable() {
            tableBody.innerHTML = '';
            
            // Get search query
            const searchQuery = document.querySelector('input[placeholder="Search"]').value;
            const filteredData = searchBankSampah(searchQuery);
            
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
                            <p class="text-sm">Tidak ada data bank sampah yang sesuai dengan pencarian Anda</p>
                        </div>
                    </td>
                `;
                tableBody.appendChild(emptyRow);
                return;
            }
            
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = filteredData.slice(start, end);
            
            paginatedData.forEach((item, index) => {
                const row = document.createElement('tr');
                row.className = index % 2 === 0 ? '' : 'bg-gray-50';
                row.innerHTML = `
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${start + index + 1}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.nama}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.tanggal}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.kontak}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.alamat}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">
                        <div class="flex justify-center space-x-2">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 btnDetail" data-id="${item.id}">Detail</button>
                            <button class="bg-[#3D8D7A] text-white px-3 py-1 rounded-md hover:bg-[#2C6A5C] btnEdit" data-id="${item.id}">Edit</button>
                            <button class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 btnHapus" data-id="${item.id}">Hapus</button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Add event listeners for detail buttons
            document.querySelectorAll('.btnDetail').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openDetailModal(id);
                });
            });

            document.querySelectorAll('.btnEdit').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openEditModal(id);
                });
            });

            document.querySelectorAll('.btnHapus').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openDeleteConfirmation(id);
                });
            });
            
            // Update pagination for filtered results
            updatePaginationForFilteredData(filteredData.length);
        }

        // Function to update pagination based on filtered data
        function updatePaginationForFilteredData(totalItems) {
            const maxPage = Math.ceil(totalItems / rowsPerPage);
            
            // Adjust current page if it's beyond max page
            if (currentPage > maxPage && maxPage > 0) {
                currentPage = maxPage;
            }
            
            // Update pagination buttons visibility
            for (let i = 1; i <= 5; i++) {
                const pageBtn = document.getElementById(`page${i}`);
                if (i <= maxPage) {
                    pageBtn.style.display = '';
                } else {
                    pageBtn.style.display = 'none';
                }
            }
            
            updatePagination();
        }

        // Function to build complete address
        function buildCompleteAddress(detailAlamat, kelurahan, kecamatan, kota, provinsi) {
            const kelurahananParts = kelurahan.split(' - ');
            const kelurahanName = kelurahananParts[0];
            return `${detailAlamat}, ${kelurahanName}, ${kecamatan}, ${kota}, ${provinsi}`;
        }

        // Function to open detail modal
        function openDetailModal(id) {
            const data = bankSampahData.find(item => item.id === id);
            if (data) {
                document.getElementById('detailId').textContent = `BS${String(data.id).padStart(3, '0')}`;
                document.getElementById('detailNama').textContent = data.nama;
                document.getElementById('detailTanggal').textContent = data.tanggal;
                document.getElementById('detailKontak').textContent = data.kontak;
                document.getElementById('detailAlamat').textContent = data.alamat;
                document.getElementById('detailFoto').src = data.fotoUrl || '/api/placeholder/400/320';
                document.getElementById('detailSuratNama').textContent = data.suratUrl || 'Dokumen Tidak Tersedia';
                
                modalDetail.classList.remove('hidden');
            }
        }

        // Initialize the table on page load
        renderTable();

        // Add event listener for search input
        document.querySelector('input[placeholder="Search"]').addEventListener('input', function() {
            currentPage = 1; // Reset to first page when searching
            renderTable();
        });

        // Event listener for the add button
        document.getElementById('btnTambah').addEventListener('click', function() {
            modalTambah.classList.remove('hidden');
        });

        // Close detail modal
        document.getElementById('btnCloseDetail').addEventListener('click', function() {
            modalDetail.classList.add('hidden');
        });

        document.getElementById('btnBatalkanTambah').addEventListener('click', function() {
            modalTambah.classList.add('hidden');
            document.getElementById('formTambah').reset();
        });

        document.getElementById('formTambah').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nextId = bankSampahData.length > 0 ? Math.max(...bankSampahData.map(item => item.id)) + 1 : 1;
            const formElements = this.elements;
            
            const nama = formElements.nama.value;
            const tanggal = formatDate(formElements.tanggal.value);
            const kontak = formElements.kontak.value;
            const provinsi = formElements.provinsi.value;
            const kota = formElements.kota.value;
            const kecamatan = formElements.kecamatan.value;
            const kelurahan = formElements.kelurahan.value;
            const detailAlamat = formElements.detailAlamat.value;
            
            // Build complete address
            const alamat = buildCompleteAddress(detailAlamat, kelurahan, kecamatan, kota, provinsi);
            
            // Handle file inputs
            const suratFile = formElements.suratLegalitas.files[0];
            const fotoFile = formElements.fotoBankSampah.files[0];
            
            // In a real application, you'd upload these files to server
            // For this demo, we'll just use the file names
            const suratUrl = suratFile ? `surat-legalitas-${nextId}.pdf` : "";
            const fotoUrl = fotoFile ? "/api/placeholder/400/320" : "";
            
            const newData = {
                id: nextId,
                nama: nama,
                tanggal: tanggal,
                kontak: kontak,
                provinsi: provinsi,
                kota: kota,
                kecamatan: kecamatan,
                kelurahan: kelurahan,
                detailAlamat: detailAlamat,
                alamat: alamat,
                suratUrl: suratUrl,
                fotoUrl: fotoUrl
            };
            
            bankSampahData.push(newData);
            renderTable();
            
            modalTambah.classList.add('hidden');
            this.reset();

            showAlert('Data bank sampah berhasil ditambahkan');
        });

        function openEditModal(id) {
            const data = bankSampahData.find(item => item.id === id);
            if (data) {
                document.getElementById('editId').value = data.id;
                document.getElementById('editNama').value = data.nama;
                
                const dateParts = data.tanggal.split('-');
                const formattedDate = `20${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
                document.getElementById('editTanggal').value = formattedDate;
                
                document.getElementById('editKontak').value = data.kontak;
                document.getElementById('editProvinsi').value = data.provinsi;
                document.getElementById('editKota').value = data.kota;
                document.getElementById('editKecamatan').value = data.kecamatan;
                document.getElementById('editKelurahan').value = data.kelurahan;
                document.getElementById('editDetailAlamat').value = data.detailAlamat;
                
                modalEdit.classList.remove('hidden');
            }
        }

        document.getElementById('btnBatalkanEdit').addEventListener('click', function() {
            modalEdit.classList.add('hidden');
        });

        document.getElementById('formEdit').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = parseInt(document.getElementById('editId').value);
            const index = bankSampahData.findIndex(item => item.id === id);
            
            if (index !== -1) {
                const nama = document.getElementById('editNama').value;
                const tanggal = formatDate(document.getElementById('editTanggal').value);
                const kontak = document.getElementById('editKontak').value;
                const provinsi = document.getElementById('editProvinsi').value;
                const kota = document.getElementById('editKota').value;
                const kecamatan = document.getElementById('editKecamatan').value;
                const kelurahan = document.getElementById('editKelurahan').value;
                const detailAlamat = document.getElementById('editDetailAlamat').value;
                
                // Build complete address
                const alamat = buildCompleteAddress(detailAlamat, kelurahan, kecamatan, kota, provinsi);
                
                // Handle file inputs
                const suratFile = document.getElementById('editSurat').files[0];
                const fotoFile = document.getElementById('editFoto').files[0];
                
                // Only update file URLs if new files are provided
                const suratUrl = suratFile ? `surat-legalitas-${id}.pdf` : bankSampahData[index].suratUrl;
                const fotoUrl = fotoFile ? "/api/placeholder/400/320" : bankSampahData[index].fotoUrl;
                
                bankSampahData[index] = {
                    id: id,
                    nama: nama,
                    tanggal: tanggal,
                    kontak: kontak,
                    provinsi: provinsi,
                    kota: kota,
                    kecamatan: kecamatan,
                    kelurahan: kelurahan,
                    detailAlamat: detailAlamat,
                    alamat: alamat,
                    suratUrl: suratUrl,
                    fotoUrl: fotoUrl
                };
                
                renderTable();
                modalEdit.classList.add('hidden');
                showAlert('Data bank sampah berhasil diperbarui');
            }
        });

        function openDeleteConfirmation(id) {
            deleteId = id;
            modalKonfirmasiHapus.classList.remove('hidden');
        }

        document.getElementById('btnBatalkanHapus').addEventListener('click', function() {
            modalKonfirmasiHapus.classList.add('hidden');
            deleteId = null;
        });

        document.getElementById('btnKonfirmasiHapus').addEventListener('click', function() {
            if (deleteId !== null) {
                const index = bankSampahData.findIndex(item => item.id === deleteId);
                
                if (index !== -1) {
                    bankSampahData.splice(index, 1);
                    renderTable();
                    modalKonfirmasiHapus.classList.add('hidden');
                    deleteId = null;
                    showAlert('Data bank sampah berhasil dihapus');
                }
            }
        });

        document.getElementById('btnCloseAlert').addEventListener('click', function() {
            alertSuccess.classList.add('hidden');
        });

        function showAlert(message) {
            alertSuccessMessage.textContent = message;
            alertSuccess.classList.remove('hidden');
            
            setTimeout(() => {
                alertSuccess.classList.add('hidden');
            }, 3000);
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = String(date.getFullYear()).slice(2);
            return `${day}-${month}-${year}`;
        }

        document.getElementById('btnPrev').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
                renderTable();
            }
        });

        document.getElementById('btnNext').addEventListener('click', function() {
            const searchQuery = document.querySelector('input[placeholder="Search"]').value;
            const filteredData = searchBankSampah(searchQuery);
            const maxPage = Math.ceil(filteredData.length / rowsPerPage);
            
            if (currentPage < maxPage) {
                currentPage++;
                updatePagination();
                renderTable();
            }
        });

        for (let i = 1; i <= 5; i++) {
            document.getElementById(`page${i}`).addEventListener('click', function() {
                currentPage = i;
                updatePagination();
                renderTable();
            });
        }

        function updatePagination() {
            for (let i = 1; i <= 5; i++) {
                const pageBtn = document.getElementById(`page${i}`);
                
                if (i === currentPage) {
                    pageBtn.classList.remove('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                    pageBtn.classList.add('bg-[#3D8D7A]', 'text-white');
                } else {
                    pageBtn.classList.remove('bg-[#3D8D7A]', 'text-white');
                    pageBtn.classList.add('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                }
            }
        }

        // Initialize dependencies
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
            
            // Pre-populate location dropdowns with appropriate options
            // In a real implementation, these would likely be fetched from an API
            
            // Cascade selections for province -> city -> district -> subdistrict
            document.querySelectorAll('select[name="provinsi"], #editProvinsi').forEach(select => {
                select.addEventListener('change', function() {
                    // In a real app, you would update city options based on selected province
                    console.log('Province changed:', this.value);
                });
            });
            
            document.querySelectorAll('select[name="kota"], #editKota').forEach(select => {
                select.addEventListener('change', function() {
                    // In a real app, you would update district options based on selected city
                    console.log('City changed:', this.value);
                });
            });
            
            document.querySelectorAll('select[name="kecamatan"], #editKecamatan').forEach(select => {
                select.addEventListener('change', function() {
                    // In a real app, you would update subdistrict options based on selected district
                    console.log('District changed:', this.value);
                });
            });
        });
    </script>
    </body>
</html>