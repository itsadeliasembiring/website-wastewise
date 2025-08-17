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

        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>

    

    <!-- Main Content -->
    <main class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-teal-700">Jemput Sampah</h2>
                <div class="flex space-x-2">
                    <button 
                        class="px-4 py-2 rounded-lg font-medium transition duration-200 
                            @if (Route::is('setor-langsung')) text-white @else text-gray-700 border border-gray-400 @endif" 
                        style="@if (Route::is('setor-langsung')) background-color: #3D8D7A; @endif"
                        onclick="window.location.href='{{ route('setor-langsung') }}'">
                        Setor Langsung
                    </button>

                    <button 
                        class="px-4 py-2 rounded-lg font-medium transition duration-200 
                            @if (Route::is('jemput-sampah')) text-white @else text-gray-700 border border-gray-400 @endif" 
                        style="@if (Route::is('jemput-sampah')) background-color: #3D8D7A; @endif"
                        onclick="window.location.href='{{ route('jemput-sampah') }}'">
                        Jemput Sampah
                    </button>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-stretch">
                <!-- Pilih Bank Sampah -->
                <div class="bg-white w-full lg:w-1/3 p-6 rounded-xl shadow">
                    <h3 class="text-xl font-semibold mb-4">1. Pilih Bank Sampah Terdekat</h3>
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
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/bank-sampah.png') }}" alt="Bank Icon" class="w-11 h-11">
                                </div>
                                <div class="ml-3 flex-grow">
                                    <h4 class="font-semibold text-base">Bank Sampah Wiyung</h4>
                                    <p class="text-sm text-gray-500">Jl. Wiyung No 64</p>
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

                        <!-- Bank 2 -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/bank-sampah.png') }}" alt="Bank Icon" class="w-11 h-11">
                                </div>
                                <div class="ml-3 flex-grow">
                                    <h4 class="font-semibold text-base">Bank Sampah Wiyung</h4>
                                    <p class="text-sm text-gray-500">Jl. Wiyung No 64</p>
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
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/bank-sampah.png') }}" alt="Bank Icon" class="w-11 h-11">
                                </div>
                                <div class="ml-3 flex-grow">
                                    <h4 class="font-semibold text-base">Bank Sampah Wiyung</h4>
                                    <p class="text-sm text-gray-500">Jl. Wiyung No 64</p>
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
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/bank-sampah.png') }}" alt="Bank Icon" class="w-11 h-11">
                                </div>
                                <div class="ml-3 flex-grow">
                                    <h4 class="font-semibold text-base">Bank Sampah Wiyung</h4>
                                    <p class="text-sm text-gray-500">Jl. Wiyung No 64</p>
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
                <div class="bg-white w-full lg:w-1/3 p-6 rounded-xl shadow">
                    <h3 class="text-xl font-semibold mb-4">2. Input Sampah</h3>
                    
                    <div class="space-y-4">
                        <!-- Plastik -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('Assets/Icon-sampah/plastik.png') }}" alt="Plastik" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold text-base">Plastik</h4>
                                    <p class="text-sm text-gray-500">
                                        110 Poin/Kg
                                    </p>
                                </div>
                            </div>
                            <input type="number" value="10" class="w-16 border rounded px-2 py-1 text-right">
                        </div>
                        
                        <!-- Sampah Makanan -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('Assets/Icon-sampah/organik.png') }}" alt="Sampah Makanan" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold text-base">Sampah Makanan</h4>
                                    <p class="text-sm text-gray-500">
                                        90 Poin/Kg
                                    </p>
                                </div>
                            </div>
                            <input type="number" value="0" class="w-16 border rounded px-2 py-1 text-right">
                        </div>
                        
                        <!-- Minyak Jelantah -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('Assets/Icon-sampah/minyak.png') }}" alt="Minyak Jelantah" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold text-base">Minyak Jelantah</h4>
                                    <p class="text-sm text-gray-500">
                                        100 Poin/Kg
                                    </p>
                                </div>
                            </div>
                            <input type="number" value="0" class="w-16 border rounded px-2 py-1 text-right">
                        </div>

                        <!-- Kaca -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('Assets/Icon-sampah/kaca.png') }}" alt="Kaca" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold text-base">Kaca</h4>
                                    <p class="text-sm text-gray-500">
                                        100 Poin/Kg
                                    </p>
                                </div>
                            </div>
                            <input type="number" value="0" class="w-16 border rounded px-2 py-1 text-right">
                        </div>

                        <!-- Kaleng -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('Assets/Icon-sampah/kaleng.png') }}" alt="Kaleng" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold text-base">Kaleng</h4>
                                    <p class="text-sm text-gray-500">
                                        100 Poin/Kg
                                    </p>
                                </div>
                            </div>
                            <input type="number" value="0" class="w-16 border rounded px-2 py-1 text-right">
                        </div>
                        
                        <!-- Kertas -->
                        <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('Assets/Icon-sampah/kardus.png') }}" alt="Kertas" class="w-10 h-10">
                                <div>
                                    <h4 class="font-semibold text-base">Kertas</h4>
                                    <p class="text-sm text-gray-500">
                                        110 Poin/Kg
                                    </p>
                                </div>
                            </div>
                            <input type="number" value="0" class="w-16 border rounded px-2 py-1 text-right">
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="pt-4 flex justify-center space-x-2 text-sm">
                        <div class="flex items-center space-x-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="page" class="form-radio text-wastewise-green" checked>
                                <span class="ml-1 text-wastewise-green"></span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="page" class="form-radio text-gray-300">
                                <span class="ml-1 text-gray-300"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Pilih Alamat -->
                <div class="bg-white w-full lg:w-1/3 p-6 rounded-xl shadow-lg border border-gray-100">
                    <h3 class="text-xl font-semibold mb-4">3. Pilih Alamat Penjemputan</h3>
                    
                    <div class="mb-6">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer transition-all" 
                               :class="{'bg-green-50 border-green-500': useMainAddress, 'hover:bg-gray-50': !useMainAddress}">
                            <input type="radio" name="alamat" class="form-radio w-5 h-5 text-green-600" 
                                   x-model="useMainAddress" :value="true">
                            <div class="ml-3">
                                <h4 class="font-semibold text-gray-800">Alamat Utama</h4>
                                <p class="text-sm text-gray-600 mt-1">
                                    Perumahan Mulyorejo Utara Blok 4D<br>
                                    No 17, Kelurahan Mulyorejo,<br>
                                    Kecamatan Mulyorejo, Kota Surabaya,<br>
                                    Jawa Timur, 60115
                                </p>
                            </div>
                        </label>
                    </div>
                    
                    <div class="mb-6">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer transition-all" 
                               :class="{'bg-green-50 border-green-500': !useMainAddress, 'hover:bg-gray-50': useMainAddress}">
                            <input type="radio" name="alamat" class="form-radio w-5 h-5 text-green-600" 
                                   x-model="useMainAddress" :value="false">
                            <span class="ml-3 font-semibold text-gray-800">Alamat Lainnya</span>
                        </label>
                    </div>
                    
                    <div x-show="!useMainAddress" class="space-y-4 border-t pt-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                <div class="relative">
                                    <select class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        <option>Jawa Timur</option>
                                        <option>Jawa Barat</option>
                                        <option>Jawa Tengah</option>
                                        <option>DKI Jakarta</option>
                                        <option>Bali</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten</label>
                                <div class="relative">
                                    <select class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        <option>Surabaya</option>
                                        <option>Malang</option>
                                        <option>Jember</option>
                                        <option>Bandung</option>
                                        <option>Solo</option>
                                        <option>Denpasar</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                <div class="relative">
                                    <select class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        <option>Mulyorejo</option>
                                        <option>Bubutan</option>
                                        <option>Gubeng</option>
                                        <option>Rungkut</option>
                                        <option>Tandes</option>
                                        <option>Kenjeran</option>
                                        <option>Wiyung</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                                <div class="relative">
                                    <select class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        <option>Kalijudan</option>
                                        <option>Gundih</option>
                                        <option>Mojo</option>
                                        <option>Wonorejo</option>
                                        <option>Tandes</option>
                                        <option>Bulak Banteng</option>
                                        <option>Babatan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Detail Alamat</label>
                            <input type="text" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Jalan Mulyorejo Barat No.34 RT 01 RW 06">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                            <input type="text" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="60115">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                            <textarea class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" rows="2" placeholder="Dekat dengan minimarket, rumah cat warna hijau, dll"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Waktu Penjemputan -->
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 mt-6">
                    <h3 class="text-2xl font-semibold mb-6 text-gray-800 border-b pb-3">4. Waktu Penjemputan</h3>
                    
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <p class="text-gray-700 mb-1">Waktu yang dipilih:</p>
                            <p class="text-xl font-semibold text-green-700" x-text="selectedTime"></p>
                        </div>
                        <div class="flex items-center space-x-4 mt-4 md:mt-0">
                            <button @click="showTimePicker = !showTimePicker" class="border border-gray-300 bg-gray-50 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pilih Waktu
                            </button>
                        </div>
                    </div>
                    
                    <div x-show="showTimePicker" class="mt-4 border-t pt-4">
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                            <template x-for="hour in ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00']">
                                <button @click="selectedTime = hour; showTimePicker = false" 
                                        class="px-4 py-2 rounded-lg border transition-all"
                                        :class="{'bg-green-100 border-green-500 text-green-800': selectedTime === hour,
                                                'border-gray-300 hover:bg-gray-50': selectedTime !== hour}">
                                    <span x-text="hour"></span>
                                </button>
                            </template>
                        </div>
                        <p class="text-sm text-gray-500 mt-3">* Waktu penjemputan tersedia pukul 08.00 - 16.00 WIB</p>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end">
                    <div class="flex space-x-4">
                        <button class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                            Kembali
                        </button>
                        <button class="px-8 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                            Konfirmasi Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>