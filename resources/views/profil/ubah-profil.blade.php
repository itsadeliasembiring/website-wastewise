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
                <a href="#" class="text-green-600 font-semibold">Tukar Poin</a>
                <a href="#">Riwayat</a>
            </div>
            <img src="{{ asset('Assets/adudu.jpeg') }}" class="h-11 w-11 bg-green-200 rounded-full" alt="User">
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10 flex">

        <!-- Sidebar -->
        <div class="w-72 pr-6">
            <div class="bg-white rounded-lg p-6 shadow-sm mb-6">
                <div class="flex flex-col items-center mb-6">
                    <div class="h-20 w-20 rounded-full overflow-hidden mb-3">
                        <img src="{{ asset('Assets/adudu.jpeg') }}" class="h-full w-full object-cover" alt="Profile picture">
                    </div>
                    <h2 class="font-bold text-lg">Abdul Dudul</h2>
                    <p class="text-sm text-gray-500">adudu2020@gmail.com</p>
                    <p class="text-sm text-gray-500">927 Poin</p>
                </div>
                <div class="border-t border-gray-200 pt-3 flex flex-col gap-5 text-sm font-medium">
                    <a href="#" class="flex items-center text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profil Saya
                    </a>
                    <a href="#" class="flex items-center text-gray-700 hover:text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Ubah Password
                    </a>
                    <a href="#" class="flex items-center text-gray-700 hover:text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar Akun
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="flex-1">
            <div class="bg-white rounded-lg p-8 shadow-sm">
                <h2 class="text-2xl font-semibold text-teal-600 mb-4">Profil Saya</h2>
                <div class="border-t border-gray-200 pt-8">
                    <div class="flex">

                        <!-- Upload Foto -->
                        <div class="w-1/3 flex flex-col items-center">
                            <div class="mb-4">
                                <img src="{{ asset('Assets/adudu.jpeg') }}" class="w-44 h-44 rounded-full object-cover" alt="Profile Photo">
                            </div>
                            <label for="foto-upload" class="cursor-pointer bg-gray-200 text-gray-700 px-6 py-2 rounded-md font-medium mb-2 transition">
                                Pilih Foto
                            </label>
                            <input id="foto-upload" type="file" name="foto" class="hidden" accept="image/jpeg,image/png,image/jpg">
                            <div class="text-xs text-gray-500 text-center">
                                <p>Besar file: maksimum 10 MB</p>
                                <p>Ekstensi file: JPG, JPEG, PNG</p>
                            </div>
                        </div>

                        <!-- Form Biodata -->
                        <div class="w-2/3 pl-8">

                            <!-- Biodata Diri -->
                            <div class="mb-8">
                                <h3 class="text-xl font-semibold text-gray-500 mb-3">Biodata Diri</h3>

                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" value="Abdul Dudul" class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm" placeholder="Nama Lengkap">
                                </div>

                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                    <div class="relative">
                                        <select class="appearance-none w-full border border-grey-300 rounded-md py-2 px-3 text-sm pr-10">
                                            <option selected>Laki-laki</option>
                                            <option>Perempuan</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                    <input type="date" value="1999-08-30" class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm">
                                </div>

                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                    <input type="text" value="Jalan Jojoran I Blok Z No. 100, Mojo, Gubeng, Surabaya, Jawa Timur" class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm" placeholder="Alamat Rumah atau Domisili">
                                </div>
                            </div>

                            <!-- Kontak -->
                            <div>
                                <h3 class="text-xl font-semibold text-gray-500 mb-3">Kontak</h3>

                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <input type="tel" value="081234567890" class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm" placeholder="+62 xxx xxxx xxxx">
                                </div>

                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" value="adudu2020@gmail.com" class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm" placeholder="email@example.com">
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="flex justify-center mt-10">
                                <button class="bg-teal-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-teal-700 transition-colors w-full max-w-xs">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>
</html>