@extends('layouts.template')
@section('title', 'Kelola Pengguna')

@section('content')
    @php
        if (count($errors) > 0) {
            alert()->error('Gagal', $errors->all());
        }
    @endphp
    <!-- Navbar -->
    <x-header.admin/>

    <div class="flex min-h-full">
        <!-- Sidebar -->
        <div class="relative">
            <x-sidebar.admin />
        </div>

        <!-- Flash Messages - Changed to show with SweetAlert -->
        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            });
        </script>
        @endif

        @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            });
        </script>
        @endif

        <!-- Main Content -->
        <main class="justify-center w-full">
            <!-- Title & Description -->
            <div class="mt-4 sm:px-8">
                <p class="text-[#3D8D7A] text-center font-semibold xs:text-[23px] sm:text-[23px] xl:text-[25px]">
                    Kelola Pengguna</p>
            </div>
            <!-- Kelola Pengguna -->
            <div class="pl-[70px] pr-[20px]">
                <div
                    class="flex xs:flex-col sm:flex-col xl:flex-row justify-center align-top mt-4 mb-2 xs:space-x-0 xs:space-y-4 sm:space-y-6 sm:space-x-0 xl:space-y-0 xl:space-x-6">
                    <div class="flex flex-col w-full align-top">
                        <div
                            class="flex items-center align-middle xs:flex-row sm:flex-row md:flex-row xl:flex-row  xs:space-y-1 xl:space-y-0 ">
                            <!-- Title -->
                            <div>
                                <p
                                    class="text-[#464748] font-semibold xs:text-[20px] sm:text-[22px] xs:text-center sm:text-left">
                                    Pengguna WasteWise
                                </p>
                            </div>
                            {{-- Aksi --}}
                            <div class="grid flex-grow justify-end">
                                <div
                                    class="flex sm:flex-row sm:space-x-2 sm:space-y-0 xs:flex-col xs:space-y-2 xs:space-x-0">
                                    <div class="flex xl:flex-row space-x-2 items-center">
                                        <select
                                            class="filter select select-sm w-fit h-9 bg-[#3D8D7A] text-[#fff] !outline-none xs:text-[12px] sm:text-[14px]"
                                            name="jenis_kelamin" id="gender-filtering">
                                            <option disabled selected>Pilih Gender</option>
                                            <option class="text-[#000] bg-[#fff]" value="all">Semua</option>
                                            <option class="text-[#000] bg-[#fff]" value="Laki-laki">Laki-laki</option>
                                            <option class="text-[#000] bg-[#fff]" value="Perempuan">Perempuan</option>
                                        </select>
                                        <!-- Tambah -->
                                        <label for="add-pengguna"
                                            class="btn btn-sm h-9 border-none pl-3 bg-[#00D100] hover:bg-[#00D100] text-white rounded-[10px] inline-flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px] sm:mr-3" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            <span class="xs:hidden sm:inline-block xs:text-[12px] sm:text-[14px]">Tambah</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Table Daftar Pengguna -->
                        <div class="card w-[100%] h-[100%] shadow-md bg-white text-primary-content px-4 py-4 mt-2">
                            <div class="overflow-x-auto">
                                <table id="penggunaTable" class="stripe hover display responsive nowrap" style="width: 100%">
                                    <thead class="bg-white xl:w-fit sm:w-auto">
                                        <tr>
                                            <th scope="col"
                                                class="xl:text-sm xs:text-xs xl:flex font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                No
                                            </th>
                                            <th scope="col"
                                                class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                Nama Lengkap
                                            </th>
                                            <th scope="col"
                                                class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                Jenis Kelamin
                                            </th>
                                            <th scope="col"
                                                class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                Tanggal Lahir
                                            </th>
                                            <th scope="col"
                                                class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                Email
                                            </th>
                                            <th scope="col"
                                                class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                Total Poin
                                            </th>
                                            <th scope="col"
                                                class="xl:text-sm xs:text-xs font-semibold text-[#35405B] sm:text-xs">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be loaded via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Pop up Pengguna-->
    <input type="checkbox" id="add-pengguna" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle dark:bg-[#E6E6E6]">
        <div class="modal-box bg-white text-black max-h-screen overflow-y-auto">
            <h3 class="font-bold text-lg mb-3 text-[#464748]">Form Pengguna Baru</h3>
            <form id="addPenggunaForm" enctype="multipart/form-data">
                @csrf
                {{-- Nama Lengkap --}}
                <label class="label accent-black">
                    <span class="label-text text-black">Nama Lengkap <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="text" placeholder="Masukkan Nama Lengkap" name="nama_lengkap"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />
                
                {{-- Jenis Kelamin --}}
                <label class="label">
                    <span class="label-text text-black">Jenis Kelamin <span class="text-[#FF000A]">*</span></span>
                </label>
                <select name="jenis_kelamin"
                    class="select w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 dark:bg-white"
                    required>
                    <option disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>

                {{-- Tanggal Lahir --}}
                <label class="label">
                    <span class="label-text text-black">Tanggal Lahir <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="date" name="tanggal_lahir"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                {{-- Nomor Telepon --}}
                <label class="label">
                    <span class="label-text text-black">Nomor Telepon <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="tel" placeholder="Masukkan Nomor Telepon" name="nomor_telepon"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                {{-- Email --}}
                <label class="label">
                    <span class="label-text text-black">Email <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="email" placeholder="Masukkan Email" name="email"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                {{-- Password --}}
                <label class="label">
                    <span class="label-text text-black">Password <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="password" placeholder="Masukkan Password" name="password"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                {{-- Total Poin --}}
                <label class="label">
                    <span class="label-text text-black">Total Poin</span>
                </label>
                <input type="number" placeholder="Masukkan Total Poin" name="total_poin" value="0"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />

                {{-- Foto --}}
                <label class="label">
                    <span class="label-text text-black">Foto <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="file" name="foto" accept="image/*"
                    class="file-input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                {{-- Detail Alamat --}}
                <label class="label">
                    <span class="label-text text-black">Detail Alamat</span>
                </label>
                <textarea placeholder="Masukkan Detail Alamat" name="detail_alamat"
                    class="textarea w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white"></textarea>

                {{-- Kelurahan --}}
                <label class="label">
                    <span class="label-text text-black">Kelurahan <span class="text-[#FF000A]">*</span></span>
                </label>
                <select name="id_kelurahan"
                    class="select w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 dark:bg-white"
                    required>
                    <option disabled selected>Pilih Kelurahan</option>
                    @foreach ($kelurahan as $kel)
                        <option value="{{ $kel->id_kelurahan }}">{{ $kel->nama_kelurahan }} - {{ $kel->kecamatan->nama_kecamatan }}</option>
                    @endforeach
                </select>

                <!-- Button -->
                <div class="flex modal-action justify-center pl-5">
                    {{-- batal --}}
                    <label for="add-pengguna"
                        class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</label>
                    {{-- submit --}}
                    <button type="Submit"
                        class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] dark:text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pop up Edit Pengguna-->
    <input type="checkbox" id="edit-pengguna" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle dark:bg-[#E6E6E6]">
        <div class="modal-box bg-white text-black max-h-screen overflow-y-auto">
            <h3 class="font-bold text-lg mb-3 text-[#464748]">Edit Pengguna</h3>
            <form id="editPenggunaForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="editIdPengguna" name="id_pengguna">
                
                {{-- Nama Lengkap --}}
                <label class="label accent-black">
                    <span class="label-text text-black">Nama Lengkap <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="text" placeholder="Masukkan Nama Lengkap" id="editNamaLengkap" name="nama_lengkap"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />
                
                {{-- Jenis Kelamin --}}
                <label class="label">
                    <span class="label-text text-black">Jenis Kelamin <span class="text-[#FF000A]">*</span></span>
                </label>
                <select id="editJenisKelamin" name="jenis_kelamin"
                    class="select w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 dark:bg-white"
                    required>
                    <option disabled>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>

                {{-- Tanggal Lahir --}}
                <label class="label">
                    <span class="label-text text-black">Tanggal Lahir <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="date" id="editTanggalLahir" name="tanggal_lahir"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                {{-- Nomor Telepon --}}
                <label class="label">
                    <span class="label-text text-black">Nomor Telepon <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="tel" placeholder="Masukkan Nomor Telepon" id="editNomorTelepon" name="nomor_telepon"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                {{-- Email --}}
                <label class="label">
                    <span class="label-text text-black">Email <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="email" placeholder="Masukkan Email" id="editEmail" name="email"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                {{-- Password --}}
                <label class="label">
                    <span class="label-text text-black">Password</span>
                </label>
                <input type="password" placeholder="Masukkan Password Baru (Kosongkan jika tidak diubah)" id="editPassword" name="password"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>

                {{-- Total Poin --}}
                <label class="label">
                    <span class="label-text text-black">Total Poin</span>
                </label>
                <input type="number" placeholder="Masukkan Total Poin" id="editTotalPoin" name="total_poin"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />

                {{-- Foto --}}
                <label class="label">
                    <span class="label-text text-black">Foto</span>
                </label>
                <input type="file" id="editFoto" name="foto" accept="image/*"
                    class="file-input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto</p>

                {{-- Detail Alamat --}}
                <label class="label">
                    <span class="label-text text-black">Detail Alamat</span>
                </label>
                <textarea placeholder="Masukkan Detail Alamat" id="editDetailAlamat" name="detail_alamat"
                    class="textarea w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white"></textarea>

                {{-- Kelurahan --}}
                <label class="label">
                    <span class="label-text text-black">Kelurahan <span class="text-[#FF000A]">*</span></span>
                </label>
                <select id="editKelurahan" name="id_kelurahan"
                    class="select w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 dark:bg-white"
                    required>
                    <option disabled>Pilih Kelurahan</option>
                    @foreach ($kelurahan as $kel)
                        <option value="{{ $kel->id_kelurahan }}">{{ $kel->nama_kelurahan }} - {{ $kel->kecamatan->nama_kecamatan }}</option>
                    @endforeach
                </select>

                <!-- Button -->
                <div class="flex modal-action justify-center pl-5">
                    <label for="edit-pengguna"
                        class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</label>
                    <button type="submit"
                        class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] dark:text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pop up Detail Pengguna -->
    <input type="checkbox" id="detail-pengguna" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle dark:bg-[#E6E6E6]">
        <div class="modal-box bg-white text-black max-w-4xl max-h-screen overflow-y-auto">
            <h3 class="font-bold text-lg mb-3 text-[#464748]">Detail Pengguna</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informasi Utama -->
                <div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">ID Pengguna</p>
                        <p id="detailIdPengguna" class="text-black font-medium">-</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p id="detailNamaLengkap" class="text-black font-medium">-</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                        <p id="detailJenisKelamin" class="text-black font-medium">-</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Tanggal Lahir</p>
                        <p id="detailTanggalLahirShow" class="text-black font-medium">-</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Nomor Telepon</p>
                        <p id="detailNomorTelepon" class="text-black font-medium">-</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Email</p>
                        <p id="detailEmailShow" class="text-black font-medium">-</p>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Total Poin</p>
                        <p id="detailTotalPoinShow" class="text-black font-medium">-</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p id="detailDetailAlamat" class="text-black font-medium">-</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-500">Kelurahan</p>
                        <p id="detailKelurahanShow" class="text-black font-medium">-</p>
                    </div>
                </div>
                
                <!-- Foto Pengguna -->
                <div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 mb-2">Foto Pengguna</p>
                        <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                            <img id="detailFotoShow" src="/api/placeholder/400/320" alt="Foto Pengguna" class="max-h-full max-w-full rounded-lg object-cover">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-action justify-center">
                <label for="detail-pengguna" class="btn bg-[#3D8D7A] border-[#3D8D7A] text-white hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Tutup</label>
            </div>
        </div>
    </div>

    <!-- Pop up hapus -->
    <input type="checkbox" id="delete-pengguna" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
        <div class="modal-box bg-white text-black items-center justify-center text-center mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-18 w-18 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>

            <h3 class="font-semibold text-lg text-center mt-2">Apakah Anda Yakin? </h3>
            <p class="text-center">Data yang terhapus tidak dapat kembali!</p>

            <!-- Button -->
            <div class="modal-action flex justify-center">
                <label for="delete-pengguna"
                    class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batalkan</label>
                <button id="confirmDeleteBtn"
                    class="btn bg-[#ED1C24] border-[#ED1C24] w-[120px] text-[#fff] dark:text-[#fff] hover:bg-[#ED1C24] hover:border-[#ED1C24]">Hapus</button>
            </div>
        </div>
    </div>

    @push('script')
        <script type="text/javascript">
            $(document).ready(function() {
                let deleteId = null;

                // Setup CSRF for AJAX requests
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // DataTable initialization function
                function initializeDataTable(gender = null) {
                    if ($.fn.DataTable.isDataTable('#penggunaTable')) {
                        $('#penggunaTable').DataTable().destroy();
                    }

                    $('#penggunaTable').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        searchable: true,
                        autoWidth: true,
                        paging: true,
                        deferRender: true,
                        orderClasses: false,
                        ajax: {
                            url: "{{ route('kelola-pengguna.data') }}",
                            type: "GET",
                            data: function(d) {
                                d.gender = gender;
                            },
                            error: function(xhr, error, thrown) {
                                console.error('DataTables error:', error, thrown);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Failed to load user data. Please refresh the page and try again.',
                                });
                            }
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                className: 'dt-center text-black',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'nama_lengkap',
                                name: 'nama_lengkap',
                                className: 'dt-center text-black'
                            },
                            {
                                data: 'jenis_kelamin',
                                name: 'jenis_kelamin',
                                className: 'dt-center text-black'
                            },
                            {
                                data: 'formatted_birth_date',
                                name: 'tanggal_lahir',
                                className: 'dt-center text-black'
                            },
                            {
                                data: 'akun.email',
                                name: 'akun.email',
                                className: 'dt-center text-black'
                            },
                            {
                                data: 'total_poin',
                                name: 'total_poin',
                                className: 'dt-center text-black'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                className: 'dt-center text-black',
                                orderable: false,
                                searchable: false,
                            }
                        ],
                        language: {
                        sEmptyTable: "Data Tidak Ditemukan",
                        sZeroRecords: "Data Tidak Ditemukan",
                        sSearch: "Cari Data : ",
                        lengthMenu: "Tampilkan _MENU_ data",
                        processing: "Loading...",
                    }
                });
            }

            // Initialize DataTable on page load
            initializeDataTable($('#gender-filtering').val());

            // Gender filter event
            $('#gender-filtering').on('change', function() {
                var gender = $(this).val();
                initializeDataTable(gender);
            });

            // Add Pengguna Form Submit
            $('#addPenggunaForm').submit(function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Menambahkan Pengguna...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                var formData = new FormData(this);
                
                $.ajax({
                    url: "{{ route('add-pengguna') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            });
                            
                            // Close modal and reset form
                            $('#add-pengguna').prop('checked', false);
                            $('#addPenggunaForm')[0].reset();
                            
                            // Reload DataTable
                            $('#penggunaTable').DataTable().ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        var errorMessage = 'Terjadi kesalahan saat menyimpan data!';
                        
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            errorMessage = Object.values(errors).flat().join('\n');
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage
                        });
                    }
                });
            });

            // Edit Pengguna Form Submit
            $('#editPenggunaForm').submit(function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Menyimpan Perubahan...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                var formData = new FormData(this);
                
                $.ajax({
                    url: "{{ route('edit-pengguna') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            });
                            
                            // Close modal
                            $('#edit-pengguna').prop('checked', false);
                            
                            // Reload DataTable
                            $('#penggunaTable').DataTable().ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        var errorMessage = 'Terjadi kesalahan saat menyimpan data!';
                        
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            errorMessage = Object.values(errors).flat().join('\n');
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage
                        });
                    }
                });
            });

            // Confirm Delete Function
            window.confirmDelete = function(id) {
                deleteId = id;
                $('#delete-pengguna').prop('checked', true);
            };

            // Confirm Delete Button Click
            $('#confirmDeleteBtn').click(function() {
                if (deleteId) {
                    Swal.fire({
                        title: 'Menghapus Data...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "{{ route('delete-pengguna', '') }}/" + deleteId,
                        type: "GET",
                        success: function(response) {
                            Swal.close();
                            $('#delete-pengguna').prop('checked', false);
                            
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                });
                                
                                // Reload DataTable
                                $('#penggunaTable').DataTable().ajax.reload(null, false);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response.message
                                });
                            }
                            deleteId = null;
                        },
                        error: function(xhr) {
                            Swal.close();
                            $('#delete-pengguna').prop('checked', false);
                            
                            var errorMessage = 'Terjadi kesalahan saat menghapus data!';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: errorMessage
                            });
                            deleteId = null;
                        }
                    });
                }
            });

            // Show Detail Function
            window.showDetail = function(id) {
                $.ajax({
                    url: "{{ route('get-pengguna', '') }}/" + id,
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            var data = response.data;
                            
                            // Fill detail modal with data
                            $('#detailIdPengguna').text(data.id_pengguna || '-');
                            $('#detailNamaLengkap').text(data.nama_lengkap || '-');
                            $('#detailJenisKelamin').text(data.jenis_kelamin || '-');
                            
                            // Format tanggal lahir
                            if (data.tanggal_lahir) {
                                var date = new Date(data.tanggal_lahir);
                                var formattedDate = date.toLocaleDateString('id-ID', {
                                    day: '2-digit',
                                    month: '2-digit',
                                    year: 'numeric'
                                });
                                $('#detailTanggalLahirShow').text(formattedDate);
                            } else {
                                $('#detailTanggalLahirShow').text('-');
                            }
                            
                            $('#detailNomorTelepon').text(data.nomor_telepon || '-');
                            $('#detailEmailShow').text(data.akun ? data.akun.email : '-');
                            $('#detailTotalPoinShow').text(data.total_poin || '0');
                            $('#detailDetailAlamat').text(data.detail_alamat || '-');
                            
                            // Show kelurahan with kecamatan
                            if (data.kelurahan) {
                                var kelurahanText = data.kelurahan.nama_kelurahan;
                                if (data.kelurahan.kecamatan) {
                                    kelurahanText += ' - ' + data.kelurahan.kecamatan.nama_kecamatan;
                                }
                                $('#detailKelurahanShow').text(kelurahanText);
                            } else {
                                $('#detailKelurahanShow').text('-');
                            }
                            
                            // Show photo
                            if (data.foto_url) {
                                $('#detailFotoShow').attr('src', data.foto_url);

                            } else {
                                $('#detailFotoShow').attr('src', '/api/placeholder/400/320');
                            }
                            
                            // Open detail modal
                            $('#detail-pengguna').prop('checked', true);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = 'Gagal mengambil detail pengguna!';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage
                        });
                    }
                });
            };

            // Edit Pengguna Function
            window.editPengguna = function(id) {
                $.ajax({
                    url: "{{ route('get-pengguna', '') }}/" + id,
                    type: "GET",
                    success: function(response) {
                        if (response.success) {
                            var data = response.data;
                            
                            // Fill edit form with data
                            $('#editIdPengguna').val(data.id_pengguna);
                            $('#editNamaLengkap').val(data.nama_lengkap);
                            $('#editJenisKelamin').val(data.jenis_kelamin);
                            $('#editTanggalLahir').val(data.tanggal_lahir);
                            $('#editNomorTelepon').val(data.nomor_telepon);
                            $('#editEmail').val(data.akun ? data.akun.email : '');
                            $('#editTotalPoin').val(data.total_poin);
                            $('#editDetailAlamat').val(data.detail_alamat);
                            $('#editKelurahan').val(data.id_kelurahan);
                            
                            // Clear password field
                            $('#editPassword').val('');
                            
                            // Open edit modal
                            $('#edit-pengguna').prop('checked', true);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = 'Gagal mengambil data pengguna!';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage
                        });
                    }
                });
            };
        });
    </script>
    @endpush
</body>
</html>