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
                    // timer: 3000, // Keep error message visible until manually closed or longer
                    // timerProgressBar: true,
                    showConfirmButton: true // Allow user to acknowledge error
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
                <div class="flex flex-col w-full align-top">
                    <div class="flex items-center align-middle xs:flex-row sm:flex-row md:flex-row xl:flex-row xs:space-y-1 xl:space-y-0 mb-4">
                        <div>
                            <p class="text-[#464748] font-semibold xs:text-[20px] sm:text-[22px] xs:text-center sm:text-left">
                                Data Setor Sampah
                            </p>
                        </div>
                        <div class="grid flex-grow justify-end">
                            <div class="flex sm:flex-row sm:space-x-2 sm:space-y-0 xs:flex-col xs:space-y-2 xs:space-x-0">
                                <div class="flex xl:flex-row space-x-2 items-center">
                                    <select class="filter select select-sm w-fit h-9 bg-[#3D8D7A] text-[#fff] !outline-none xs:text-[12px] sm:text-[14px]"
                                        name="status_filter" id="status-filtering"> {{-- ID is okay here --}}
                                        <option disabled selected>Filter Status</option>
                                        <option class="text-[#000] bg-[#fff]" value="all">Semua Status</option>
                                        <option class="text-[#000] bg-[#fff]" value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                                        <option class="text-[#000] bg-[#fff]" value="Di Proses">Di Proses</option>
                                        <option class="text-[#000] bg-[#fff]" value="Selesai">Selesai</option>
                                        <option class="text-[#000] bg-[#fff]" value="Dibatalkan">Dibatalkan</option>
                                    </select>
                                    <select class="filter select select-sm w-fit h-9 bg-[#3D8D7A] text-[#fff] !outline-none xs:text-[12px] sm:text-[14px]"
                                        name="metode_filter" id="metode-filtering"> {{-- Changed ID --}}
                                        <option disabled selected>Filter Metode</option>
                                        <option class="text-[#000] bg-[#fff]" value="all">Semua Metode</option>
                                        <option class="text-[#000] bg-[#fff]" value="jemput">Dijemput</option>
                                        <option class="text-[#000] bg-[#fff]" value="antar">Setor Langsung</option> {{-- Value should match DB --}}
                                    </select>
                                    <label for="add-setor-sampah"
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

                    <div class="card w-[100%] h-[100%] shadow-md bg-white text-primary-content px-4 py-4 mt-2">
                        <div class="overflow-x-auto">
                            <table id="setorSampahTable" class="stripe hover display responsive nowrap" style="width: 100%">
                                <thead class="bg-white xl:w-fit sm:w-auto">
                                    <tr>
                                        <!-- <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">No</th> -->
                                        <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">ID Setor</th>
                                        <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">Pengguna</th>
                                        <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">Waktu Setor</th>
                                        <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">Waktu Penjemputan</th>
                                        <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">Metode</th>
                                        <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">Total Berat (kg)</th>
                                        <!-- <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">Total Poin</th> -->
                                        <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">Status</th>
                                        <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] sm:text-xs">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="modalDetail" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="absolute inset-0 flex items-center justify-center py-10">
            <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-[#3D8D7A]">Detail Setor Sampah</h2>
                    <button id="btnCloseDetail" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">ID Setoran</p>
                            <p id="detailId" class="text-black font-semibold">-</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Waktu Setor</p>
                            <p id="detailWaktuSetor" class="text-black">-</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Kode Verifikasi</p>
                            <p id="detailKodeVerifikasi" class="text-black font-mono bg-gray-300 p-1 rounded inline-block">-</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500 mb-2">Status Setor</p>
                            <span id="detailStatus" class="px-2 py-1 text-xs font-semibold rounded-full">-</span>
                        </div>
                         <div class="mb-3">
                            <p class="text-sm text-gray-500">Metode Setor</p>
                            <p id="detailMetodeSetor" class="text-black">-</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Total Berat</p>
                            <p id="detailTotalBerat" class="text-black font-semibold">-</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Total Poin</p>
                            <p id="detailTotalPoin" class="text-black font-semibold">-</p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Nama Pengguna</p>
                            <p id="detailNamaPengguna" class="text-black">-</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Bank Sampah</p>
                            <p id="detailBankSampah" class="text-black">-</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Lokasi Penjemputan</p>
                            <p id="detailLokasiPenjemputan" class="text-black">-</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Waktu Penjemputan</p>
                            <p id="detailWaktuPenjemputan" class="text-black">-</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-sm text-gray-500">Catatan</p>
                            <p id="detailCatatan" class="text-black">-</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-md font-semibold mb-3 text-[#3D8D7A]">Rincian Sampah</h3>
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="py-2 px-3 text-left text-xs font-medium text-black uppercase">Nama Sampah</th>
                                    <th class="py-2 px-3 text-left text-xs font-medium text-black uppercase">Jenis Sampah</th>
                                    <th class="py-2 px-3 text-right text-xs font-medium text-black uppercase">Berat (kg)</th>
                                    <th class="py-2 px-3 text-right text-xs font-medium text-black uppercase">Poin/kg</th>
                                    <th class="py-2 px-3 text-right text-xs font-medium text-black uppercase">Total Poin</th>
                                </tr>
                            </thead>
                            <tbody id="detailSampahTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="checkbox" id="add-setor-sampah" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box w-11/12 max-w-3xl">
            <label for="add-setor-sampah" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="font-bold text-lg text-[#3D8D7A] mb-4">Tambah Setor Sampah Baru</h3>
            
            <form action="{{ route('admin.setor-sampah.add') }}" method="POST">
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
                                <option value="{{ $bank->id_bank_sampah }}" class="text-[#000] bg-[#fff]">{{ $bank->nama }}</option>
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
                    <textarea name="lokasi_penjemputan" class="textarea textarea-bordered" placeholder="Masukkan alamat lengkap penjemputan atau '-' jika diantar langsung" required></textarea>
                </div>


                <div class="form-control mb-4">
                    <label class="label"><span class="label-text">Catatan</span></label>
                    <textarea name="catatan" class="textarea textarea-bordered" placeholder="Catatan tambahan (opsional)"></textarea>
                </div>

                <div class="mb-4">
                    <h4 class="font-semibold text-[#3D8D7A] mb-2">Detail Sampah <span class="text-red-500">*</span></h4>
                    <div id="detail-sampah-container">
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
                                    <input type="number" name="detail_sampah[0][berat_kg]" step="0.01" min="0.01" 
                                        class="input input-bordered input-sm" placeholder="Berat (kg)" required>
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

    <!-- Edit Modal -->
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
                                <option value="{{ $bank->id_bank_sampah }}" class="text-[#000] bg-[#fff]">{{ $bank->nama }}</option>
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
                            <option class="text-[#000] bg-[#fff]" value="all">Semua Status</option>
                            <option class="text-[#000] bg-[#fff]" value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                            <option class="text-[#000] bg-[#fff]" value="Di Proses">Di Proses</option>
                            <option class="text-[#000] bg-[#fff]" value="Selesai">Selesai</option>
                            <option class="text-[#000] bg-[#fff]" value="Dibatalkan">Dibatalkan</option>
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
                        <!-- Dynamic content will be loaded here -->
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
        // Global function for showDetailModal
        function showDetailModal(id) {
            $.ajax({
                url: "{{ route('admin.setor-sampah.get-detail', '') }}/" + id,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        let setorData = response.data.setor_sampah; // Main deposit info
                        let sampahDetails = response.data.detail_setor; // Array of waste items
                        
                        $('#detailId').text(setorData.id_setor);
                        $('#detailWaktuSetor').text(setorData.waktu_setor_formatted); // Assuming formatted in controller
                        $('#detailKodeVerifikasi').text(setorData.kode_verifikasi || '-');
                        $('#detailTotalBerat').text(setorData.calculated_total_berat + ' kg');
                        $('#detailTotalPoin').text(setorData.calculated_total_poin + ' poin');
                        $('#detailNamaPengguna').text(setorData.pengguna ? setorData.pengguna.nama_lengkap : 'N/A');
                        $('#detailBankSampah').text(setorData.bank_sampah ? setorData.bank_sampah.nama_bank_sampah : 'N/A');
                        $('#detailLokasiPenjemputan').text(setorData.lokasi_penjemputan);
                        $('#detailWaktuPenjemputan').text(setorData.waktu_penjemputan_formatted || '-'); // Assuming formatted
                        $('#detailCatatan').text(setorData.catatan || '-');
                        $('#detailMetodeSetor').text(setorData.metode_setor === 'Dijemput' ? 'Dijemput' : 'Setor Langsung');

                        let statusClass = '';
                        let statusText = setorData.status_setor ? setorData.status_setor.charAt(0).toUpperCase() + setorData.status_setor.slice(1) : 'N/A';
                        switch(setorData.status_setor) {
                            case 'Menunggu Konfirmasi':
                                statusClass = 'bg-blue-100 text-blue-800';
                                break;
                            case 'Diproses':
                                statusClass = 'bg-yellow-100 text-yellow-800';
                                break;
                            case 'Selesai':
                                statusClass = 'bg-green-100 text-green-800';
                                break;
                            case 'Dibatalkan':
                                statusClass = 'bg-red-100 text-red-800';
                                break;
                            default: statusClass = 'bg-gray-100 text-gray-800';
                        }
                        $('#detailStatus').removeClass().addClass('px-2 py-1 text-xs font-semibold rounded-full ' + statusClass).text(statusText);
                        
                        let sampahTableHtml = '';
                        if (sampahDetails && sampahDetails.length > 0) {
                            sampahDetails.forEach(function(item) {
                                sampahTableHtml += `
                                    <tr class="border-b">
                                        <td class="py-2 px-3 text-sm text-black">${item.sampah ? item.sampah.nama_sampah : 'N/A'}</td>
                                        <td class="py-2 px-3 text-sm text-black">${item.sampah ? item.sampah.nama_jenis_sampah : 'N/A'}</td>
                                        <td class="py-2 px-3 text-sm text-black text-right">${item.berat_kg} kg</td>
                                        <td class="py-2 px-3 text-sm text-black text-right">${item.sampah ? item.sampah.bobot_poin : 'N/A'}</td>
                                        <td class="py-2 px-3 text-sm text-black text-right">${(item.berat_kg * (item.sampah ? item.sampah.bobot_poin : 0)).toFixed(2)}</td>
                                    </tr>
                                `;
                            });
                        } else {
                            sampahTableHtml = '<tr><td colspan="5" class="py-4 text-center text-gray-500">Tidak ada data detail sampah</td></tr>';
                        }
                        $('#detailSampahTableBody').html(sampahTableHtml); // Corrected ID
                        
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

        $(document).ready(function() {
            let table = $('#setorSampahTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.setor-sampah.data') }}",
                    data: function(d) {
                        d.status = $('#status-filtering').val();
                        d.metode = $('#metode-filtering').val(); // Added metode filter
                        d.bank_sampah = $('#bank-sampah-filtering').val();
                    }
                },
                columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center'},
                    {data: 'id_setor', name: 'id_setor'},
                    {data: 'nama_lengkap', name: 'pengguna.nama_lengkap'}, // Adjusted for eager loading sort/search
                    {data: 'waktu_setor_formatted', name: 'waktu_setor'},
                    {data: 'waktu_penjemputan_formatted', name: 'waktu_penjemputan'},
                    {data: 'metode_setor_formatted', name: 'metode_setor'}, // Added column for metode
                    {data: 'calculated_total_berat', name: 'calculated_total_berat', className: 'text-center'},
                    // {data: 'calculated_total_poin', name: 'calculated_total_poin', className: 'text-center'},
                    {data: 'status_badge', name: 'status_setor', orderable: false, searchable: false}, // Name should be status_setor
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
                ],
                responsive: true,
                language: { /* ... your language settings ... */ }
            });

            // Filter functionality
            $('#status-filtering, #metode-filtering, #bank-sampah-filtering').change(function() {
                table.draw();
            });

            // Handle detail modal
            $(document).on('click', 'button[data-action="detail"]', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                showDetailModal(id);
            });

            $('#btnCloseDetail').click(function() {
                $('#modalDetail').addClass('hidden');
            });

            $('#modalDetail').click(function(e) {
                if (e.target === this) {
                    $(this).addClass('hidden');
                }
            });
            
       
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
                        // Create a form to submit with DELETE method or use AJAX
                        let deleteForm = document.createElement('form');
                        deleteForm.action = "{{ route('admin.setor-sampah.delete', '') }}/" + id;
                        deleteForm.method = 'POST'; // HTML forms only support GET/POST

                        let csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = '{{ csrf_token() }}';
                        deleteForm.appendChild(csrfInput);

                        let methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE'; // To simulate DELETE request
                        deleteForm.appendChild(methodInput);
                        
                        document.body.appendChild(deleteForm);
                        deleteForm.submit();
                    }
                });
            });

            let sampahIndex = 1;
            $('#add-sampah-item').click(function() {
                let html = `
                    <div class="detail-sampah-item border border-gray-200 rounded-lg p-3 mb-2">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div class="form-control">
                                <select name="detail_sampah[${sampahIndex}][id_sampah]" class="select select-bordered select-sm" required>
                                    <option disabled selected value="">Pilih Jenis Sampah</option>
                                    @foreach ($sampah as $item)
                                        <option value="{{ $item->id_sampah }}">{{ $item->nama_sampah }} ({{ $item->bobot_poin }} poin/kg)</option>
                                    @endforeach
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
                if ($('.detail-sampah-item').length > 1) {
                    $(this).closest('.detail-sampah-item').remove();
                } else {
                    Swal.fire('Error', 'Minimal harus ada 1 jenis sampah.', 'error');
                }
            });
        });

        let editSampahIndex = 0;

        function showEditModal(id) {
            $.ajax({
                url: "{{ route('admin.setor-sampah.get-detail', '') }}/" + id,
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        let setorData = response.data.setor_sampah;
                        let sampahDetails = response.data.detail_setor;
                        
                        // Set form action
                        $('#editSetorForm').attr('action', "{{ route('admin.setor-sampah.update', '') }}/" + id);
                        
                        // Fill form fields
                        $('#edit_id_pengguna').val(setorData.id_pengguna);
                        $('#edit_id_bank_sampah').val(setorData.id_bank_sampah);
                        $('#edit_metode_setor').val(setorData.metode_setor);
                        $('#edit_waktu_penjemputan').val(setorData.waktu_penjemputan); // Assuming you send raw datetime
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

        function addEditSampahItem(selectedSampah = '', beratValue = '', detailId = '') {
            let html = `
                <div class="detail-sampah-item border border-gray-200 rounded-lg p-3 mb-2">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="form-control">
                            <select name="detail_sampah[${editSampahIndex}][id_sampah]" class="select select-bordered select-sm" required>
                                <option disabled value="">Pilih Jenis Sampah</option>
                                @foreach ($sampah as $item)
                                    <option value="{{ $item->id_sampah }}" ${selectedSampah == '{{ $item->id_sampah }}' ? 'selected' : ''}>{{ $item->nama_sampah }} ({{ $item->bobot_poin }} poin/kg)</option>
                                @endforeach
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
                </div>
            `;
            $('#edit-detail-sampah-container').append(html);
            editSampahIndex++;
        }

        $(document).ready(function() {
            // Edit button click handler
            $(document).on('click', 'a[href^="#edit-setor/"]', function(e) {
                e.preventDefault();
                let id = $(this).attr('href').replace('#edit-setor/', '');
                showEditModal(id);
            });

            // Add sampah item in edit modal
            $('#edit-add-sampah-item').click(function() {
                addEditSampahItem();
            });

            // Remove sampah item in edit modal
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
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = Object.values(xhr.responseJSON.errors).flat();
                            errorMessage = errors.join('<br>');
                        }
                        Swal.fire('Error', errorMessage, 'error');
                    }
                });
            });
        });
    </script>
@endsection