<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Setor Sampah</title>
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
                <a href="#" class="text-green-600 font-semibold">Setor Sampah</a>
                <a href="#">Edukasi</a>
                <a href="#">Tukar Poin</a>
                <a href="#">Riwayat</a>
            </div>
            <img src="{{ asset('Assets/adudu.jpeg') }}" class="h-11 w-11 bg-green-200 rounded-full" alt="User">
        </div>
    </nav>

    <!-- Main Content -->
    <main class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-teal-700">Setor Langsung</h2>
                <div class="flex space-x-2">
                    <button class="text-white px-4 py-2 rounded-lg" style="background-color: #3D8D7A;">Setor Langsung</button>
                    <button class="border border-gray-400 text-gray-700 px-4 py-2 rounded-lg">Jemput Sampah</button>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 items-stretch">
                <!-- Pilih Bank Sampah -->
                <div class="bg-white w-full lg:w-1/2 p-6 rounded-xl shadow min-h-[600px]">
                    <h3 class="text-xl font-semibold mb-4 text-center">1. Pilih Bank Sampah Terdekat</h3>
                    <!-- Search Box -->
                     <div class="relative mb-6">
                        <input type="text" placeholder="Search" class="w-full py-2 pl-10 pr-4 bg-gray-100 rounded-full text-gray-700">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Bank List -->
                     <div class="space-y-4">
                        <!-- Bank 1 -->
                        <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 cursor-pointer">
                            <div class="flex items-center">
                                <div class="bg-gray-200 rounded-full p-2 flex-shrink-0">
                                    <img src="{{ asset('assets/bank-sampah.png') }}" alt="Bank Icon" class="w-11 h-11">
                                </div>
                                <div class="ml-3 flex-grow">
                                    <h4 class="font-semibold text-base">Bank Sampah Wiyung</h4>
                                    <p class="text-sm text-gray-500">Jl. Wiyung No 64 Mulyorejo Utara</p>
                                </div>
                                <div class="flex items-center text-green-600">>
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>7 KM</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bank 2 -->
                        <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 cursor-pointer">
                            <div class="flex items-center">
                                <div class="bg-gray-200 rounded-full p-2 flex-shrink-0">
                                    <img src="{{ asset('assets/bank-sampah.png') }}" alt="Bank Icon" class="w-11 h-11">
                                </div>
                                <div class="ml-3 flex-grow">
                                    <h4 class="font-semibold text-base">Bank Sampah Jojoran</h4>
                                    <p class="text-sm text-gray-500">Jl. Jojoran IV No 6 Gubeng</p>
                                </div>
                                <div class="flex items-center text-green-600">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>7 KM</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bank 3 -->
                        <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 cursor-pointer">
                            <div class="flex items-center">
                                <div class="bg-gray-200 rounded-full p-2 flex-shrink-0">
                                    <img src="{{ asset('assets/bank-sampah.png') }}" alt="Bank Icon" class="w-11 h-11">
                                </div>
                                <div class="ml-3 flex-grow">
                                    <h4 class="font-semibold text-base">Bank Sampah Wiyung</h4>
                                    <p class="text-sm text-gray-500">Jl. Wiyung No 64 Mulyorejo Utara</p>
                                </div>
                                <div class="flex items-center text-green-600">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>7 KM</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bank 4 -->
                        <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 cursor-pointer">
                            <div class="flex items-center">
                                <div class="bg-gray-200 rounded-full p-2 flex-shrink-0">
                                    <img src="{{ asset('assets/bank-sampah.png') }}" alt="Bank Icon" class="w-11 h-11">
                                </div>
                                <div class="ml-3 flex-grow">
                                    <h4 class="font-semibold text-base">Bank Sampah Wiyung</h4>
                                    <p class="text-sm text-gray-500">Jl. Wiyung No 64 Mulyorejo Utara</p>
                                </div>
                                <div class="flex items-center text-green-600">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>7 KM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Input Sampah -->
                <div class="bg-white w-full lg:w-1/2 p-6 rounded-xl shadow min-h-[600px] flex flex-col justify-between">
                    <h3 class="text-xl font-semibold mb-4 text-center">2. Input Sampah</h3>
                    <div class="flex-1">
                    <!-- Halaman 1 -->
                    <div id="page-1" class="space-y-4">
                        <!-- Plastik -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('assets/icon-sampah/plastik.png') }}" alt="Plastik" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold text-base">Plastik</h4>
                                    <p class="text-sm text-gray-500">110 Poin/Kg</p>
                                </div>
                            </div>
                            <input type="number" value="10" class="w-16 border rounded px-2 py-1 text-right">
                        </div>
                        <!-- Sampah Makanan -->
                        <div class="bg-gray-50 rounded-lg p-5 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('assets/icon-sampah/organik.png') }}" alt="Sampah Makanan" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold">Sampah Makanan</h4>
                                    <p class="text-sm text-gray-500">90 Poin/Kg</p>
                                </div>
                            </div>
                            <input type="number" value="0" class="w-16 border rounded px-2 py-1 text-right">
                        </div>
                        <!-- Minyak Jelantah -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('assets/icon-sampah/minyak.png') }}" alt="Minyak Jelantah" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold">Minyak Jelantah</h4>
                                    <p class="text-sm text-gray-500">100 Poin/Kg</p>
                                </div>
                            </div>
                            <input type="number" value="3" class="w-16 border rounded px-2 py-1 text-right">
                        </div>
                        <!-- Kertas -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('assets/icon-sampah/kardus.png') }}" alt="Kertas" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold">Kertas</h4>
                                    <p class="text-sm text-gray-500">110 Poin/Kg</p>
                                </div>
                            </div>
                            <input type="number" value="2" class="w-16 border rounded px-2 py-1 text-right">
                        </div>
                        <!-- Kaleng -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('assets/icon-sampah/kaleng.png') }}" alt="Kaleng" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold">Kaleng</h4>
                                    <p class="text-sm text-gray-500">120 Poin/Kg</p>
                                </div>
                            </div>
                            <input type="number" value="0" class="w-16 border rounded px-2 py-1 text-right">
                        </div>
                    </div>

                    <!-- Halaman 2 -->
                    <div id="page-2" class="space-y-4 hidden">
                        <!-- Kaca -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('assets/icon-sampah/kaca.png') }}" alt="Kaca" class="w-10 h-102">
                                <div>
                                    <h4 class="font-semibold">Kaca</h4>
                                    <p class="text-sm text-gray-500">120 Poin/Kg</p>
                                </div>
                            </div>
                            <input type="number" value="0" class="w-16 border rounded px-2 py-1 text-right">
                        </div>
                    </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pt-4 flex justify-center space-x-2 text-sm">
                        <button id="prevBtn" class="text-gray-500 hover:underline">Prev</button>
                        <button id="page1Btn" class="bg-green-700 text-white rounded px-3 py-1">1</button>
                        <button id="page2Btn" class="bg-green-700 text-white rounded px-3 py-1">2</button>
                        <button id="nextBtn" class="text-gray-500 hover:underline">Next</button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button class="text-white px-6 py-2 rounded-lg hover:bg-green-800 active:bg-green-900 transition duration-150 ease-in-out" style="background-color: #3D8D7A;">Submit</button>
            </div>
        </div>
    </main>

    <!-- Script Pagination -->
    <script>
        const page1 = document.getElementById('page-1');
        const page2 = document.getElementById('page-2');
        const page1Btn = document.getElementById('page1Btn');
        const page2Btn = document.getElementById('page2Btn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        let currentPage = 1;

        function showPage(page) {
            currentPage = page;
            page1.classList.toggle('hidden', page !== 1);
            page2.classList.toggle('hidden', page !== 2);

            page1Btn.classList.toggle('bg-green-700', page === 1);
            page1Btn.classList.toggle('text-white', page === 1);
            page1Btn.classList.toggle('text-green-700', page !== 1);

            page2Btn.classList.toggle('bg-green-700', page === 2);
            page2Btn.classList.toggle('text-white', page === 2);
            page2Btn.classList.toggle('text-green-700', page !== 2);
        }

        page1Btn.addEventListener('click', () => showPage(1));
        page2Btn.addEventListener('click', () => showPage(2));
        prevBtn.addEventListener('click', () => showPage(Math.max(1, currentPage - 1)));
        nextBtn.addEventListener('click', () => showPage(Math.min(2, currentPage + 1)));
    </script>
</body>
</html>
