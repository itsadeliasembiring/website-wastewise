@vite('resources/css/app.css')
<aside class="absolute z-10 overflow-hidden min-h-full pt-0 left-0 w[calc(3.73rem)] bg-[#FFFFFF] xs:hidden sm:block">
    <div class="drawer bg-[#FFFFFF]">
        <div
            class="transition-all ease-in-out h-full w-[3.35rem] overflow-hidden hover:w-60 hover:bg-[#FFFFFF] hover:shadow-lg hover:ease">
            <div class="flex h-full flex-col justify-between">
                <div class="bg-[#FFFFFF]">
                    <ul class="space-y-2 tracking-wide bg-[#FFFFFF]">
                        <!-- Dashboard -->
                        <li class="min-w-max {{ Route::is('dashboard-admin') ? 'bg-[#D6EFD8]' : '' }}">
                            <a href="{{ route('dashboard-admin') }}" aria-label="Dashboard"
                                class="relative flex items-center space-x-4 hover:bg-[#B5B5B5] px-4 py-3 hover:bg-opacity-30 active:bg-opacity-30">
                                <x-ri-dashboard-fill class="w-[21px] h-[21px] mr-5 {{ Route::is('dashboard-admin') ? 'text-[#3D8D7A]' : 'text-[#464748]' }}" />
                                <span class="text-[15px] {{ Route::is('dashboard-admin') ? 'text-[#3D8D7A] font-semibold' : 'text-[#464748]' }}">Dashboard</span>
                            </a>
                        </li>

                        <!-- Riwayat Setor Sampah -->
                        <li class="min-w-max {{ Route::is('riwayat-setor-sampah') ? 'bg-[#D6EFD8]' : '' }}">
                            <a href="{{ route('riwayat-setor-sampah') }}" aria-label="riwayatsetor"
                                class="relative flex items-center space-x-4 hover:bg-[#B5B5B5] px-4 py-3 hover:bg-opacity-30 active:bg-opacity-30">
                                <x-fas-history class="w-[21px] h-[21px] mr-5 {{ Route::is('riwayat-setor-sampah') ? 'text-[#3D8D7A]' : 'text-[#464748]' }}" />
                                <span class="text-[15px] {{ Route::is('riwayat-setor-sampah') ? 'text-[#3D8D7A] font-semibold' : 'text-[#464748]' }}">Riwayat Setor Sampah</span>
                            </a>
                        </li>

                        <!-- Verifikasi Setor Sampah -->
                        <li class="min-w-max {{ Route::is('admin.verifikasi-setor-sampah') ? 'bg-[#D6EFD8]' : '' }}">
                            <a href="{{ route('admin.verifikasi-setor-sampah') }}" aria-label="verifikasisetorsampah"
                                class="relative flex items-center space-x-4 hover:bg-[#B5B5B5] px-4 py-3 hover:bg-opacity-30 active:bg-opacity-30">
                                <x-fas-check-circle class="w-[21px] h-[21px] mr-5 {{ Route::is('admin.verifikasi-setor-sampah') ? 'text-[#3D8D7A]' : 'text-[#464748]' }}" />
                                <span class="text-[15px] {{ Route::is('admin.verifikasi-setor-sampah') ? 'text-[#3D8D7A] font-semibold' : 'text-[#464748]' }}">Verifikasi Setor</span>
                            </a>
                        </li>

                        <!-- Verifikasi Tukar Barang -->
                        <li class="min-w-max {{ Route::is('admin.beranda-verifikasi-tukar-barang') ? 'bg-[#D6EFD8]' : '' }}">
                            <a href="{{ route('admin.beranda-verifikasi-tukar-barang') }}" aria-label="verifikasitukarbarang"
                                class="relative flex items-center space-x-4 hover:bg-[#B5B5B5] px-4 py-3 hover:bg-opacity-30 active:bg-opacity-30">
                                <x-fas-clipboard-check class="w-[21px] h-[21px] mr-5 {{ Route::is('admin.beranda-verifikasi-tukar-barang') ? 'text-[#3D8D7A]' : 'text-[#464748]' }}" />
                                <span class="text-[15px] {{ Route::is('admin.beranda-verifikasi-tukar-barang') ? 'text-[#3D8D7A] font-semibold' : 'text-[#464748]' }}">Verifikasi Penukaran</span>
                            </a>
                        </li>

                        <!-- Kelola akun -->
                        <li class="min-w-max {{ Route::is('kelola-akun') ? 'bg-[#D6EFD8]' : '' }}">
                            <a href="{{ route('kelola-akun') }}" aria-label="riwayattukarpoin"
                                class="relative flex items-center space-x-4 hover:bg-[#B5B5B5] px-4 py-3 hover:bg-opacity-30 active:bg-opacity-30">
                                <x-ri-account-pin-box-fill class="w-[21px] h-[21px] mr-5 {{ Route::is('kelola-akun') ? 'text-[#3D8D7A]' : 'text-[#464748]' }}" />
                                <span class="text-[15px] {{ Route::is('kelola-akun') ? 'text-[#3D8D7A] font-semibold' : 'text-[#464748]' }}">Kelola Akun</span>
                            </a>
                        </li>

                        <!-- Kelola Pengguna -->
                        <li class="min-w-max {{ Route::is('kelola-pengguna') ? 'bg-[#D6EFD8]' : '' }}">
                            <a href="{{ route('kelola-pengguna') }}" aria-label="kelolapengguna"
                                class="relative flex items-center space-x-4 hover:bg-[#B5B5B5] px-4 py-3 hover:bg-opacity-30 active:bg-opacity-30">
                                <x-fas-people-group class="w-[21px] h-[21px] mr-5 {{ Route::is('kelola-pengguna') ? 'text-[#3D8D7A]' : 'text-[#464748]' }}" />
                                <span class="text-[15px] {{ Route::is('kelola-pengguna') ? 'text-[#3D8D7A] font-semibold' : 'text-[#464748]' }}">Kelola Pengguna</span>
                            </a>
                        </li>

                        <!-- Kelola Artikel -->
                        <li class="min-w-max {{ Route::is('kelola-artikel') ? 'bg-[#D6EFD8]' : '' }}">
                            <a href="{{ route('kelola-artikel') }}" aria-label="kelolaartikel"
                                class="relative flex items-center space-x-4 hover:bg-[#B5B5B5] px-4 py-3 hover:bg-opacity-30 active:bg-opacity-30">
                                <x-ri-article-fill class="w-[21px] h-[21px] mr-5 {{ Route::is('kelola-artikel') ? 'text-[#3D8D7A]' : 'text-[#464748]' }}" />
                                <span class="text-[15px] {{ Route::is('kelola-artikel') ? 'text-[#3D8D7A] font-semibold' : 'text-[#464748]' }}">Kelola Artikel</span>
                            </a>
                        </li>

                        <!-- Kelola Sampah -->
                        <li class="min-w-max {{ Route::is('kelola-sampah') ? 'bg-[#D6EFD8]' : '' }}">
                            <a href="{{ route('kelola-sampah') }}" aria-label="kelolasampah"
                                class="relative flex items-center space-x-4 hover:bg-[#B5B5B5] px-4 py-3 hover:bg-opacity-30 active:bg-opacity-30">
                                <x-fas-trash class="w-[21px] h-[21px] mr-5 {{ Route::is('kelola-sampah') ? 'text-[#3D8D7A]' : 'text-[#464748]' }}" />
                                <span class="text-[15px] {{ Route::is('kelola-sampah') ? 'text-[#3D8D7A] font-semibold' : 'text-[#464748]' }}">Kelola Sampah</span>
                            </a>
                        </li>

                        <!-- Penukaran Barang -->
                        <li class="min-w-max {{ Route::is('penukaran-barang') ? 'bg-[#D6EFD8]' : '' }}">
                            <a href="{{ route('penukaran-barang') }}" aria-label="kelolabarang"
                                class="relative flex items-center space-x-4 hover:bg-[#B5B5B5] px-4 py-3 hover:bg-opacity-30 active:bg-opacity-30">
                                <x-fas-gift class="w-[21px] h-[21px] mr-5 {{ Route::is('penukaran-barang') ? 'text-[#3D8D7A]' : 'text-[#464748]' }}" />
                                <span class="text-[15px] {{ Route::is('penukaran-barang') ? 'text-[#3D8D7A] font-semibold' : 'text-[#464748]' }}">Penukaran Barang</span>
                            </a>
                        </li>

                        <!-- Penukaran Donasi -->
                        <li class="min-w-max {{ Route::is('penukaran-donasi') ? 'bg-[#D6EFD8]' : '' }}">
                            <a href="{{ route('penukaran-donasi') }}" aria-label="keloladonasi"
                                class="relative flex items-center space-x-4 hover:bg-[#B5B5B5] px-4 py-3 hover:bg-opacity-30 active:bg-opacity-30">
                                <x-fas-donate class="w-[21px] h-[21px] mr-5 {{ Route::is('penukaran-donasi') ? 'text-[#3D8D7A]' : 'text-[#464748]' }}" />
                                <span class="text-[15px] {{ Route::is('penukaran-donasi') ? 'text-[#3D8D7A] font-semibold' : 'text-[#464748]' }}">Penukaran Donasi</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</aside>