<!DOCTYPE html>
<html lang="en" class="h-full bg-[#E6E6E6] dark:bg-[#E6E6E6]">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full w-full">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 h-16 bg-white shadow-sm w-full">
        <x-header.admin/>
    </header>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-20 bottom-0 transition-all duration-300 bg-white">
        <x-sidebar.admin />
    </aside>

   <!-- Main Content -->
   <main class="min-h-screen pt-25 overflow-y-auto sm:pl-[70px] xl:pl-15 mt-2 mb-6">
        <div class="max-w-7xl px-5">
            <div class="flex justify-between items-center mb-3">
                <h1 class="text-2xl font-semibold text-[#3D8D7A]">Kelola Artikel</h1>
                <div class="flex space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Search" class="text-black w-64 pl-10 pr-4 py-2 rounded-lg border bg-white border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                        <span class="absolute left-3 top-2.5 text-black">
                            <x-fas-search class="w-5 h-5 text-[#3D8D7A]" />
                        </span>
                    </div>
                    <button id="btnTambah" class="bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white px-4 py-2 rounded-lg flex items-center">
                        <x-fas-plus class="w-5 h-5 text-[#fff] mr-2"/> Tambah
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-[#3D8D7A] text-white">
                            <th class="py-3 px-4 text-center">No</th>
                            <th class="py-3 px-4 text-center">Judul Artikel</th>
                            <th class="py-3 px-4 text-center">Waktu Publikasi</th>
                            <th class="py-3 px-4 text-center">Bank Sampah</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-end mt-4 space-x-2 mb-5">
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnPrev">Prev</button>
                <button class="px-3 py-1 rounded bg-[#3D8D7A] text-white" id="page1">1</button>
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="page2">2</button>
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="page3">3</button>
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="page4">4</button>
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="page5">5</button>
                <button class="px-3 py-1 rounded border border-gray-300 text-gray-700 hover:bg-gray-100" id="btnNext">Next</button>
            </div>
        </div>
    </main>

    <!-- Modal Form Tambah -->
    <div id="modalTambah" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full px-6 py-10 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Form Tambah Artikel</h2>
                
                <form id="formTambah">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" placeholder="Masukkan Judul Artikel" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Konten Artikel <span class="text-red-500">*</span></label>
                        <textarea name="konten" placeholder="Masukkan isi artikel" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required rows="6"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Bank Sampah <span class="text-red-500">*</span></label>
                        <select name="bankSampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Bank Sampah</option>
                            <option value="1">Bank Sampah Hijau Lestari</option>
                            <option value="2">Bank Sampah Bersih Bersama</option>
                            <option value="3">Bank Sampah Peduli Lingkungan</option>
                            <option value="4">Bank Sampah Mandiri Sejahtera</option>
                            <option value="5">Bank Sampah Bumi Sehat</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto Artikel<span class="text-red-500">*</span></label>
                        <input type="file" name="fotoArtikel" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanTambah" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                        <button type="submit" class="w-1/2 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Form Edit -->
    <div id="modalEdit" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 max-h-screen overflow-y-auto">
                <h2 class="text-xl font-semibold mb-4 text-center text-[#3D8D7A]">Edit Artikel</h2>
                <form id="formEdit">
                    <input type="hidden" id="editId">
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                        <input type="text" id="editJudul" placeholder="Masukkan Judul Artikel" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Konten Artikel <span class="text-red-500">*</span></label>
                        <textarea id="editKonten" placeholder="Masukkan isi artikel" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required rows="6"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Bank Sampah <span class="text-red-500">*</span></label>
                        <select id="editBankSampah" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]" required>
                            <option value="">Pilih Bank Sampah</option>
                            <option value="1">Bank Sampah Hijau Lestari</option>
                            <option value="2">Bank Sampah Bersih Bersama</option>
                            <option value="3">Bank Sampah Peduli Lingkungan</option>
                            <option value="4">Bank Sampah Mandiri Sejahtera</option>
                            <option value="5">Bank Sampah Bumi Sehat</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Waktu Publikasi</label>
                        <input type="text" id="editWaktu" class="w-full px-3 py-2 border border-gray-300 text-gray-400 rounded-lg bg-gray-100" disabled>
                        <p class="text-xs text-gray-500 mt-1">Waktu publikasi tidak dapat diubah</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Upload Foto Artikel</label>
                        <input type="file" id="editFoto" class="w-full px-3 py-2 border border-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#3D8D7A]">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah</p>
                    </div>

                    <div class="flex justify-between space-x-4">
                        <button type="button" id="btnBatalkanEdit" class="w-1/2 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                        <button type="submit" class="w-1/2 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="modalKonfirmasiHapus" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 text-center">
                <h2 class="text-xl font-bold mb-3 text-red-500">APAKAH ANDA YAKIN?</h2>
                <div class="flex justify-center mb-3 text-red-500">
                    <x-fas-trash class="w-15 h-15" />
                </div>
                <p class="text-gray-600 mb-6">Data yang terhapus tidak dapat kembali</p>
                
                <div class="flex justify-center space-x-4">
                    <button id="btnBatalkanHapus" class="px-6 py-2 bg-white border border-[#3D8D7A] text-[#3D8D7A] rounded-lg hover:bg-gray-50">Batalkan</button>
                    <button id="btnKonfirmasiHapus" class="px-8 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Ya</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Detail Artikel -->
    <div id="modalDetail" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Artikel</h2>
                    <button id="btnCloseDetail" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Utama -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">ID Artikel</p>
                            <p id="detailId" class="text-black">ART001</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Judul Artikel</p>
                            <p id="detailJudul" class="text-black font-semibold">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Waktu Publikasi</p>
                            <p id="detailWaktu" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Bank Sampah</p>
                            <p id="detailBankSampah" class="text-black">-</p>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">Konten Artikel</p>
                            <div id="detailKonten" class="text-black mt-2 border border-gray-200 rounded-lg p-4 h-52 overflow-y-auto bg-gray-50">-</div>
                        </div>
                    </div>
                    
                    <!-- Foto -->
                    <div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Foto Artikel</p>
                            <div class="w-full h-80 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img id="detailFoto" src="/api/placeholder/400/320" alt="Foto Artikel" class="max-h-full max-w-full rounded-lg object-cover text-black">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Success -->
    <div id="alertSuccess" class="fixed bottom-4 right-4 bg-green-100 border-l-4 border-green-500 text-[#3D8D7A] p-4 rounded shadow-md hidden">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3 text-green-500"></i>
            <div>
                <p class="font-bold">Berhasil!</p>
                <p id="alertSuccessMessage">Operasi berhasil dilakukan.</p>
            </div>
            <button class="ml-6 text-green-500 hover:text-[#3D8D7A]" id="btnCloseAlert">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <script>
        const artikelData = [
            { 
                id: 1, 
                judul: "Cara Efektif Mengelola Sampah Rumah Tangga", 
                waktu: "15 Mar 2023, 09:30", 
                konten: "Sampah rumah tangga adalah masalah yang dihadapi oleh setiap keluarga. Artikel ini membahas berbagai metode praktis untuk mengelola sampah rumah tangga dengan efektif, termasuk cara memilah sampah, teknik pengomposan sederhana, dan tips untuk mengurangi sampah plastik. Dengan menerapkan metode-metode ini, kita dapat berkontribusi pada lingkungan yang lebih bersih dan sehat.\n\nLangkah pertama dalam mengelola sampah adalah memilahnya berdasarkan jenisnya: organik, anorganik, dan B3 (Bahan Berbahaya dan Beracun). Sampah organik seperti sisa makanan dapat diolah menjadi kompos. Sampah anorganik seperti plastik, kertas, dan logam dapat didaur ulang. Sedangkan sampah B3 seperti baterai bekas harus dikelola secara khusus.", 
                bankSampahId: 1,
                bankSampahNama: "Bank Sampah Hijau Lestari",
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 2, 
                judul: "Mengenal Jenis-jenis Plastik yang Dapat Didaur Ulang", 
                waktu: "22 Apr 2023, 14:15", 
                konten: "Plastik adalah material yang sangat umum digunakan dalam kehidupan sehari-hari, namun tidak semua jenis plastik dapat didaur ulang dengan mudah. Artikel ini menjelaskan berbagai jenis plastik yang umum ditemui, kode identifikasinya, dan bagaimana cara mendaur ulangnya dengan benar.\n\nSetiap produk plastik memiliki kode identifikasi yang biasanya tertera pada bagian bawah produk. Kode ini terdiri dari angka 1-7 yang menunjukkan jenis plastik yang digunakan. Misalnya, plastik dengan kode 1 (PET/PETE) biasanya digunakan untuk botol air mineral dan relatif mudah didaur ulang. Sementara plastik dengan kode 3 (PVC) lebih sulit didaur ulang dan dapat mengandung bahan berbahaya.", 
                bankSampahId: 2,
                bankSampahNama: "Bank Sampah Bersih Bersama",
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 3, 
                judul: "Manfaat Ekonomi dari Bank Sampah untuk Masyarakat", 
                waktu: "04 Jun 2023, 10:45", 
                konten: "Bank sampah tidak hanya bermanfaat bagi lingkungan, tetapi juga memberikan manfaat ekonomi yang signifikan bagi masyarakat. Artikel ini mengulas bagaimana bank sampah dapat menjadi sumber pendapatan tambahan bagi warga, menciptakan lapangan kerja baru, dan mengembangkan ekonomi kreatif berbasis daur ulang.\n\nSistem bank sampah memungkinkan masyarakat menukarkan sampah dengan nilai ekonomis. Sampah yang sudah dipilah seperti kertas, plastik, dan logam bisa ditimbang dan dinilai dengan harga tertentu. Nilai tersebut kemudian dicatat dalam buku tabungan dan dapat diambil sewaktu-waktu. Selain itu, sebagian bank sampah juga mengolah sampah menjadi produk kreatif yang memiliki nilai jual lebih tinggi.", 
                bankSampahId: 3,
                bankSampahNama: "Bank Sampah Peduli Lingkungan",
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 4, 
                judul: "Workshop Daur Ulang Sampah Plastik menjadi Kerajinan", 
                waktu: "17 Aug 2023, 13:20", 
                konten: "Bank Sampah Mandiri Sejahtera baru saja menyelenggarakan workshop daur ulang sampah plastik menjadi berbagai produk kerajinan bernilai jual tinggi. Acara yang dihadiri oleh puluhan peserta ini bertujuan untuk mengedukasi masyarakat tentang potensi ekonomi dari sampah plastik sekaligus mengurangi pencemaran lingkungan.\n\nDalam workshop yang berlangsung selama sehari penuh, peserta belajar berbagai teknik pengolahan sampah plastik, mulai dari cara membersihkan, memotong, hingga merangkainya menjadi produk seperti tas, dompet, dan hiasan rumah. Instruktur workshop, Ibu Rini, menekankan bahwa kegiatan ini tidak hanya membantu mengurangi sampah plastik, tetapi juga membuka peluang usaha baru bagi masyarakat.", 
                bankSampahId: 4,
                bankSampahNama: "Bank Sampah Mandiri Sejahtera",
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 5, 
                judul: "Kolaborasi Bank Sampah dengan Sekolah Lokal", 
                waktu: "29 Sep 2023, 09:00", 
                konten: "Bank Sampah Bumi Sehat menjalin kerjasama dengan beberapa sekolah dasar dan menengah di wilayah sekitarnya untuk program edukasi pengelolaan sampah. Program ini melibatkan siswa dalam kegiatan praktis pengelolaan sampah dan memberikan pengetahuan tentang pentingnya menjaga lingkungan sejak usia dini.\n\nMelalui program ini, setiap sekolah dibantu untuk mendirikan bank sampah mini yang dikelola oleh siswa dengan bimbingan guru dan tim dari Bank Sampah Bumi Sehat. Siswa belajar memilah sampah, menimbang, mencatat, dan bahkan mengolah sampah menjadi produk yang bermanfaat. Hasil penjualan sampah dan produk olahan kemudian masuk ke kas sekolah untuk mendukung kegiatan lingkungan lainnya.", 
                bankSampahId: 5,
                bankSampahNama: "Bank Sampah Bumi Sehat",
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 6, 
                judul: "Teknologi Pengolahan Sampah Organik menjadi Kompos", 
                waktu: "10 Nov 2023, 11:30", 
                konten: "Bank Sampah Bersih Bersama memperkenalkan teknologi baru dalam pengolahan sampah organik menjadi kompos berkualitas tinggi. Teknologi yang dikembangkan bersama dengan tim peneliti universitas lokal ini mampu mempercepat proses pengomposan dan menghasilkan kompos dengan kandungan nutrisi yang lebih baik untuk tanaman.\n\nTeknologi ini menggunakan kombinasi mikroorganisme pengurai khusus dan sistem pengaturan suhu otomatis yang memungkinkan proses pengomposan selesai dalam waktu 2 minggu, jauh lebih cepat dibandingkan metode konvensional yang membutuhkan 1-3 bulan. Kompos yang dihasilkan telah diuji di laboratorium dan menunjukkan hasil yang baik untuk berbagai jenis tanaman.", 
                bankSampahId: 2,
                bankSampahNama: "Bank Sampah Bersih Bersama",
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 7, 
                judul: "Kiat Sukses Mendirikan Bank Sampah di Lingkungan Perumahan", 
                waktu: "24 Dec 2023, 08:45", 
                konten: "Mendirikan bank sampah di lingkungan perumahan memiliki tantangan tersendiri. Artikel ini berbagi pengalaman dan tips praktis dari Bank Sampah Hijau Lestari yang telah berhasil mengembangkan jaringan bank sampah di berbagai kompleks perumahan di kota Surabaya.\n\nBeberapa kiat sukses yang dibagikan antara lain: membangun kesadaran masyarakat melalui sosialisasi intensif, membentuk tim pengelola yang solid dan terlatih, menyediakan infrastruktur yang memadai, menjalin kerjasama dengan pengepul dan industri daur ulang, serta mengembangkan program-program inovatif yang melibatkan semua lapisan masyarakat. Dengan pendekatan yang tepat, bank sampah bisa menjadi gerakan sosial yang berkelanjutan di tingkat komunitas.", 
                bankSampahId: 1,
                bankSampahNama: "Bank Sampah Hijau Lestari",
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 8, 
                judul: "Sistem Pencatatan Digital untuk Bank Sampah", 
                waktu: "05 Jan 2024, 15:10", 
                konten: "Di era digital, pengelolaan bank sampah juga perlu memanfaatkan teknologi untuk meningkatkan efisiensi dan transparansi. Bank Sampah Peduli Lingkungan telah mengimplementasikan sistem pencatatan digital yang memudahkan proses administrasi dan memberikan pengalaman lebih baik bagi nasabah.\n\nSistem ini memungkinkan pencatatan transaksi secara real-time, perhitungan otomatis nilai tukar sampah, dan pembuatan laporan berkala yang dapat diakses oleh pengelola maupun nasabah. Nasabah juga dapat mengecek saldo tabungan mereka melalui aplikasi mobile. Implementasi sistem digital ini telah meningkatkan kepercayaan masyarakat dan mendorong lebih banyak orang untuk berpartisipasi dalam program bank sampah.", 
                bankSampahId: 3,
                bankSampahNama: "Bank Sampah Peduli Lingkungan",
                fotoUrl: "/api/placeholder/400/320"
            },
            { 
                id: 9, 
                judul: "Program CSR Perusahaan dalam Mendukung Bank Sampah", 
                waktu: "19 Feb 2024, 10:25", 
                konten: "Perusahaan-perusahaan besar mulai menyadari pentingnya mendukung gerakan bank sampah sebagai bagian dari program tanggung jawab sosial perusahaan (CSR). Artikel ini membahas berbagai bentuk dukungan yang diberikan perusahaan dan dampaknya terhadap keberlanjutan bank sampah.\n\nBeberapa bentuk dukungan yang umum diberikan antara lain: bantuan finansial untuk pengembangan infrastruktur, pelatihan untuk pengelola bank sampah, bantuan pemasaran produk daur ulang, dan program buyback untuk jenis sampah tertentu. Kolaborasi antara sektor bisnis dan bank sampah ini menciptakan simbiosis mutualisme yang menguntungkan semua pihak, termasuk masyarakat dan lingkungan.", 
                bankSampahId: 4,
                bankSampahNama: "Bank Sampah Mandiri Sejahtera",
                fotoUrl: "/api/placeholder/400/320"
            }
        ];

        let currentPage = 1;
        const rowsPerPage = 5;
        let deleteId = null;

        const tableBody = document.getElementById('tableBody');
        const modalTambah = document.getElementById('modalTambah');
        const modalEdit = document.getElementById('modalEdit');
        const modalKonfirmasiHapus = document.getElementById('modalKonfirmasiHapus');
        const modalDetail = document.getElementById('modalDetail');
        const alertSuccess = document.getElementById('alertSuccess');
        const alertSuccessMessage = document.getElementById('alertSuccessMessage');

        // Function to search through articles
        function searchArtikel(query) {
            if (!query) {
                return artikelData; // Return all data if query is empty
            }
            
            query = query.toLowerCase();
            return artikelData.filter(item => 
                item.judul.toLowerCase().includes(query) || 
                item.waktu.toLowerCase().includes(query) || 
                item.konten.toLowerCase().includes(query) || 
                item.bankSampahNama.toLowerCase().includes(query)
            );
        }

        function renderTable() {
            tableBody.innerHTML = '';
            
            // Get search query
            const searchQuery = document.querySelector('input[placeholder="Search"]').value;
            const filteredData = searchArtikel(searchQuery);
            
            // Check if there's data to display
            if (filteredData.length === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="5" class="py-8 px-4 border-b border-gray-200 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-medium">Data tidak tersedia</p>
                            <p class="text-sm">Tidak ada artikel yang sesuai dengan pencarian Anda</p>
                        </div>
                    </td>
                `;
                tableBody.appendChild(emptyRow);
                return;
            }
            
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedData = filteredData.slice(start, end);
            
            paginatedData.forEach((item, index) => {
                const row = document.createElement('tr');
                row.className = index % 2 === 0 ? '' : 'bg-gray-50';
                row.innerHTML = `
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">${start + index + 1}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.judul}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.waktu}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black">${item.bankSampahNama}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-black text-center">
                        <div class="flex justify-center space-x-2">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 btnDetail" data-id="${item.id}">Detail</button>
                            <button class="bg-[#3D8D7A] text-white px-3 py-1 rounded-md hover:bg-[#2C6A5C] btnEdit" data-id="${item.id}">Edit</button>
                            <button class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 btnHapus" data-id="${item.id}">Hapus</button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Add event listeners for buttons
            document.querySelectorAll('.btnDetail').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openDetailModal(id);
                });
            });

            document.querySelectorAll('.btnEdit').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openEditModal(id);
                });
            });

            document.querySelectorAll('.btnHapus').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openDeleteConfirmation(id);
                });
            });
            
            // Update pagination for filtered results
            updatePaginationForFilteredData(filteredData.length);
        }

        // Function to update pagination based on filtered data
        function updatePaginationForFilteredData(totalItems) {
            const maxPage = Math.ceil(totalItems / rowsPerPage);
            
            // Adjust current page if it's beyond max page
            if (currentPage > maxPage && maxPage > 0) {
                currentPage = maxPage;
            }
            
            // Update pagination buttons visibility
            for (let i = 1; i <= 5; i++) {
                const pageBtn = document.getElementById(`page${i}`);
                if (i <= maxPage) {
                    pageBtn.style.display = '';
                } else {
                    pageBtn.style.display = 'none';
                }
            }
            
            updatePagination();
        }

        // Function to open detail modal
        function openDetailModal(id) {
            const data = artikelData.find(item => item.id === id);
            if (data) {
                document.getElementById('detailId').textContent = `ART${String(data.id).padStart(3, '0')}`;
                document.getElementById('detailJudul').textContent = data.judul;
                document.getElementById('detailWaktu').textContent = data.waktu;
                document.getElementById('detailBankSampah').textContent = data.bankSampahNama;
                document.getElementById('detailKonten').textContent = data.konten;
                document.getElementById('detailFoto').src = data.fotoUrl || '/api/placeholder/400/320';
                
                modalDetail.classList.remove('hidden');
            }
        }

        // Function to open edit modal
        function openEditModal(id) {
            const data = artikelData.find(item => item.id === id);
            if (data) {
                document.getElementById('editId').value = data.id;
                document.getElementById('editJudul').value = data.judul;
                document.getElementById('editKonten').value = data.konten;
                document.getElementById('editBankSampah').value = data.bankSampahId;
                document.getElementById('editWaktu').value = data.waktu;
                
                modalEdit.classList.remove('hidden');
            }
        }

        // Function to open delete confirmation modal
        function openDeleteConfirmation(id) {
            deleteId = id;
            modalKonfirmasiHapus.classList.remove('hidden');
        }

        // Initialize the table on page load
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();

            // Add event listener for search input
            document.querySelector('input[placeholder="Search"]').addEventListener('input', function() {
                currentPage = 1; // Reset to first page when searching
                renderTable();
            });

            // Event listener for the add button
            document.getElementById('btnTambah').addEventListener('click', function() {
                modalTambah.classList.remove('hidden');
            });

            // Close detail modal
            document.getElementById('btnCloseDetail').addEventListener('click', function() {
                modalDetail.classList.add('hidden');
            });

            // Cancel add form
            document.getElementById('btnBatalkanTambah').addEventListener('click', function() {
                modalTambah.classList.add('hidden');
                document.getElementById('formTambah').reset();
            });

            // Submit add form
            document.getElementById('formTambah').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const nextId = artikelData.length > 0 ? Math.max(...artikelData.map(item => item.id)) + 1 : 1;
                const formElements = this.elements;
                
                const judul = formElements.judul.value;
                const konten = formElements.konten.value;
                const bankSampahId = parseInt(formElements.bankSampah.value);
                
                // Get bank name from ID
                const bankSampah = getBankSampahName(bankSampahId);
                
                // Get current date and time
                const now = new Date();
                const day = String(now.getDate()).padStart(2, '0');
                const month = getMonthName(now.getMonth());
                const year = now.getFullYear();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const waktu = `${day} ${month} ${year}, ${hours}:${minutes}`;
                
                // Handle file inputs
                const fotoFile = formElements.fotoArtikel.files[0];
                // In a real application, you'd upload the file to server
                const fotoUrl = fotoFile ? "/api/placeholder/400/320" : "";
                
                const newData = {
                    id: nextId,
                    judul: judul,
                    waktu: waktu,
                    konten: konten,
                    bankSampahId: bankSampahId,
                    bankSampahNama: bankSampah,
                    fotoUrl: fotoUrl
                };
                
                artikelData.push(newData);
                renderTable();
                
                modalTambah.classList.add('hidden');
                this.reset();

                showAlert('Artikel berhasil ditambahkan');
            });

            // Cancel edit form
            document.getElementById('btnBatalkanEdit').addEventListener('click', function() {
                modalEdit.classList.add('hidden');
            });

            // Submit edit form
            document.getElementById('formEdit').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const id = parseInt(document.getElementById('editId').value);
                const index = artikelData.findIndex(item => item.id === id);
                
                if (index !== -1) {
                    const judul = document.getElementById('editJudul').value;
                    const konten = document.getElementById('editKonten').value;
                    const bankSampahId = parseInt(document.getElementById('editBankSampah').value);
                    const bankSampah = getBankSampahName(bankSampahId);
                    
                    // Handle file input
                    const fotoFile = document.getElementById('editFoto').files[0];
                    // Only update file URL if new file is provided
                    const fotoUrl = fotoFile ? "/api/placeholder/400/320" : artikelData[index].fotoUrl;
                    
                    artikelData[index] = {
                        ...artikelData[index],
                        judul: judul,
                        konten: konten,
                        bankSampahId: bankSampahId,
                        bankSampahNama: bankSampah,
                        fotoUrl: fotoUrl
                    };
                    
                    renderTable();
                    modalEdit.classList.add('hidden');
                    showAlert('Artikel berhasil diperbarui');
                }
            });

            // Cancel delete confirmation
            document.getElementById('btnBatalkanHapus').addEventListener('click', function() {
                modalKonfirmasiHapus.classList.add('hidden');
                deleteId = null;
            });

            // Confirm delete
            document.getElementById('btnKonfirmasiHapus').addEventListener('click', function() {
                if (deleteId !== null) {
                    const index = artikelData.findIndex(item => item.id === deleteId);
                    
                    if (index !== -1) {
                        artikelData.splice(index, 1);
                        renderTable();
                        modalKonfirmasiHapus.classList.add('hidden');
                        deleteId = null;
                        showAlert('Artikel berhasil dihapus');
                    }
                }
            });

            // Close alert
            document.getElementById('btnCloseAlert').addEventListener('click', function() {
                alertSuccess.classList.add('hidden');
            });

            // Pagination controls
            document.getElementById('btnPrev').addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    updatePagination();
                    renderTable();
                }
            });

            document.getElementById('btnNext').addEventListener('click', function() {
                const searchQuery = document.querySelector('input[placeholder="Search"]').value;
                const filteredData = searchArtikel(searchQuery);
                const maxPage = Math.ceil(filteredData.length / rowsPerPage);
                
                if (currentPage < maxPage) {
                    currentPage++;
                    updatePagination();
                    renderTable();
                }
            });

            for (let i = 1; i <= 5; i++) {
                document.getElementById(`page${i}`).addEventListener('click', function() {
                    currentPage = i;
                    updatePagination();
                    renderTable();
                });
            }
        });

        // Helper function to get month name
        function getMonthName(monthIndex) {
            const months = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ];
            return months[monthIndex];
        }

        // Helper function to get bank sampah name by ID
        function getBankSampahName(id) {
            const bankNames = {
                1: "Bank Sampah Hijau Lestari",
                2: "Bank Sampah Bersih Bersama",
                3: "Bank Sampah Peduli Lingkungan",
                4: "Bank Sampah Mandiri Sejahtera",
                5: "Bank Sampah Bumi Sehat"
            };
            return bankNames[id] || "Bank Sampah Tidak Diketahui";
        }

        // Function to show alert message
        function showAlert(message) {
            alertSuccessMessage.textContent = message;
            alertSuccess.classList.remove('hidden');
            
            setTimeout(() => {
                alertSuccess.classList.add('hidden');
            }, 3000);
        }

        // Function to update pagination UI
        function updatePagination() {
            for (let i = 1; i <= 5; i++) {
                const pageBtn = document.getElementById(`page${i}`);
                
                if (i === currentPage) {
                    pageBtn.classList.remove('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                    pageBtn.classList.add('bg-[#3D8D7A]', 'text-white');
                } else {
                    pageBtn.classList.remove('bg-[#3D8D7A]', 'text-white');
                    pageBtn.classList.add('border', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-100');
                }
            }
        }
    </script>
</body>
</html>