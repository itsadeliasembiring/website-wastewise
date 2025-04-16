<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Detail Artikel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 font-sans">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.guest/>
    </header>

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
                            <a href="{{ route('artikel') }}" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
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
                            <a href="{{ route('artikel') }}" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

        <!-- Contact Section -->
        <x-footer.guest id="kontak"/>

</body>
</html>