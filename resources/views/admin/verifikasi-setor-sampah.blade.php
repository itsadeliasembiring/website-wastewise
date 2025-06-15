@extends('layouts.template')
@section('title', 'Verifikasi Setor Sampah')
@push('css')
{{-- SweetAlert2 CSS for styled alerts --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
{{-- Font Awesome for icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush

@section('content')

<x-header.admin/>

<div class="flex min-h-full">
    <div class="relative">
        <x-sidebar.admin />
    </div>

    <main class="flex-1 p-6 bg-gray-50">
        <div class="pl-[50px]">
            <div class="text-center mb-8">
                <h1 class="text-[#3D8D7A] font-semibold text-xl sm:text-2xl">
                    Verifikasi Setor Sampah
                </h1>
                <p class="text-gray-600 mt-2 hidden sm:block">
                    Masukkan kode verifikasi untuk memverifikasi setor sampah
                </p>
            </div>


            {{-- Search Section --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Cari Kode Verifikasi</h3>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" 
                               id="kode_verifikasi" 
                               placeholder="Masukkan kode verifikasi..." 
                               class="w-full px-4 py-2 border text-black border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent">
                    </div>
                    <button type="button" 
                            id="btn-cari-kode" 
                            class="px-6 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A] focus:ring-2 focus:ring-[#3D8D7A] focus:ring-offset-2 transition duration-200">
                        Cari
                    </button>
                </div>
            </div>

            {{-- Data Display Section (hidden by default) --}}
            <div id="data-setor" class="hidden">
                <input type="hidden" id="id_setor">
                
                {{-- User & Deposit Info --}}
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pengguna & Setor</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <p id="nama-pengguna" class="mt-1 text-gray-900 font-medium">-</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <p id="nomor-telepon" class="mt-1 text-gray-900">-</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total Poin Saat Ini</label>
                            <p id="total-poin-sekarang" class="mt-1 text-gray-900 font-medium">-</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Waktu Setor</label>
                            <p id="waktu-setor" class="mt-1 text-gray-900">-</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Metode Setor</label>
                            <p id="metode-setor" class="mt-1 text-gray-900">-</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bank Sampah</label>
                            <p id="bank-sampah" class="mt-1 text-gray-900">-</p>
                        </div>
                        <div id="lokasi-container" class="hidden">
                            <label class="block text-sm font-medium text-gray-700">Lokasi Penjemputan</label>
                            <p id="lokasi-penjemputan" class="mt-1 text-gray-900">-</p>
                        </div>
                        <div id="waktu-penjemputan-container" class="hidden">
                            <label class="block text-sm font-medium text-gray-700">Waktu Penjemputan</label>
                            <p id="waktu-penjemputan" class="mt-1 text-gray-900">-</p>
                        </div>
                    </div>

                    <div id="catatan-container" class="mt-4 hidden">
                        <label class="block text-sm font-medium text-gray-700">Catatan</label>
                        <p id="catatan" class="mt-1 text-gray-900">-</p>
                    </div>
                </div>

                {{-- Waste Deposit Details --}}
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Detail Setor Sampah</h3>
                        <button type="button" 
                                id="btn-tambah-item" 
                                class="px-4 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A] focus:ring-2 focus:ring-[#3D8D7A] focus:ring-offset-2 transition duration-200">
                            Tambah Item
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Sampah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat (KG)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poin/KG</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Poin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabel-detail" class="bg-white divide-y divide-gray-200">
                                {{-- Rows will be populated by JavaScript --}}
                            </tbody>
                        </table>
                    </div>

                    {{-- Totals --}}
                    <div class="mt-6 bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div class="text-lg font-semibold text-gray-800">
                                Total Berat: <span id="total-berat" class="text-[#3D8D7A]">0</span> KG
                            </div>
                            <div class="text-lg font-semibold text-gray-800">
                                Total Poin: <span id="total-poin" class="text-[#3D8D7A]">0</span> Poin
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-end gap-4">
                        <button type="button" 
                                id="btn-reset" 
                                class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                          Reset
                        </button>
                        <button type="button" 
                                id="btn-verifikasi" 
                                class="px-6 py-3 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A] focus:ring-2 focus:ring-[#3D8D7A] focus:ring-offset-2 transition duration-200 font-semibold">
                            Verifikasi Setor
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

{{-- Add New Item Modal --}}
<div id="modal-tambah-item" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Item Sampah</h3>
                <form id="form-tambah-item">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Sampah</label>
                        <select id="select-sampah" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent" required>
                            <option value="">Pilih jenis sampah...</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Berat (KG)</label>
                        <input type="number" 
                               id="input-berat" 
                               step="0.01" 
                               min="0.01" 
                               placeholder="0.00"
                               class="w-full text-black px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent"
                               required>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" 
                                id="btn-batal-tambah" 
                                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A] transition duration-200">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Weight Modal --}}
<div id="modal-edit-berat" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Berat Sampah</h3>
                <form id="form-edit-berat">
                    <input type="hidden" id="edit-id-detail">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Sampah</label>
                        <p id="edit-nama-sampah" class="text-gray-900 font-medium">-</p>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Berat (KG)</label>
                        <input type="number" 
                               id="edit-input-berat" 
                               step="0.01" 
                               min="0.01" 
                               placeholder="0.00"
                               class="w-full text-black px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#3D8D7A] focus:border-transparent"
                               required>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" 
                                id="btn-batal-edit" 
                                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A] transition duration-200">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
{{-- SweetAlert2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    
    // CSRF Token Setup for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let daftarSampahCache = [];

    // --- UTILITY FUNCTIONS ---

    // Function to format date
    function formatWaktu(waktu) {
        if (!waktu) return '-';
        const date = new Date(waktu);
        return date.toLocaleString('id-ID', { dateStyle: 'long', timeStyle: 'short' });
    }

    // Function to calculate and update totals
    function updateTotals() {
        let totalBerat = 0;
        let totalPoin = 0;
        $('#tabel-detail tr').each(function() {
            const berat = parseFloat($(this).data('berat-kg')) || 0;
            const poin = parseFloat($(this).data('total-poin-item')) || 0;
            totalBerat += berat;
            totalPoin += poin;
        });
        $('#total-berat').text(totalBerat.toFixed(2));
        $('#total-poin').text(totalPoin.toFixed(0));
    }

    // Function to reset the entire form/view
    function resetView() {
        $('#data-setor').addClass('hidden');
        $('#kode_verifikasi').val('').prop('disabled', false);
        $('#btn-cari-kode').prop('disabled', false);
        $('#tabel-detail').empty();
        $('#id_setor').val('');
        updateTotals();
    }

    // Function to show a loading alert
    function showLoading(message = 'Memuat...') {
        Swal.fire({
            title: message,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    // --- EVENT HANDLERS ---

    // 1. Search for Verification Code
    $('#btn-cari-kode').on('click', function() {
        const kodeVerifikasi = $('#kode_verifikasi').val();
        if (!kodeVerifikasi) {
            Swal.fire('Error', 'Kode verifikasi tidak boleh kosong.', 'error');
            return;
        }

        showLoading('Mencari data...');

        $.ajax({
            url: '{{ route("admin.verifikasi.cari-kode") }}',
            type: 'POST',
            data: { kode_verifikasi: kodeVerifikasi },
            success: function(response) {
                if (response.success) {
                    Swal.close();
                    const data = response.data;
                    
                    // Populate data
                    $('#id_setor').val(data.id_setor);
                    $('#nama-pengguna').text(data.pengguna.nama_lengkap);
                    $('#nomor-telepon').text(data.pengguna.nomor_telepon);
                    $('#total-poin-sekarang').text(data.pengguna.total_poin);
                    $('#waktu-setor').text(formatWaktu(data.waktu_setor));
                    $('#metode-setor').text(data.metode_setor);
                    $('#bank-sampah').text(data.bank_sampah.nama_bank_sampah);

                    if (data.metode_setor.toLowerCase() === 'jemput') {
                        $('#lokasi-container, #waktu-penjemputan-container').removeClass('hidden');
                        $('#lokasi-penjemputan').text(data.lokasi_penjemputan || '-');
                        $('#waktu-penjemputan').text(formatWaktu(data.waktu_penjemputan));
                    } else {
                        $('#lokasi-container, #waktu-penjemputan-container').addClass('hidden');
                    }

                    if (data.catatan) {
                        $('#catatan-container').removeClass('hidden');
                        $('#catatan').text(data.catatan);
                    } else {
                         $('#catatan-container').addClass('hidden');
                    }

                    // Populate table
                    $('#tabel-detail').empty();
                    data.detail_setor.forEach(function(item) {
                        const row = `
                            <tr id="row-${item.id_detail}" 
                                data-id-detail="${item.id_detail}" 
                                data-nama-sampah="${item.sampah.nama_sampah}"
                                data-berat-kg="${item.berat_kg}" 
                                data-total-poin-item="${item.total_poin_item}">
                                <td class="text-black px-6 py-4 whitespace-nowrap">${item.sampah.nama_sampah}</td>
                                <td class="text-black px-6 py-4 whitespace-nowrap">${item.sampah.jenis_sampah}</td>
                                <td class="text-black px-6 py-4 whitespace-nowrap">${item.berat_kg}</td>
                                <td class="text-black px-6 py-4 whitespace-nowrap">${item.sampah.bobot_poin}</td>
                                <td class="text-black px-6 py-4 whitespace-nowrap">${item.total_poin_item.toFixed(0)}</td>
                                <td class="text-black px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="btn-edit text-[#3D8D7A] hover:text-[#3D8D7A] mr-3">Edit</button>
                                    <button class="btn-hapus text-red-600 hover:text-red-900">Hapus</button>
                                </td>
                            </tr>
                        `;
                        $('#tabel-detail').append(row);
                    });
                    
                    updateTotals();
                    $('#data-setor').removeClass('hidden');
                    $('#kode_verifikasi').prop('disabled', true);
                    $('#btn-cari-kode').prop('disabled', true);
                }
            },
            error: function(xhr) {
                const error = xhr.responseJSON;
                Swal.fire('Error', error.message || 'Terjadi kesalahan.', 'error');
            }
        });
    });

    // 2. Open Edit Weight Modal
    $('#tabel-detail').on('click', '.btn-edit', function() {
        const row = $(this).closest('tr');
        const idDetail = row.data('id-detail');
        const namaSampah = row.data('nama-sampah');
        const beratKg = row.data('berat-kg');

        $('#edit-id-detail').val(idDetail);
        $('#edit-nama-sampah').text(namaSampah);
        $('#edit-input-berat').val(beratKg);
        $('#modal-edit-berat').removeClass('hidden');
    });

    // 3. Submit Edit Weight Form
    $('#form-edit-berat').on('submit', function(e) {
        e.preventDefault();
        const idDetail = $('#edit-id-detail').val();
        const beratKg = $('#edit-input-berat').val();

        showLoading('Mengupdate berat...');

        $.ajax({
            url: '{{ route("admin.verifikasi.update-berat") }}',
            type: 'POST',
            data: {
                id_detail: idDetail,
                berat_kg: beratKg
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire('Berhasil!', response.message, 'success');
                    const data = response.data;
                    const row = $(`#row-${data.id_detail}`);
                    
                    // Update the row data attributes and text
                    row.data('berat-kg', data.berat_kg);
                    row.data('total-poin-item', data.total_poin_item);
                    row.find('td:eq(2)').text(data.berat_kg);
                    row.find('td:eq(4)').text(data.total_poin_item.toFixed(0));

                    updateTotals();
                    $('#modal-edit-berat').addClass('hidden');
                }
            },
            error: function(xhr) {
                const error = xhr.responseJSON;
                Swal.fire('Error', error.message || 'Gagal mengupdate berat.', 'error');
            }
        });
    });

    // 4. Delete Detail Item
    $('#tabel-detail').on('click', '.btn-hapus', function() {
        const idDetail = $(this).closest('tr').data('id-detail');
        
        Swal.fire({
            title: 'Anda yakin?',
            text: "Item ini akan dihapus dari daftar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading('Menghapus item...');
                $.ajax({
                    url: '{{ route("admin.verifikasi.hapus-detail") }}',
                    type: 'DELETE',
                    data: { id_detail: idDetail },
                    success: function(response) {
                        if(response.success) {
                            Swal.fire('Dihapus!', response.message, 'success');
                            $(`#row-${idDetail}`).remove();
                            updateTotals();
                        }
                    },
                    error: function(xhr) {
                        const error = xhr.responseJSON;
                        Swal.fire('Error', error.message || 'Gagal menghapus item.', 'error');
                    }
                });
            }
        });
    });

    // 5. Open Add New Item Modal
    $('#btn-tambah-item').on('click', function() {
        // Fetch waste list if cache is empty
        if (daftarSampahCache.length === 0) {
            showLoading('Memuat daftar sampah...');
            $.ajax({
                url: '{{ route("admin.verifikasi.daftar-sampah") }}',
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        Swal.close();
                        daftarSampahCache = response.data;
                        const select = $('#select-sampah');
                        select.find('option:not(:first)').remove(); // Clear previous options
                        daftarSampahCache.forEach(function(sampah) {
                            select.append(`<option value="${sampah.id_sampah}" class="text-black">${sampah.nama_sampah} (${sampah.bobot_poin})</option>`);
                        });
                        $('#modal-tambah-item').removeClass('hidden');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Error', 'Gagal memuat daftar sampah.', 'error');
                }
            });
        } else {
             $('#modal-tambah-item').removeClass('hidden');
        }
    });

    // 6. Submit Add New Item Form
    $('#form-tambah-item').on('submit', function(e) {
        e.preventDefault();
        const idSetor = $('#id_setor').val();
        const idSampah = $('#select-sampah').val();
        const beratKg = $('#input-berat').val();

        if (!idSampah) {
            Swal.fire('Error', 'Silakan pilih jenis sampah.', 'error');
            return;
        }

        showLoading('Menambahkan item...');

        $.ajax({
            url: '{{ route("admin.verifikasi.tambah-detail") }}',
            type: 'POST',
            data: {
                id_setor: idSetor,
                id_sampah: idSampah,
                berat_kg: beratKg
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire('Berhasil!', response.message, 'success');
                    const item = response.data;
                    
                    // Find jenis sampah from cache
                    const sampahInfo = daftarSampahCache.find(s => s.id_sampah === item.sampah.id_sampah);
                    const jenisSampah = sampahInfo ? sampahInfo.nama_jenis : 'N/A';
                    
                    const row = `
                        <tr id="row-${item.id_detail}" 
                            data-id-detail="${item.id_detail}" 
                            data-nama-sampah="${item.sampah.nama_sampah}"
                            data-berat-kg="${item.berat_kg}" 
                            data-total-poin-item="${item.total_poin_item}">
                            <td class="text-black px-6 py-4 whitespace-nowrap">${item.sampah.nama_sampah}</td>
                            <td class="text-black px-6 py-4 whitespace-nowrap">${item.sampah.jenis_sampah}</td>
                            <td class="text-black px-6 py-4 whitespace-nowrap">${item.berat_kg}</td>
                            <td class="text-black px-6 py-4 whitespace-nowrap">${item.sampah.bobot_poin}</td>
                            <td class="text-black px-6 py-4 whitespace-nowrap">${item.total_poin_item.toFixed(0)}</td>
                            <td class="text-black px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="btn-edit text-[#3D8D7A] hover:text-[#3D8D7A] mr-3">Edit</button>
                                <button class="btn-hapus text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    `;
                    $('#tabel-detail').append(row);
                    updateTotals();
                    $('#modal-tambah-item').addClass('hidden');
                    $('#form-tambah-item')[0].reset();
                }
            },
            error: function(xhr) {
                const error = xhr.responseJSON;
                Swal.fire('Error', error.message || 'Gagal menambahkan item.', 'error');
            }
        });
    });

    // 7. Final Verification
    $('#btn-verifikasi').on('click', function() {
        const idSetor = $('#id_setor').val();
        if ($('#tabel-detail tr').length === 0) {
            Swal.fire('Error', 'Tidak ada item sampah untuk diverifikasi. Tambahkan setidaknya satu item.', 'error');
            return;
        }

        Swal.fire({
            title: 'Verifikasi Setor Sampah?',
            text: "Aksi ini akan menyelesaikan transaksi dan menambahkan poin ke pengguna. Ini tidak dapat diurungkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Verifikasi!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                showLoading('Memverifikasi...');
                $.ajax({
                    url: '{{ route("admin.verifikasi.verifikasi-setor") }}',
                    type: 'POST',
                    data: { id_setor: idSetor },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Selesai'
                            }).then(() => {
                                resetView();
                            });
                        }
                    },
                    error: function(xhr) {
                        const error = xhr.responseJSON;
                        Swal.fire('Error', error.message || 'Gagal memverifikasi.', 'error');
                    }
                });
            }
        });
    });

    // 8. Reset Button
    $('#btn-reset').on('click', function() {
        resetView();
    });

    // Close Modals
    $('#btn-batal-edit, #btn-batal-tambah').on('click', function() {
        $('#modal-edit-berat').addClass('hidden');
        $('#modal-tambah-item').addClass('hidden');
        $('#form-edit-berat')[0].reset();
        $('#form-tambah-item')[0].reset();
    });
});
</script>
@endpush