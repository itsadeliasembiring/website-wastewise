@extends('layouts.template')
@section('title', 'Edit Artikel')

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

        <!-- Flash Messages -->
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
        <main class="justify-center w-full">
            <!-- Title & Description -->
            <div class="mt-4 sm:px-8">
                <p class="text-[#3D8D7A] text-center font-semibold xs:text-[23px] sm:text-[23px] xl:text-[25px]">
                    Edit Artikel</p>
                <p class="text-[#3D8D7A] italic text-center font-semibold xs:text-[23px] sm:text-[23px] xl:text-[25px]">
                    "{{ $artikel->judul_artikel }}"</p>
            </div>

            <!-- Form Edit Artikel -->
            <div class="pl-[70px] pr-[20px]">
                <div class="flex justify-center mt-4 mb-2">
                    <div class="w-full max-w-4xl">
                        <!-- Header dengan tombol kembali -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('kelola-artikel') }}" 
                                   class="btn btn-sm bg-[#3D8D7A] border-[#3D8D7A] w-[120px] text-[#fff] dark:text-[#fff] hover:bg-[#3D8D7A] hover:border-[#3D8D7A]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Kembali
                                </a>
                            </div>
                        </div>

                        <!-- Form Card -->
                        <div class="card w-full shadow-md bg-white px-6 py-6">
                            <form action="{{ route('edit-artikel') }}" method="POST" enctype="multipart/form-data" id="editArtikelForm">
                                @csrf
                                <input type="hidden" name="id_artikel" value="{{ $artikel->id_artikel }}">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Kolom Kiri -->
                                    <div class="space-y-4">
                                        {{-- ID Artikel (Read Only) --}}
                                        <div>
                                            <label class="label">
                                                <span class="label-text text-black font-medium">ID Artikel</span>
                                            </label>
                                            <input type="text" value="{{ $artikel->id_artikel }}" 
                                                class="input w-full border-3 text-[#000] bg-gray-100 text-gray-600" readonly />
                                        </div>

                                        {{-- Judul Artikel --}}
                                        <div>
                                            <label class="label">
                                                <span class="label-text text-black font-medium">Judul Artikel <span class="text-[#FF000A]">*</span></span>
                                            </label>
                                            <input type="text" placeholder="Masukkan Judul Artikel" name="judul_artikel"
                                                value="{{ old('judul_artikel', $artikel->judul_artikel) }}"
                                                class="input w-full border-3 text-[#000] !outline-none shadow-inner shadow-slate-300 bg-white @error('judul_artikel') border-red-500 @enderror" required />
                                            @error('judul_artikel')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        {{-- Foto Artikel --}}
                                        <div>
                                            <label class="label">
                                                <span class="label-text text-black font-medium">Foto Artikel</span>
                                            </label>
                                            @if($artikel->foto)
                                                <div class="mb-3">
                                                    <p class="text-sm text-black mb-2">Foto Saat Ini:</p>
                                                    <img src="{{ asset('storage/' . $artikel->foto) }}" alt="Current Photo" 
                                                         class="w-40 h-40 object-cover rounded-lg border shadow-sm text-black">
                                                </div>
                                            @endif
                                            <input type="file" name="foto" accept="image/*"
                                                class="file-input w-full border-3 text-[#000] !outline-none shadow-inner shadow-slate-300 bg-white @error('foto') border-red-500 @enderror" />
                                            <p class="text-xs text-gray-500 mt-1">
                                                Format: JPEG, PNG, JPG, GIF (Max: 2MB)<br>
                                                Kosongkan jika tidak ingin mengubah foto
                                            </p>
                                            @error('foto')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="space-y-4">
                                        {{-- Detail Artikel --}}
                                        <div>
                                            <label class="label">
                                                <span class="label-text text-black font-medium">Detail Artikel <span class="text-[#FF000A]">*</span></span>
                                            </label>
                                            <textarea placeholder="Masukkan Detail Artikel" name="detail_artikel" rows="20"
                                                class="textarea text-[#000] w-full border-3 !outline-none shadow-inner shadow-slate-300 bg-white resize-none @error('detail_artikel') border-red-500 @enderror" required>{{ old('detail_artikel', $artikel->detail_artikel) }}</textarea>
                                            @error('detail_artikel')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Tambahan -->
                                <div class="mt-6 pt-4 border-t border-gray-200">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                        <div>
                                            <span class="font-medium">Dibuat:</span> 
                                            {{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y H:i') }}
                                        </div>
                                        <div>
                                            <span class="font-medium">Terakhir Diupdate:</span> 
                                            {{ \Carbon\Carbon::parse($artikel->updated_at)->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Button Actions -->
                                <div class="flex justify-center space-x-4 mt-8 pt-6 border-t border-gray-200">
                                    <a href="{{ route('kelola-artikel') }}"
                                        class="btn btn-outline border-[#3D8D7A] text-[#3D8D7A] hover:bg-[#3D8D7A] hover:text-white hover:border-[#3D8D7A] w-[140px]">
                                        Batal
                                    </a>
                                    <button type="submit"
                                        class="btn bg-[#3D8D7A] border-[#3D8D7A] text-white hover:bg-[#2a7063] hover:border-[#2a7063] w-[140px]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @push('script')
        <script type="text/javascript">
            $(document).ready(function() {
                // Setup CSRF for AJAX requests
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Handle form submission with loading
                $('#editArtikelForm').on('submit', function(e) {
                    // Show loading
                    Swal.fire({
                        title: 'Menyimpan Perubahan...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                });

                // File input preview
                $('input[name="foto"]').on('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        // Validate file size (2MB = 2048KB)
                        if (file.size > 2048 * 1024) {
                            Swal.fire({
                                icon: 'error',
                                title: 'File Terlalu Besar!',
                                text: 'Ukuran file maksimal 2MB'
                            });
                            $(this).val('');
                            return;
                        }

                        // Validate file type
                        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                        if (!allowedTypes.includes(file.type)) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Format File Tidak Valid!',
                                text: 'Hanya file JPEG, PNG, JPG, dan GIF yang diperbolehkan'
                            });
                            $(this).val('');
                            return;
                        }

                        // Show preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Remove existing preview if any
                            $('.file-preview').remove();
                            
                            // Create new preview
                            const preview = $(`
                                <div class="file-preview mt-2">
                                    <p class="text-sm text-gray-600 mb-2">Preview Foto Baru:</p>
                                    <img src="${e.target.result}" alt="Preview" 
                                         class="w-40 h-40 object-cover rounded-lg border shadow-sm">
                                </div>
                            `);
                            
                            $('input[name="foto"]').closest('div').append(preview);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Confirm navigation away with unsaved changes
                let formChanged = false;
                $('#editArtikelForm input, #editArtikelForm textarea').on('input change', function() {
                    formChanged = true;
                });

                $('a[href*="kelola-artikel"]').on('click', function(e) {
                    if (formChanged) {
                        e.preventDefault();
                        const href = $(this).attr('href');
                        
                        Swal.fire({
                            title: 'Perubahan Belum Disimpan!',
                            text: 'Apakah Anda yakin ingin meninggalkan halaman ini?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Tinggalkan',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = href;
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection