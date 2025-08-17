<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WasteWise - Ubah Sampah Jadi Berkah</title>
        <meta name="description" content="Platform berbasis bank sampah sekaligus media edukasi interaktif untuk mengatasi permasalahan pengelolaan sampah">
        @vite('resources/css/app.css')
    </head>

    <body>
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <x-header.guest/>
        </header>

        <!-- Tentang Kami Section -->
        <section id="tentangkami" class="py-16 bg-gradient-to-b bg-gray-100">
            <div class="container mx-auto px-4">
                <!-- Heading -->
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#3D8D7A] mb-4">Tentang Kami</h2>
                    <div class="w-24 h-1 bg-[#3D8D7A] mx-auto mb-6"></div>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">Misi kami adalah menjadikan Surabaya lebih bersih dengan pendekatan inovatif terhadap pengelolaan sampah.</p>
                </div>
                
                <!-- Content -->
                <div class="flex flex-col lg:flex-row items-center gap-12 px-20">
                    <!-- Image -->
                    <div class="lg:w-1/2">
                        <div class="rounded-lg overflow-hidden shadow-xl">
                            <img src="{{ asset('Assets/logo-wastewise.svg') }}" alt="Tim WasteWise" class="w-full h-auto object-cover"/>
                        </div>
                    </div>
                    
                    <!-- Text Content -->
                    <div class="lg:w-1/2">
                        <h3 class="text-3xl font-bold text-[#3D8D7A] mb-4">WasteWise: Ubah Sampah Jadi Berkah</h3>
                        <p class="text-gray-700 text-base mb-4 text-justify">
                            WasteWise merupakan platform berbasis bank sampah sekaligus media edukasi interaktif yang dirancang sebagai solusi dalam mengatasi permasalahan pengelolaan sampah di Surabaya.
                        </p>
                        <p class="text-gray-700 mb-6 text-justify">
                            Kami berkomitmen untuk mendorong kebiasaan baru dalam mengelola sampah secara bijak, melalui pendekatan yang mudah, menyenangkan, dan berdampak positif. Dengan mengusung misi mengurangi pencemaran lingkungan dan meningkatkan kesadaran masyarakat, WasteWise menyediakan berbagai fitur unggulan.
                        </p>
                        
                        <!-- Features -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-[#3D8D7A] rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Layanan Jemput Sampah</h4>
                                    <p class="text-sm text-gray-600">Kemudahan dalam menyetor sampah</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-[#3D8D7A] rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Pencatatan Riwayat</h4>
                                    <p class="text-sm text-gray-600">Dokumentasi lengkap setoran sampah</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-[#3D8D7A] rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Edukasi Berbasis AI</h4>
                                    <p class="text-sm text-gray-600">Pemahaman mendalam tentang pengolahan sampah</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-[#3D8D7A] rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Sistem Poin Rewards</h4>
                                    <p class="text-sm text-gray-600">Tukar poin atau donasikan untuk lingkungan</p>
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 mb-6 text-justify">
                            Melalui WasteWise, kami percaya bahwa perubahan besar bisa dimulai dari langkah kecil. Bersama, mari wujudkan Surabaya yang lebih bersih, hijau, dan berkelanjutan.
                        </p>
                        
                        <div class="flex space-x-4">
                            <a href="{{ route('detail-layanan') }}" class="bg-[#3D8D7A] text-white px-6 py-3 rounded-md hover:bg-opacity-90 transition duration-300 inline-flex items-center">
                                <span>Layanan Kami</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#kontak" class="border-2 border-[#3D8D7A] text-[#3D8D7A] px-6 py-3 rounded-md hover:bg-gray-50 transition duration-300">Hubungi Kami</a>
                        </div>
                    </div>
                </div>
                
                <!-- Stats -->
                <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-lg shadow-md text-center">
                        <div class="text-[#3D8D7A] text-4xl font-bold mb-2">50+</div>
                        <div class="text-gray-600 font-medium">Pengguna Aktif</div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-lg shadow-md text-center">
                        <div class="text-[#3D8D7A] text-4xl font-bold mb-2">1.5 ton</div>
                        <div class="text-gray-600 font-medium">Sampah Terkelola</div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-lg shadow-md text-center">
                        <div class="text-[#3D8D7A] text-4xl font-bold mb-2">10+</div>
                        <div class="text-gray-600 font-medium">Komunitas Mitra</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
                <x-footer.guest id="kontak" fill="#f3f4f6"/>

    </body>
</html>