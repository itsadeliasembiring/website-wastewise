<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Riwayat Setor Sampah</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
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
        <h2 class="text-2xl font-bold text-teal-600 mb-4">Riwayat Tukar Poin</h2>
        
        <!-- Stats and Filters -->
        <div class="mb-6 flex justify-between items-center">
            <div class="bg-green-100 rounded-lg px-6 py-2 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.535 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">929 Poin</span>
            </div>
            
            <div class="flex space-x-2">
                <button class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md">Riwayat Setor Sampah</button>
                <button class="bg-green-600 text-white px-4 py-2 rounded-md">Riwayat Tukar Poin</button>
            </div>
        </div>
        
        <!-- Transaction List -->
        <div class="space-y-4">
            <!-- Transaction 1 -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold">Donasi</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            2 Februari 2025
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            7:30 WIB
                        </div>
                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Panti Asuhan Harapan Sejahtera
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-red-500 font-medium">- 100 Poin</span>
                        <button class="mt-6 bg-green-600 text-white px-3 py-1 rounded-md text-sm">Detail</button>
                    </div>
                </div>
            </div>
            
            <!-- Transaction 2 -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold">Barang Eco-Friendly</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            7 Februari 2025
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            7:30 WIB
                        </div>
                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Gelas dari Bahan Bambu
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-red-500 font-medium">- 90 Poin</span>
                        <button class="mt-6 bg-green-600 text-white px-3 py-1 rounded-md text-sm">Detail</button>
                    </div>
                </div>
            </div>
            
            <!-- Transaction 3 -->
            <div class="bg-white rounded-lg shadow-sm p-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold">Donasi</h3>
                        <div class="flex items-center text-sm text-gray-500 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            16 Februari 2025
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            7:30 WIB
                        </div>
                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Panti Asuhan Cahaya Hati
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-red-500 font-medium">- 100 Poin</span>
                        <button class="mt-6 bg-green-600 text-white px-3 py-1 rounded-md text-sm">Detail</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            <div class="flex space-x-2">
                <button class="px-3 py-1 border border-gray-300 rounded text-gray-500">Prev</button>
                <button class="px-3 py-1 bg-green-600 text-white rounded">1</button>
                <button class="px-3 py-1 border border-gray-300 rounded text-gray-500">2</button>
                <button class="px-3 py-1 border border-gray-300 rounded text-gray-500">Next</button>
            </div>
        </div>
    </main>
</body>
</html>