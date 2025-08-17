@extends('layouts.template')
@section('title', 'Verifikasi Tukar Barang')

@push('css')
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
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
                    Verifikasi Tukar Barang
                </h1>
                <p class="text-gray-600 mt-2 hidden sm:block">
                    Masukkan kode verifikasi untuk memverifikasi penukaran barang
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
                            class="px-6 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#2C6B5A] focus:ring-2 focus:ring-[#3D8D7A] focus:ring-offset-2 transition duration-200">
                        Cari
                    </button>
                </div>
            </div>

            {{-- Verification Result Section --}}
            <div id="verification-result" class="bg-white rounded-lg shadow-md p-6 mb-6" style="display: none;">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Penukaran</h3>
                <div id="verification-content">
                    <!-- Content will be loaded here -->
                </div>
            </div>

            {{-- Pending Exchanges Table --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Penukaran Pending</h3>
                <div class="overflow-x-auto">
                    <table id="pending-exchanges-table" class="table table-striped w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Redeem</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pengguna</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will populate this -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

{{-- Detail Modal --}}
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" style="display: none;">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Detail Penukaran</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600" onclick="closeDetailModal()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="detail-content">
                <!-- Detail content will be loaded here -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    let table = $('#pending-exchanges-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.penukaran-pending') }}",
            type: "GET"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kode_redeem', name: 'kode_redeem' },
            { data: 'nama_pengguna', name: 'nama_pengguna' },
            { data: 'nama_barang', name: 'nama_barang' },
            { data: 'waktu_formatted', name: 'waktu_formatted' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
        }
    });

    // Search verification code
    $('#btn-cari-kode').click(function() {
        let kodeVerifikasi = $('#kode_verifikasi').val().trim();
        
        if (!kodeVerifikasi) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Kode verifikasi harus diisi!'
            });
            return;
        }

        $.ajax({
            url: "{{ route('admin.cari-kode-tukar-barang') }}",
            type: 'POST',
            data: {
                kode_redeem: kodeVerifikasi,
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $('#btn-cari-kode').prop('disabled', true).text('Mencari...');
            },
            success: function(response) {
                if (response.status) {
                    displayVerificationResult(response.data);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr) {
                let message = 'Terjadi kesalahan saat mencari kode verifikasi';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message
                });
            },
            complete: function() {
                $('#btn-cari-kode').prop('disabled', false).text('Cari');
            }
        });
    });

    // Enter key search
    $('#kode_verifikasi').keypress(function(e) {
        if (e.which == 13) {
            $('#btn-cari-kode').click();
        }
    });

    // Display verification result
    function displayVerificationResult(data) {
        let penukaran = data.penukaran;
        let sudahDigunakan = data.sudah_digunakan;
        
        let content = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode Redeem</label>
                    <p class="mt-1 text-sm text-gray-900">${penukaran.kode_redeem}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <p class="mt-1 text-sm ${sudahDigunakan ? 'text-red-600' : 'text-[#3D8D7A]'}">
                        ${sudahDigunakan ? 'Sudah Ditukar' : 'Belum Ditukar'}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pengguna</label>
                    <p class="mt-1 text-sm text-gray-900">${penukaran.pengguna ? penukaran.pengguna.nama_lengkap : '-'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <p class="mt-1 text-sm text-gray-900">${penukaran.barang ? penukaran.barang.nama_barang : '-'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Waktu Penukaran</label>
                    <p class="mt-1 text-sm text-gray-900">${new Date(penukaran.waktu).toLocaleString('id-ID')}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok Barang</label>
                    <p class="mt-1 text-sm text-gray-900">${penukaran.barang ? penukaran.barang.stok : '-'}</p>
                </div>
            </div>
        `;
        
        if (!sudahDigunakan) {
            content += `
                <div class="mt-6 text-center">
                    <button type="button" 
                            class="btn-verifikasi px-6 py-2 bg-[#3D8D7A] text-white rounded-lg hover:bg-[#3D8D7A] focus:ring-2 focus:ring-[#3D8D7A] focus:ring-offset-2 transition duration-200"
                            data-id="${penukaran.id_penukaran_barang}">
                        Verifikasi Penukaran
                    </button>
                </div>
            `;
        }
        
        $('#verification-content').html(content);
        $('#verification-result').show();
    }

    // Verify exchange
    $(document).on('click', '.btn-verifikasi', function() {
        let idPenukaran = $(this).data('id');
        
        Swal.fire({
            title: 'Konfirmasi Verifikasi',
            text: 'Apakah Anda yakin ingin memverifikasi penukaran ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Verifikasi!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.submit-verifikasi-tukar-barang') }}",
                    type: 'POST',
                    data: {
                        id_penukaran_barang: idPenukaran,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message
                            }).then(() => {
                                // Refresh page or update display
                                $('#verification-result').hide();
                                $('#kode_verifikasi').val('');
                                table.ajax.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        let message = 'Terjadi kesalahan saat verifikasi';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: message
                        });
                    }
                });
            }
        });
    });

    // Detail button click
    $(document).on('click', '.btn-detail', function() {
        let id = $(this).data('id');
        
        $.ajax({
            url: "{{ route('admin.tukar-barang-detail', ':id') }}".replace(':id', id),
            type: 'GET',
            success: function(response) {
                if (response.status) {
                    displayDetailModal(response.data);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat mengambil detail'
                });
            }
        });
    });

    // Display detail modal
    function displayDetailModal(data) {
        let content = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode Redeem</label>
                    <p class="mt-1 text-sm text-gray-900">${data.kode_redeem}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <p class="mt-1 text-sm ${data.status_redeem ? 'text-[#3D8D7A]' : 'text-yellow-600'}">
                        ${data.status_redeem ? 'Sudah Diverifikasi' : 'Pending'}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pengguna</label>
                    <p class="mt-1 text-sm text-gray-900">${data.pengguna ? data.pengguna.nama_lengkap : '-'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <p class="mt-1 text-sm text-gray-900">${data.barang ? data.barang.nama_barang : '-'}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Waktu Penukaran</label>
                    <p class="mt-1 text-sm text-gray-900">${new Date(data.waktu).toLocaleString('id-ID')}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok Barang</label>
                    <p class="mt-1 text-sm text-gray-900">${data.barang ? data.barang.stok : '-'}</p>
                </div>
            </div>
        `;
        
        $('#detail-content').html(content);
        $('#detailModal').show();
    }
});

// Close detail modal
function closeDetailModal() {
    $('#detailModal').hide();
}

// Close modal when clicking outside
$(document).on('click', '#detailModal', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});
</script>
@endpush