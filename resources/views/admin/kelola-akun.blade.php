<!DOCTYPE html>
<html lang="en" class="h-full bg-[#E6E6E6] dark:bg-[#E6E6E6]">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin</title>
    @vite('resources/css/app.css')
    <!-- Include jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <!-- Add SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <main class="justify-center w-full pt-20">
        <!-- Title & Description -->
        <div class="mt-4 sm:px-8">
            <p class="text-[#00D100] text-center font-semibold xs:text-[23px] sm:text-[23px] xl:text-[25px]">
                Kelola Akun</p>
        </div>
        <!-- Kelola Akun -->
        <div class="pl-[70px] pr-[20px]">
            <div
                class="flex xs:flex-col sm:flex-col xl:flex-row justify-center align-top mt-4 mb-2 xs:space-x-0 xs:space-y-4 sm:space-y-6 sm:space-x-0 xl:space-y-0 xl:space-x-6">
                <div class="flex flex-col w-full align-top">
                    <div
                        class="flex items-center align-middle xs:flex-row sm:flex-row md:flex-col xl:flex-row  xs:space-y-1 xl:space-y-0 ">
                        <!-- Title -->
                        <div>
                            <p
                                class="text-[#464748] font-semibold xs:text-[20px] sm:text-[22px] xs:text-center sm:text-left">
                                Akun WasteWise
                            </p>
                        </div>
                        {{-- Aksi --}}
                        <div class="grid flex-grow justify-end">
                            <div
                                class="flex sm:flex-row sm:space-x-2 sm:space-y-0 xs:flex-col xs:space-y-2 xs:space-x-0">
                                <div class="flex xl:flex-row space-x-2 items-center">
                                    <select
                                        class="filter select select-sm w-fit h-9 bg-[#FF8138] text-[#fff] !outline-none xs:text-[12px] sm:text-[14px]"
                                        name="id_level" id="level-filtering">
                                        <option disabled selected>Pilih Level</option>
                                        <option class="text-[#000] bg-[#fff]" value="all">Semua</option>
                                        @foreach ($level_akun as $lvl)
                                            <option class="text-[#000] bg-[#fff]" value="{{ $lvl->id_level }}">
                                                {{ $lvl->nama_level }}</option>
                                        @endforeach
                                    </select>
                                    <!-- Tambah -->
                                    <label for="add-akun"
                                        class="btn btn-sm h-9 border-none pl-3 bg-[#00D100] hover:bg-[#00D100] text-white rounded-[10px] inline-flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px] sm:mr-3" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="xs:hidden sm:inline-block">Tambah</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table Daftar Akun -->
                    <div class="card w-[100%] h-[100%] shadow-md bg-white text-primary-content px-4 py-4 mt-2">
                        <div class="overflow-x-auto">
                            <table id="akunTable" class="stripe hover display responsive nowrap" style="width: 100%">
                                <thead class="bg-white xl:w-fit sm:w-auto">
                                    <tr>
                                        <th scope="col"
                                            class="xl:text-sm xs:text-xs xl:flex font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                            Id Akun
                                        </th>
                                        <th scope="col"
                                            class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                            Level akun
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

    <!-- Pop up Akun-->
    {{-- Tambah --}}
    <input type="checkbox" id="add-akun" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
        <div class="modal-box bg-white text-black">
            <h3 class="font-bold text-lg mb-3 text-[#464748]">Form Akun Baru</h3>
            <form id="addAkunForm" action="{{ url('add-akun') }}" method="POST">
                @csrf
                {{-- Email --}}
                <label class="label accent-black">
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
                <!-- Level akun-->
                <div>
                    <label class="label">
                        <span class="label-text text-black">Level akun <span class="text-[#FF000A]">*</span></span>
                    </label>
                    <select name="id_level"
                        class="select w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 dark:bg-white"
                        required>
                        <option disabled selected>Pilih Level akun</option>
                        @foreach ($level_akun as $lvl)
                            <option value="{{ $lvl->id_level }}">{{ $lvl->nama_level }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Button -->
                <div class="flex modal-action justify-center pl-5">
                    {{-- batal --}}
                    <label for="add-akun"
                        class="btn btn-outline btn-[#FF8138] w-[120px] bg-[#fff] text-[#FF8138] hover:bg-[#FFF] hover:border-[#FF8138] hover:text-[#FF8138]">Batal</label>
                    {{-- submit --}}
                    <button type="Submit"
                        class="btn bg-[#3786FF] border-[#3786FF] w-[120px] text-[#fff] dark:text-[#fff] hover:bg-[#38B6FF] hover:border-[#38B6FF]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pop up Edit Akun-->
    @foreach ($akun as $usr)
        <div class="modal modal-bottom sm:modal-middle" id="edit-akun/{{ $usr->id_akun }}">
            <div class="modal-box bg-white text-black">
                <h3 class="font-bold text-lg mb-3 text-[#464748]">Edit Akun</h3>
                <form class="editAkunForm" action="{{ url('edit-akun') }}" method="POST">
                    @csrf
                    <input type="text" name="id_akun" class="hidden" value="{{ $usr->id_akun }}">
                    {{-- email --}}
                    <label class="label accent-black">
                        <span class="label-text text-black">Email <span class="text-[#FF000A]">*</span></span>
                    </label>
                    <input type="email" placeholder="Masukkan email" name="email"
                        value="{{ old('email', $usr->email) }}" required
                        class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                    {{-- password --}}
                    <label class="label">
                        <span class="label-text text-black">Password <span class="text-[#FF000A]">*</span></span>
                    </label>
                    <input type="password" placeholder="Masukkan Password" name="password"
                        value="" required
                        class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                    <!-- Level akun-->
                    <div>
                        <label class="label">
                            <span class="label-text text-black">Level akun <span class="text-[#FF000A]">*</span></span>
                        </label>
                        <select
                            class="select w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 dark:bg-white"
                            name="id_level" required>
                            <option disabled>Pilih Level akun</option>
                            @foreach ($level_akun as $lvl)
                                <option value="{{ $lvl->id_level }}" class="text-black"
                                    {{ $lvl->id_level == $usr->id_level ? 'selected' : '' }}>
                                    {{ $lvl->nama_level }}</option>
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Button -->
                    <div class="flex modal-action justify-center pl-5">
                        <a href="#"
                            class="btn btn-outline btn-[#FF8138] w-[120px] bg-[#fff] text-[#FF8138] hover:bg-[#FFF] hover:border-[#FF8138] hover:text-[#FF8138]">Batal</a>
                        <button type="submit" value="editakunKesiswaan"
                            class="btn bg-[#3786FF] border-[#3786FF] w-[120px] text-[#fff] dark:text-[#fff] hover:bg-[#38B6FF] hover:border-[#38B6FF]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Pop up hapus -->
        <div class="modal" id="delete-akun/{{ $usr->id_akun }}">
            <div class="modal-box bg-white text-black items-center justify-center text-center mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-18 w-18 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>

                <h3 class="font-semibold text-lg text-center mt-2">Apakah Anda Yakin? </h3>
                <p class="text-center">Data yang terhapus tidak dapat kembali!</p>
                </p>

                <!-- Button -->
                <div class="modal-action flex justify-center">
                    <a href="#"
                        class="btn btn-outline btn-[#FF8138] w-[120px] bg-[#fff] text-[#FF8138] hover:bg-[#FFF] hover:border-[#FF8138] hover:text-[#FF8138]">Batalkan</a>
                      <a href="/hapus-akun/{{ $usr->id_akun }}"
                        class="btn bg-[#ED1C24] border-[#ED1C24] w-[120px] text-[#fff] dark:text-[#fff] hover:bg-[#ED1C24] hover:border-[#ED1C24]">Hapus</a>
                </div>
            </div>
        </div>
    @endforeach

    <script type="text/javascript">
        $(document).ready(function() {
            // Setup CSRF for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // DataTable initialization function
            function initializeDataTable(level = null) {
                if ($.fn.DataTable.isDataTable('#akunTable')) {
                    $('#akunTable').DataTable().destroy();
                }

                $('#akunTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    searchable: true,
                    autoWidth: true,
                    paging: true,
                    deferRender: true,
                    orderClasses: false,
                    ajax: {
                        url: "{{ route('kelola-akun.data') }}",
                        type: "GET",
                        data: function(d) {
                            d.level = level;
                        },
                        error: function(xhr, error, thrown) {
                            console.error('DataTables error:', error, thrown);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to load account data. Please refresh the page and try again.',
                            });
                        }
                    },
                    columns: [{
                            data: 'id_akun',
                            name: 'id_akun',
                            className: 'dt-center text-black'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            className: 'dt-center text-black'
                        },
                        {
                            data: 'level_akun.nama_level',
                            name: 'level_akun.nama_level',
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
            initializeDataTable($('#level-filtering').val());

            // Handle level filtering
            $('#level-filtering').on('change', function() {
                var level = $(this).val();
                initializeDataTable(level);
            });

            // Handle delete button click
         
            // Handle add account form submission with SweetAlert
            $('#addAkunForm').submit(function(e) {
                // Don't prevent default so form still submits normally
                // Just show loading state
                Swal.fire({
                    title: 'Menambahkan Akun...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });

            // Handle edit account form submission with SweetAlert
            $('.editAkunForm').submit(function(e) {
                // Don't prevent default so form still submits normally
                // Just show loading state
                Swal.fire({
                    title: 'Menyimpan Perubahan...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            });
        });
    </script>
</body>
</html>