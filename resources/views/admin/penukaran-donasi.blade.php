@extends('layouts.template')
@section('title', 'Kelola Donasi')

@section('content')
    @php
        if (count($errors) > 0) {
            // Menggabungkan semua pesan error menjadi satu string
            $errorMessages = '';
            foreach ($errors->all() as $error) {
                $errorMessages .= $error . '<br>';
            }
            alert()->error('Gagal', $errorMessages)->html()->persistent('Tutup');
        }
    @endphp
    <x-header.admin />

    <div class="flex min-h-full">
        <div class="relative">
            <x-sidebar.admin />
        </div>

        @if (session('success'))
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

        @if (session('error'))
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

        <main class="justify-center w-full">
            <div class="mt-4 sm:px-8">
                <p class="text-[#3D8D7A] text-center font-semibold xs:text-[23px] sm:text-[23px] xl:text-[25px]">
                    Kelola Donasi dan Riwayat Penukaran</p>
            </div>

            <div class="pl-[70px] pr-[20px]">
                <div class="tabs tabs-border mt-4">
                    {{-- Tab Kelola Donasi --}}
                    <input type="radio" name="my_tabs_2" role="tab" class="tab !text-[#3D8D7A] font-semibold ml-3"
                        aria-label="Kelola Donasi" checked />
                    <div role="tabpanel" class="tab-content p-6">
                        <div class="flex flex-col w-full align-top">
                            <div
                                class="flex items-center align-middle xs:flex-row sm:flex-row md:flex-row xl:flex-row xs:space-y-1 xl:space-y-0">
                                <div>
                                    <p
                                        class="text-[#464748] font-semibold xs:text-[20px] sm:text-[22px] xs:text-center sm:text-left">
                                        Data Donasi
                                    </p>
                                </div>
                                {{-- Aksi --}}
                                <div class="grid flex-grow justify-end">
                                    <div
                                        class="flex sm:flex-row sm:space-x-2 sm:space-y-0 xs:flex-col xs:space-y-2 xs:space-x-0">
                                        <div class="flex xl:flex-row space-x-2 items-center">
                                            {{-- Tambah button --}}
                                            <label for="add-donasi-modal"
                                                class="btn btn-sm h-9 border-none pl-3 bg-[#00D100] hover:bg-[#00D100] text-white rounded-[10px] inline-flex justify-center items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px] sm:mr-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                <span
                                                    class="xs:hidden sm:inline-block xs:text-[12px] sm:text-[14px]">Tambah
                                                    Donasi</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card w-[100%] h-[100%] shadow-md bg-white text-primary-content px-4 py-4 mt-2">
                                <div class="overflow-x-auto">
                                    <table id="donasiTable" class="stripe hover display responsive nowrap"
                                        style="width: 100%">
                                        <thead class="bg-white xl:w-fit sm:w-auto">
                                            <tr>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    ID Donasi
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Foto
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Nama Donasi
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Total Poin Donasi
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] sm:text-xs">
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Data diisi oleh DataTables --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tab Riwayat Penukaran Donasi --}}
                    <input type="radio" name="my_tabs_2" role="tab"
                        class="tab !text-[#3D8D7A] font-semibold" aria-label="Riwayat Penukaran Donasi" />
                    <div role="tabpanel" class="tab-content p-6">
                        <div class="flex flex-col w-full align-top">
                            <div
                                class="flex items-center align-middle xs:flex-row sm:flex-row md:flex-row xl:flex-row xs:space-y-1 xl:space-y-0">
                                <div>
                                    <p
                                        class="text-[#464748] font-semibold xs:text-[20px] sm:text-[22px] xs:text-center sm:text-left">
                                        Riwayat Penukaran Donasi
                                    </p>
                                </div>
                                <div class="grid flex-grow justify-end">
                                    {{-- Filter select removed from here --}}
                                </div>
                            </div>
                            <div
                                class="card w-[100%] h-[100%] shadow-md bg-white text-primary-content px-4 py-4 mt-2">
                                <div class="overflow-x-auto">
                                    <table id="riwayatPenukaranDonasiTable" class="stripe hover display responsive nowrap"
                                        style="width: 100%">
                                        <thead class="bg-white xl:w-fit sm:w-auto">
                                            <tr>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    No
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    ID Penukaran
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Nama Donasi
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Nama Penukar
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Waktu Penukaran
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Jumlah Poin Donasi
                                                </th>
                                                {{-- Status column header removed --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Data diisi oleh DataTables --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- Modal Tambah Donasi --}}
    <input type="checkbox" id="add-donasi-modal" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle dark:bg-[#E6E6E6]">
        <div class="modal-box bg-white text-black max-w-2xl">
            <h3 class="font-bold text-lg mb-3 text-[#464748]">Form Donasi Baru</h3>
            <form id="addDonasiForm" action="{{ route('donasi.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label accent-black">
                            <span class="label-text text-black">Nama Donasi <span class="text-[#FF000A]">*</span></span>
                        </label>
                        <input type="text" placeholder="Masukkan Nama Donasi" name="nama_donasi"
                            class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white"
                            required />
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text text-black">Total Poin Donasi</span>
                        </label>
                        <input type="number" placeholder="0" name="total_donasi" min="0" disabled value="0"
                            class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                    </div>
                </div>
                 <div class="mt-4">
                    <label class="label">
                        <span class="label-text text-black">Foto Donasi</span>
                    </label>
                    <input type="file" name="foto" accept="image/*"
                        class="file-input file-input-bordered w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                </div>
                <div class="mt-4">
                    <label class="label">
                        <span class="label-text text-black">Deskripsi Donasi <span
                                class="text-[#FF000A]">*</span></span>
                    </label>
                    <textarea placeholder="Masukkan Deskripsi Donasi" name="deskripsi_donasi" rows="3"
                        class="textarea w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required></textarea>
                </div>

                <div class="flex modal-action justify-center mt-6">
                    <label for="add-donasi-modal"
                        class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</label>
                    <button type="submit"
                        class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    {{-- Iterasi untuk modal edit dan delete donasi --}}
    @if(isset($donasi))
        @foreach ($donasi as $item)
            <input type="checkbox" id="edit-donasi-modal-{{ $item->id_donasi }}" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle dark:bg-[#E6E6E6]" id="edit-donasi-{{ $item->id_donasi }}">
                <div class="modal-box bg-white text-black max-w-2xl">
                    <h3 class="font-bold text-lg mb-3 text-[#464748]">Edit Donasi</h3>
                    <form class="editDonasiForm" action="{{ route('donasi.edit') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_donasi" value="{{ $item->id_donasi }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="label accent-black">
                                    <span class="label-text text-black">Nama Donasi <span
                                            class="text-[#FF000A]">*</span></span>
                                </label>
                                <input type="text" name="nama_donasi" value="{{ $item->nama_donasi }}"
                                    class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white"
                                    required />
                            </div>
                            <div>
                                <label class="label">
                                    <span class="label-text text-black">Total Poin Donasi</span>
                                </label>
                                <input type="number" name="total_donasi" value="{{ $item->total_donasi }}" min="0" disabled
                                    placeholder="{{ $item->total_donasi }}"
                                    class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="label">
                                <span class="label-text text-black">Foto Donasi</span>
                            </label>
                            @if ($item->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/donasi/' . $item->foto) }}" alt="Foto Donasi"
                                        class="w-20 h-20 object-cover rounded">
                                    <p class="text-sm text-gray-500">Foto saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="foto" accept="image/*"
                                class="file-input file-input-bordered w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                        </div>
                        <div class="mt-4">
                            <label class="label">
                                <span class="label-text text-black">Deskripsi Donasi <span
                                        class="text-[#FF000A]">*</span></span>
                            </label>
                            <textarea name="deskripsi_donasi" rows="3"
                                class="textarea w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required>{{ $item->deskripsi_donasi }}</textarea>
                        </div>

                        <div class="flex modal-action justify-center mt-6">
                                <label for="edit-donasi-modal-{{ $item->id_donasi }}"
                                    class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</label>
                            <button type="submit"
                                class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Delete Donasi --}}
            <input type="checkbox" id="delete-donasi-modal-{{ $item->id_donasi }}" class="modal-toggle" />
            <div class="modal" id="delete-donasi-{{ $item->id_donasi }}">
                <div class="modal-box bg-white text-black items-center justify-center text-center mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-18 w-18 mx-auto text-red-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <h3 class="font-semibold text-lg text-center mt-2">Apakah Anda Yakin?</h3>
                    <p class="text-center">Data donasi "{{ $item->nama_donasi }}" akan dihapus permanen!</p>
                    <div class="modal-action flex justify-center">
                        <label for="delete-donasi-modal-{{ $item->id_donasi }}"
                            class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batalkan</label>
                        <a href="{{ route('donasi.delete', ['id' => $item->id_donasi]) }}"
                            class="btn bg-[#ED1C24] border-[#ED1C24] w-[120px] text-[#fff] hover:bg-[#ED1C24] hover:border-[#ED1C24]">Hapus</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif


    <script>
        $(document).ready(function() {
            // Initialize DataTable for Donasi
            var donasiTable = $('#donasiTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('donasi.data') }}", // Updated route
                },
                columns: [{
                    data: 'id_donasi',
                    name: 'id_donasi',
                    className: 'text-center dt-body-center'
                }, {
                    data: 'foto',
                    name: 'foto',
                    orderable: false,
                    searchable: false,
                    className: 'text-center dt-body-center'
                }, {
                    data: 'nama_donasi',
                    name: 'nama_donasi'
                }, 
                {
                    data: 'total_donasi',
                    name: 'total_donasi',
                    className: 'text-center dt-body-center',
                    render: function(data, type, row) {
                        // Display points without "Rp"
                        const value = parseInt(data);
                        return !isNaN(value) ? value.toString() : '0';
                    }
                },  
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center dt-body-center'
                }],
                language: { // Indonesian language settings
                    processing: "Memproses...",
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada data donasi tersedia"
                }
            });

            // Initialize DataTable for Riwayat Penukaran Donasi
            var riwayatPenukaranDonasiTable = $('#riwayatPenukaranDonasiTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('riwayat.penukaran.donasi.data') }}",
                    data: function(d) {
                        // d.status = $('#status-redeem-filter').val(); // Removed status filter
                    }
                },
                columns: [{
                    data: 'DT_RowIndex', // For auto numbering
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'text-center dt-body-center'
                }, 
                {
                    data: 'id_penukaran_donasi', // ADDED: ID Penukaran
                    name: 'id_penukaran_donasi', // Ensure backend provides this
                    className: 'text-center dt-body-center'
                },
                {
                    data: 'nama_donasi', // from controller: $row->donasi->nama_donasi
                    name: 'donasi.nama_donasi' // for server-side searching/sorting on related table
                }, {
                    data: 'nama_pengguna', // from controller: $row->pengguna->nama_lengkap
                    name: 'pengguna.nama_lengkap'
                }, {
                    data: 'waktu_formatted',
                    name: 'waktu' // base column for sorting
                }, {
                    data: 'jumlah_poin', // MODIFIED: Use raw jumlah_poin for points
                    name: 'jumlah_poin', // base column for sorting
                    className: 'text-center dt-body-center',
                    render: function(data, type, row) { // ADDED: Render for points
                        const value = parseInt(data);
                        return !isNaN(value) ? value.toString() : '0';
                    }
                }
                // { // REMOVED: Status column
                //     data: 'status_badge',
                //     name: 'status_redeem',
                //     className: 'text-center dt-body-center'
                // }
                ],
                language: { // Indonesian language settings
                    processing: "Memproses...",
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada riwayat penukaran donasi tersedia"
                }
            });

            // REMOVED: Filter for Riwayat Penukaran status
            // $('#status-redeem-filter').on('change', function() {
            //     riwayatPenukaranDonasiTable.draw();
            // });

            // Global functions for modal handling
            window.openEditModal = function(id) {
                const checkboxId = `edit-donasi-modal-${id}`;
                const checkbox = document.getElementById(checkboxId);
                if (checkbox) {
                    checkbox.checked = true;
                }
            };

            window.openDeleteModal = function(id) {
                const checkboxId = `delete-donasi-modal-${id}`;
                const checkbox = document.getElementById(checkboxId);
                if (checkbox) {
                    checkbox.checked = true;
                }
            };
            
            // Handle modal toggle checkbox changes
            $(document).on('change', 'input[type="checkbox"].modal-toggle', function() {
                var modalId = $(this).attr('id');
                var modal;
                
                if (modalId === 'add-donasi-modal') {
                    modal = $(this).next('.modal')[0];
                } else {
                    var targetModalId = modalId.replace('-modal', ''); 
                    modal = document.getElementById(targetModalId);
                }
                
                if (modal) {
                    if (this.checked) {
                        modal.classList.add('modal-open');
                    } else {
                        modal.classList.remove('modal-open');
                        var form = modal.querySelector('form');
                        if (form && modalId === 'add-donasi-modal') {
                            form.reset();
                        }
                    }
                }
            });

            // Close modal when clicking on the backdrop
            $(document).on('click', '.modal', function(e) {
                if (e.target === this) { 
                    this.classList.remove('modal-open');
                    const modalId = $(this).attr('id'); 
                    let checkboxId;
                    
                    if (modalId) { 
                        if (modalId.startsWith('edit-donasi-')) {
                            checkboxId = modalId.replace('edit-donasi-', 'edit-donasi-modal-');
                        } else if (modalId.startsWith('delete-donasi-')) {
                            checkboxId = modalId.replace('delete-donasi-', 'delete-donasi-modal-');
                        }
                    } else { 
                         const modalToggle = $(this).prev('input.modal-toggle');
                         if (modalToggle.length > 0) {
                            checkboxId = modalToggle.attr('id');
                         }
                    }
                    
                    if (checkboxId) {
                        $('#' + checkboxId).prop('checked', false);
                    } else if ($(this).prev('input.modal-toggle').length > 0) {
                        $(this).prev('input.modal-toggle').prop('checked', false);
                    }
                }
            });


            // Close modal with "Batal" button
            $(document).on('click', '.modal-box .btn[class*="btn-outline"]', function(e) {
                e.preventDefault();
                var modal = $(this).closest('.modal');
                if (modal.length > 0) {
                    modal[0].classList.remove('modal-open');
                    const modalId = modal.attr('id');
                    let checkboxId;
                    
                    if (modalId) {
                        if (modalId.startsWith('edit-donasi-')) {
                            checkboxId = modalId.replace('edit-donasi-', 'edit-donasi-modal-');
                        } else if (modalId.startsWith('delete-donasi-')) {
                            checkboxId = modalId.replace('delete-donasi-', 'delete-donasi-modal-');
                        }
                    } else {
                         const modalToggleId = modal.prev('input.modal-toggle').attr('id');
                         if (modalToggleId) {
                            checkboxId = modalToggleId;
                         }
                    }
                    
                    if (checkboxId) {
                        $('#' + checkboxId).prop('checked', false);
                    }
                }
            });

            // Close modal with Escape key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    $('.modal.modal-open').each(function() {
                        this.classList.remove('modal-open');
                        const modalId = $(this).attr('id');
                        let checkboxId;
                        
                        if (modalId) {
                            if (modalId.startsWith('edit-donasi-')) {
                                checkboxId = modalId.replace('edit-donasi-', 'edit-donasi-modal-');
                            } else if (modalId.startsWith('delete-donasi-')) {
                                checkboxId = modalId.replace('delete-donasi-', 'delete-donasi-modal-');
                            }
                        } else {
                            const modalToggleId = $(this).prev('input.modal-toggle').attr('id');
                            if (modalToggleId) {
                                checkboxId = modalToggleId;
                            }
                        }
                        
                        if (checkboxId) {
                            $('#' + checkboxId).prop('checked', false);
                        }
                    });
                }
            });


            // Form validation and submission
            $('#addDonasiForm').on('submit', function(e) {
                if (!validateDonasiForm(this)) {
                    e.preventDefault();
                    return false;
                }
                showLoadingAlert('Menyimpan Data Donasi...');
            });

            $(document).on('submit', '.editDonasiForm', function(e) {
                if (!validateDonasiForm(this)) {
                    e.preventDefault();
                    return false;
                }
                showLoadingAlert('Memperbarui Data Donasi...');
            });

            function validateDonasiForm(form) {
                var $form = $(form);
                var nama = $form.find('input[name="nama_donasi"]').val().trim();
                var totalDonasi = $form.find('input[name="total_donasi"]').val(); 
                var deskripsi = $form.find('textarea[name="deskripsi_donasi"]').val().trim();
                var fotoInput = $form.find('input[name="foto"]')[0];

                if (!nama) {
                    showErrorAlert('Nama donasi tidak boleh kosong!');
                    return false;
                }
                if (nama.length > 255) {
                    showErrorAlert('Nama donasi maksimal 255 karakter!');
                    return false;
                }
                if (totalDonasi !== '' && (isNaN(parseFloat(totalDonasi)) || parseFloat(totalDonasi) < 0)) {
                    showErrorAlert('Total poin donasi harus berupa angka positif atau kosong!');
                    return false;
                }
                if (!deskripsi) {
                    showErrorAlert('Deskripsi donasi tidak boleh kosong!');
                    return false;
                }
                if (fotoInput && fotoInput.files.length > 0) {
                    const file = fotoInput.files[0];
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    const maxSize = 2 * 1024 * 1024; // 2MB

                    if (!allowedTypes.includes(file.type)) {
                        showErrorAlert('Format gambar harus jpeg, png, jpg, atau gif!');
                        return false;
                    }
                    if (file.size > maxSize) {
                        showErrorAlert('Ukuran gambar maksimal 2MB!');
                        return false;
                    }
                }
                return true;
            }

            function showErrorAlert(message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error Validasi!',
                    html: message,
                    confirmButtonColor: '#3D8D7A'
                });
            }

            function showLoadingAlert(title) {
                Swal.fire({
                    title: title,
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        });
    </script>

    <style>
        .dt-body-center {
            text-align: center;
            vertical-align: middle;
        }

        table.dataTable tbody td {
             vertical-align: middle;
        }
        .modal {
            display: none; /* Hidden by default */
        }
        .modal-open { /* Utility class to force modal open */
            display: flex !important;
            opacity: 1 !important;
            visibility: visible !important;
            align-items: center;
            justify-content: center;
        }
        .modal {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.5); z-index: 1000;
            opacity: 0; visibility: hidden;
            transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
            will-change: opacity, visibility;
        }
        input.modal-toggle:checked + .modal {
            opacity: 1 !important; visibility: visible !important; display: flex !important;
            align-items: center; justify-content: center;
        }
        .modal.modal-open { /* If manually adding .modal-open class */
            opacity: 1 !important; visibility: visible !important; display: flex !important;
            align-items: center; justify-content: center;
        }
        .modal-box {
            transform: scale(0.9) translateY(-20px);
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform;
            backface-visibility: hidden;
            -webkit-font-smoothing: antialiased;
        }
        input.modal-toggle:checked + .modal .modal-box,
        .modal.modal-open .modal-box {
            transform: scale(1) translateY(0);
        }
        .dataTables_wrapper { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        table { border-collapse: collapse; }
        @media (max-width: 768px) {
            .modal-box { margin: 1rem; max-height: calc(100vh - 2rem); overflow-y: auto; -webkit-overflow-scrolling: touch; }
            .table { font-size: 12px; transform: translateZ(0); }
            .btn { padding: 0.25rem 0.5rem; font-size: 12px; min-height: auto; }
        }
        .input, .select, .textarea { will-change: auto; }
        .input:focus, .select:focus, .textarea:focus { transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
        .btn { transform: translateZ(0); transition: all 0.15s ease-in-out; }
        .tab-content { min-height: 400px; contain: layout style; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
        @media (prefers-reduced-motion: reduce) {
            .modal, .modal-box, .btn { transition: none !important; animation: none !important; }
        }
    </style>
@endsection