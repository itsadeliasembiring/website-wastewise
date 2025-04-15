<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Detail Artikel</title>
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
                <a href="#" class="text-green-600 font-semibold">Edukasi</a>
                <a href="#">Tukar Poin</a>
                <a href="#">Riwayat</a>
            </div>
            <img src="{{ asset('Assets/adudu.jpeg') }}" class="h-11 w-11 bg-green-200 rounded-full" alt="User">
        </div>
    </nav>

    <!-- Konten Artikel -->
    <main class="bg-gray-45 py-6">
        <div class="container mx-auto px-4">

            <!-- Gambar Utama -->
            <div class="mt-3">
                <div class="flex flex-col items-center justify-center py-18 mb-8">
                    <img src="{{ asset('Assets/waste-wise-artikel.png') }}" alt="WasteWise Banner" 
                        class="w-full max-w-5xl mx-auto rounded-xl">
                </div>
            </div>

            <div class="max-w-5xl mx-auto">
                <!-- Judul Artikel -->
                <h1 class="text-3xl md:text-3xl font-bold text-gray-900 mb-3 text-justify">
                    WasteWise: Inovasi Aplikasi Bank Sampah untuk Lingkungan Lebih Bersih
                </h1>

                <!-- Meta -->
                <div class="flex items-center mb-6">
                    <div class="bg-gray-200 rounded-full p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[#3D8D7A] font-semibold text-base">Nama Bank Sampah</p>
                        <p class="text-sm text-gray-500">17/02/2024, 08:30 WIB</p>
                    </div>
                </div>

                <!-- Isi Artikel -->
                <div class="text-base text-gray-700 leading-relaxed space-y-4 mb-12 text-justify [text-align:justify]">
                    <p>
                        Surabaya - Inovasi teknologi terus berkembang untuk mendukung keberlanjutan lingkungan. Salah satu solusi terbaru yang hadir adalah WasteWise, sebuah aplikasi bank sampah digital yang dirancang untuk membantu masyarakat dalam mengelola sampah dengan lebih efektif dan efisien. Dengan fitur-fitur canggih dan sistem insentif yang menarik, WasteWise diharapkan mampu meningkatkan kesadaran masyarakat dalam mendaur ulang sampah serta mendorong praktik pengelolaan limbah yang lebih bertanggung jawab.
                    </p>
                    <p>
                        Aplikasi ini menawarkan berbagai fitur unggulan, termasuk pencatatan transaksi sampah, edukasi mengenai jenis-jenis sampah dan cara pengolahannya, serta program insentif berbasis poin yang dapat ditukarkan dengan berbagai hadiah menarik. Dengan adanya sistem insentif ini, pengguna semakin termotivasi untuk memilah dan mendaur ulang sampah mereka secara lebih aktif.
                    </p>
                    <p>
                        CEO WasteWise, Adelia Trisna, menyatakan bahwa aplikasi ini hadir sebagai jawaban atas permasalahan sampah yang kian meningkat di Indonesia. Menurutnya, masih banyak masyarakat yang belum memiliki kebiasaan memilah sampah, sehingga limbah yang seharusnya dapat didaur ulang justru berakhir di tempat pembuangan akhir.
                    </p>
                    <p>
                        “Kami ingin mengubah cara pandang masyarakat tentang sampah. Dengan WasteWise, sampah bukan lagi limbah yang harus dibuang, tetapi bisa memiliki nilai ekonomi. Kami berharap aplikasi ini dapat membantu menciptakan lingkungan yang lebih bersih serta meningkatkan kesejahteraan masyarakat melalui konsep ekonomi sirkular,” ujar Adelia.
                    </p>
                    <p>
                        Dukungan teknologi yang diterapkan dalam WasteWise memungkinkan pengguna untuk melacak dan memantau jumlah sampah yang telah mereka kumpulkan serta dampak positif yang telah mereka ciptakan terhadap lingkungan. Aplikasi ini juga dilengkapi dengan modul edukasi interaktif yang memberikan informasi tentang pengolahan sampah organik dan anorganik, serta cara mengurangi limbah rumah tangga secara efektif.
                    </p>
                    <p>
                        Saat ini, WasteWise sudah tersedia untuk diunduh di perangkat berbasis Android maupun iOS. Dengan semakin banyaknya pengguna yang bergabung, diharapkan aplikasi ini dapat menjadi solusi nyata dalam mengatasi permasalahan sampah dan membangun budaya peduli lingkungan di Indonesia.
                    </p>
                </div>

                <!-- Artikel Lainnya -->
                <h2 class="text-xl font-bold text-[#1C5EAC] mb-6">Baca Artikel Lainnya</h2>
                <div class="space-y-6">

                <!-- Artikel Terkait 1 -->
                <div class="bg-white border border-gray-200 shadow-md rounded-xl overflow-hidden flex flex-col sm:flex-row h-[200px]">
                    <img src="{{ asset('Assets/kura-kura.jpg') }}" alt="Sampah di Laut" 
                         class="w-full sm:w-1/3 h-48 sm:h-full object-cover">
                    <div class="p-4 flex flex-col justify-between sm:w-2/3">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Sampah Plastik di Laut Ancam Ekosistem dan Biota Laut</h3>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed text-justify">
                                Surabaya - Sampah plastik di laut semakin mengancam ekosistem perairan Indonesia. Berdasarkan laporan terbaru dari organisasi lingkungan hidup, jumlah sampah yang tersebar di lautan semakin meningkatkan kekhawatiran biota laut, terutama kura-kura, banteng, dan fauna laut. Sisa makanan dari penangkap ikan yang sering kali melewati plastik secara tidak sengaja. Jika tidak segera ditangani...
                            </p>
                        </div>
                        <div class="text-right pt-2 mt-auto">
                            <a href="#" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                        </div>
                    </div>
                </div>

                <!-- Artikel Terkait 2 -->
                <div class="bg-white border border-gray-200 shadow-md rounded-xl overflow-hidden flex flex-col sm:flex-row h-[200px]">
                    <img src="{{ asset('Assets/bersih-pantai.jpg') }}" alt="Bersih Pantai" 
                        class="w-full sm:w-1/3 h-48 sm:h-full object-cover">
                    <div class="p-4 flex flex-col justify-between sm:w-2/3">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Aksi Bersih Pantai di Surabaya: Warga dan Relawan Bersatu Demi Laut yang Lebih Bersih</h3>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed text-justify">
                                Surabaya - Ratusan warga dan relawan lingkungan hidup berkumpul di Pantai Kenjeran, Surabaya, untuk melakukan aksi bersih-bersih pantai. Kegiatan ini merupakan bagian dari gerakan peduli lingkungan yang bertujuan mengurangi pencemaran sampah di pesisir laut. Sampah plastik mendominasi temuan.....
                            </p>
                        </div>
                        <div class="text-right pt-2 mt-auto">
                            <a href="#" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Contact Section -->
    <section id="kontak" class="relative bg-[#3D8D7A] text-white">
        <!-- Wave Decoration Top -->
        <div class="absolute top-0 left-0 right-0 transform rotate-180">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-full">
                <path fill="#ffffff" fill-opacity="1" d="M0,96L80,80C160,64,320,32,480,32C640,32,800,64,960,69.3C1120,75,1280,53,1360,42.7L1440,32L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>                </svg>
        </div>

        <div class="container mx-auto px-4 py-16 pt-32">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="pl-15">
                    <img src="{{ asset('Assets/logo-wastewise.svg') }}" alt="WasteWise Logo" class="h-30 w-30">
                    <h2 class="text-2xl font-bold">WasteWise</h2>
                    <p class="text-[16px] text-white">"Ubah Sampah Jadi Berkah"</p>
                </div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Fitur</h2>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-emerald-200">Halaman Beranda</a></li>
                        <li><a href="#" class="hover:text-emerald-200">Layanan</a></li>
                        <li><a href="#" class="hover:text-emerald-200">Artikel</a></li>
                        <li><a href="#" class="hover:text-emerald-200">Kontak Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h2 class="text-2xl font-bold mb-4">Kontak Kami</h2>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21.714 3 15 3 8V5z" />
                            </svg>
                            <span>+62 812 005 2315</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>wastewisegyu53@gmail.com</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jalan Pengabdi No. 101 G Rungkut, Surabaya, Indonesia 123456</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</body>
</html>