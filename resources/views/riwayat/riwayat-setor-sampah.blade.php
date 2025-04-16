<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Riwayat Setor Sampah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eefbf4',
                            100: '#d6f5e3',
                            200: '#b0eac8',
                            300: '#7fdaa7',
                            400: '#4cc283',
                            500: '#26a866',
                            600: '#1a8a53',
                            700: '#166e44',
                            800: '#155738',
                            900: '#134830',
                            950: '#092819',
                        },
                    }
                }
            }
        }
    </script>
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .transaction-card {
            transition: all 0.3s ease;
        }
        .transaction-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .pagination-btn {
            transition: all 0.2s ease;
        }
        .pagination-btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">
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

    <!-- Mobile Navigation Bar (Bottom) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white shadow-[0_-2px_10px_rgba(0,0,0,0.1)] z-50">
        <div class="flex justify-around items-center p-3">
            <a href="#" class="flex flex-col items-center text-gray-500 hover:text-primary-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-xs mt-1">Beranda</span>
            </a>
            <a href="#" class="flex flex-col items-center text-gray-500 hover:text-primary-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="text-xs mt-1">Setor</span>
            </a>
            <a href="#" class="flex flex-col items-center text-gray-500 hover:text-primary-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="text-xs mt-1">Edukasi</span>
            </a>
            <a href="#" class="flex flex-col items-center text-primary-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="text-xs mt-1">Riwayat</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6 pb-20 md:pb-6 flex-grow">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-primary-700">Riwayat Setor Sampah</h2>
                <div class="bg-primary-100 rounded-full px-4 py-2 flex items-center gap-2">
                    <img src="{{ asset('Assets/coin.svg') }}" alt="Koin" class="h-5 w-5 text-yellow-500">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    <span class="font-bold text-primary-900">929 Poin</span>
                </div>
            </div>
            
            <!-- Filter Tabs -->
            <div class="mb-8 flex gap-3">
                <button class="bg-primary-600 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-primary-700 transition duration-200 flex-1 md:flex-none">Riwayat Setor Sampah</button>
                <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-50 transition duration-200 flex-1 md:flex-none">Riwayat Tukar Poin</button>
            </div>
            
            <!-- Transaction List -->
            <div class="space-y-4" x-data="{ openModal: false, selectedTransaction: null }">
                <!-- Transaction 1 -->
                <div class="bg-white rounded-lg shadow-sm p-5 transaction-card">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div class="flex-grow">
                            <div class="flex items-start">
                                <div class="bg-primary-100 rounded-lg p-2 mr-4 hidden md:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Bank Sampah Wiyung Surabaya</h3>
                                    <div class="flex flex-wrap items-center text-sm text-gray-500 mt-1 gap-x-3 gap-y-1">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            10 Februari 2025
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            10:33 WIB
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap mt-3 gap-x-6 gap-y-2">
                                        <div>
                                            <p class="text-xs text-gray-500">Total Berat</p>
                                            <p class="font-medium">5Kg</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Layanan</p>
                                            <p class="font-medium flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Jemput
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Status</p>
                                            <p class="font-medium text-yellow-500 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Di Proses
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-end justify-between gap-4">
                            <div class="flex space-x-2">
                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                    Kode
                                </button>
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
                                    class="bg-primary-600 hover:bg-primary-700 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-200"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction 2 -->
                <div class="bg-white rounded-lg shadow-sm p-5 transaction-card">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div class="flex-grow">
                            <div class="flex items-start">
                                <div class="bg-primary-100 rounded-lg p-2 mr-4 hidden md:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Bank Sampah Terpadu</h3>
                                    <div class="flex flex-wrap items-center text-sm text-gray-500 mt-1 gap-x-3 gap-y-1">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            9 Februari 2025
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            7:31 WIB
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap mt-3 gap-x-6 gap-y-2">
                                        <div>
                                            <p class="text-xs text-gray-500">Total Berat</p>
                                            <p class="font-medium">5Kg</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Layanan</p>
                                            <p class="font-medium flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                Langsung
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Status</p>
                                            <p class="font-medium text-primary-600 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Selesai
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-end justify-between gap-4">
                            <span class="text-primary-600 font-medium bg-primary-50 px-3 py-1 rounded-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                100 Poin
                            </span>
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
                                class="bg-primary-600 hover:bg-primary-700 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-200"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            
                <!-- Transaction 3 -->
                <div class="bg-white rounded-lg shadow-sm p-5 transaction-card">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div class="flex-grow">
                            <div class="flex items-start">
                            <div class="bg-primary-100 rounded-lg p-2 mr-4 hidden md:block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Bank Sampah Mulyorejo</h3>
                                <div class="flex flex-wrap items-center text-sm text-gray-500 mt-1 gap-x-3 gap-y-1">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        8 Februari 2025
                                        </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        8:00 WIB
                                    </div>
                                </div>
                                <div class="flex flex-wrap mt-3 gap-x-6 gap-y-2">
                                    <div>
                                        <p class="text-xs text-gray-500">Total Berat</p>
                                        <p class="font-medium">5Kg</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Layanan</p>
                                        <p class="font-medium flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Jemput
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Status</p>
                                        <p class="font-medium text-red-600 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Dibatalkan
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end justify-between gap-4">
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
                }}"
                class="bg-primary-600 hover:bg-primary-700 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Detail
            </button>
        </div>
    </div>
