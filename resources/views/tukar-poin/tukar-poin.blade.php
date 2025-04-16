<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Tukar Poin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-sertif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10">
        <!-- Header Donasi -->
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-bold text-teal-700 mb-8">Donasi</h2>
            <div class="flex items-center gap-4">
                <!-- Kolom Total Poin + Riwayat -->
                <div class="flex flex-col items-end gap-1 mt-[0.25px]">
                    <!-- Box Total Poin -->
                    <div class="px-3 py-2 rounded-2xl flex items-center gap-2 max-w-[250px]" style="background-color: #A3D1C6;">
                        <!-- Coin Icon -->
                        <div class="bg-yellow-400 p-1 rounded-full">
                            <img src="{{ asset('Assets/coin.svg') }}" alt="Coin Icon" class="h-11 w-11">
                        </div>
                        <!-- Text Total Poin -->
                        <div class="ml-2">
                            <p class="text-base font-bold text-black-700">Total Poin</p>
                            <p class="text-3xl font-extrabold text-teal-700">729</p>
                        </div>
                    </div>
                    <!-- Link Riwayat -->
                    <a href="#" class="text-grey-500 text-sm font-medium underline hover:text-grey-500 mb-5">Riwayat Poin</a>
                </div>
            </div>
        </div>

        <!-- Kartu Donasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-7 mb-12">
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <img src="{{ asset('Assets/rumah-donasi.jpeg') }}" class="w-full object-cover h-46" alt="Panti Asuhan Harapan Sejahtera">
                <div class="p-5">
                    <h3 class="mt-[0.25px] text-xl font-bold mb-1">Panti Asuhan Harapan Sejahtera</h3>
                    <p class="text-sm text-gray-500 mb-4">Jl. Raya Manyar No. 32, Kel. Manyar Sabrangan, Kec. Mulyorejo, Surabaya 60116</p>
                    <button class="border border-teal-500 text-teal-600 px-4 py-2 rounded-lg hover:bg-teal-50 transition duration-300">Donasi</button>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <img src="{{ asset('Assets/rumah-donasi.jpeg') }}" class="w-full object-cover h-46 w-30" alt="Panti Asuhan Cahaya Hati">
                <div class="p-5">
                    <h3 class="mt-[0.25px] text-xl font-bold mb-1">Panti Asuhan Cahaya Hati</h3>
                    <p class="text-sm text-gray-500 mb-4">Jl. Raya Kedung Baruk No. 12, Kel. Kedung Baruk, Kec. Rungkut, Surabaya 60298</p>
                    <button class="border border-teal-500 text-teal-600 px-4 py-2 rounded-lg hover:bg-teal-50 transition duration-300">Donasi</button>
                </div>
            </div>
        </div>

        <!-- Barang Ramah Lingkungan -->
        <h2 class="text-3xl font-bold text-teal-700 text-center mb-8">Barang Ramah Lingkungan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Produk 1 -->
            <div class="bg-white shadow-sm rounded-xl p-4 text-center">
                <img src="{{ asset('Assets/tempat-minum.jpeg') }}" class="mx-auto h-36 w-36 object-cover mb-4 rounded-lg" alt="Botol Minum">
                <h3 class="font-semibold text-base">Botol Minum Stainless Steel</h3>
                <p class="text-base text-gray-500 mb-3">120 poin</p>
                <button class="w-full border border-teal-500 text-teal-600 py-2 rounded-lg hover:bg-teal-50 transitio duration-300">Tukar</button>
            </div>

            <!-- Produk 2 -->
            <div class="bg-white shadow-sm rounded-xl p-4 text-center">
                <img src="{{ asset('Assets/gelas-bambu.jpeg') }}" class="mx-auto h-36 w-36 object-cover mb-4 rounded-lg" alt="Gelas Bambu">
                <h3 class="font-semibold text-base">Gelas dari Bahan Bambu</h3>
                <p class="text-base text-gray-500 mb-3">95 poin</p>
                <button class="w-full border border-teal-500 text-teal-600 py-2 rounded-lg hover:bg-teal-50 transitio duration-300">Tukar</button>
            </div>

            <!-- Produk 3 -->
            <div class="bg-white shadow-sm rounded-xl p-4 text-center">
                <img src="{{ asset('Assets/tote-bag.jpeg') }}" class="mx-auto h-36 w-36 object-cover mb-4 rounded-lg" alt="Tote Bag">
                <h3 class="font-semibold text-base">Tote Bag Ramah Lingkungan</h3>
                <p class="text-base text-gray-500 mb-3">75 poin</p>
                <button class="w-full border border-teal-500 text-teal-600 py-2 rounded-lg hover:bg-teal-50 transitio duration-300">Tukar</button>
            </div>

            <!-- Produk 4 -->
            <div class="bg-white shadow-sm rounded-xl p-4 text-center">
                <img src="{{ asset('Assets/set-makan-kayu.jpeg') }}" class="mx-auto h-36 w-36 object-cover mb-4 rounded-lg" alt="Alat Makan Kayu">
                <h3 class="font-semibold text-base">Alat Makan dari Bahan Kayu</h3>
                <p class="text-base text-gray-500 mb-3">86 poin</p>
                <button class="w-full border border-teal-500 text-teal-600 py-2 rounded-lg hover:bg-teal-50 transitio duration-300">Tukar</button>
            </div>
        </div>
    </main>
</body>
</html>