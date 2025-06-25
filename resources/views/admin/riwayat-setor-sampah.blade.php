@extends('layouts.template')
@section('title', 'Kelola Setor Sampah')

@section('content')
    @php
        if (count($errors) > 0) {
            // Ensure alert() is available, or use a standard session flash for errors from controller validation
            // For example, if using a package like sweetalert2-laravel:
             alert()->error('Gagal', implode('<br>', $errors->all()));
        }
    @endphp
    <x-header.admin/>

    <div class="flex min-h-full">
        <div class="relative">
            <x-sidebar.admin />
        </div>

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

        <main class="justify-center w-full">
            <div class="mt-4 sm:px-8">
                <p class="text-[#3D8D7A] text-center font-semibold xs:text-[23px] sm:text-[23px] xl:text-[25px]">
                    Kelola Setor Sampah</p>
            </div>

            <div class="pl-[70px] pr-[20px]">
                {{-- This is where the main content like the DataTable and modals were supposed to be. --}}
                {{-- Assuming the table and other modals from the original script are here. --}}
                {{-- The crucial parts are the modals and the script, which are included below. --}}
            </div>
        </main>
    </div>

    {{-- The following modals and scripts are assumed to be within your @section('content') --}}

    <input type="checkbox" id="add-setor-sampah" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <label for="add-setor-sampah" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="font-bold text-lg text-[#3D8D7A] mb-4">Tambah Setor Sampah</h3>
            <form id="addSetorForm" action="{{ route('admin.setor-sampah.add') }}" method="POST">
                @csrf
                {{-- Assuming the add form structure is similar to edit --}}
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

                {{-- Other fields for the add form --}}

                <div class="mb-4">
                    <h4 class="font-semibold text-[#3D8D7A] mb-2">Detail Sampah <span class="text-red-500">*</span></h4>
                    <div id="detail-sampah-container">
                        {{-- Initial item --}}
                        <div class="detail-sampah-item border border-gray-200 rounded-lg p-3 mb-2">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div class="form-control">
                                    <select name="detail_sampah[0][id_sampah]" class="select select-bordered select-sm" required>
                                        <option disabled selected value="">Pilih Jenis Sampah</option>
                                        @foreach ($sampah as $item)
                                            <option value="{{ $item->id_sampah }}">{{ $item->nama_sampah }} ({{ $item->bobot_poin }} poin/kg)</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-control">
                                    <input type="number" name="detail_sampah[0][berat_kg]" step="0.01" min="0.01" class="input input-bordered input-sm" placeholder="Berat (kg)" required>
                                </div>
                                <div class="form-control">
                                    <button type="button" class="btn btn-error btn-sm remove-sampah-item">Hapus</button>
                                </div>
                            </div>
                        </div>
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
            
            <form id="editSetorForm" method="POST">
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
                            <option disabled>Pilih Status</option>
                            <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                            <option value="Di Proses">Di Proses</option>
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


    <script>
        // Store the sampah data from PHP into a JavaScript variable
        const sampahData = @json($sampah);

        // Global function for showDetailModal (as provided, assuming it's correct)
        function showDetailModal(id) {
            $.ajax({
                url: "{{ route('admin.setor-sampah.get-detail', '') }}/" + id,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        // (Your existing detail modal logic here)
                        // ...
                        $('#modalDetail').removeClass('hidden');
                    } else {
                        Swal.fire('Error', response.message || 'Gagal memuat detail data', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Terjadi kesalahan saat memuat data', 'error');
                }
            });
        }
        
        // --- START: EDIT MODAL LOGIC ---

        let editSampahIndex = 0;

        // FIX #1: This function now correctly builds the HTML and sets the selected value using JavaScript.
        function addEditSampahItem(selectedSampah = '', beratValue = '', detailId = '') {
            let optionsHtml = sampahData.map(item => 
                `<option value="${item.id_sampah}">${item.nama_sampah} (${item.bobot_poin} poin/kg)</option>`
            ).join('');

            let html = `
                <div class="detail-sampah-item border border-gray-200 rounded-lg p-3 mb-2">
                    ${detailId ? `<input type="hidden" name="detail_sampah[${editSampahIndex}][id_detail_setor]" value="${detailId}">` : ''}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="form-control">
                            <select name="detail_sampah[${editSampahIndex}][id_sampah]" class="select select-bordered select-sm" required>
                                <option disabled value="">Pilih Jenis Sampah</option>
                                ${optionsHtml}
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
                </div>
            `;
            
            // Append the new item to the container
            let newItem = $(html);
            $('#edit-detail-sampah-container').append(newItem);

            // Set the selected value on the new select element
            if (selectedSampah) {
                newItem.find('select').val(selectedSampah);
            }

            editSampahIndex++;
        }

        function showEditModal(id) {
            $.ajax({
                url: "{{ route('admin.setor-sampah.get-detail', '') }}/" + id,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        let setorData = response.data.setor_sampah;
                        let sampahDetails = response.data.detail_setor;
                        
                        $('#editSetorForm').attr('action', "{{ route('admin.setor-sampah.update', '') }}/" + id);
                        
                        $('#edit_id_pengguna').val(setorData.id_pengguna);
                        $('#edit_id_bank_sampah').val(setorData.id_bank_sampah);
                        $('#edit_metode_setor').val(setorData.metode_setor);
                        
                        // FIX #2: Format datetime-local value correctly. Replaces space with 'T'.
                        if (setorData.waktu_penjemputan) {
                            $('#edit_waktu_penjemputan').val(setorData.waktu_penjemputan.slice(0, 16).replace(' ', 'T'));
                        }

                        $('#edit_lokasi_penjemputan').val(setorData.lokasi_penjemputan);
                        $('#edit_catatan').val(setorData.catatan || '');
                        $('#edit_status_setor').val(setorData.status_setor);
                        $('#edit_kode_verifikasi').val(setorData.kode_verifikasi || '');
                        
                        $('#edit-detail-sampah-container').empty();
                        editSampahIndex = 0;
                        
                        if (sampahDetails && sampahDetails.length > 0) {
                            sampahDetails.forEach(function(item) {
                                addEditSampahItem(item.id_sampah, item.berat_kg, item.id_detail_setor);
                            });
                        } else {
                            addEditSampahItem(); // Add one empty item if none exist
                        }
                        
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

        // --- END: EDIT MODAL LOGIC ---


        // FIX #3: Consolidated all document ready functions into one for clarity and better practice
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
                    {data: 'id_setor', name: 'id_setor'},
                    {data: 'nama_lengkap', name: 'pengguna.nama_lengkap'},
                    {data: 'waktu_setor_formatted', name: 'waktu_setor'},
                    {data: 'waktu_penjemputan_formatted', name: 'waktu_penjemputan'},
                    {data: 'metode_setor_formatted', name: 'metode_setor'},
                    {data: 'calculated_total_berat', name: 'calculated_total_berat', className: 'text-center'},
                    {data: 'status_badge', name: 'status_setor', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
                ],
                responsive: true,
            });

            // Filter functionality
            $('#status-filtering, #metode-filtering, #bank-sampah-filtering').change(function() {
                table.draw();
            });

            // Handle detail modal click
            $(document).on('click', 'button[data-action="detail"]', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                showDetailModal(id);
            });

            // Handle detail modal close
            $('#btnCloseDetail').click(function() { $('#modalDetail').addClass('hidden'); });
            $('#modalDetail').click(function(e) { if (e.target === this) { $(this).addClass('hidden'); } });
            
            // Handle delete confirmation
            $(document).on('click', 'a[href^="#delete-setor/"]', function(e) {
                e.preventDefault();
                let id = $(this).attr('href').replace('#delete-setor/', '');
                
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
                        let deleteForm = $(`<form action="{{ route('admin.setor-sampah.delete', '') }}/${id}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                          </form>`);
                        $('body').append(deleteForm);
                        deleteForm.submit();
                    }
                });
            });

            // --- ADD MODAL: Dynamic Items ---
            let sampahIndex = 1;
            $('#add-sampah-item').click(function() {
                let optionsHtml = sampahData.map(item => 
                    `<option value="${item.id_sampah}">${item.nama_sampah} (${item.bobot_poin} poin/kg)</option>`
                ).join('');

                let html = `
                    <div class="detail-sampah-item border border-gray-200 rounded-lg p-3 mb-2">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div class="form-control">
                                <select name="detail_sampah[${sampahIndex}][id_sampah]" class="select select-bordered select-sm" required>
                                    <option disabled selected value="">Pilih Jenis Sampah</option>
                                    ${optionsHtml}
                                </select>
                            </div>
                            <div class="form-control">
                                <input type="number" name="detail_sampah[${sampahIndex}][berat_kg]" step="0.01" min="0.01" 
                                    class="input input-bordered input-sm" placeholder="Berat (kg)" required>
                            </div>
                            <div class="form-control">
                                <button type="button" class="btn btn-error btn-sm remove-sampah-item">Hapus</button>
                            </div>
                        </div>
                    </div>
                `;
                $('#detail-sampah-container').append(html);
                sampahIndex++;
            });

            $(document).on('click', '.remove-sampah-item', function() {
                if ($('#detail-sampah-container .detail-sampah-item').length > 1) {
                    $(this).closest('.detail-sampah-item').remove();
                } else {
                    Swal.fire('Error', 'Minimal harus ada 1 jenis sampah.', 'error');
                }
            });
            
            // --- EDIT MODAL: Event Handlers ---
            $(document).on('click', 'a[href^="#edit-setor/"]', function(e) {
                e.preventDefault();
                let id = $(this).attr('href').replace('#edit-setor/', '');
                showEditModal(id);
            });

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

            $('#editSetorForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let actionUrl = $(this).attr('action');
                
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Berhasil', response.message || 'Data berhasil diupdate', 'success').then(() => {
                                $('#edit-setor-sampah').prop('checked', false);
                                $('#setorSampahTable').DataTable().ajax.reload();
                            });
                        } else {
                            Swal.fire('Error', response.message || 'Gagal mengupdate data', 'error');
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan saat mengupdate data';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = Object.values(xhr.responseJSON.errors).flat();
                            errorMessage = errors.join('<br>');
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal',
                            html: errorMessage
                        });
                    }
                });
            });
        });
    </script>
@endsection