</div>
            
            <!-- Transaction 4 -->
            <div class="bg-white rounded-lg shadow-sm p-5 transaction-card">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div class="flex-grow">
                            <div class="flex items-start">
                                <div class="bg-primary-100 rounded-lg p-2 mr-4 hidden md:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Bank Sampah Airlangga</h3>
                                    <div class="flex flex-wrap items-center text-sm text-gray-500 mt-1 gap-x-3 gap-y-1">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            7 Februari 2025
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            10:30 WIB
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap mt-3 gap-x-6 gap-y-2">
                                        <div>
                                            <p class="text-xs text-gray-500">Total Berat</p>
                                            <p class="font-medium">5Kg</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Layanan</p>
                                            <p class="font-medium flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                Langsung
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Status</p>
                                            <p class="font-medium text-primary-600 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Selesai
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-end justify-between gap-4">
                            <span class="text-primary-600 font-medium bg-primary-50 px-3 py-1 rounded-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                100 Poin
                            </span>
                            <button 
                            @click="openModal = true; selectedTransaction = {
                                id: 4,
                                title: 'Bank Sampah Airlangga',
                                date: '7 Februari 2025',
                                time: '10:30 WIB',
                                service: 'Langsung',
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
                            class="bg-primary-600 hover:bg-primary-700 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-200"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            
            <!-- Transaction 5 -->
            <div class="bg-white rounded-lg shadow-sm p-5 transaction-card">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                        <div class="flex-grow">
                            <div class="flex items-start">
                                <div class="bg-primary-100 rounded-lg p-2 mr-4 hidden md:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-800">Bank Sampah Jojoran I</h3>
                                    <div class="flex flex-wrap items-center text-sm text-gray-500 mt-1 gap-x-3 gap-y-1">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            6 Februari 2025
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            7:30 WIB
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap mt-3 gap-x-6 gap-y-2">
                                        <div>
                                            <p class="text-xs text-gray-500">Total Berat</p>
                                            <p class="font-medium">5Kg</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Layanan</p>
                                            <p class="font-medium flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                Langsung
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Status</p>
                                            <p class="font-medium text-primary-600 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Selesai
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-end justify-between gap-4">
                            <span class="text-primary-600 font-medium bg-primary-50 px-3 py-1 rounded-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                100 Poin
                            </span>
                            <button 
                            @click="openModal = true; selectedTransaction = {
                                id: 5,
                                title: 'Bank Sampah Jojoran I',
                                date: '6 Februari 2025',
                                time: '7:30 WIB',
                                service: 'Langsung',
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
                            class="bg-primary-600 hover:bg-primary-700 text-white px-3 py-1 rounded-md text-sm flex items-center transition duration-200"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
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