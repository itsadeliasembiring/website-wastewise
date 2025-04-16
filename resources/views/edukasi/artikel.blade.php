<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WasteWise - Ubah Sampah Jadi Berkah</title>
        <meta name="description" content="Platform berbasis bank sampah sekaligus media edukasi interaktif untuk mengatasi permasalahan pengelolaan sampah">
        
        @vite('resources/css/app.css')
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
    <body class="font-sans">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <x-header.pengguna/>
    </header>

    <!-- Artikel Section -->
    <section class="pt-10 py-16 px-6 bg-gray-100">
        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-[#3D8D7A] mb-4">Artikel</h2>
            <div class="w-24 h-1 bg-[#3D8D7A] mx-auto mb-6"></div>
        </div>

            <!-- Artikel 1 -->
            <div class="bg-white rounded-xl shadow-md flex flex-col md:flex-row overflow-hidden mb-6 h-64">
                <!-- Gambar -->
                <div class="md:w-1/3 h-full">
                    <img src="{{ asset('assets/waste-wise-artikel.png') }}" alt="WasteWise" class="object-cover w-full h-full">
                </div>
                <!-- Konten Artikel -->
                <div class="p-6 md:w-2/3 flex flex-col justify-between h-full">
                    <div class="flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800">WasteWise: Inovasi Aplikasi Bank Sampah untuk Lingkungan Lebih Bersih</h3>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed text-justify [text-align:justify]">
                            Surabaya - Inovasi teknologi terus berkembang untuk mendukung keberlanjutan lingkungan. 
                            Salah satu solusi terbaru yang hadir adalah WasteWise, sebuah aplikasi bank sampah digital yang dirancang untuk membantu masyarakat dalam mengelola sampah dengan lebih efektif dan efisien.
                            Dengan fitur-fitur canggih dan sistem insentif yang menarik, WasteWise diharapkan mampu meningkatkan kesadaran masyarakat dalam mendaur ......
                        </p>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('detail-artikel') }}" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                    </div>
                </div>
            </div>

            <!-- Artikel 2 -->
            <div class="bg-white rounded-xl shadow-md flex flex-col md:flex-row overflow-hidden mb-6 h-64">
                <!-- Gambar -->
                <div class="md:w-1/3 h-full">
                    <img src="{{ asset('assets/kura-kura.jpg') }}" alt="Sampah di Laut" class="object-cover w-full h-full">
                </div>
                <!-- Konten Artikel -->
                <div class="p-6 md:w-2/3 flex flex-col justify-between h-full">
                    <div class="flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800">Sampah Plastik di Laut Ancam Ekosistem dan Biota Laut</h3>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed text-justify [text-align:justify]">
                            Surabaya - Sampah plastik di laut semakin mengancam ekosistem perairan Indonesia. 
                            Berdasarkan laporan terbaru dari organisasi lingkungan hidup, Indonesia masih menjadi salah satu penyumbang sampah plastik terbesar di dunia. 
                            Sampah yang berakhir di lautan dapat membahayakan kehidupan biota laut, termasuk penyu, ikan, burung laut, dan mamalia laut yang sering kali menelan plastik secara tidak sengaja. 
                            Jika tidak segera ditangani, ......</p>
                    </div>    
                    <div class="text-right">
                        <a href="{{ route('detail-artikel') }}" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                    </div>
                </div>
            </div>

            <!-- Artikel 3 -->
            <div class="bg-white rounded-xl shadow-md flex flex-col md:flex-row overflow-hidden mb-6 h-64">
                <!-- Gambar -->
                <div class="md:w-1/3 h-full">
                    <img src="{{ asset('assets/bersih-pantai.jpg') }}" alt="Aksi Bersih Sampah" class="object-cover w-full h-full">
                </div>
                <!-- Konten Artikel -->
                <div class="p-6 md:w-2/3 flex flex-col justify-between h-full">
                    <div class="flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800">Aksi Bersih Pantai di Surabaya: Warga dan Relawan Bersatu Demi Laut yang Lebih Bersih</h3>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed text-justify [text-align:justify]">
                            Surabaya - Ratusan warga dan relawan lingkungan hidup berkumpul di Pantai Kenjeran, Surabaya, untuk melakukan aksi bersih-bersih pantai. 
                            Kegiatan ini merupakan bagian dari gerakan peduli lingkungan yang bertujuan mengurangi pencemaran sampah di pesisir laut. 
                            Sampah plastik mendominasi temuan dalam aksi ini, mencerminkan masih kurangnya kesadaran masyarakat terhadap dampak buruk limbah terhadap ekosistem .....</p>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('detail-artikel') }}" class="text-teal-700 mt-4 text-sm inline-block font-semibold hover:underline">Baca Selengkapnya »</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Contact Section -->
        <x-footer.guest id="kontak"/>
</body>
</html>
