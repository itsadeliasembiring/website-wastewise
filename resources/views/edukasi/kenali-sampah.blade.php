<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Kenali Sampah</title>
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

    <!-- Main Content -->
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-bold text-teal-700 mb-6 px-4">Botol Plastik</h2>
        
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-6 px-5">
            <!-- Left Section -->
            <div class="bg-white rounded-lg shadow-sm p-6 md:w-1/2">
                <img src="{{ asset('Assets/botol-plastik.jpg') }}" alt="Botol Plastik" class="w-full h-200 object-cover mb-6 rounded">
                
                <p class="text-gray-800 mb-4 text-justify">
                    Botol Plastik adalah wadah yang terbuat dari bahan polimer seperti PET (Polyethylene Terephthalate) yang sering digunakan untuk kemasan air mineral, minuman ringan, dan produk lainnya. Botol plastik banyak digunakan karena ringan, murah, dan tahan lama, namun jika tidak dikelola dengan baik, dapat mencemari lingkungan.
                </p>
                
                <h3 class="font-semibold text-lg mb-2">Jenis Sampah</h3>
                <p class="text-gray-800 text-justify">
                    Anorganik adalah jenis sampah yang berasal dari non-hayati dan tidak mudah terurai, seperti plastik, kaca, logam, dan kertas.
                </p>
            </div>
            
            <!-- Right Section -->
            <div class="bg-white rounded-lg shadow-sm p-6 md:w-1/2">
                <h3 class="font-semibold text-lg mb-2">Ciri - ciri :</h3>
                <ul class="list-disc pl-5 mb-6 space-y-2 text-justify">
                    <li>Terbuat dari bahan polimer sintetis (biasanya PET - Polyethylene Terephthalate)</li>
                    <li>Ringan tetapi kuat</li>
                    <li>Transparan atau semi-transparan (tergantung jenis plastiknya)</li>
                    <li>Tahan terhadap air dan kelembapan</li>
                    <li>Sulit terurai secara alami (bisa membutuhkan waktu 450-1000 tahun)</li>
                    <li>Mudah berubah bentuk jika terkena panas tinggi</li>
                </ul>
                
                <h3 class="font-semibold text-lg mb-2">Pemanfaatan :</h3>
                <ol class="list-decimal pl-5 space-y-2 text-justify">
                    <li><span class="font-medium">Daur Ulang:</span> Dijadikan botol baru, kain poliester, ember, kursi plastik, atau aspal plastik.</li>
                    <li><span class="font-medium">Kerajinan Tangan:</span> Pot tanaman, tempat pensil, lampu hias, atau mainan anak.</li>
                    <li><span class="font-medium">Wadah Penyimpanan:</span> Untuk sabun cair, minyak goreng, atau botol penyiram tanaman.</li>
                    <li><span class="font-medium">Konstruksi:</span> Bata ramah lingkungan (eco-bricks), dinding rumah, atau perahu dari botol plastik.</li>
                    <li><span class="font-medium">Pertanian:</span> Media tanam hidroponik dan sistem irigasi tetes sederhana.</li>
                </ol>
            </div>
        </div>
        
        <!-- Back Button -->
        <div class="flex justify-end mt-8 px-4">
            <button class="bg-teal-600 hover:bg-teal-700 text-white text-semibold py-3 px-10 rounded">Kembali</button>
        </div>
    </div>
</body>
</html>