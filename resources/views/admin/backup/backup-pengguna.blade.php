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
                <h1 class="text-2xl font-semibold text-[#3D8D7A]">Kelola Pengguna</h1>
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
                            <th class="py-3 px-4 text-center">Nama Lengkap</th>
                            <th class="py-3 px-4 text-center">Jenis Kelamin</th>
                            <th class="py-3 px-4 text-center">Tanggal Lahir</th>
                            <th class="py-3 px-4 text-center">Email</th>
                            <th class="py-3 px-4 text-center">Total Poin</th>
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
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Form Tambah Pengguna</h2>
                
                <form id="formTambah">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="gender" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="form-control w-full mb-4">
                        <label class="label mb-1">
                            <span class="label-text text-gray-700">Tanggal Lahir <span class="text-red-500">*</span></span>
                        </label>
                        <input 
                            type="date" 
                            name="tanggal_lahir"
                            placeholder="Pilih Tanggal" 
                            class="input input-bordered w-[100%] border border-gray-300 bg-white text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]"
                            required
                        />
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                        <input type="tel" name="telepon" placeholder="Masukkan Nomor Telepon" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" placeholder="Masukkan Email" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" placeholder="Masukkan Password" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Total Poin</label>
                        <input type="number" name="total_poin" placeholder="Masukkan Total Poin" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" value="0">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto<span class="text-red-500">*</span></label>
                        <input type="file" name="foto" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
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
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Edit Pengguna</h2>
                <form id="formEdit">
                    <input type="hidden" id="editId">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="editNama" placeholder="Masukkan Nama Lengkap" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select id="editGender" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" id="editTanggalLahir" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                        <input type="tel" id="editTelepon" placeholder="Masukkan Nomor Telepon" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="editEmail" placeholder="Masukkan Email" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Password</label>
                        <input type="password" id="editPassword" placeholder="Masukkan Password Baru (Kosongkan jika tidak diubah)" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Total Poin</label>
                        <input type="number" id="editTotalPoin" placeholder="Masukkan Total Poin" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto</label>
                        <input type="file" id="editFoto" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto</p>
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
    
    <!-- Modal Detail Pengguna -->
    <div id="modalDetail" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Pengguna</h2>
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
                            <p class="text-sm text-gray-500">ID Pengguna</p>
                            <p id="detailId" class="text-black">USR001</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Nama Lengkap</p>
                            <p id="detailNama" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Jenis Kelamin</p>
                            <p id="detailGender" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Tanggal Lahir</p>
                            <p id="detailTanggalLahir" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Nomor Telepon</p>
                            <p id="detailTelepon" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Email</p>
                            <p id="detailEmail" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Total Poin</p>
                            <p id="detailTotalPoin" class="text-black">-</p>
                        </div>
                    </div>
                    
                    <!-- Foto Pengguna -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Foto Pengguna</p>
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img id="detailFoto" src="/api/placeholder/400/320" alt="Foto Pengguna" class="max-h-full max-w-full rounded-lg object-cover text-black">
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
        // User data structure
        const userData = [
            { 
                id: 1, 
                nama: "Budi Santoso", 
                gender: "Laki-laki",
                tanggal_lahir: "15-03-1990", 
                telepon: "081234567890", 
                email: "budi.santoso@gmail.com",
                password: "hashed_password_1", 
                total_poin: 450,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 2, 
                nama: "Siti Rahma", 
                gender: "Perempuan",
                tanggal_lahir: "22-07-1992", 
                telepon: "081298765432", 
                email: "siti.rahma@gmail.com",
                password: "hashed_password_2", 
                total_poin: 780,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 3, 
                nama: "Andi Pratama", 
                gender: "Laki-laki",
                tanggal_lahir: "04-11-1988", 
                telepon: "085678901234", 
                email: "andi.pratama@gmail.com",
                password: "hashed_password_3", 
                total_poin: 320,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 4, 
                nama: "Dewi Anggraini", 
                gender: "Perempuan",
                tanggal_lahir: "17-09-1995", 
                telepon: "082345678901", 
                email: "dewi.anggraini@gmail.com",
                password: "hashed_password_4", 
                total_poin: 650,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 5, 
                nama: "Agus Hermawan", 
                gender: "Laki-laki",
                tanggal_lahir: "30-05-1987", 
                telepon: "087654321098", 
                email: "agus.hermawan@gmail.com",
                password: "hashed_password_5", 
                total_poin: 180,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 6, 
                nama: "Rina Novita", 
                gender: "Perempuan",
                tanggal_lahir: "12-12-1993", 
                telepon: "089012345678", 
                email: "rina.novita@gmail.com",
                password: "hashed_password_6", 
                total_poin: 520,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 7, 
                nama: "Dodi Setiawan", 
                gender: "Laki-laki",
                tanggal_lahir: "25-04-1991", 
                telepon: "081234987650", 
                email: "dodi.setiawan@gmail.com",
                password: "hashed_password_7", 
                total_poin: 890,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 8, 
                nama: "Nina Wulandari", 
                gender: "Perempuan",
                tanggal_lahir: "08-02-1994", 
                telepon: "082156789012", 
                email: "nina.wulandari@gmail.com",
                password: "hashed_password_8", 
                total_poin: 720,
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 9, 
                nama: "Hendra Wijaya", 
                gender: "Laki-laki",
                tanggal_lahir: "19-10-1989", 
                telepon: "083456789012", 
                email: "hendra.wijaya@gmail.com",
                password: "hashed_password_9", 
                total_poin: 340,
                fotoUrl: "/api/placeholder/400/320"
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

        // Function to search through userData
        function searchUser(query) {
            if (!query) {
                return userData; // Return all data if query is empty
            }
            
            query = query.toLowerCase();
            return userData.filter(item => 
                item.nama.toLowerCase().includes(query) || 
                item.gender.toLowerCase().includes(query) || 
                item.tanggal_lahir.toLowerCase().includes(query) || 
                item.telepon.toLowerCase().includes(query) ||
                item.email.toLowerCase().includes(query) ||
                item.total_poin.toString().includes(query)
            );
        }

        function renderTable() {
            tableBody.innerHTML = '';
            
            // Get search query
            const searchQuery = document.querySelector('input[placeholder="Search"]').value;
            const filteredData = searchUser(searchQuery);
            
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
                            <p class="text-sm">Tidak ada data pengguna yang sesuai dengan pencarian Anda</p>
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
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.gender}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.tanggal_lahir}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.email}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.total_poin}</td>
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

            // Add event listeners for buttons
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
            
            // Update navigation buttons state
            document.getElementById('btnPrev').disabled = currentPage === 1;
            document.getElementById('btnNext').disabled = currentPage === maxPage || maxPage === 0;
            
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

        // Function to format date for display
        function formatDisplayDate(dateString) {
            const dateParts = dateString.split('-');
            if (dateParts.length === 3) {
                return `${dateParts[0]}-${dateParts[1]}-${dateParts[2]}`;
            }
            return dateString;
        }

        // Function to format date for form input
        function formatInputDate(dateString) {
            const dateParts = dateString.split('-');
            if (dateParts.length === 3) {
                return `20${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
            }
            return dateString;
        }

        // Function to open detail modal
        function openDetailModal(id) {
            const data = userData.find(item => item.id === id);
            if (data) {
                document.getElementById('detailId').textContent = `USR${String(data.id).padStart(3, '0')}`;
                document.getElementById('detailNama').textContent = data.nama;
                document.getElementById('detailGender').textContent = data.gender;
                document.getElementById('detailTanggalLahir').textContent = data.tanggal_lahir;
                document.getElementById('detailTelepon').textContent = data.telepon;
                document.getElementById('detailEmail').textContent = data.email;
                document.getElementById('detailTotalPoin').textContent = data.total_poin;
                document.getElementById('detailFoto').src = data.fotoUrl || '/api/placeholder/400/320';
                
                modalDetail.classList.remove('hidden');
            }
        }

        // Function to open edit modal
        function openEditModal(id) {
            const data = userData.find(item => item.id === id);
            if (data) {
                document.getElementById('editId').value = data.id;
                document.getElementById('editNama').value = data.nama;
                document.getElementById('editGender').value = data.gender;
                
                // Format date for the date input field which requires YYYY-MM-DD
                document.getElementById('editTanggalLahir').value = formatInputDate(data.tanggal_lahir);
                
                document.getElementById('editTelepon').value = data.telepon;
                document.getElementById('editEmail').value = data.email;
                document.getElementById('editTotalPoin').value = data.total_poin;
                // Password field is left empty as it would only be updated if a new value is provided
                
                modalEdit.classList.remove('hidden');
            }
        }

        // Function to open delete confirmation modal
        function openDeleteConfirmation(id) {
            deleteId = id;
            modalKonfirmasiHapus.classList.remove('hidden');
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

        // Form Tambah - Cancel button
        document.getElementById('btnBatalkanTambah').addEventListener('click', function() {
            modalTambah.classList.add('hidden');
            document.getElementById('formTambah').reset();
        });

        // Form Tambah - Submit
        document.getElementById('formTambah').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nextId = userData.length > 0 ? Math.max(...userData.map(item => item.id)) + 1 : 1;
            const formElements = this.elements;
            
            const nama = formElements.nama.value;
            const gender = formElements.gender.value;
            const rawDate = formElements.tanggal_lahir.value;
            const tanggal_lahir = formatDate(rawDate);
            const telepon = formElements.telepon.value;
            const email = formElements.email.value;
            const password = formElements.password.value;
            const total_poin = parseInt(formElements.total_poin.value) || 0;
            
            // Handle file input
            const fotoFile = formElements.foto.files[0];
            const fotoUrl = fotoFile ? "/api/placeholder/400/320" : "";
            
            const newData = {
                id: nextId,
                nama,
                gender,
                tanggal_lahir,
                telepon,
                email,
                password: `hashed_password_${nextId}`, // In a real app, this would be properly hashed
                total_poin,
                fotoUrl
            };
            
            userData.push(newData);
            renderTable();
            
            modalTambah.classList.add('hidden');
            this.reset();

            showAlert('Data pengguna berhasil ditambahkan');
        });

        // Form Edit - Cancel button
        document.getElementById('btnBatalkanEdit').addEventListener('click', function() {
            modalEdit.classList.add('hidden');
        });

        // Form Edit - Submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = parseInt(document.getElementById('editId').value);
            const index = userData.findIndex(item => item.id === id);
            
            if (index !== -1) {
                const nama = document.getElementById('editNama').value;
                const gender = document.getElementById('editGender').value;
                const rawDate = document.getElementById('editTanggalLahir').value;
                const tanggal_lahir = formatDate(rawDate);
                const telepon = document.getElementById('editTelepon').value;
                const email = document.getElementById('editEmail').value;
                const newPassword = document.getElementById('editPassword').value;
                const total_poin = parseInt(document.getElementById('editTotalPoin').value) || 0;
                
                // Handle file input
                const fotoFile = document.getElementById('editFoto').files[0];
                const fotoUrl = fotoFile ? "/api/placeholder/400/320" : userData[index].fotoUrl;
                
                // Only update password if a new one is provided
                const password = newPassword ? `hashed_password_new_${id}` : userData[index].password;
                
                userData[index] = {
                    id,
                    nama,
                    gender,
                    tanggal_lahir,
                    telepon,
                    email,
                    password,
                    total_poin,
                    fotoUrl
                };
                
                renderTable();
                modalEdit.classList.add('hidden');
                showAlert('Data pengguna berhasil diperbarui');
            }
        });

        // Delete confirmation - Cancel button
        document.getElementById('btnBatalkanHapus').addEventListener('click', function() {
            modalKonfirmasiHapus.classList.add('hidden');
            deleteId = null;
        });

        // Delete confirmation - Confirm button
        document.getElementById('btnKonfirmasiHapus').addEventListener('click', function() {
            if (deleteId !== null) {
                const index = userData.findIndex(item => item.id === deleteId);
                
                if (index !== -1) {
                    userData.splice(index, 1);
                    renderTable();
                    modalKonfirmasiHapus.classList.add('hidden');
                    deleteId = null;
                    showAlert('Data pengguna berhasil dihapus');
                }
            }
        });

        // Close alert button
        document.getElementById('btnCloseAlert').addEventListener('click', function() {
            alertSuccess.classList.add('hidden');
        });

        // Function to show alert message
        function showAlert(message) {
            alertSuccessMessage.textContent = message;
            alertSuccess.classList.remove('hidden');
            
            setTimeout(() => {
                alertSuccess.classList.add('hidden');
            }, 3000);
        }

        // Format date from YYYY-MM-DD to DD-MM-YY
        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = String(date.getFullYear()).slice(2);
            return `${day}-${month}-${year}`;
        }

        // Pagination - Previous button
        document.getElementById('btnPrev').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
                renderTable();
            }
        });

        // Pagination - Next button
        document.getElementById('btnNext').addEventListener('click', function() {
            const searchQuery = document.querySelector('input[placeholder="Search"]').value;
            const filteredData = searchUser(searchQuery);
            const maxPage = Math.ceil(filteredData.length / rowsPerPage);
            
            if (currentPage < maxPage) {
                currentPage++;
                updatePagination();
                renderTable();
            }
        });

        // Pagination - Page number buttons
        for (let i = 1; i <= 5; i++) {
            document.getElementById(`page${i}`).addEventListener('click', function() {
                currentPage = i;
                updatePagination();
                renderTable();
            });
        }

        // Update pagination UI to reflect current page
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

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
        });
    </script>
    </body>
</html>