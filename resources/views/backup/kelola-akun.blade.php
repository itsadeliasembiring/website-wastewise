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
                <h1 class="text-2xl font-semibold text-[#3D8D7A]">Kelola Akun</h1>
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
                            <th class="py-3 px-4 text-center">ID Akun</th>
                            <th class="py-3 px-4 text-center">Email</th>
                            <th class="py-3 px-4 text-center">Level</th>
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
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Form Tambah Akun</h2>
                
                <form id="formTambah">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" placeholder="Masukkan Email" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" placeholder="Masukkan Password" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Level Akun <span class="text-red-500">*</span></label>
                        <select name="level" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Level</option>
                            <option value="Pengguna">Pengguna</option>
                            <option value="Admin">Admin</option>
                        </select>
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
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Edit Akun</h2>
                <form id="formEdit">
                    <input type="hidden" id="editId">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">ID Akun</label>
                        <input type="text" id="editIdAkun" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg bg-gray-100" readonly>
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
                        <label class="block text-gray-700 mb-2">Level Akun <span class="text-red-500">*</span></label>
                        <select id="editLevel" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Level</option>
                            <option value="Pengguna">Pengguna</option>
                            <option value="Admin">Admin</option>
                        </select>
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
    
    <!-- Modal Detail Akun -->
    <div id="modalDetail" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Akun</h2>
                    <button id="btnCloseDetail" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">ID Akun</p>
                        <p id="detailIdAkun" class="text-black font-medium">-</p>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">Email</p>
                        <p id="detailEmail" class="text-black font-medium">-</p>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-500">Level</p>
                        <p id="detailLevel" class="text-black font-medium">-</p>
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
        const accountData = [
            { 
                id: 1, 
                id_akun: "ACC001", 
                email: "admin@example.com",
                password: "hashed_password_1", 
                level: "Admin"
            },
            { 
                id: 2, 
                id_akun: "ACC002", 
                email: "user1@example.com",
                password: "hashed_password_2", 
                level: "Pengguna"
            },
            { 
                id: 3, 
                id_akun: "ACC003", 
                email: "user2@example.com",
                password: "hashed_password_3", 
                level: "Pengguna"
            },
            { 
                id: 4, 
                id_akun: "ACC004", 
                email: "manager@example.com",
                password: "hashed_password_4", 
                level: "Admin"
            },
            { 
                id: 5, 
                id_akun: "ACC005", 
                email: "user3@example.com",
                password: "hashed_password_5", 
                level: "Pengguna"
            },
            { 
                id: 6, 
                id_akun: "ACC006", 
                email: "staff@example.com",
                password: "hashed_password_6", 
                level: "Admin"
            },
            { 
                id: 7, 
                id_akun: "ACC007", 
                email: "user4@example.com",
                password: "hashed_password_7", 
                level: "Pengguna"
            },
            { 
                id: 8, 
                id_akun: "ACC008", 
                email: "support@example.com",
                password: "hashed_password_8", 
                level: "Admin"
            }
        ];

        let currentPage = 1;
        const rowsPerPage = 8;
        let deleteId = null;

        const tableBody = document.getElementById('tableBody');
        const modalTambah = document.getElementById('modalTambah');
        const modalEdit = document.getElementById('modalEdit');
        const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');
        const modalDetail = document.getElementById('modalDetail');
        const alertSuccess = document.getElementById('alertSuccess');
        const alertSuccessMessage = document.getElementById('alertSuccessMessage');

        // Function to search through accountData
        function searchAccount(query) {
            if (!query) {
                return accountData; // Return all data if query is empty
            }
            
            query = query.toLowerCase();
            return accountData.filter(item => 
                item.id_akun.toLowerCase().includes(query) || 
                item.email.toLowerCase().includes(query) || 
                item.level.toLowerCase().includes(query)
            );
        }

        function renderTable() {
            tableBody.innerHTML = '';
            
            // Get search query
            const searchQuery = document.querySelector('input[placeholder="Search"]').value;
            const filteredData = searchAccount(searchQuery);
            
            // Check if there's data to display
            if (filteredData.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="5" class="py-8 px-4 border-b border-gray-200 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-medium">Data tidak tersedia</p>
                            <p class="text-sm">Tidak ada data akun yang sesuai dengan pencarian Anda</p>
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
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.id_akun}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${item.email}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">
                        <span class="px-2 py-1 rounded-full text-xs ${item.level === 'Admin' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'}">${item.level}</span>
                    </td>
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

        // Function to open detail modal
        function openDetailModal(id) {
            const data = accountData.find(item => item.id === id);
            if (data) {
                document.getElementById('detailIdAkun').textContent = data.id_akun;
                document.getElementById('detailEmail').textContent = data.email;
                document.getElementById('detailLevel').textContent = data.level;
                
                modalDetail.classList.remove('hidden');
            }
        }

        // Function to open edit modal
        function openEditModal(id) {
            const data = accountData.find(item => item.id === id);
            if (data) {
                document.getElementById('editId').value = data.id;
                document.getElementById('editIdAkun').value = data.id_akun;
                document.getElementById('editEmail').value = data.email;
                document.getElementById('editLevel').value = data.level;
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
            
            const nextId = accountData.length > 0 ? Math.max(...accountData.map(item => item.id)) + 1 : 1;
            const formElements = this.elements;
            
            const email = formElements.email.value;
            const password = formElements.password.value;
            const level = formElements.level.value;
            const id_akun = `ACC${String(nextId).padStart(3, '0')}`;
            
            const newData = {
                id: nextId,
                id_akun,
                email,
                password: `hashed_password_${nextId}`, // In a real app, this would be properly hashed
                level
            };
            
            accountData.push(newData);
            renderTable();
            
            modalTambah.classList.add('hidden');
            this.reset();

            showAlert('Data akun berhasil ditambahkan');
        });

        // Form Edit - Cancel button
        document.getElementById('btnBatalkanEdit').addEventListener('click', function() {
            modalEdit.classList.add('hidden');
        });

        // Form Edit - Submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = parseInt(document.getElementById('editId').value);
            const index = accountData.findIndex(item => item.id === id);
            
            if (index !== -1) {
                const email = document.getElementById('editEmail').value;
                const newPassword = document.getElementById('editPassword').value;
                const level = document.getElementById('editLevel').value;
                
                // Only update password if a new one is provided
                const password = newPassword ? `hashed_password_new_${id}` : accountData[index].password;
                
                accountData[index] = {
                    id,
                    id_akun: accountData[index].id_akun,
                    email,
                    password,
                    level
                };
                
                renderTable();
                modalEdit.classList.add('hidden');
                showAlert('Data akun berhasil diperbarui');
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
                const index = accountData.findIndex(item => item.id === deleteId);
                
                if (index !== -1) {
                    accountData.splice(index, 1);
                    renderTable();
                    modalKonfirmasiHapus.classList.add('hidden');
                    deleteId = null;
                    showAlert('Data akun berhasil dihapus');
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
            const filteredData = searchAccount(searchQuery);
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

        // Initialize pagination on page load
        updatePagination();

        // Check for clicks outside modals to close them (optional UX improvement)
        window.addEventListener('click', function(e) {
            // Close modals when clicking outside them
            if (e.target.classList.contains('bg-black')) {
                modalTambah.classList.add('hidden');
                modalEdit.classList.add('hidden');
                modalKonfirmasiHapus.classList.add('hidden');
                modalDetail.classList.add('hidden');
                deleteId = null;
            }
        });

        // Initialize search box with empty value
        document.querySelector('input[placeholder="Search"]').value = '';

        // Optional: Add event listener for pressing Enter in search box
        document.querySelector('input[placeholder="Search"]').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                currentPage = 1;
                renderTable();
            }
        });

        // Optional: Clear search button functionality
        // Add this if you want to add a clear search button in the future
        function clearSearch() {
            document.querySelector('input[placeholder="Search"]').value = '';
            currentPage = 1;
            renderTable();
        }

        // Expose functions for potential external use
        window.accountManager = {
            renderTable,
            clearSearch,
            showAlert,
            updatePagination
        };
    </script>
</body>
</html>