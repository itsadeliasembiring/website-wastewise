@extends('layouts.template')
@section('title', 'Kelola Penukaran Barang')

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
                    Kelola Penukaran Barang</p>
            </div>

            <div class="pl-[70px] pr-[20px]">
                <div class="tabs tabs-border mt-4">
                    {{-- Tab Kelola Barang --}}
                    <input type="radio" name="my_tabs_2" role="tab" class="tab !text-[#3D8D7A] font-semibold ml-3"
                        aria-label="Kelola Barang" checked />
                    <div role="tabpanel" class="tab-content p-6">
                        <div class="flex flex-col w-full align-top">
                            <div
                                class="flex items-center align-middle xs:flex-row sm:flex-row md:flex-row xl:flex-row xs:space-y-1 xl:space-y-0">
                                <div>
                                    <p
                                        class="text-[#464748] font-semibold xs:text-[20px] sm:text-[22px] xs:text-center sm:text-left">
                                        Data Barang
                                    </p>
                                </div>
                                {{-- Aksi --}}
                                <div class="grid flex-grow justify-end">
                                    <div
                                        class="flex sm:flex-row sm:space-x-2 sm:space-y-0 xs:flex-col xs:space-y-2 xs:space-x-0">
                                        <div class="flex xl:flex-row space-x-2 items-center">
                                            {{-- Tambah button --}}
                                            <label for="add-barang-modal"
                                                class="btn btn-sm h-9 border-none pl-3 bg-[#00D100] hover:bg-[#00D100] text-white rounded-[10px] inline-flex justify-center items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px] sm:mr-3"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                <span
                                                    class="xs:hidden sm:inline-block xs:text-[12px] sm:text-[14px]">Tambah
                                                    Barang</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card w-[100%] h-[100%] shadow-md bg-white text-primary-content px-4 py-4 mt-2">
                                <div class="overflow-x-auto">
                                    <table id="barangTable" class="stripe hover display responsive nowrap"
                                        style="width: 100%">
                                        <thead class="bg-white xl:w-fit sm:w-auto">
                                            <tr>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    ID Barang
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Foto
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Nama Barang
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Bobot Poin
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Stok
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

                    {{-- Tab Riwayat Penukaran Barang --}}
                    <input type="radio" name="my_tabs_2" role="tab"
                        class="tab !text-[#3D8D7A] font-semibold" aria-label="Riwayat Penukaran" />
                    <div role="tabpanel" class="tab-content p-6">
                        <div class="flex flex-col w-full align-top">
                            <div
                                class="flex items-center align-middle xs:flex-row sm:flex-row md:flex-row xl:flex-row xs:space-y-1 xl:space-y-0">
                                <div>
                                    <p
                                        class="text-[#464748] font-semibold xs:text-[20px] sm:text-[22px] xs:text-center sm:text-left">
                                        Riwayat Penukaran Barang
                                    </p>
                                </div>
                                <div class="grid flex-grow justify-end">
                                    <div class="flex xl:flex-row space-x-2 items-center">
                                        <select class="filter select select-sm w-fit h-9 bg-[#3D8D7A] text-[#fff] !outline-none xs:text-[12px] sm:text-[14px]"
                                            name="status_redeem_filter" id="status-redeem-filter">
                                            <option class="text-[#000] bg-[#fff]" value="all">Semua Status</option>
                                            <option class="text-[#000] bg-[#fff]" value="true">Sudah Ditukar</option>
                                            <option class="text-[#000] bg-[#fff]" value="false">Belum Ditukar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card w-[100%] h-[100%] shadow-md bg-white text-primary-content px-4 py-4 mt-2">
                                <div class="overflow-x-auto">
                                    <table id="riwayatPenukaranTable" class="stripe hover display responsive nowrap"
                                        style="width: 100%">
                                        <thead class="bg-white xl:w-fit sm:w-auto">
                                            <tr>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    No
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Nama Barang
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
                                                    Jumlah
                                                </th>
                                                <th scope="col"
                                                    class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Status
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
                </div>
            </div>
        </main>
    </div>

    {{-- Modal Tambah Barang --}}
    <input type="checkbox" id="add-barang-modal" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle dark:bg-[#E6E6E6]">
        <div class="modal-box bg-white text-black max-w-2xl">
            <h3 class="font-bold text-lg mb-3 text-[#464748]">Form Barang Baru</h3>
            <form id="addBarangForm" action="{{ route('barang.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label accent-black">
                            <span class="label-text text-black">Nama Barang <span class="text-[#FF000A]">*</span></span>
                        </label>
                        <input type="text" placeholder="Masukkan Nama Barang" name="nama_barang"
                            class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white"
                            required />
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text text-black">Bobot Poin <span class="text-[#FF000A]">*</span></span>
                        </label>
                        <input type="number" placeholder="Masukkan Bobot Poin" name="bobot_poin" min="0"
                            class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white"
                            required />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="label">
                            <span class="label-text text-black">Stok <span class="text-[#FF000A]">*</span></span>
                        </label>
                        <input type="number" placeholder="Masukkan Stok Barang" name="stok" min="0"
                            class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white"
                            required />
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text text-black">Foto Barang</span>
                        </label>
                        <input type="file" name="foto" accept="image/*"
                            class="file-input file-input-bordered w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                    </div>
                </div>
                <div class="mt-4">
                    <label class="label">
                        <span class="label-text text-black">Deskripsi Barang <span
                                class="text-[#FF000A]">*</span></span>
                    </label>
                    <textarea placeholder="Masukkan Deskripsi Barang" name="deskripsi_barang" rows="3"
                        class="textarea w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required></textarea>
                </div>

                <div class="flex modal-action justify-center mt-6">
                    <label for="add-barang-modal"
                        class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</label>
                    <button type="submit"
                        class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    {{-- Modal Edit Barang (struktur sama dengan add, di-clone dan diisi data via JS) --}}
    {{-- Iterasi untuk modal edit dan delete barang --}}
    @foreach ($barang as $item)
        <input type="checkbox" id="edit-barang-modal-{{ $item->id_barang }}" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle dark:bg-[#E6E6E6]" id="edit-barang-{{ $item->id_barang }}">
            <div class="modal-box bg-white text-black max-w-2xl">
                <h3 class="font-bold text-lg mb-3 text-[#464748]">Edit Barang</h3>
                <form class="editBarangForm" action="{{ route('barang.edit') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_barang" value="{{ $item->id_barang }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label accent-black">
                                <span class="label-text text-black">Nama Barang <span
                                        class="text-[#FF000A]">*</span></span>
                            </label>
                            <input type="text" name="nama_barang" value="{{ $item->nama_barang }}"
                                class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white"
                                required />
                        </div>
                        <div>
                            <label class="label">
                                <span class="label-text text-black">Bobot Poin <span
                                        class="text-[#FF000A]">*</span></span>
                            </label>
                            <input type="number" name="bobot_poin" value="{{ $item->bobot_poin }}" min="0"
                                class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white"
                                required />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="label">
                                <span class="label-text text-black">Stok <span class="text-[#FF000A]">*</span></span>
                            </label>
                            <input type="number" name="stok" value="{{ $item->stok }}" min="0"
                                class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white"
                                required />
                        </div>
                        <div>
                            <label class="label">
                                <span class="label-text text-black">Foto Barang</span>
                            </label>
                            @if ($item->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/barang/' . $item->foto) }}" alt="Foto Barang"
                                        class="w-20 h-20 object-cover rounded">
                                    <p class="text-sm text-gray-500">Foto saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="foto" accept="image/*"
                                class="file-input file-input-bordered w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="label">
                            <span class="label-text text-black">Deskripsi Barang <span
                                    class="text-[#FF000A]">*</span></span>
                        </label>
                        <textarea name="deskripsi_barang" rows="3"
                            class="textarea w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required>{{ $item->deskripsi_barang }}</textarea>
                    </div>

                    <div class="flex modal-action justify-center mt-6">
                         <label for="edit-barang-modal-{{ $item->id_barang }}"
                            class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</label>
                        <button type="submit"
                            class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Delete Barang --}}
        <input type="checkbox" id="delete-barang-modal-{{ $item->id_barang }}" class="modal-toggle" />
        <div class="modal" id="delete-barang-{{ $item->id_barang }}">
            <div class="modal-box bg-white text-black items-center justify-center text-center mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-18 w-18 mx-auto text-red-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                <h3 class="font-semibold text-lg text-center mt-2">Apakah Anda Yakin?</h3>
                <p class="text-center">Data barang "{{ $item->nama_barang }}" akan dihapus permanen!</p>
                <div class="modal-action flex justify-center">
                    <label for="delete-barang-modal-{{ $item->id_barang }}"
                        class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batalkan</label>
                    <a href="{{ route('barang.delete', ['id' => $item->id_barang]) }}"
                        class="btn bg-[#ED1C24] border-[#ED1C24] w-[120px] text-[#fff] hover:bg-[#ED1C24] hover:border-[#ED1C24]">Hapus</a>
                </div>
            </div>
        </div>
    @endforeach


    <script>
        $(document).ready(function() {
            // Initialize DataTable for Barang
            var barangTable = $('#barangTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('barang.data') }}",
                },
                columns: [{
                    data: 'id_barang',
                    name: 'id_barang',
                    className: 'text-center dt-body-center'
                }, {
                    data: 'foto',
                    name: 'foto',
                    orderable: false,
                    searchable: false,
                    className: 'text-center dt-body-center'
                }, {
                    data: 'nama_barang',
                    name: 'nama_barang'
                }, {
                    data: 'bobot_poin',
                    name: 'bobot_poin',
                    className: 'text-center dt-body-center'
                }, {
                    data: 'stok_status',
                    name: 'stok',
                    className: 'text-center dt-body-center'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center dt-body-center'
                }],
                language: {
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
                    emptyTable: "Tidak ada data barang tersedia"
                }
            });

            // Initialize DataTable for Riwayat Penukaran
            var riwayatPenukaranTable = $('#riwayatPenukaranTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('riwayat.penukaran.data') }}",
                    data: function(d) {
                        d.status = $('#status-redeem-filter').val();
                    }
                },
                columns: [{
                    data: 'id_penukaran_barang',
                    name: 'id_penukaran_barang',
                    className: 'text-center dt-body-center'
                }, {
                    data: 'nama_barang',
                    name: 'barang.nama_barang'
                }, {
                    data: 'nama_pengguna',
                    name: 'pengguna.nama_lengkap'
                }, {
                    data: 'waktu_formatted',
                    name: 'waktu'
                }, {
                    data: 'jumlah_poin',
                    name: 'jumlah_poin',
                    className: 'text-center dt-body-center'
                }, {
                    data: 'status_badge',
                    name: 'status_redeem',
                    className: 'text-center dt-body-center'
                }],
                language: {
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
                    emptyTable: "Tidak ada riwayat penukaran tersedia"
                }
            });

            // Filter for Riwayat Penukaran status
            $('#status-redeem-filter').on('change', function() {
                riwayatPenukaranTable.draw();
            });

            // Global functions for modal handling (called from controller-generated buttons)
            window.openEditModal = function(id) {
                const checkboxId = `edit-barang-modal-${id}`;
                const checkbox = document.getElementById(checkboxId);
                if (checkbox) {
                    checkbox.checked = true;
                }
            };

            window.openDeleteModal = function(id) {
                const checkboxId = `delete-barang-modal-${id}`;
                const checkbox = document.getElementById(checkboxId);
                if (checkbox) {
                    checkbox.checked = true;
                }
            };

            // Handle modal toggle checkbox changes
            $(document).on('change', 'input[type="checkbox"].modal-toggle', function() {
                var modalId = $(this).attr('id');
                var modal;
                
                if (modalId === 'add-barang-modal') {
                    modal = $(this).next('.modal')[0];
                } else {
                    // For edit and delete modals
                    var targetModalId = modalId.replace('-modal', '');
                    modal = document.getElementById(targetModalId);
                }
                
                if (modal) {
                    if (this.checked) {
                        modal.classList.add('modal-open');
                    } else {
                        modal.classList.remove('modal-open');
                        var form = modal.querySelector('form');
                        if (form && modalId === 'add-barang-modal') {
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
                        if (modalId.startsWith('edit-barang-')) {
                            checkboxId = modalId.replace('edit-barang-', 'edit-barang-modal-');
                        } else if (modalId.startsWith('delete-barang-')) {
                            checkboxId = modalId.replace('delete-barang-', 'delete-barang-modal-');
                        }
                        
                        if (checkboxId) {
                            $('#' + checkboxId).prop('checked', false);
                        }
                    } else {
                        // For add modal
                        const modalToggleId = $(this).prev('input.modal-toggle').attr('id');
                        if (modalToggleId) {
                            $('#' + modalToggleId).prop('checked', false);
                        }
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
                        if (modalId.startsWith('edit-barang-')) {
                            checkboxId = modalId.replace('edit-barang-', 'edit-barang-modal-');
                        } else if (modalId.startsWith('delete-barang-')) {
                            checkboxId = modalId.replace('delete-barang-', 'delete-barang-modal-');
                        }
                        
                        if (checkboxId) {
                            $('#' + checkboxId).prop('checked', false);
                        }
                    } else {
                        const modalToggleId = modal.prev('input.modal-toggle').attr('id');
                        if (modalToggleId) {
                            $('#' + modalToggleId).prop('checked', false);
                        }
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
                            if (modalId.startsWith('edit-barang-')) {
                                checkboxId = modalId.replace('edit-barang-', 'edit-barang-modal-');
                            } else if (modalId.startsWith('delete-barang-')) {
                                checkboxId = modalId.replace('delete-barang-', 'delete-barang-modal-');
                            }
                            
                            if (checkboxId) {
                                $('#' + checkboxId).prop('checked', false);
                            }
                        } else {
                            const modalToggleId = $(this).prev('input.modal-toggle').attr('id');
                            if (modalToggleId) {
                                $('#' + modalToggleId).prop('checked', false);
                            }
                        }
                    });
                }
            });

            // Form validation and submission
            $('#addBarangForm').on('submit', function(e) {
                if (!validateBarangForm(this)) {
                    e.preventDefault();
                    return false;
                }
                showLoadingAlert('Menyimpan Data Barang...');
            });

            $(document).on('submit', '.editBarangForm', function(e) {
                if (!validateBarangForm(this)) {
                    e.preventDefault();
                    return false;
                }
                showLoadingAlert('Memperbarui Data Barang...');
            });

            function validateBarangForm(form) {
                var $form = $(form);
                var nama = $form.find('input[name="nama_barang"]').val().trim();
                var bobotPoin = $form.find('input[name="bobot_poin"]').val();
                var stok = $form.find('input[name="stok"]').val();
                var deskripsi = $form.find('textarea[name="deskripsi_barang"]').val().trim();
                var fotoInput = $form.find('input[name="foto"]')[0];

                if (!nama) {
                    showErrorAlert('Nama barang tidak boleh kosong!');
                    return false;
                }
                if (nama.length > 255) {
                    showErrorAlert('Nama barang maksimal 255 karakter!');
                    return false;
                }
                if (bobotPoin === '' || isNaN(parseFloat(bobotPoin)) || parseFloat(bobotPoin) < 0) {
                    showErrorAlert('Bobot poin tidak boleh kosong dan harus berupa angka positif!');
                    return false;
                }
                if (stok === '' || isNaN(parseInt(stok)) || parseInt(stok) < 0 || !Number.isInteger(parseFloat(stok))) {
                    showErrorAlert('Stok tidak boleh kosong dan harus berupa angka bulat positif!');
                    return false;
                }
                if (!deskripsi) {
                    showErrorAlert('Deskripsi barang tidak boleh kosong!');
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
            display: none;
            /* Hidden by default, controlled by checkbox:checked + .modal */
            /* Tailwind's modal component handles visibility, this is a fallback or for direct manipulation */
        }

        .modal-open { /* Utility class to force modal open if needed via JS */
            display: flex !important;
            opacity: 1 !important;
            visibility: visible !important;
            align-items: center;
            justify-content: center;
        }

        /* Styling from your example */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
            will-change: opacity, visibility;
        }

        /* Ensure DaisyUI's modal-toggle takes precedence or works with this */
        input.modal-toggle:checked+.modal {
            opacity: 1 !important;
            visibility: visible !important;
            display: flex !important; /* Ensure it's flex for centering */
             align-items: center;
            justify-content: center;
        }
         .modal.modal-open { /* If manually adding .modal-open class */
            opacity: 1 !important;
            visibility: visible !important;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }


        .modal-box {
            transform: scale(0.9) translateY(-20px);
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform;
            backface-visibility: hidden;
            -webkit-font-smoothing: antialiased;
        }

        input.modal-toggle:checked+.modal .modal-box,
        .modal.modal-open .modal-box {
            transform: scale(1) translateY(0);
        }


        .dataTables_wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            /* table-layout: fixed; */ /* Can cause issues with responsive, use with caution */
            border-collapse: collapse;
        }

        @media (max-width: 768px) {
            .modal-box {
                margin: 1rem;
                max-height: calc(100vh - 2rem);
                overflow-y: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table {
                font-size: 12px;
                transform: translateZ(0);
            }

            .btn {
                padding: 0.25rem 0.5rem;
                font-size: 12px;
                min-height: auto;
            }
        }

        .input,
        .select,
        .textarea {
            will-change: auto;
        }

        .input:focus,
        .select:focus,
        .textarea:focus {
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn {
            transform: translateZ(0);
            transition: all 0.15s ease-in-out;
        }

        .tab-content {
            min-height: 400px;
            contain: layout style;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media (prefers-reduced-motion: reduce) {

            .modal,
            .modal-box,
            .btn {
                transition: none !important;
                animation: none !important;
            }
        }
    </style>
@endsection