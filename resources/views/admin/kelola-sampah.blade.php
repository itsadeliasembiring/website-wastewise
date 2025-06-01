@extends('layouts.template')
@section('title', 'Kelola Sampah')

@section('content')
    @php
        if (count($errors) > 0) {
            alert()->error('Gagal', $errors->all());
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
                    Kelola Sampah</p>
            </div>

            <div class="pl-[70px] pr-[20px]">
                <div class="tabs tabs-border mt-4">
                    <input type="radio" name="my_tabs_2" role="tab" class="tab !text-[#3D8D7A] font-semibold ml-3" aria-label="Data Sampah" checked />
                    <div role="tabpanel" class="tab-content p-6">
                        <div class="flex flex-col w-full align-top">
                            <div class="flex items-center align-middle xs:flex-row sm:flex-row md:flex-row xl:flex-row xs:space-y-1 xl:space-y-0">
                                <div>
                                    <p class="text-[#464748] font-semibold xs:text-[20px] sm:text-[22px] xs:text-center sm:text-left">
                                        Data Sampah
                                    </p>
                                </div>
                                {{-- Aksi --}}
                                <div class="grid flex-grow justify-end">
                                    <div class="flex sm:flex-row sm:space-x-2 sm:space-y-0 xs:flex-col xs:space-y-2 xs:space-x-0">
                                        <div class="flex xl:flex-row space-x-2 items-center">
                                            <select class="filter select select-sm w-fit h-9 bg-[#3D8D7A] text-[#fff] !outline-none xs:text-[12px] sm:text-[14px]"
                                                name="jenis_sampah" id="jenis-filtering">
                                                <option disabled selected>Pilih Jenis</option>
                                                <option class="text-[#000] bg-[#fff]" value="all">Semua</option>
                                                @foreach ($jenis_sampah as $jenis)
                                                    <option class="text-[#000] bg-[#fff]" value="{{ $jenis->id_jenis_sampah }}">
                                                        {{ $jenis->nama_jenis_sampah }}</option>
                                                @endforeach
                                            </select>
                                            <label for="add-sampah"
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
                                    <table id="sampahTable" class="stripe hover display responsive nowrap" style="width: 100%">
                                        <thead class="bg-white xl:w-fit sm:w-auto">
                                            <tr>
                                                <th scope="col" class="xl:text-sm xs:text-xs xl:flex font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    ID Sampah
                                                </th>
                                                <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Foto
                                                </th>
                                                <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Nama Sampah
                                                </th>
                                                <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Jenis Sampah
                                                </th>
                                                <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Bobot Poin
                                                </th>
                                                <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] sm:text-xs">
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="radio" name="my_tabs_2" role="tab" class="tab !text-[#3D8D7A] font-semibold tab-active:text-[#3D8D7A]" aria-label="Jenis Sampah" />
                    <div role="tabpanel" class="tab-content p-6">
                        <div class="flex flex-col w-full align-top">
                            <div class="flex items-center align-middle xs:flex-row sm:flex-row md:flex-row xl:flex-row xs:space-y-1 xl:space-y-0">
                                <div>
                                    <p class="text-[#464748] font-semibold xs:text-[20px] sm:text-[22px] xs:text-center sm:text-left">
                                        Jenis Sampah
                                    </p>
                                </div>
                                {{-- Aksi --}}
                                <div class="grid flex-grow justify-end">
                                    <div class="flex sm:flex-row sm:space-x-2 sm:space-y-0 xs:flex-col xs:space-y-2 xs:space-x-0">
                                        <div class="flex xl:flex-row space-x-2 items-center">
                                            <label for="add-jenis-sampah"
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
                                    <table id="jenisSampahTable" class="stripe hover display responsive nowrap" style="width: 100%">
                                        <thead class="bg-white xl:w-fit sm:w-auto">
                                            <tr>
                                                <th scope="col" class="xl:text-sm xs:text-xs xl:flex font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    ID Jenis
                                                </th>
                                                <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Nama Jenis Sampah
                                                </th>
                                                <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] px-6 py-4 sm:text-xs">
                                                    Warna Tempat Sampah
                                                </th>
                                                <th scope="col" class="xl:text-sm xs:text-xs font-semibold text-[#35405B] sm:text-xs">
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jenis_sampah as $jenis)
                                                <tr>
                                                    <td class="text-center text-black">{{ $jenis->id_jenis_sampah }}</td>
                                                    <td class="text-center text-black">{{ $jenis->nama_jenis_sampah }}</td>
                                                    <td class="text-center text-black">
                                                        <div class="flex items-center justify-center space-x-2">
                                                            <span>{{ $jenis->warna_tempat_sampah }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="flex space-x-2 items-center justify-center">
                                                            <label for="edit-jenis-sampah-{{ $jenis->id_jenis_sampah }}" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </label>
                                                            <label for="delete-jenis-sampah-{{ $jenis->id_jenis_sampah }}" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
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

    <input type="checkbox" id="add-sampah" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle dark:bg-[#E6E6E6]">
        <div class="modal-box bg-white text-black max-w-2xl">
            <h3 class="font-bold text-lg mb-3 text-[#464748]">Form Sampah Baru</h3>
            <form id="addSampahForm" action="{{ url('add-sampah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label accent-black">
                            <span class="label-text text-black">Nama Sampah <span class="text-[#FF000A]">*</span></span>
                        </label>
                        <input type="text" 
                            id="add-nama-sampah"
                            placeholder="Masukkan Nama Sampah" 
                            name="nama_sampah"
                            class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" 
                            required />
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text text-black">Jenis Sampah <span class="text-[#FF000A]">*</span></span>
                        </label>
                        <select name="jenis_sampah" 
                                id="add-jenis-sampah-select"
                                class="select w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" 
                                required>
                            <option disabled selected value="">Pilih Jenis Sampah</option>
                            @foreach ($jenis_sampah as $jenis)
                                <option value="{{ $jenis->id_jenis_sampah }}">{{ $jenis->nama_jenis_sampah }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="label">
                        <span class="label-text text-black">Detail Ciri <span class="text-[#FF000A]">*</span></span>
                    </label>
                    <textarea placeholder="Masukkan Detail Ciri" 
                        id="add-detail-ciri"
                        name="detail_ciri" 
                        rows="3"
                        class="textarea w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" 
                        required></textarea>
                </div>
                <div>
                    <label class="label">
                        <span class="label-text text-black">Detail Manfaat <span class="text-[#FF000A]">*</span></span>
                    </label>
                    <textarea placeholder="Masukkan Detail Manfaat" 
                        id="add-detail-manfaat"
                        name="detail_manfaat" 
                        rows="3"
                        class="textarea w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" 
                        required></textarea>
                </div>
                <div>
                    <label class="label">
                        <span class="label-text text-black">Bobot Poin <span class="text-[#FF000A]">*</span></span>
                    </label>
                    <input type="number" 
                        id="add-bobot-poin"
                        placeholder="Masukkan Bobot Poin" 
                        name="bobot_poin" 
                        min="0" 
                        step="0.1"
                        class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" 
                        required />
                </div>
                <div>
                    <label class="label">
                        <span class="label-text text-black">Foto Sampah</span>
                    </label>
                    <input type="file" 
                        id="add-foto"
                        name="foto" 
                        accept="image/*"
                        class="file-input file-input-bordered w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                </div>

                <div class="flex modal-action justify-center">
                    <label for="add-sampah"
                        class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</label>
                    <button type="submit"
                        class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <input type="checkbox" id="add-jenis-sampah" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle dark:bg-[#E6E6E6]">
        <div class="modal-box bg-white text-black">
            <h3 class="font-bold text-lg mb-3 text-[#464748]">Form Jenis Sampah Baru</h3>
            <form id="addJenisSampahForm" action="{{ url('add-jenis-sampah') }}" method="POST">
                @csrf
                <label class="label accent-black">
                    <span class="label-text text-black">Nama Jenis Sampah <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="text" placeholder="Masukkan Nama Jenis Sampah" name="nama_jenis_sampah"
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />
                
                <label class="label">
                    <span class="label-text text-black">Warna Tempat Sampah <span class="text-[#FF000A]">*</span></span>
                </label>
                <input type="text" name="warna_tempat_sampah"  placeholder="Masukkan Warna Tempat Sampah" 
                    class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                <div class="flex modal-action justify-center pl-5">
                    <label for="add-jenis-sampah"
                        class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</label>
                    <button type="submit"
                        class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($sampah as $item)
        <div class="modal modal-bottom sm:modal-middle" id="edit-sampah/{{ $item->id_sampah }}">
            <div class="modal-box bg-white text-black max-w-2xl">
                <h3 class="font-bold text-lg mb-3 text-[#464748]">Edit Sampah</h3>
                <form class="editSampahForm" action="{{ url('edit-sampah') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_sampah" value="{{ $item->id_sampah }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="label accent-black">
                                <span class="label-text text-black">Nama Sampah <span class="text-[#FF000A]">*</span></span>
                            </label>
                            <input type="text" name="nama_sampah" value="{{ $item->nama_sampah }}"
                                class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />
                        </div>
                        <div>
                            <label class="label">
                                <span class="label-text text-black">Jenis Sampah <span class="text-[#FF000A]">*</span></span>
                            </label>
                            <select name="jenis_sampah" class="select w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required>
                                @foreach ($jenis_sampah as $jenis)
                                    <option value="{{ $jenis->id_jenis_sampah }}" {{ $jenis->id_jenis_sampah == $item->jenis_sampah ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis_sampah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text text-black">Detail Ciri <span class="text-[#FF000A]">*</span></span>
                        </label>
                        <textarea name="detail_ciri" rows="3"
                            class="textarea w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required>{{ $item->detail_ciri }}</textarea>
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text text-black">Detail Manfaat <span class="text-[#FF000A]">*</span></span>
                        </label>
                        <textarea name="detail_manfaat" rows="3"
                            class="textarea w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required>{{ $item->detail_manfaat }}</textarea>
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text text-black">Bobot Poin <span class="text-[#FF000A]">*</span></span>
                        </label>
                        <input type="number" name="bobot_poin" value="{{ $item->bobot_poin }}" min="0" step="0.1"
                            class="input w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />
                    </div>
                    <div>
                        <label class="label">
                            <span class="label-text text-black">Foto Sampah</span>
                        </label>
                        @if($item->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/sampah/'.$item->foto) }}" alt="Foto Sampah" class="w-20 h-20 object-cover rounded">
                                <p class="text-sm text-gray-500">Foto saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="foto" accept="image/*"
                            class="file-input file-input-bordered w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white" />
                    </div>

                    <div class="flex modal-action justify-center">
                        <a href="#" class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</a>
                        <button type="submit" class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal" id="delete-sampah/{{ $item->id_sampah }}">
            <div class="modal-box bg-white text-black items-center justify-center text-center mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-18 w-18 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                <h3 class="font-semibold text-lg text-center mt-2">Apakah Anda Yakin?</h3>
                <p class="text-center">Data yang terhapus tidak dapat kembali!</p>
                <div class="modal-action flex justify-center">
                    <a href="#" class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batalkan</a>
                    <a href="/hapus-sampah/{{ $item->id_sampah }}" class="btn bg-[#ED1C24] border-[#ED1C24] w-[120px] text-[#fff] hover:bg-[#ED1C24] hover:border-[#ED1C24]">Hapus</a>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($jenis_sampah as $jenis)
        <input type="checkbox" id="edit-jenis-sampah-{{ $jenis->id_jenis_sampah }}" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle">
            <div class="modal-box bg-white text-black">
                <h3 class="font-bold text-lg mb-3 text-[#464748]">Edit Jenis Sampah</h3>
                <form class="editJenisSampahForm" action="{{ url('edit-jenis-sampah') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_jenis_sampah" value="{{ $jenis->id_jenis_sampah }}">
                    
                    <label class="label accent-black">
                        <span class="label-text text-black">Nama Jenis Sampah <span class="text-[#FF000A]">*</span></span>
                    </label>
                    <input type="text" name="nama_jenis_sampah" value="{{ $jenis->nama_jenis_sampah }}"
                        class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />
                    
                    <label class="label">
                        <span class="label-text text-black">Warna Tempat Sampah <span class="text-[#FF000A]">*</span></span>
                    </label>
                    <input type="color" name="warna_tempat_sampah" value="{{ $jenis->warna_tempat_sampah }}"
                        class="input w-full max-w-lg border-3 !outline-none shadow-inner shadow-slate-300 bg-white" required />

                    <div class="flex modal-action justify-center pl-5">
                        <label for="edit-jenis-sampah-{{ $jenis->id_jenis_sampah }}"
                            class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batal</label>
                        <button type="submit"
                            class="btn bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <input type="checkbox" id="delete-jenis-sampah-{{ $jenis->id_jenis_sampah }}" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle">
            <div class="modal-box bg-white text-black items-center justify-center text-center mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-18 w-18 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                <h3 class="font-semibold text-lg text-center mt-2">Apakah Anda Yakin?</h3>
                <p class="text-center">Data yang terhapus tidak dapat kembali!</p>
                <div class="modal-action flex justify-center">
                    <label for="delete-jenis-sampah-{{ $jenis->id_jenis_sampah }}"
                        class="btn btn-outline btn-[#3D8D7A] w-[120px] bg-[#fff] text-[#3D8D7A] hover:bg-[#FFF] hover:border-[#3D8D7A] hover:text-[#3D8D7A]">Batalkan</label>
                    <a href="/hapus-jenis-sampah/{{ $jenis->id_jenis_sampah }}" 
                        class="btn bg-[#ED1C24] border-[#ED1C24] w-[120px] text-[#fff] hover:bg-[#ED1C24] hover:border-[#ED1C24]">Hapus</a>
                </div>
            </div>
        </div>
    @endforeach


    <script>
        $(document).ready(function() {
            // Initialize DataTable for Sampah
            var sampahTable = $('#sampahTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('sampah.data') }}",
                    data: function (d) {
                        d.jenis = $('#jenis-filtering').val();
                    }
                },
                columns: [
                    {data: 'id_sampah', name: 'id_sampah', className: 'text-center dt-body-center width-[30px]'},
                    {data: 'foto', name: 'foto', orderable: false, searchable: false, className: 'text-center dt-body-center'},
                    {data: 'nama_sampah', name: 'nama_sampah'}, // Default left align for text
                    {data: 'nama_jenis_sampah', name: 'jenis_sampah.nama_jenis_sampah'}, // Default left align
                    {data: 'bobot_poin', name: 'bobot_poin', className: 'text-center dt-body-center'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center dt-body-center'}
                ],
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
                    emptyTable: "Tidak ada data tersedia"
                }
            });

            // Initialize DataTable for Jenis Sampah
                $('#jenisSampahTable').DataTable({
                responsive: true,
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
                    emptyTable: "Tidak ada data tersedia"
                }
            });

            // Filter functionality
            $('#jenis-filtering').on('change', function() {
                sampahTable.draw();
            });
            
            // MODAL MANAGEMENT
            var modalCache = {};
            function getModal(modalId) {
                if (!modalCache[modalId]) {
                    modalCache[modalId] = document.getElementById(modalId);
                }
                return modalCache[modalId];
            }

            
            $(document).on('click', 'a[href*="edit-sampah/"], a[href*="delete-sampah/"]', function(e) {
                e.preventDefault();
                var href = $(this).attr('href');
                var modalId = href.substring(1); 
                var modal = getModal(modalId); 
                
                if (modal) {
                    modal.classList.add('modal-open');
                }
            });

            
            $(document).on('click', '.modal .btn[href="#"], .modal-box a[href="#"]', function(e) {
                e.preventDefault();
                var modal = $(this).closest('.modal')[0];
                if (modal) {
                    modal.classList.remove('modal-open');
                }
            });
            
            $(document).on('change', 'input[type="checkbox"].modal-toggle', function() {
                var modalId = $(this).attr('id'); 
                var modal = $(this).next('.modal')[0]; 
                
                if (!modal && modalId) { 
                    modal = document.getElementById(modalId);
                }


                if (modal) {
                    if (this.checked) {
                        modal.classList.add('modal-open');
                    } else {
                        modal.classList.remove('modal-open');
                        var form = modal.querySelector('form');
                        if (form) form.reset();
                    }
                }
            });

            $(document).on('click', '.modal', function(e) {
                if (e.target === this) { 
                    this.classList.remove('modal-open');
                    const modalToggleId = $(this).prev('input.modal-toggle').attr('id');
                    if (modalToggleId) {
                        $('#' + modalToggleId).prop('checked', false);
                    }
                }
            });

            // Close modal with Escape key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    $('.modal.modal-open').each(function() {
                        this.classList.remove('modal-open');
                        const modalToggleId = $(this).prev('input.modal-toggle').attr('id');
                        if (modalToggleId) {
                            $('#' + modalToggleId).prop('checked', false);
                        }
                    });
                }
            });


            // Form validation
            $('#addSampahForm').on('submit', function(e) {
                if (!validateSampahForm(this)) {
                    e.preventDefault();
                    return false;
                }
                showLoadingAlert('Menyimpan...');
            });

            $(document).on('submit', '.editSampahForm', function(e) {
                if (!validateSampahForm(this)) {
                    e.preventDefault();
                    return false;
                }
                showLoadingAlert('Mengupdate...');
            });
            
            $('#addJenisSampahForm').on('submit', function(e) {
                if (!validateJenisSampahForm(this)) {
                    e.preventDefault();
                    return false;
                }
                showLoadingAlert('Menyimpan...');
            });

            $(document).on('submit', '.editJenisSampahForm', function(e) {
                if (!validateJenisSampahForm(this)) {
                    e.preventDefault();
                    return false;
                }
                showLoadingAlert('Mengupdate...');
            });

            
            function validateSampahForm(form) {
                var $form = $(form);
                var nama = $form.find('input[name="nama_sampah"]').val().trim();
                var jenis = $form.find('select[name="jenis_sampah"]').val();
                var ciri = $form.find('textarea[name="detail_ciri"]').val().trim();
                var manfaat = $form.find('textarea[name="detail_manfaat"]').val().trim();
                var bobot = $form.find('input[name="bobot_poin"]').val();

                if (!nama) {
                    showErrorAlert('Nama sampah wajib diisi!');
                    return false;
                }
                if (!jenis) {
                    showErrorAlert('Jenis sampah wajib dipilih!');
                    return false;
                }
                if (!ciri) {
                    showErrorAlert('Detail ciri wajib diisi!');
                    return false;
                }
                if (!manfaat) {
                    showErrorAlert('Detail manfaat wajib diisi!');
                    return false;
                }
                if (bobot === '' || parseFloat(bobot) < 0) { 
                    showErrorAlert('Bobot poin wajib diisi dengan nilai yang valid (minimal 0)!');
                    return false;
                }
                return true;
            }

            function validateJenisSampahForm(form) {
                var $form = $(form);
                var nama = $form.find('input[name="nama_jenis_sampah"]').val().trim();
                var warna = $form.find('input[name="warna_tempat_sampah"]').val();

                if (!nama) {
                    showErrorAlert('Nama jenis sampah wajib diisi!');
                    return false;
                }
                if (!warna) {
                    showErrorAlert('Warna tempat sampah wajib dipilih!');
                    return false;
                }
                return true;
            }

            function showErrorAlert(message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: message,
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
        }
        
        .modal {
            display: none; 
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

        .modal-open {
            display: flex !important; 
            opacity: 1 !important;
            visibility: visible !important;
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

        .modal-open .modal-box {
            transform: scale(1) translateY(0);
        }


        /* Optimasi untuk DataTables */
        .dataTables_wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Optimasi rendering tabel */
        table {
            table-layout: fixed;
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

        .loading-state {
            pointer-events: none;
            opacity: 0.7;
            position: relative;
        }

        .loading-state::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .input, .select, .textarea {
            will-change: auto;
        }

        .input:focus, .select:focus, .textarea:focus {
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

        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(-10px);
            }
            to { 
                opacity: 1; 
                transform: translateY(0);
            }
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