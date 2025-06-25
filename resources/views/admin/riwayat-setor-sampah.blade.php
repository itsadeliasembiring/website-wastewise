@extends('layouts.template')
@section('title', 'Kelola Setor Sampah')

@section('content')
    {{-- Error handling from controller validation --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let errorMessages = '';
                @foreach ($errors->all() as $error)
                    errorMessages += `{{ $error }}<br>`;
                @endforeach
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: errorMessages,
                    showConfirmButton: true
                });
            });
        </script>
    @endif

    <x-header.admin/>

    <div class="flex min-h-full">
        <div class="relative">
            <x-sidebar.admin />
        </div>

        {{-- Session-based success/error messages --}}
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
                    showConfirmButton: true
                });
            });
        </script>
        @endif

        <main class="justify-center flex-grow w-full">
            <div class="mt-4 sm:px-8">
                <p class="text-[#3D8D7A] text-center font-semibold xs:text-[23px] sm:text-[23px] xl:text-[25px]">
                    Kelola Setor Sampah
                </p>
            </div>

            <div class="p-4 sm:p-6 lg:p-8">
                <div class="flex flex-col w-full align-top">
                    {{-- Header and Filters --}}
                    <div class="flex flex-wrap items-center justify-between mb-4 gap-4">
                        <div>
                            <p class="text-[#464748] font-semibold text-lg sm:text-xl">
                                Data Setor Sampah
                            </p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <label for="add-setor-sampah" class="btn btn-primary bg-[#3D8D7A] hover:bg-[#2C6A5C] text-white btn-sm sm:btn-md">
                                + Tambah Setor Sampah
                            </label>
                            <select class="filter select select-bordered select-sm w-full sm:w-fit" name="status_filter" id="status-filtering">
                                <option disabled selected>Filter Status</option>
                                <option value="">Semua Status</option>
                                <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                                <option value="Diproses">Diproses</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                            </select>
                            <select class="filter select select-bordered select-sm w-full sm:w-fit" name="metode_filter" id="metode-filtering">
                                <option disabled selected>Filter Metode</option>
                                <option value="">Semua Metode</option>
                                <option value="Dijemput">Dijemput</option>
                                <option value="Setor Langsung">Setor Langsung</option>
                            </select>
                            <select class="filter select select-bordered select-sm w-full sm:w-fit" name="bank_sampah_filter" id="bank-sampah-filtering">
                                <option disabled selected>Filter Bank Sampah</option>
                                <option value="">Semua Bank</option>
                                @foreach($bank_sampah as $bank)
                                    <option value="{{ $bank->id_bank_sampah }}">{{ $bank->nama_bank_sampah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Data Table --}}
                    <div class="overflow-x-auto bg-white p-4 rounded-lg shadow-md">
                        <table id="setorSampahTable" class="table w-full">
                            <thead>
                                <tr>
                                    <th>ID Setor</th>
                                    <th>Nama Pengguna</th>
                                    <th>Waktu Setor</th>
                                    <th>Jadwal</th>
                                    <th>Metode</th>
                                    <th class="text-center">Total Berat (kg)</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <input type="checkbox" id="add-setor-sampah" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <label for="add-setor-sampah" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="font-bold text-lg text-[#3D8D7A] mb-4">Tambah Setor Sampah Baru</h3>
            <form id="addSetorForm" action="{{ route('admin.setor-sampah.add') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text">Pengguna <span class="text-red-500">*</span></span></label>
                        <select name="id_pengguna" class="select select-bordered" required>
                            <option disabled selected value="">Pilih Pengguna</option>
                            @foreach ($pengguna as $user)
                                <option value="{{ $user->id_pengguna }}">{{ $user->nama }} ({{ $user->id_pengguna }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Bank Sampah <span class="text-red-500">*</span></span></label>
                        <select name="id_bank_sampah" class="select select-bordered" required>
                            <option disabled selected value="">Pilih Bank Sampah</option>
                            @foreach ($bank_sampah as $bank)
                                <option value="{{ $bank->id_bank_sampah }}">{{ $bank->nama_bank_sampah }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text">Metode Setor <span class="text-red-500">*</span></span></label>
                        <select name="metode_setor" class="select select-bordered" required>
                            <option disabled selected value="">Pilih Metode</option>
                            <option value="Dijemput">Dijemput</option>
                            <option value="Setor Langsung">Setor Langsung</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Waktu Penjemputan/Pengantaran <span class="text-red-500">*</span></span></label>
                        <input type="datetime-local" name="waktu_penjemputan" class="input input-bordered" required>
                    </div>
                </div>
                <div class="form-control mb-4">
                    <label class="label"><span class="label-text">Lokasi Penjemputan <span class="text-red-500">*</span></span></label>
                    <textarea name="lokasi_penjemputan" class="textarea textarea-bordered" placeholder="Masukkan alamat lengkap atau '-' jika diantar langsung" required></textarea>
                </div>
                <div class="form-control mb-4">
                    <label class="label"><span class="label-text">Catatan</span></label>
                    <textarea name="catatan" class="textarea textarea-bordered" placeholder="Catatan tambahan (opsional)"></textarea>
                </div>
                <div class="mb-4">
                    <h4 class="font-semibold text-[#3D8D7A] mb-2">Detail Sampah <span class="text-red-500">*</span></h4>
                    <div id="add-detail-sampah-container">
                        {{-- DYNAMIC CONTENT HERE --}}
                    </div>
                    <button type="button" id="add-sampah-item" class="btn btn-outline btn-sm mt-2">+ Tambah Jenis Sampah</button>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn bg-[#3D8D7A] text-white hover:bg-[#2C6A5C]">Simpan</button>
                    <label for="add-setor-sampah" class="btn">Batal</label>
                </div>
            </form>
        </div>
    </div>

    <input type="checkbox" id="edit-setor-sampah" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <label for="edit-setor-sampah" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="font-bold text-lg text-[#3D8D7A] mb-4">Edit Setor Sampah</h3>
            <form id="editSetorForm" method="POST"> {{-- Action will be set dynamically --}}
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text">Pengguna <span class="text-red-500">*</span></span></label>
                        <select name="id_pengguna" id="edit_id_pengguna" class="select select-bordered" required>
                            <option disabled value="">Pilih Pengguna</option>
                            @foreach ($pengguna as $user)
                                <option value="{{ $user->id_pengguna }}">{{ $user->nama }} ({{ $user->id_pengguna }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Bank Sampah <span class="text-red-500">*</span></span></label>
                        <select name="id_bank_sampah" id="edit_id_bank_sampah" class="select select-bordered" required>
                            <option disabled value="">Pilih Bank Sampah</option>
                            @foreach ($bank_sampah as $bank)
                                <option value="{{ $bank->id_bank_sampah }}">{{ $bank->nama_bank_sampah }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text">Metode Setor <span class="text-red-500">*</span></span></label>
                        <select name="metode_setor" id="edit_metode_setor" class="select select-bordered" required>
                            <option disabled value="">Pilih Metode</option>
                            <option value="Dijemput">Dijemput</option>
                            <option value="Setor Langsung">Setor Langsung</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Waktu Penjemputan/Pengantaran <span class="text-red-500">*</span></span></label>
                        <input type="datetime-local" name="waktu_penjemputan" id="edit_waktu_penjemputan" class="input input-bordered" required>
                    </div>
                </div>
                <div class="form-control mb-4">
                    <label class="label"><span class="label-text">Lokasi Penjemputan <span class="text-red-500">*</span></span></label>
                    <textarea name="lokasi_penjemputan" id="edit_lokasi_penjemputan" class="textarea textarea-bordered" placeholder="Masukkan alamat lengkap penjemputan atau '-' jika diantar langsung" required></textarea>
                </div>
                <div class="form-control mb-4">
                    <label class="label"><span class="label-text">Catatan</span></label>
                    <textarea name="catatan" id="edit_catatan" class="textarea textarea-bordered" placeholder="Catatan tambahan (opsional)"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text">Status <span class="text-red-500">*</span></span></label>
                        <select name="status_setor" id="edit_status_setor" class="select select-bordered" required>
                            <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text">Kode Verifikasi</span></label>
                        <input type="text" name="kode_verifikasi" id="edit_kode_verifikasi" class="input input-bordered" placeholder="Kode verifikasi">
                    </div>
                </div>
                <div class="mb-4">
                    <h4 class="font-semibold text-[#3D8D7A] mb-2">Detail Sampah <span class="text-red-500">*</span></h4>
                    <div id="edit-detail-sampah-container">
                        {{-- DYNAMIC CONTENT WILL BE LOADED HERE --}}
                    </div>
                    <button type="button" id="edit-add-sampah-item" class="btn btn-outline btn-sm mt-2">+ Tambah Jenis Sampah</button>
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn bg-[#3D8D7A] text-white hover:bg-[#2C6A5C]">Update</button>
                    <label for="edit-setor-sampah" class="btn">Batal</label>
                </div>
            </form>
        </div>
    </div>
    
    {{-- ADDED: Detail Modal Structure --}}
    <input type="checkbox" id="detail-setor-sampah" class="modal-toggle" />
    <div class="modal" id="modalDetail">
        <div class="modal-box w-11/12 max-w-4xl">
            <label for="detail-setor-sampah" class="btn btn-sm btn-circle absolute right-2 top-2" id="btnCloseDetail">✕</label>
            <h3 class="font-bold text-lg text-[#3D8D7A] mb-4">Detail Setor Sampah</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div><strong>ID Setor:</strong> <span id="detailId"></span></div>
                <div><strong>Status:</strong> <span id="detailStatus" class="px-2 py-1 text-xs font-semibold rounded-full"></span></div>
                <div><strong>Nama Pengguna:</strong> <span id="detailNamaPengguna"></span></div>
                <div><strong>Bank Sampah:</strong> <span id="detailBankSampah"></span></div>
                <div><strong>Waktu Setor:</strong> <span id="detailWaktuSetor"></span></div>
                <div><strong>Metode Setor:</strong> <span id="detailMetodeSetor"></span></div>
                <div class="md:col-span-2"><strong>Jadwal Penjemputan/Antar:</strong> <span id="detailWaktuPenjemputan"></span></div>
                <div class="md:col-span-2"><strong>Lokasi:</strong> <span id="detailLokasiPenjemputan"></span></div>
                <div class="md:col-span-2"><strong>Catatan:</strong> <span id="detailCatatan"></span></div>
                <div><strong>Kode Verifikasi:</strong> <span id="detailKodeVerifikasi"></span></div>
            </div>
            <div class="divider"></div>
            <h4 class="font-semibold text-md text-[#3D8D7A] mb-2">Rincian Sampah</h4>
            <div class="overflow-x-auto">
                <table class="table table-compact w-full">
                    <thead>
                        <tr>
                            <th>Nama Sampah</th>
                            <th>Jenis</th>
                            <th class="text-right">Berat (kg)</th>
                            <th class="text-right">Poin/kg</th>
                            <th class="text-right">Subtotal Poin</th>
                        </tr>
                    </thead>
                    <tbody id="detailSampahTableBody">
                        {{-- Dynamic content from AJAX --}}
                    </tbody>
                    <tfoot>
                        <tr class="font-bold">
                            <td colspan="2" class="text-right">Total Keseluruhan</td>
                            <td id="detailTotalBerat" class="text-right"></td>
                            <td></td>
                            <td id="detailTotalPoin" class="text-right"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-action">
                <label for="detail-setor-sampah" class="btn">Tutup</label>
            </div>
        </div>
    </div>


    <script>
        // FIX: Pass PHP variables to JavaScript
        const allSampahItems = @json($sampah);
        const detailUrl = "{{ route('admin.setor-sampah.get-detail', '') }}";
        const updateUrl = "{{ route('admin.setor-sampah.update', '') }}";
        const deleteUrl = "{{ route('admin.setor-sampah.delete', '') }}";
        const csrfToken = '{{ csrf_token() }}';

        // FIX: Consolidate all JS into one script block after defining variables
        $(document).ready(function() {
            let table = $('#setorSampahTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.setor-sampah.data') }}",
                    data: function(d) {
                        d.status = $('#status-filtering').val();
                        d.metode = $('#metode-filtering').val();
                        d.bank_sampah = $('#bank-sampah-filtering').val();
                    }
                },
                columns: [
                    { data: 'id_setor', name: 'id_setor' },
                    { data: 'nama_lengkap', name: 'pengguna.nama' }, // Corrected relation name if needed
                    { data: 'waktu_setor_formatted', name: 'waktu_setor' },
                    { data: 'waktu_penjemputan_formatted', name: 'waktu_penjemputan' },
                    { data: 'metode_setor_formatted', name: 'metode_setor' },
                    { data: 'calculated_total_berat', name: 'calculated_total_berat', className: 'text-center' },
                    { data: 'status_badge', name: 'status_setor', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
                ],
                responsive: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                }
            });

            // Filter functionality
            $('#status-filtering, #metode-filtering, #bank-sampah-filtering').change(function() {
                table.draw();
            });

            // --- Modal Handlers ---

            // Handle DETAIL modal
            $(document).on('click', 'button[data-action="detail"]', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                showDetailModal(id);
            });

            // Handle DELETE confirmation
            $(document).on('click', 'button[data-action="delete"]', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data setor sampah akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let deleteForm = $(`<form action="${deleteUrl}/${id}" method="POST" style="display:none;">
                                            <input type="hidden" name="_token" value="${csrfToken}">
                                            <input type="hidden" name="_method" value="DELETE">
                                           </form>`);
                        $('body').append(deleteForm);
                        deleteForm.submit();
                    }
                });
            });

            // Handle EDIT modal
            $(document).on('click', 'button[data-action="edit"]', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                showEditModal(id);
            });


            // --- DYNAMIC ITEM FUNCTIONS ---
            
            let addSampahIndex = 0;
            let editSampahIndex = 0;

            // FIX: Helper function to generate sampah options
            function generateSampahOptions(selectedId = '') {
                let options = '<option disabled selected value="">Pilih Jenis Sampah</option>';
                allSampahItems.forEach(item => {
                    const isSelected = item.id_sampah == selectedId ? 'selected' : '';
                    options += `<option value="${item.id_sampah}" ${isSelected}>${item.nama_sampah} (${item.bobot_poin} poin/kg)</option>`;
                });
                return options;
            }
            
            // Function to add item row in ADD modal
            function addSampahItem() {
                const html = `
                    <div class="detail-sampah-item border border-gray-200 rounded-lg p-3 mb-2">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-center">
                            <div class="form-control">
                                <select name="detail_sampah[${addSampahIndex}][id_sampah]" class="select select-bordered select-sm" required>
                                    ${generateSampahOptions()}
                                </select>
                            </div>
                            <div class="form-control">
                                <input type="number" name="detail_sampah[${addSampahIndex}][berat_kg]" step="0.01" min="0.01" 
                                    class="input input-bordered input-sm" placeholder="Berat (kg)" required>
                            </div>
                            <div class="form-control">
                                <button type="button" class="btn btn-error btn-sm remove-sampah-item">Hapus</button>
                            </div>
                        </div>
                    </div>`;
                $('#add-detail-sampah-container').append(html);
                addSampahIndex++;
            }

            // Function to add item row in EDIT modal
            function addEditSampahItem(selectedSampah = '', beratValue = '', detailId = '') {
                const html = `
                    <div class="detail-sampah-item border border-gray-200 rounded-lg p-3 mb-2">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-center">
                            <div class="form-control">
                                <select name="detail_sampah[${editSampahIndex}][id_sampah]" class="select select-bordered select-sm" required>
                                    ${generateSampahOptions(selectedSampah)}
                                </select>
                            </div>
                            <div class="form-control">
                                <input type="number" name="detail_sampah[${editSampahIndex}][berat_kg]" step="0.01" min="0.01" 
                                    class="input input-bordered input-sm" placeholder="Berat (kg)" value="${beratValue}" required>
                            </div>
                            <div class="form-control">
                                <button type="button" class="btn btn-error btn-sm remove-edit-sampah-item">Hapus</button>
                            </div>
                        </div>
                        ${detailId ? `<input type="hidden" name="detail_sampah[${editSampahIndex}][id_detail_setor]" value="${detailId}">` : ''}
                    </div>`;
                $('#edit-detail-sampah-container').append(html);
                editSampahIndex++;
            }

            // --- ADD Modal Logic ---
            $('#add-sampah-item').click(function() {
                addSampahItem();
            });

            // Initially add one item to the add modal
            addSampahItem(); 

            $(document).on('click', '.remove-sampah-item', function() {
                if ($('#add-detail-sampah-container .detail-sampah-item').length > 1) {
                    $(this).closest('.detail-sampah-item').remove();
                } else {
                    Swal.fire('Error', 'Minimal harus ada 1 jenis sampah.', 'error');
                }
            });


            // --- EDIT Modal Logic ---
            $('#edit-add-sampah-item').click(function() {
                addEditSampahItem();
            });

            $(document).on('click', '.remove-edit-sampah-item', function() {
                if ($('#edit-detail-sampah-container .detail-sampah-item').length > 1) {
                    $(this).closest('.detail-sampah-item').remove();
                } else {
                    Swal.fire('Error', 'Minimal harus ada 1 jenis sampah.', 'error');
                }
            });
            
            // Handle edit form submission
            $('#editSetorForm').submit(function(e) {
                e.preventDefault();
                
                let formData = new FormData(this);
                let actionUrl = $(this).attr('action');
                
                $.ajax({
                    url: actionUrl,
                    method: 'POST', // Form method spoofing handles PUT
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Berhasil', response.message || 'Data berhasil diupdate', 'success').then(() => {
                                $('#edit-setor-sampah').prop('checked', false);
                                table.ajax.reload();
                            });
                        } else {
                            Swal.fire('Error', response.message || 'Gagal mengupdate data', 'error');
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan saat mengupdate data';
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.responseJSON.errors) {
                                let errors = Object.values(xhr.responseJSON.errors).flat();
                                errorMessage = errors.join('<br>');
                            }
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Validasi',
                            html: errorMessage
                        });
                    }
                });
            });

        }); // End of document ready

        // --- GLOBAL FUNCTIONS for Modals ---
        function showDetailModal(id) {
            $.ajax({
                url: `${detailUrl}/${id}`,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        let setorData = response.data.setor_sampah;
                        let sampahDetails = response.data.detail_setor;
                        
                        $('#detailId').text(setorData.id_setor);
                        $('#detailWaktuSetor').text(setorData.waktu_setor_formatted);
                        $('#detailKodeVerifikasi').text(setorData.kode_verifikasi || '-');
                        $('#detailTotalBerat').text(setorData.calculated_total_berat + ' kg');
                        $('#detailTotalPoin').text(setorData.calculated_total_poin + ' poin');
                        $('#detailNamaPengguna').text(setorData.pengguna ? setorData.pengguna.nama : 'N/A');
                        $('#detailBankSampah').text(setorData.bank_sampah ? setorData.bank_sampah.nama_bank_sampah : 'N/A');
                        $('#detailLokasiPenjemputan').text(setorData.lokasi_penjemputan);
                        $('#detailWaktuPenjemputan').text(setorData.waktu_penjemputan_formatted || '-');
                        $('#detailCatatan').text(setorData.catatan || '-');
                        $('#detailMetodeSetor').text(setorData.metode_setor);

                        let statusClass = '';
                        let statusText = setorData.status_setor ? setorData.status_setor : 'N/A';
                        switch(setorData.status_setor) {
                            case 'Menunggu Konfirmasi': statusClass = 'bg-blue-100 text-blue-800'; break;
                            case 'Diproses': statusClass = 'bg-yellow-100 text-yellow-800'; break;
                            case 'Selesai': statusClass = 'bg-green-100 text-green-800'; break;
                            case 'Dibatalkan': statusClass = 'bg-red-100 text-red-800'; break;
                            default: statusClass = 'bg-gray-100 text-gray-800';
                        }
                        $('#detailStatus').removeClass().addClass('px-2 py-1 text-xs font-semibold rounded-full ' + statusClass).text(statusText);
                        
                        let sampahTableHtml = '';
                        if (sampahDetails && sampahDetails.length > 0) {
                            sampahDetails.forEach(function(item) {
                                sampahTableHtml += `
                                    <tr class="border-b">
                                        <td class="py-2 px-3">${item.sampah ? item.sampah.nama_sampah : 'N/A'}</td>
                                        <td class="py-2 px-3">${item.sampah ? (item.sampah.jenis_sampah ? item.sampah.jenis_sampah.nama_jenis : 'N/A') : 'N/A'}</td>
                                        <td class="py-2 px-3 text-right">${item.berat_kg} kg</td>
                                        <td class="py-2 px-3 text-right">${item.sampah ? item.sampah.bobot_poin : 'N/A'}</td>
                                        <td class="py-2 px-3 text-right">${(item.berat_kg * (item.sampah ? item.sampah.bobot_poin : 0)).toFixed(2)}</td>
                                    </tr>`;
                            });
                        } else {
                            sampahTableHtml = '<tr><td colspan="5" class="py-4 text-center text-gray-500">Tidak ada data detail sampah</td></tr>';
                        }
                        $('#detailSampahTableBody').html(sampahTableHtml);
                        
                        $('#detail-setor-sampah').prop('checked', true);
                    } else {
                        Swal.fire('Error', response.message || 'Gagal memuat detail data', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Terjadi kesalahan saat memuat data', 'error');
                }
            });
        }

        function showEditModal(id) {
            $.ajax({
                url: `${detailUrl}/${id}`,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        let setorData = response.data.setor_sampah;
                        let sampahDetails = response.data.detail_setor;
                        
                        // Set form action
                        $('#editSetorForm').attr('action', `${updateUrl}/${id}`);
                        
                        // Fill form fields
                        // NOTE: Pastikan controller mengembalikan waktu_penjemputan dalam format YYYY-MM-DDTHH:MM
                        $('#edit_id_pengguna').val(setorData.id_pengguna);
                        $('#edit_id_bank_sampah').val(setorData.id_bank_sampah);
                        $('#edit_metode_setor').val(setorData.metode_setor);
                        $('#edit_waktu_penjemputan').val(setorData.waktu_penjemputan); 
                        $('#edit_lokasi_penjemputan').val(setorData.lokasi_penjemputan);
                        $('#edit_catatan').val(setorData.catatan || '');
                        $('#edit_status_setor').val(setorData.status_setor);
                        $('#edit_kode_verifikasi').val(setorData.kode_verifikasi || '');
                        
                        // Clear and populate sampah details
                        $('#edit-detail-sampah-container').empty();
                        editSampahIndex = 0;
                        
                        if (sampahDetails && sampahDetails.length > 0) {
                            sampahDetails.forEach(function(item) {
                                addEditSampahItem(item.id_sampah, item.berat_kg, item.id_detail_setor);
                            });
                        } else {
                            // Add one empty item if none exist
                            addEditSampahItem(); 
                        }
                        
                        // Show modal
                        $('#edit-setor-sampah').prop('checked', true);
                    } else {
                        Swal.fire('Error', response.message || 'Gagal memuat data untuk edit', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Terjadi kesalahan saat memuat data', 'error');
                }
            });
        }
    </script>
@endsection