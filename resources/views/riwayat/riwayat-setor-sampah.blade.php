<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Riwayat Setor Sampah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
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
    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <img src="{{ asset('Assets/logo-wastewise.svg') }}" class="h-12 w-12 bg-green-100 rounded-full" alt="Logo">
                <div class="ml-3">
                    <h1 class="text-green-600 font-bold text-lg">WasteWise</h1>
                    <p class="text-xs text-gray-500">"Ubah Sampah Jadi Berkah"</p>
                </div>
            </div>
            <div class="flex gap-6 text-gray-700 font-medium">
                <a href="#">Beranda</a>
                <a href="#">Setor Sampah</a>
                <a href="#">Edukasi</a>
                <a href="#">Tukar Poin</a>
                <a href="#" class="text-green-600 font-semibold">Riwayat</a>
            </div>
            <img src="{{ asset('Assets/adudu.jpeg') }}" class="h-11 w-11 bg-green-200 rounded-full" alt="User">
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold text-teal-700 mb-4">Riwayat Setor Sampah</h2>
        
        <!-- Stats and Filters -->
        <div class="mb-6 flex justify-between items-center">
            <div class="bg-teal-100 rounded-lg px-4 py-2 flex items-center">
                <img src="{{ asset('Assets/coin.svg') }}" class="h-6 w-6 mr-2" alt="Coin Icon">
                <span class="font-bold text-green-900">929 Poin</span>
            </div>
            <div class="flex gap-2">
                <button class="bg-teal-600 text-white px-4 py-2 rounded-md font-medium">Riwayat Setor Sampah</button>
                <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md font-medium">Riwayat Tukar Poin</button>
            </div>
        </div>
        
        <!-- Transaction List -->
        <div class="space-y-4" x-data="{ openModal: false, selectedTransaction: null }">
            <!-- Transaction 1 -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold">Bank Sampah Wiyung Surabaya</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            10 Februari 2025
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            10:33 WIB
                        </div>
                        <div class="flex mt-3 space-x-8">
                            <div>
                                <p class="text-xs text-gray-500">Total Berat</p>
                                <p class="font-medium">5Kg</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Layanan</p>
                                <p class="font-medium">Jemput</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status</p>
                                <p class="font-medium text-yellow-500">Di Proses</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-green-600 font-medium">+ 100 Poin</span>
                        <div class="mt-6 flex space-x-2">
                            <button class="bg-green-600 text-white px-3 py-1 rounded-md text-sm">Code</button>
                            <button 
                                @click="openModal = true; selectedTransaction = {
                                    id: 1,
                                    title: 'Bank Sampah Wiyung Surabaya',
                                    date: '10 Februari 2025',
                                    time: '10:33 WIB',
                                    service: 'Jemput',
                                    status: 'Di Proses',
                                    points: 100,
                                    waste_types: [
                                        {name: 'Kertas', weight: 2, unit: 'Kg'},
                                        {name: 'Plastik', weight: 1.5, unit: 'Kg'},
                                        {name: 'Botol Kaca', weight: 1.5, unit: 'Kg'}
                                    ],
                                    total_weight: 5,
                                    address: 'Jl. Raya Wiyung No. 45, Surabaya',
                                    notes: 'Sampah diletakkan di depan pagar rumah'
                                }"
                                class="mt-6 bg-green-600 text-white px-3 py-1 rounded-md text-sm"
                            >
                                Detail
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            <!-- Transaction 2 -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold">Bank Sampah Terpadu</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            9 Februari 2025
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            7:31 WIB
                        </div>
                        <div class="flex mt-3 space-x-8">
                            <div>
                                <p class="text-xs text-gray-500">Total Berat</p>
                                <p class="font-medium">5Kg</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Layanan</p>
                                <p class="font-medium">Langsung</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status</p>
                                <p class="font-medium text-green-600">Selesai</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-green-600 font-medium">+ 100 Poin</span>
                        <div class="mt-6 flex space-x-2">
                            <button 
                                @click="openModal = true; selectedTransaction = {
                                    id: 2,
                                    title: 'Bank Sampah Terpadu',
                                    date: '9 Februari 2025',
                                    time: '7:31 WIB',
                                    service: 'Langsung',
                                    status: 'Selesai',
                                    points: 100,
                                    waste_types: [
                                        {name: 'Kardus', weight: 3, unit: 'Kg'},
                                        {name: 'Plastik', weight: 2, unit: 'Kg'}
                                    ],
                                    total_weight: 5,
                                    address: 'Jl. Raya Terpadu No. 12, Surabaya',
                                    notes: 'Diantar langsung ke lokasi bank sampah'
                                }"
                                class="bg-green-600 text-white px-3 py-1 rounded-md text-sm"
                            >
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Transaction 3 -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold">Bank Sampah Mulyorejo</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            8 Februari 2025
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            8:00 WIB
                        </div>
                        <div class="flex mt-3 space-x-8">
                            <div>
                                <p class="text-xs text-gray-500">Total Berat</p>
                                <p class="font-medium">5Kg</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Layanan</p>
                                <p class="font-medium">Jemput</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status</p>
                                <p class="font-medium text-red-500">Dibatalkan</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-green-600 font-medium">+ 100 Poin</span>
                        <button 
                            @click="openModal = true; selectedTransaction = {
                                id: 3,
                                title: 'Bank Sampah Mulyorejo',
                                date: '8 Februari 2025',
                                time: '8:00 WIB',
                                service: 'Jemput',
                                status: 'Dibatalkan',
                                points: 100,
                                waste_types: [
                                    {name: 'Plastik', weight: 3, unit: 'Kg'},
                                    {name: 'Elektronik', weight: 2, unit: 'Kg'}
                                ],
                                total_weight: 5,
                                address: 'Jl. Mulyorejo Utara No. 78, Surabaya',
                                notes: 'Dibatalkan karena hujan deras',
                                cancellation_reason: 'Cuaca buruk, akan dijadwal ulang'
                            }"
                            class="mt-6 bg-green-600 text-white px-3 py-1 rounded-md text-sm"
                        >
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Transaction 4 -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold">Bank Sampah Airlangga</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            7 Februari 2025
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            10:30 WIB
                        </div>
                        <div class="flex mt-3 space-x-8">
                            <div>
                                <p class="text-xs text-gray-500">Total Berat</p>
                                <p class="font-medium">5Kg</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Layanan</p>
                                <p class="font-medium">Jemput</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status</p>
                                <p class="font-medium text-green-600">Selesai</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-green-600 font-medium">+ 100 Poin</span>
                        <button 
                            @click="openModal = true; selectedTransaction = {
                                id: 4,
                                title: 'Bank Sampah Airlangga',
                                date: '7 Februari 2025',
                                time: '10:30 WIB',
                                service: 'Jemput',
                                status: 'Selesai',
                                points: 100,
                                waste_types: [
                                    {name: 'Kertas', weight: 1, unit: 'Kg'},
                                    {name: 'Kardus', weight: 2, unit: 'Kg'},
                                    {name: 'Botol Plastik', weight: 2, unit: 'Kg'}
                                ],
                                total_weight: 5,
                                address: 'Jl. Airlangga No. 23, Surabaya',
                                notes: 'Penjemputan tepat waktu'
                            }"
                            class="mt-6 bg-green-600 text-white px-3 py-1 rounded-md text-sm"
                        >
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Transaction 5 -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold">Bank Sampah Jojoran I</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            6 Februari 2025
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            7:30 WIB
                        </div>
                        <div class="flex mt-3 space-x-8">
                            <div>
                                <p class="text-xs text-gray-500">Total Berat</p>
                                <p class="font-medium">5Kg</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Layanan</p>
                                <p class="font-medium">Jemput</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Status</p>
                                <p class="font-medium text-green-600">Selesai</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-green-600 font-medium">+ 100 Poin</span>
                        <button 
                            @click="openModal = true; selectedTransaction = {
                                id: 5,
                                title: 'Bank Sampah Jojoran I',
                                date: '6 Februari 2025',
                                time: '7:30 WIB',
                                service: 'Jemput',
                                status: 'Selesai',
                                points: 100,
                                waste_types: [
                                    {name: 'Botol Plastik', weight: 2.5, unit: 'Kg'},
                                    {name: 'Kaleng', weight: 1.5, unit: 'Kg'},
                                    {name: 'Minyak Jelantah', weight: 1, unit: 'Kg'}
                                ],
                                total_weight: 5,
                                address: 'Jl. Jojoran I No. 56, Surabaya',
                                notes: 'Sampah sudah dipilah'
                            }"
                            class="mt-6 bg-green-600 text-white px-3 py-1 rounded-md text-sm"
                        >
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Detail Modal -->
            <div 
                x-show="openModal" 
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <div 
                    class="bg-white rounded-lg shadow-xl w-[680px] h-[680px] mx-4 flex flex-col overflow-hidden"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    @click.away="openModal = false"
                >
                    <div class="bg-green-600 text-white px-6 py-4 flex justify-between items-center">
                        <h3 class="text-lg font-bold" x-text="selectedTransaction?.title"></h3>
                        <button @click="openModal = false" class="text-white hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="px-6 py-4 overflow-y-auto flex-grow">
                        <div class="p-2">
                            <!-- Transaction Info -->
                            <div class="mb-6">
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Tanggal Setor</p>
                                        <p class="font-medium" x-text="selectedTransaction?.date"></p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Jam</p>
                                        <p class="font-medium" x-text="selectedTransaction?.time"></p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Layanan</p>
                                        <p class="font-medium" x-text="selectedTransaction?.service"></p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Status</p>
                                        <p 
                                            class="font-medium"
                                            :class="{
                                                'text-yellow-500': selectedTransaction?.status === 'Di Proses',
                                                'text-green-600': selectedTransaction?.status === 'Selesai',
                                                'text-red-500': selectedTransaction?.status === 'Dibatalkan'
                                            }"
                                            x-text="selectedTransaction?.status"
                                        ></p>
                                    </div>
                                </div>
                            
                                <!-- Cancellation reason if applicable -->
                                <div x-show="selectedTransaction?.cancellation_reason" class="mb-4 bg-red-50 border border-red-200 rounded-md p-3">
                                    <p class="text-sm text-gray-700">
                                        <span class="font-medium">Alasan Pembatalan:</span> 
                                        <span x-text="selectedTransaction?.cancellation_reason"></span>
                                    </p>
                                </div>
                    
                                <!-- Address -->
                                <div class="mb-4">
                                    <p class="text-sm text-gray-500">Alamat</p>
                                    <p class="font-medium" x-text="selectedTransaction?.address"></p>
                                </div>
                    
                                <!-- Points earned -->
                                <div class="mb-4">
                                    <p class="text-sm text-gray-500">Poin yang Didapatkan</p>
                                    <p class="font-medium text-green-600">+ <span x-text="selectedTransaction?.points"></span> Poin</p>
                                </div>
                    
                                <!-- Notes -->
                                <div class="mb-6">
                                    <p class="text-sm text-gray-500">Catatan</p>
                                    <p class="font-medium" x-text="selectedTransaction?.notes"></p>
                                </div>
                            </div>
                
                            <!-- Waste Types -->
                            <div>
                                <h4 class="font-bold mb-2">Daftar Sampah</h4>
                                <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="text-left text-sm text-gray-500">
                                                <th class="pb-2">Jenis Sampah</th>
                                                <th class="pb-2 text-right">Jumlah (kg)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(waste, index) in selectedTransaction?.waste_types" :key="index">
                                                <tr class="border-t border-gray-200">
                                                    <td class="py-2" x-text="waste.name"></td>
                                                    <td class="py-2 text-right" x-text="`${waste.weight} ${waste.unit}`"></td>
                                                </tr>
                                            </template>
                                            <!-- Total -->
                                            <tr class="border-t border-gray-200 font-medium">
                                                <td class="py-2">Total Berat</td>
                                                <td class="py-2 text-right" x-text="`${selectedTransaction?.total_weight} Kg`"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="bg-gray-50 px-6 py-4 flex justify-end">
                        <button 
                            @click="openModal = false" 
                            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition"
                        >Tutup</button>
                    </div>
                </div>
            </div>
        </div> <!-- gatau hapus atau engga -->
        
        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center space-x-2">
                <button class="w-10 h-10 flex items-center justify-center rounded-md border border-gray-300 text-gray-500 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                <button class="w-10 h-10 flex items-center justify-center rounded-md border border-gray-300 bg-green-600 text-white font-medium">1</button>
                <button class="w-10 h-10 flex items-center justify-center rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">2</button>
                <button class="w-10 h-10 flex items-center justify-center rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">3</button>
                <button class="w-10 h-10 flex items-center justify-center rounded-md border border-gray-300 text-gray-500 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </nav>
        </div>
    </main>
</body>
</html>