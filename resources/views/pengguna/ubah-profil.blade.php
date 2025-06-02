<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WasteWise - Ubah Profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10 flex">

        <!-- Sidebar -->
        <div class="w-72 pr-6">
            <div class="bg-white rounded-lg p-6 shadow-sm mb-6">
                <div class="flex flex-col items-center mb-6">
                    <div class="h-20 w-20 rounded-full overflow-hidden mb-3">
                        <img src="{{ $pengguna->foto ? asset('storage/' . $pengguna->foto) : asset('Assets/default-avatar.png') }}" 
                             class="h-full w-full object-cover" alt="Profile picture">
                    </div>
                    <h2 class="font-bold text-lg">{{ $pengguna->nama_lengkap }}</h2>
                    <p class="text-sm text-gray-500">{{ $pengguna->akun->email }}</p>
                    <p class="text-sm text-gray-500">{{ $pengguna->total_poin ?? 0 }} Poin</p>
                </div>
                <div class="border-t border-gray-200 pt-3 flex flex-col gap-5 text-sm font-medium">
                    <a href="#" class="flex items-center text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profil Saya
                    </a>
                    <a href="{{ route('ubah-password') }}" class="flex items-center text-gray-700 hover:text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Ubah Password
                    </a>
                    <a href="{{ route('landing-page') }}" class="flex items-center text-gray-700 hover:text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar Akun
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="flex-1">
            <div class="bg-white rounded-lg p-8 shadow-sm">
                <h2 class="text-2xl font-semibold text-teal-600 mb-4">Profil Saya</h2>
                
                <!-- Alert Messages -->
                <div id="alert-success" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <span id="success-message"></span>
                </div>
                <div id="alert-error" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <span id="error-message"></span>
                </div>

                <div class="border-t border-gray-200 pt-8">
                    <form id="profileForm" enctype="multipart/form-data">
                        @csrf
                        <div class="flex">

                            <!-- Upload Foto -->
                            <div class="w-1/3 flex flex-col items-center">
                                <div class="mb-4">
                                    <img id="preview-image" 
                                         src="{{ $pengguna->foto ? asset('storage/' . $pengguna->foto) : asset('Assets/default-avatar.png') }}" 
                                         class="w-44 h-44 rounded-full object-cover" alt="Profile Photo">
                                </div>
                                <label for="foto-upload" class="cursor-pointer bg-gray-200 text-gray-700 px-6 py-2 rounded-md font-medium mb-2 transition hover:bg-gray-300">
                                    Pilih Foto
                                </label>
                                <input id="foto-upload" type="file" name="foto" class="hidden" accept="image/jpeg,image/png,image/jpg">
                                <div class="text-xs text-gray-500 text-center">
                                    <p>Besar file: maksimum 10 MB</p>
                                    <p>Ekstensi file: JPG, JPEG, PNG</p>
                                </div>
                            </div>

                            <!-- Form Biodata -->
                            <div class="w-2/3 pl-8">

                                <!-- Biodata Diri -->
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold text-gray-500 mb-3">Biodata Diri</h3>

                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" value="{{ $pengguna->nama_lengkap }}" 
                                               class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm" 
                                               placeholder="Nama Lengkap" required>
                                    </div>

                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                        <div class="relative">
                                            <select name="jenis_kelamin" class="appearance-none w-full border border-grey-300 rounded-md py-2 px-3 text-sm pr-10" required>
                                                <option value="Laki-laki" {{ $pengguna->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ $pengguna->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" value="{{ $pengguna->tanggal_lahir }}" 
                                               class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm" required>
                                    </div>

                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                        <input type="text" name="detail_alamat" value="{{ $pengguna->detail_alamat }}" 
                                               class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm" 
                                               placeholder="Alamat Rumah atau Domisili">
                                    </div>

                                    <!-- Kecamatan Field -->
                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                        <div class="relative">
                                            <select id="kecamatan-select" class="appearance-none w-full border border-grey-300 rounded-md py-2 px-3 text-sm pr-10">
                                                <option value="" disabled>Pilih Kecamatan</option>
                                                @foreach($kecamatan as $kec)
                                                    <option value="{{ $kec->id_kecamatan }}" 
                                                            {{ ($pengguna->kelurahan && $pengguna->kelurahan->kecamatan->id_kecamatan == $kec->id_kecamatan) ? 'selected' : '' }}>
                                                        {{ $kec->nama_kecamatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kelurahan Field -->
                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                                        <div class="relative">
                                            <select name="id_kelurahan" id="kelurahan-select" class="appearance-none w-full border border-grey-300 rounded-md py-2 px-3 text-sm pr-10" required>
                                                <option value="" disabled>Pilih Kelurahan</option>
                                                @if($pengguna->kelurahan)
                                                    @foreach($kelurahan->where('id_kecamatan', $pengguna->kelurahan->kecamatan->id_kecamatan) as $kel)
                                                        <option value="{{ $kel->id_kelurahan }}" 
                                                                {{ $pengguna->id_kelurahan == $kel->id_kelurahan ? 'selected' : '' }}>
                                                            {{ $kel->nama_kelurahan }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kontak -->
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-500 mb-3">Kontak</h3>

                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                        <input type="tel" name="nomor_telepon" value="{{ $pengguna->nomor_telepon }}" 
                                               class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm" 
                                               placeholder="+62 xxx xxxx xxxx" required>
                                    </div>

                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input type="email" name="email" value="{{ $pengguna->akun->email }}" 
                                               class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm" 
                                               placeholder="email@example.com" required>
                                    </div>
                                </div>

                                <!-- Tombol Simpan -->
                                <div class="flex justify-center mt-10">
                                    <button type="submit" id="submitBtn" 
                                            class="bg-teal-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-teal-700 transition-colors w-full max-w-xs">
                                        <span id="submitText">Simpan Perubahan</span>
                                        <span id="loadingText" class="hidden">Menyimpan...</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <script>
        $(document).ready(function() {
            // Setup CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Image preview functionality
            $('#foto-upload').change(function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Kecamatan change handler
            $('#kecamatan-select').change(function() {
                const kecamatanId = $(this).val();
                const kelurahanSelect = $('#kelurahan-select');
                
                if (kecamatanId) {
                    $.get(`/kelurahan/${kecamatanId}`)
                        .done(function(response) {
                            if (response.success) {
                                kelurahanSelect.html('<option value="" disabled>Pilih Kelurahan</option>');
                                $.each(response.data, function(index, kelurahan) {
                                    kelurahanSelect.append(`<option value="${kelurahan.id_kelurahan}">${kelurahan.nama_kelurahan}</option>`);
                                });
                            }
                        })
                        .fail(function() {
                            showAlert('error', 'Gagal memuat data kelurahan!');
                        });
                } else {
                    kelurahanSelect.html('<option value="" disabled>Pilih Kelurahan</option>');
                }
            });

            // Form submission
            $('#profileForm').submit(function(e) {
                e.preventDefault();
                
                const submitBtn = $('#submitBtn');
                const submitText = $('#submitText');
                const loadingText = $('#loadingText');
                
                // Disable button and show loading
                submitBtn.prop('disabled', true);
                submitText.addClass('hidden');
                loadingText.removeClass('hidden');
                
                const formData = new FormData(this);
                
                $.ajax({
                    url: '{{ route("profil.update") }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            showAlert('success', response.message);
                            // Optionally reload the page or update specific elements
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            showAlert('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        let message = 'Terjadi kesalahan saat menyimpan data!';
                        
                        if (xhr.status === 422) {
                            // Validation errors
                            const errors = xhr.responseJSON.errors;
                            let errorMessages = [];
                            
                            for (let field in errors) {
                                errorMessages.push(errors[field][0]);
                            }
                            
                            message = errorMessages.join('<br>');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        
                        showAlert('error', message);
                    },
                    complete: function() {
                        // Re-enable button and hide loading
                        submitBtn.prop('disabled', false);
                        submitText.removeClass('hidden');
                        loadingText.addClass('hidden');
                    }
                });
            });

            function showAlert(type, message) {
                const alertSuccess = $('#alert-success');
                const alertError = $('#alert-error');
                
                // Hide all alerts first
                alertSuccess.addClass('hidden');
                alertError.addClass('hidden');
                
                if (type === 'success') {
                    $('#success-message').html(message);
                    alertSuccess.removeClass('hidden');
                    
                    // Auto hide after 5 seconds
                    setTimeout(() => {
                        alertSuccess.addClass('hidden');
                    }, 5000);
                } else {
                    $('#error-message').html(message);
                    alertError.removeClass('hidden');
                    
                    // Auto hide after 8 seconds
                    setTimeout(() => {
                        alertError.addClass('hidden');
                    }, 8000);
                }
                
                // Scroll to top to show alert
                $('html, body').animate({
                    scrollTop: 0
                }, 300);
            }
        });
    </script>

</body>
</html>