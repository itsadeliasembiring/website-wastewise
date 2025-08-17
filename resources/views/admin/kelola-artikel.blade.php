@extends('layouts.template')
@section('title', 'Kelola Artikel')

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

        @if(session('deleted'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Dihapus!',
                    text: "{{ session('deleted') }}",
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
                    Kelola Artikel</p>
            </div>
            <!-- Kelola Artikel -->
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
                                    Artikel WasteWise
                                </p>
                            </div>
                            {{-- Aksi --}}
                            <div class="grid flex-grow justify-end">
                                <div
                                    class="flex sm:flex-row sm:space-x-2 sm:space-y-0 xs:flex-col xs:space-y-2 xs:space-x-0">
                                    <div class="flex xl:flex-row space-x-2 items-center">
                                        <!-- Filter Tanggal -->
                                        <div class="relative w-fit">
                                            <input type="date" id="start-date"
                                                class="input input-sm h-9 bg-white border-[#3D8D7A] text-black !outline-none xs:text-[12px] sm:text-[14px] pl-10 pr-2"
                                                placeholder="Tanggal Mulai" />

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="#3D8D7A"
                                                class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="relative w-fit">
                                            <input type="date" id="end-date"
                                                class="input input-sm h-9 bg-white border-[#3D8D7A] text-black !outline-none xs:text-[12px] sm:text-[14px] pl-10 pr-2"
                                                placeholder="Tanggal Mulai" />

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="#3D8D7A"
                                                class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <button id="filter-date"
                                            class="btn btn-sm h-9 border-none pl-3 bg-[#3D8D7A] hover:bg-[#3D8D7A] text-white rounded-[10px] inline-flex justify-center items-center xs:text-[12px] sm:text-[14px]">
                                            Filter
                                        </button>
                                        <button id="reset-filter"
                                            class="btn btn-sm h-9 border-none pl-3 bg-gray-500 hover:bg-gray-600 text-white rounded-[10px] inline-flex justify-center items-center xs:text-[12px] sm:text-[14px]">
                                            Reset
                                        </button>
                                        <!-- Tambah -->
                                        <label for="add-artikel"
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
                        <!-- Table Daftar Artikel -->
                        <div class="card w-[100%] h-[100%] shadow-md bg-white text-primary-content px-4 py-4 mt-2">
                            <div class="overflow-x-auto">
                                <table id="artikelTable" class="stripe hover display responsive nowrap" style="width: 100%">
                                    <thead class="bg-white xl:w-fit sm:w-auto">
                                        <tr>
                                            <th scope="col"
                                                class="xl:text-sm xs:text-xs xl:flex font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                No
                                            </th>
                                            <th scope="col"
                                                class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                Judul Artikel
                                            </th>
                                            <th scope="col"
                                                class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                Tanggal Dibuat
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

    <!-- Pop up Artikel-->
    <input type="checkbox" id="add-artikel" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle dark:bg-[#E6E6E6]">
        <div class="modal-box bg-white text-black max-h-screen overflow-y-auto">
            <h3 class="font-bold text-lg mb-3 text-[#464748]">Form Artikel Baru</h3>
            <form id="addArtikelForm" action="{{ url('add-artikel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Judul Artikel --}}
                <label class="label accent-black">
                    <span class="label-text text-black">Judul Artikel <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="text" placeholder="Masukkan Judul Artikel" name="judul_artikel"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                {{-- Detail Artikel --}}
                <label class="label">
                    <span class="label-text text-black">Detail Artikel <span class="text-[#FF000A]">*</span></span>
                </label>
                <textarea placeholder="Masukkan Detail Artikel" name="detail_artikel" rows="6"
                    class="textarea w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required></textarea>

                {{-- Foto --}}
                <label class="label">
                    <span class="label-text text-black">Foto Artikel <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="file" name="foto" accept="image/*"
                    class="file-input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />
                <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</p>

                <!-- Button -->
                <div class="flex modal-action justify-center pl-5">
                    {{-- batal --}}
                    <label for="add-artikel"
                        class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</label>
                    {{-- submit --}}
                    <button type="Submit"
                        class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] dark:text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($artikel as $art)
        <!-- Pop up hapus -->
        <div class="modal" id="delete-artikel/{{ $art->id_artikel }}">
            <div class="modal-box bg-white text-black items-center justify-center text-center mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-18 w-18 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>

                <h3 class="font-semibold text-lg text-center mt-2">Apakah Anda Yakin? </h3>
                <p class="text-center">Data yang terhapus tidak dapat kembali!</p>

                <!-- Button -->
                <div class="modal-action flex justify-center">
                    <a href="#"
                        class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batalkan</a>
                    <a href="/hapus-artikel/{{ $art->id_artikel }}"
                        class="btn bg-[#ED1C24] border-[#ED1C24] w-[120px] text-[#fff] dark:text-[#fff] hover:bg-[#ED1C24] hover:border-[#ED1C24]">Hapus</a>
                </div>
            </div>
        </div>
    @endforeach
    
    @push('script')
        <script type="text/javascript">
            $(document).ready(function() {
                // Setup CSRF for AJAX requests
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // DataTable initialization function
                function initializeDataTable(startDate = null, endDate = null) {
                    if ($.fn.DataTable.isDataTable('#artikelTable')) {
                        $('#artikelTable').DataTable().destroy();
                    }

                    $('#artikelTable').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: false,
                        searchable: true,
                        autoWidth: true,
                        paging: true,
                        deferRender: true,
                        orderClasses: false,
                        ajax: {
                            url: "{{ route('kelola-artikel.data') }}",
                            type: "GET",
                            data: function(d) {
                                d.start_date = startDate;
                                d.end_date = endDate;
                            },
                            error: function(xhr, error, thrown) {
                                console.error('DataTables error:', error, thrown);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Failed to load artikel data. Please refresh the page and try again.',
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
                                data: 'judul_artikel',
                                name: 'judul_artikel',
                                className: 'dt-center text-black'
                            },
                            {
                                data: 'created_at',
                                name: 'created_at',
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
                initializeDataTable();

                // Filter date event
                $('#filter-date').on('click', function() {
                    var startDate = $('#start-date').val();
                    var endDate = $('#end-date').val();
                    
                    if (startDate && endDate) {
                        initializeDataTable(startDate, endDate);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan!',
                            text: 'Silakan pilih tanggal mulai dan tanggal akhir!'
                        });
                    }
                });

                // Reset filter event
                $('#reset-filter').on('click', function() {
                    $('#start-date').val('');
                    $('#end-date').val('');
                    initializeDataTable();
                });

                // Handle add artikel form
                $('#addArtikelForm').on('submit', function(e) {
                    Swal.fire({
                        title: 'Menambahkan Artikel...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                });

                // Handle modal checkbox for add artikel
                $('#add-artikel').on('change', function() {
                    if (!this.checked) {
                        // Reset form when modal is closed
                        $('#addArtikelForm')[0].reset();
                    }
                });
            });

            // Function untuk menampilkan detail artikel
            function showDetail(id) {
                // Redirect ke halaman edit artikel
                window.location.href = '/detail-artikel/' + id;
            }

            // Function untuk edit artikel - REDIRECT KE HALAMAN TERPISAH
            function editArtikel(id) {
                // Redirect ke halaman edit artikel
                window.location.href = '/edit-artikel/' + id;
            }

            // Function untuk konfirmasi delete
            function confirmDelete(id) {
                const modal = document.getElementById('delete-artikel/' + id);
                if (modal) {
                    modal.classList.add('modal-open');
                    
                    // Close modal when clicking outside or cancel button
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            modal.classList.remove('modal-open');
                        }
                    });
                    
                    // Handle cancel button
                    const cancelBtn = modal.querySelector('a[href="#"]');
                    if (cancelBtn) {
                        cancelBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            modal.classList.remove('modal-open');
                        });
                    }
                }
            }

            // Function untuk close semua modal
            function closeAllModals() {
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    modal.classList.remove('modal-open');
                });
            }

            // Event listener untuk ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAllModals();
                }
            });
        </script>
    @endpush
@endsection