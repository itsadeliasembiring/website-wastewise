<!DOCTYPE html>
<html lang="en" class="h-full bg-[#E6E6E6] dark:bg-[#E6E6E6]">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Setor Sampah</title>
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
                <h1 class="text-2xl font-semibold text-[#3D8D7A]">Riwayat Setor Sampah</h1>
                <div class="flex space-x-4">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Search" class="text-black w-64 pl-10 pr-4 py-2 rounded-lg border bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                        <span class="absolute left-3 top-2.5 text-black">
                            <x-fas-search class="w-5 h-5 text-[#3D8D7A]" />
                        </span>
                    </div>
                </div>
            </div>

            <!-- Filter Options -->
            <div class="bg-white rounded-xl p-4 shadow mb-4">
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Filter by Type -->
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-2">Tipe Setor:</span>
                        <select id="filterType" class="rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] text-gray-700 py-1 px-3">
                            <option value="all">Semua</option>
                            <option value="jemput">Dijemput</option>
                            <option value="langsung">Setor Langsung</option>
                        </select>
                    </div>
                    
                    <!-- Filter by Status -->
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-2">Status:</span>
                        <select id="filterStatus" class="rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] text-gray-700 py-1 px-3">
                            <option value="all">Semua</option>
                            <option value="selesai">Selesai</option>
                            <option value="diproses">Diproses</option>
                        </select>
                    </div>
                    
                    <!-- Filter by Date Range -->
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-2">Tanggal:</span>
                        <input type="date" id="startDate" class="rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] text-gray-700 py-1 px-2">
                        <span class="mx-2">-</span>
                        <input type="date" id="endDate" class="rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] text-gray-700 py-1 px-2">
                    </div>
                    
                    <!-- Apply/Reset Filters -->
                    <div class="flex items-center ml-auto">
                        <button id="resetFilter" class="border border-gray-300 text-gray-700 py-1 px-4 rounded-lg hover:bg-gray-50 mr-2">Reset</button>
                        <button id="applyFilter" class="bg-[#3D8D7A] text-white py-1 px-4 rounded-lg hover:bg-[#2C6A5C]">Terapkan</button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-[#3D8D7A] text-white">
                            <th class="py-3 px-4 text-center">No</th>
                            <th class="py-3 px-4 text-left">ID Setor</th>
                            <th class="py-3 px-4 text-left">Tanggal & Waktu</th>
                            <th class="py-3 px-4 text-left">Pengguna</th>
                            <th class="py-3 px-4 text-left">Bank Sampah</th>
                            <th class="py-3 px-4 text-center">Total Berat</th>
                            <th class="py-3 px-4 text-center">Total Poin</th>
                            <th class="py-3 px-4 text-center">Tipe</th>
                            <th class="py-3 px-4 text-center">Status</th>
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
    
    <!-- Modal Detail Setor Sampah -->
    <div id="modalDetail" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Setor Sampah</h2>
                    <button id="btnCloseDetail" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Informasi Setor Sampah -->
                    <div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">ID Setoran</p>
                            <p id="detailId" class="text-black font-semibold">-</p>
                        </div>
                        
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Waktu Setor</p>
                            <p id="detailWaktuSetor" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Kode Verifikasi</p>
                            <p id="detailKodeVerifikasi" class="text-black font-mono bg-gray-50 p-1 rounded inline-block">-</p>
                        </div>
                        
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Status</p>
                            <p id="detailStatus" class="inline-block px-2 py-1 rounded text-white text-sm">-</p>
                        </div>
                    </div>
                    
                    <!-- Informasi Pengguna dan Bank Sampah -->
                    <div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Nama Pengguna</p>
                            <p id="detailNamaPengguna" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">ID Pengguna</p>
                            <p id="detailIdPengguna" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Bank Sampah</p>
                            <p id="detailBankSampah" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Tipe Setor</p>
                            <p id="detailTipeSetor" class="text-black">-</p>
                        </div>
                    </div>
                </div>
                
                <!-- Informasi Lokasi dan Waktu Penjemputan (jika ada) -->
                <div id="detailPenjemputanContainer" class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h3 class="text-md font-semibold mb-2 text-[#3D8D7A]">Informasi Penjemputan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <p class="text-sm text-gray-500">Lokasi Penjemputan</p>
                            <p id="detailLokasiPenjemputan" class="text-black">-</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Waktu Penjemputan</p>
                            <p id="detailWaktuPenjemputan" class="text-black">-</p>
                        </div>
                    </div>
                </div>
                
                <!-- Informasi Sampah dan Poin -->
                <div class="mb-6">
                    <h3 class="text-md font-semibold mb-3 text-[#3D8D7A]">Rincian Sampah</h3>
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="py-2 px-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Sampah</th>
                                    <th class="py-2 px-3 text-right text-xs font-medium text-gray-500 uppercase">Berat (kg)</th>
                                    <th class="py-2 px-3 text-right text-xs font-medium text-gray-500 uppercase">Poin/kg</th>
                                    <th class="py-2 px-3 text-right text-xs font-medium text-gray-500 uppercase">Total Poin</th>
                                </tr>
                            </thead>
                            <tbody id="detailSampahTable">
                            </tbody>
                            <tfoot class="border-t border-gray-200">
                                <tr class="bg-gray-50">
                                    <td class="py-2 px-3 text-left font-medium">Total</td>
                                    <td id="detailTotalBerat" class="py-2 px-3 text-right font-medium text-black">-</td>
                                    <td class="py-2 px-3"></td>
                                    <td id="detailTotalPoin" class="py-2 px-3 text-right font-medium text-black">-</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data for the waste deposit history
        const setorSampahData = [
            {
                id: "STR001",
                waktu_setor: "15 Mar 2023, 09:30",
                tanggal_setor: "2023-03-15",
                total_berat: 5.5,
                total_poin: 275,
                lokasi_penjemputan: "Jl. Mawar No. 10, RT 02/RW 03, Kec. Maju Jaya",
                waktu_penjemputan: "15 Mar 2023, 13:00",
                kode_verifikasi: "ABC123XYZ",
                status: "selesai",
                tipe_setor: "jemput",
                id_pengguna: "USR123",
                nama_pengguna: "Ahmad Rifai",
                bank_sampah: "Bank Sampah Hijau Lestari",
                detail_sampah: [
                    { nama: "Botol Plastik PET", berat: 2.5, poin_per_kg: 50, total_poin: 125 },
                    { nama: "Kardus", berat: 3.0, poin_per_kg: 50, total_poin: 150 }
                ]
            },
            {
                id: "STR002",
                waktu_setor: "22 Apr 2023, 14:15",
                tanggal_setor: "2023-04-22",
                total_berat: 3.2,
                total_poin: 160,
                lokasi_penjemputan: "",
                waktu_penjemputan: "",
                kode_verifikasi: "DEF456UVW",
                status: "selesai",
                tipe_setor: "langsung",
                id_pengguna: "USR456",
                nama_pengguna: "Siti Aminah",
                bank_sampah: "Bank Sampah Bersih Bersama",
                detail_sampah: [
                    { nama: "Kaleng Aluminium", berat: 1.2, poin_per_kg: 75, total_poin: 90 },
                    { nama: "Botol Kaca", berat: 2.0, poin_per_kg: 35, total_poin: 70 }
                ]
            },
            {
                id: "STR003",
                waktu_setor: "04 Jun 2023, 10:45",
                tanggal_setor: "2023-06-04",
                total_berat: 7.8,
                total_poin: 390,
                lokasi_penjemputan: "Perumahan Griya Indah Blok C2 No. 15",
                waktu_penjemputan: "04 Jun 2023, 15:30",
                kode_verifikasi: "GHI789RST",
                status: "selesai",
                tipe_setor: "jemput",
                id_pengguna: "USR789",
                nama_pengguna: "Budi Santoso",
                bank_sampah: "Bank Sampah Peduli Lingkungan",
                detail_sampah: [
                    { nama: "Kertas HVS", berat: 3.5, poin_per_kg: 40, total_poin: 140 },
                    { nama: "Kardus", berat: 2.3, poin_per_kg: 50, total_poin: 115 },
                    { nama: "Botol Plastik PET", berat: 2.0, poin_per_kg: 50, total_poin: 100 },
                    { nama: "Plastik Kemasan", berat: 0.5, poin_per_kg: 70, total_poin: 35 }
                ]
            },
            {
                id: "STR004",
                waktu_setor: "17 Aug 2023, 13:20",
                tanggal_setor: "2023-08-17",
                total_berat: 2.5,
                total_poin: 125,
                lokasi_penjemputan: "",
                waktu_penjemputan: "",
                kode_verifikasi: "JKL012OPQ",
                status: "selesai",
                tipe_setor: "langsung",
                id_pengguna: "USR234",
                nama_pengguna: "Dewi Lestari",
                bank_sampah: "Bank Sampah Mandiri Sejahtera",
                detail_sampah: [
                    { nama: "Botol Plastik PET", berat: 1.5, poin_per_kg: 50, total_poin: 75 },
                    { nama: "Kaleng Aluminium", berat: 1.0, poin_per_kg: 50, total_poin: 50 }
                ]
            },
            {
                id: "STR005",
                waktu_setor: "29 Sep 2023, 09:00",
                tanggal_setor: "2023-09-29",
                total_berat: 4.5,
                total_poin: 225,
                lokasi_penjemputan: "Jl. Anggrek No. 27, RT 05/RW 02",
                waktu_penjemputan: "29 Sep 2023, 11:00",
                kode_verifikasi: "MNO345HIJ",
                status: "selesai",
                tipe_setor: "jemput",
                id_pengguna: "USR567",
                nama_pengguna: "Andi Wijaya",
                bank_sampah: "Bank Sampah Bumi Sehat",
                detail_sampah: [
                    { nama: "Kardus", berat: 2.5, poin_per_kg: 50, total_poin: 125 },
                    { nama: "Kertas Koran", berat: 2.0, poin_per_kg: 50, total_poin: 100 }
                ]
            },
            {
                id: "STR006",
                waktu_setor: "10 Nov 2023, 11:30",
                tanggal_setor: "2023-11-10",
                total_berat: 3.0,
                total_poin: 150,
                lokasi_penjemputan: "",
                waktu_penjemputan: "",
                kode_verifikasi: "PQR678KLM",
                status: "selesai",
                tipe_setor: "langsung",
                id_pengguna: "USR890",
                nama_pengguna: "Nita Susanti",
                bank_sampah: "Bank Sampah Bersih Bersama",
                detail_sampah: [
                    { nama: "Botol Plastik PET", berat: 1.0, poin_per_kg: 50, total_poin: 50 },
                    { nama: "Botol Kaca", berat: 2.0, poin_per_kg: 50, total_poin: 100 }
                ]
            },
            {
                id: "STR007",
                waktu_setor: "24 Dec 2023, 08:45",
                tanggal_setor: "2023-12-24",
                total_berat: 6.2,
                total_poin: 310,
                lokasi_penjemputan: "Jl. Melati No. 8, RT 03/RW 04",
                waktu_penjemputan: "24 Dec 2023, 14:30",
                kode_verifikasi: "STU901NOP",
                status: "selesai",
                tipe_setor: "jemput",
                id_pengguna: "USR345",
                nama_pengguna: "Hendra Gunawan",
                bank_sampah: "Bank Sampah Hijau Lestari",
                detail_sampah: [
                    { nama: "Kardus", berat: 3.0, poin_per_kg: 50, total_poin: 150 },
                    { nama: "Plastik HDPE", berat: 1.2, poin_per_kg: 50, total_poin: 60 },
                    { nama: "Botol Plastik PET", berat: 2.0, poin_per_kg: 50, total_poin: 100 }
                ]
            },
            {
                id: "STR008",
                waktu_setor: "05 Jan 2024, 15:10",
                tanggal_setor: "2024-01-05",
                total_berat: 2.7,
                total_poin: 135,
                lokasi_penjemputan: "",
                waktu_penjemputan: "",
                kode_verifikasi: "VWX234QRS",
                status: "selesai",
                tipe_setor: "langsung",
                id_pengguna: "USR678",
                nama_pengguna: "Tia Ramadani",
                bank_sampah: "Bank Sampah Peduli Lingkungan",
                detail_sampah: [
                    { nama: "Kaleng Aluminium", berat: 1.2, poin_per_kg: 75, total_poin: 90 },
                    { nama: "Kertas HVS", berat: 1.5, poin_per_kg: 30, total_poin: 45 }
                ]
            },
            {
                id: "STR009",
                waktu_setor: "19 Feb 2024, 10:25",
                tanggal_setor: "2024-02-19",
                total_berat: 4.0,
                total_poin: 200,
                lokasi_penjemputan: "Apartemen Green View Tower A Unit 1205",
                waktu_penjemputan: "19 Feb 2024, 14:00",
                kode_verifikasi: "YZA567TUV",
                status: "diproses",
                tipe_setor: "jemput",
                id_pengguna: "USR901",
                nama_pengguna: "Rudi Hermawan",
                bank_sampah: "Bank Sampah Mandiri Sejahtera",
                detail_sampah: [
                    { nama: "Kardus", berat: 2.0, poin_per_kg: 50, total_poin: 100 },
                    { nama: "Botol Plastik PET", berat: 1.5, poin_per_kg: 50, total_poin: 75 },
                    { nama: "Kertas Koran", berat: 0.5, poin_per_kg: 50, total_poin: 25 }
                ]
            },
            {
                id: "STR010",
                waktu_setor: "08 Mar 2024, 16:40",
                tanggal_setor: "2024-03-08",
                total_berat: 3.5,
                total_poin: 175,
                lokasi_penjemputan: "Jl. Dahlia No. 15, RT 01/RW 06",
                waktu_penjemputan: "09 Mar 2024, 10:00",
                kode_verifikasi: "BCD890WXY",
                status: "diproses",
                tipe_setor: "jemput",
                id_pengguna: "USR234",
                nama_pengguna: "Dewi Lestari",
                bank_sampah: "Bank Sampah Bumi Sehat",
                detail_sampah: [
                    { nama: "Botol Plastik PET", berat: 2.0, poin_per_kg: 50, total_poin: 100 },
                    { nama: "Kardus", berat: 1.5, poin_per_kg: 50, total_poin: 75 }
                ]
            }
        ];

        let currentPage = 1;
        const rowsPerPage = 5;
        let filteredData = [...setorSampahData];

        const tableBody = document.getElementById('tableBody');
        const modalDetail = document.getElementById('modalDetail');

        // Function to search and filter data
        function filterData() {
            const searchQuery = document.getElementById('searchInput').value.toLowerCase();
            const typeFilter = document.getElementById('filterType').value;
            const statusFilter = document.getElementById('filterStatus').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            
            return setorSampahData.filter(item => {
                // Search query filtering
                const matchesSearch = searchQuery === '' || 
                    item.id.toLowerCase().includes(searchQuery) ||
                    item.waktu_setor.toLowerCase().includes(searchQuery) ||
                    item.nama_pengguna.toLowerCase().includes(searchQuery) ||
                    item.bank_sampah.toLowerCase().includes(searchQuery) ||
                    (item.lokasi_penjemputan && item.lokasi_penjemputan.toLowerCase().includes(searchQuery));
                
                // Type filtering
                const matchesType = typeFilter === 'all' || 
                    (typeFilter === 'jemput' && item.tipe_setor === 'jemput') ||
                    (typeFilter === 'langsung' && item.tipe_setor === 'langsung');
                
                // Status filtering
                const matchesStatus = statusFilter === 'all' || item.status === statusFilter;
                
                // Date range filtering
                let matchesDate = true;
                if (startDate && endDate) {
                    const itemDate = new Date(item.tanggal_setor);
                    const start = new Date(startDate);
                    const end = new Date(endDate);
                    end.setHours(23, 59, 59, 999); // Set to end of day
                    matchesDate = itemDate >= start && itemDate <= end;
                }
                
                return matchesSearch && matchesType && matchesStatus && matchesDate;
            });
        }

        function renderTable() {
            tableBody.innerHTML = '';
            
            // Apply filters
            const filteredData = filterData();
            
            // Check if there's data to display
            if (filteredData.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="10" class="py-8 px-4 border-b border-gray-200 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-medium">Data tidak tersedia</p>
                            <p class="text-sm">Tidak ada data setoran yang sesuai dengan filter Anda</p>
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
                
                const statusClass = item.status === 'selesai' 
                    ? 'bg-green-500' 
                    : 'bg-yellow-500';
                
                const tipeLabel = item.tipe_setor === 'jemput' 
                    ? 'Dijemput' 
                    : 'Setor Langsung';
                
                const absoluteIndex = start + index + 1;
                
                row.innerHTML = `
                    <td class="py-3 px-4 text-center border-b border-gray-200">${absoluteIndex}</td>
                    <td class="py-3 px-4 text-left border-b border-gray-200 font-medium">${item.id}</td>
                    <td class="py-3 px-4 text-left border-b border-gray-200">${item.waktu_setor}</td>
                    <td class="py-3 px-4 text-left border-b border-gray-200">${item.nama_pengguna}</td>
                    <td class="py-3 px-4 text-left border-b border-gray-200">${item.bank_sampah}</td>
                    <td class="py-3 px-4 text-center border-b border-gray-200">${item.total_berat} kg</td>
                    <td class="py-3 px-4 text-center border-b border-gray-200">${item.total_poin}</td>
                    <td class="py-3 px-4 text-center border-b border-gray-200">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${item.tipe_setor === 'jemput' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'}">
                            ${tipeLabel}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-center border-b border-gray-200">
                        <span class="inline-block px-2 py-1 rounded text-white text-xs ${statusClass}">
                            ${item.status === 'selesai' ? 'Selesai' : 'Diproses'}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-center border-b border-gray-200">
                        <button class="text-[#3D8D7A] hover:text-[#2C6A5C] focus:outline-none btn-detail" data-id="${item.id}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
            
            // Update event listeners for detail buttons
            document.querySelectorAll('.btn-detail').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    showDetailModal(id);
                });
            });
            
            // Update pagination
            renderPagination();
        }

        // Function to render pagination buttons
        function renderPagination() {
            const totalPages = Math.ceil(filteredData.length / rowsPerPage);
            const pageButtons = [
                document.getElementById('page1'),
                document.getElementById('page2'),
                document.getElementById('page3'),
                document.getElementById('page4'),
                document.getElementById('page5')
            ];
            
            // Update pagination button visibility and active state
            pageButtons.forEach((button, index) => {
                const pageNum = index + 1;
                
                if (pageNum <= totalPages) {
                    button.style.display = 'block';
                    
                    if (pageNum === currentPage) {
                        button.classList.remove('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                        button.classList.add('bg-[#3D8D7A]', 'text-white');
                    } else {
                        button.classList.remove('bg-[#3D8D7A]', 'text-white');
                        button.classList.add('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                    }
                } else {
                    button.style.display = 'none';
                }
            });
            
            // Update previous/next buttons
            document.getElementById('btnPrev').disabled = currentPage === 1;
            document.getElementById('btnNext').disabled = currentPage === totalPages;
            
            // Update button styling based on disabled state
            if (currentPage === 1) {
                document.getElementById('btnPrev').classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                document.getElementById('btnPrev').classList.remove('opacity-50', 'cursor-not-allowed');
            }
            
            if (currentPage === totalPages || totalPages === 0) {
                document.getElementById('btnNext').classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                document.getElementById('btnNext').classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        // Function to show deposit details in modal
        function showDetailModal(id) {
            const item = setorSampahData.find(deposit => deposit.id === id);
            if (!item) return;
            
            // Set basic information
            document.getElementById('detailId').textContent = item.id;
            document.getElementById('detailWaktuSetor').textContent = item.waktu_setor;
            document.getElementById('detailKodeVerifikasi').textContent = item.kode_verifikasi;
            
            // Set status with appropriate styling
            const statusEl = document.getElementById('detailStatus');
            statusEl.textContent = item.status === 'selesai' ? 'Selesai' : 'Diproses';
            statusEl.className = 'inline-block px-2 py-1 rounded text-white text-sm ' + 
                                (item.status === 'selesai' ? 'bg-green-500' : 'bg-yellow-500');
            
            // Set user and bank information
            document.getElementById('detailNamaPengguna').textContent = item.nama_pengguna;
            document.getElementById('detailIdPengguna').textContent = item.id_pengguna;
            document.getElementById('detailBankSampah').textContent = item.bank_sampah;
            
            // Set deposit type
            document.getElementById('detailTipeSetor').textContent = item.tipe_setor === 'jemput' ? 'Dijemput' : 'Setor Langsung';
            
            // Handle pickup information container
            const penjemputanContainer = document.getElementById('detailPenjemputanContainer');
            if (item.tipe_setor === 'jemput') {
                penjemputanContainer.style.display = 'block';
                document.getElementById('detailLokasiPenjemputan').textContent = item.lokasi_penjemputan;
                document.getElementById('detailWaktuPenjemputan').textContent = item.waktu_penjemputan;
            } else {
                penjemputanContainer.style.display = 'none';
            }
            
            // Populate waste details table
            const sampahTable = document.getElementById('detailSampahTable');
            sampahTable.innerHTML = '';
            
            item.detail_sampah.forEach(sampah => {
                const row = document.createElement('tr');
                row.className = 'border-t border-gray-200';
                row.innerHTML = `
                    <td class="py-2 px-3 text-left text-sm text-black ">${sampah.nama}</td>
                    <td class="py-2 px-3 text-right text-sm text-black">${sampah.berat} kg</td>
                    <td class="py-2 px-3 text-right text-sm text-black">${sampah.poin_per_kg}</td>
                    <td class="py-2 px-3 text-right text-sm text-black">${sampah.total_poin}</td>
                `;
                sampahTable.appendChild(row);
            });
            
            // Set total weight and points
            document.getElementById('detailTotalBerat').textContent = `${item.total_berat} kg`;
            document.getElementById('detailTotalPoin').textContent = item.total_poin;
            
            // Show modal
            modalDetail.classList.remove('hidden');
        }

        // Function to render table with given data
        function renderTable() {
            tableBody.innerHTML = '';
            
            // Apply filters
            filteredData = filterData();
            
            // Check if there's data to display
            if (filteredData.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="10" class="py-8 px-4 border-b border-gray-200 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-medium">Data tidak tersedia</p>
                            <p class="text-sm">Tidak ada data setoran yang sesuai dengan filter Anda</p>
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
                
                const statusClass = item.status === 'selesai' 
                    ? 'bg-green-500' 
                    : 'bg-yellow-500';
                
                const tipeLabel = item.tipe_setor === 'jemput' 
                    ? 'Dijemput' 
                    : 'Setor Langsung';
                
                const absoluteIndex = start + index + 1;
                
                row.innerHTML = `
                    <td class="py-3 px-4 text-center border-b border-gray-200 text-black">${absoluteIndex}</td>
                    <td class="py-3 px-4 text-left border-b border-gray-200 text-black text-black">${item.id}</td>
                    <td class="py-3 px-4 text-left border-b border-gray-200 text-black">${item.waktu_setor}</td>
                    <td class="py-3 px-4 text-left border-b border-gray-200 text-black">${item.nama_pengguna}</td>
                    <td class="py-3 px-4 text-left border-b border-gray-200 text-black">${item.bank_sampah}</td>
                    <td class="py-3 px-4 text-center border-b border-gray-200 text-black">${item.total_berat} kg</td>
                    <td class="py-3 px-4 text-center border-b border-gray-200 text-black">${item.total_poin}</td>
                    <td class="py-3 px-4 text-center border-b border-gray-200 text-black">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${item.tipe_setor === 'jemput' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'}">
                            ${tipeLabel}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-center border-b border-gray-200">
                        <span class="inline-block px-2 py-1 rounded text-white text-xs ${statusClass}">
                            ${item.status === 'selesai' ? 'Selesai' : 'Diproses'}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-center border-b border-gray-200">
                        <button class="text-[#3D8D7A] hover:text-[#2C6A5C] focus:outline-none btn-detail" data-id="${item.id}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
            
            // Update event listeners for detail buttons
            document.querySelectorAll('.btn-detail').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    showDetailModal(id);
                });
            });
            
            // Update pagination
            renderPagination();
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', () => {
            // Initial render
            renderTable();
            
            // Search input
            document.getElementById('searchInput').addEventListener('keyup', (event) => {
                if (event.key === 'Enter') {
                    currentPage = 1;
                    renderTable();
                }
            });
            
            // Filter button
            document.getElementById('applyFilter').addEventListener('click', () => {
                currentPage = 1;
                renderTable();
            });
            
            // Reset button
            document.getElementById('resetFilter').addEventListener('click', () => {
                document.getElementById('searchInput').value = '';
                document.getElementById('filterType').value = 'all';
                document.getElementById('filterStatus').value = 'all';
                document.getElementById('startDate').value = '';
                document.getElementById('endDate').value = '';
                currentPage = 1;
                renderTable();
            });
            
            // Pagination buttons
            document.getElementById('btnPrev').addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                }
            });
            
            document.getElementById('btnNext').addEventListener('click', () => {
                const totalPages = Math.ceil(filteredData.length / rowsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            });
            
            // Page number buttons
            for (let i = 1; i <= 5; i++) {
                document.getElementById(`page${i}`).addEventListener('click', () => {
                    currentPage = i;
                    renderTable();
                });
            }
            
            // Close detail modal
            document.getElementById('btnCloseDetail').addEventListener('click', () => {
                modalDetail.classList.add('hidden');
            });
            
            // Close modal when clicking outside
            modalDetail.addEventListener('click', (event) => {
                if (event.target === modalDetail) {
                    modalDetail.classList.add('hidden');
                }
            });
            
            // Prevent escape key from closing modal to avoid accidental closures
            window.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !modalDetail.classList.contains('hidden')) {
                    event.preventDefault();
                }
            });
        });
    </script>
    </body>
</html>