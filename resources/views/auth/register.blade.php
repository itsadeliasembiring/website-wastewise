<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Registrasi</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Tambahan style untuk preview gambar jika diinginkan */
        .image-preview-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 0.5rem;
        }
        .image-preview {
            width: 80px;
            height: 80px;
            border: 1px solid #ddd;
            border-radius: 0.375rem; /* rounded-md */
            object-fit: cover;
        }
        .remove-image-btn {
            background-color: #ef4444; /* bg-red-500 */
            color: white;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem; /* text-xs */
            border-radius: 0.25rem; /* rounded */
            cursor: pointer;
        }
        .remove-image-btn:hover {
            background-color: #dc2626; /* bg-red-600 */
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-8 lg:py-12 px-4">
        <div class="grid lg:grid-cols-2 gap-8 w-full max-w-6xl">
            <div class="flex flex-col justify-center items-center bg-[#A3D1C6] bg-opacity-50 rounded-3xl p-8 order-2 lg:order-1">
                <div class="text-center mb-6">
                    <h1 class="text-[#3D8D7A] text-4xl font-bold mb-1">WasteWise</h1>
                    <p class="text-emerald-700 italic">"Ubah Sampah Jadi Berkah"</p>
                </div>
                <div class="w-full max-w-sm">
                    <img src="{{ asset('Assets/maskot.png') }}" alt="WasteWise Mascot" class="w-full h-auto">
                </div>
            </div>
            
            <div class="flex flex-col justify-center bg-white p-8 shadow-lg rounded-3xl order-1 lg:order-2">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Halo, WasteWarriors!</h2>
                    <p class="text-gray-600 mt-2">Bergabunglah bersama kami! Selamatkan lingkungan dengan ubah sampah jadi berkah!</p>
                </div>

                @if(session('success'))
                    {{-- SweetAlert akan menangani ini, jadi div ini bisa dihapus atau dibiarkan sebagai fallback --}}
                    {{-- <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div> --}}
                @endif

                @if(session('error'))
                     {{-- SweetAlert akan menangani ini, jadi div ini bisa dihapus atau dibiarkan sebagai fallback --}}
                    {{-- <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div> --}}
                @endif
                
                @if ($errors->any())
                    {{-- <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <strong class="font-bold">Oops! Ada beberapa kesalahan:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div> --}}
                @endif
                
                {{-- Tambahkan enctype untuk upload file --}}
                <form method="POST" action="{{ route('register-form') }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input id="nama" type="text" name="nama" value="{{ old('nama') }}" required autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('nama') border-red-500 @enderror"
                            placeholder="Nama Lengkap">
                        @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jenis-kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select id="jenis-kelamin" name="jenis-kelamin" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('jenis-kelamin') border-red-500 @enderror">
                            <option value="" disabled {{ old('jenis-kelamin') ? '' : 'selected' }} class="text-gray-500">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis-kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis-kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis-kelamin')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal-lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input id="tanggal-lahir" type="date" name="tanggal-lahir" value="{{ old('tanggal-lahir') }}" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('tanggal-lahir') border-red-500 @enderror">
                        @error('tanggal-lahir')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="alamat-lengkap" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea id="alamat-lengkap" name="alamat-lengkap" required rows="3"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('alamat-lengkap') border-red-500 @enderror"
                            placeholder="Masukkan alamat lengkap Anda">{{ old('alamat-lengkap') }}</textarea>
                        @error('alamat-lengkap')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('kecamatan') border-red-500 @enderror">
                            <option value="" disabled {{ old('kecamatan') ? '' : 'selected' }} class="text-gray-500">Pilih Kecamatan</option>
                            @if(isset($kecamatans) && $kecamatans->count() > 0)
                                @foreach($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id_kecamatan }}" {{ old('kecamatan') == $kecamatan->id_kecamatan ? 'selected' : '' }}>
                                        {{ $kecamatan->nama_kecamatan }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('kecamatan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kelurahan" class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                        <select id="kelurahan" name="kelurahan" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('kelurahan') border-red-500 @enderror"
                            {{ old('kecamatan') ? '' : 'disabled' }}>
                            <option value="" disabled {{ old('kelurahan') ? '' : 'selected' }} class="text-gray-500">Pilih Kelurahan</option>
                            {{-- Opsi kelurahan akan diisi oleh AJAX, atau dari $kelurahans jika ada old input --}}
                            @if(isset($kelurahans) && $kelurahans->count() > 0 && old('kecamatan'))
                                @foreach($kelurahans as $k)
                                    <option value="{{ $k->id_kelurahan }}" {{ old('kelurahan') == $k->id_kelurahan ? 'selected' : '' }}>
                                        {{ $k->nama_kelurahan }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('kelurahan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nomor-telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input id="nomor-telepon" type="text" name="nomor-telepon" value="{{ old('nomor-telepon') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('nomor-telepon') border-red-500 @enderror"
                            placeholder="08xxxxxxxxxx">
                        @error('nomor-telepon')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input untuk Foto --}}
                    <div>
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Profil (Opsional)</label>
                        <input id="foto" type="file" name="foto" accept="image/*"
                            class="w-full px-3 py-2 rounded-lg border border-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#A3D1C6] file:text-[#3D8D7A] hover:file:bg-emerald-100 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('foto') border-red-500 @enderror">
                        <div id="image-preview-container" class="image-preview-container" style="display: none;">
                             <img id="image-preview" src="#" alt="Preview Foto" class="image-preview"/>
                             <button type="button" id="remove-image-btn" class="remove-image-btn">Hapus Gambar</button>
                        </div>
                        @error('foto')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('email') border-red-500 @enderror"
                            placeholder="contoh@email.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('password') border-red-500 @enderror"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="konfirmasi-password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input id="konfirmasi-password" type="password" name="konfirmasi-password" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition text-gray-900 @error('konfirmasi-password') border-red-500 @enderror"
                            placeholder="Ulangi password">
                        @error('konfirmasi-password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="privacy_policy" type="checkbox" name="privacy_policy" value="1" {{ old('privacy_policy') ? 'checked' : '' }} required
                                class="h-4 w-4 rounded border-gray-300 text-[#3D8D7A] focus:ring-[#3D8D7A]">
                            <label for="privacy_policy" class="ml-2 block text-sm text-gray-700">
                                Saya telah membaca dan menyetujui 
                                <a href="#" class="text-[#3D8D7A] hover:underline">Kebijakan Privasi</a>
                            </label>
                        </div>
                    </div>
                     @error('privacy_policy') {{-- Dipindahkan agar tidak merusak flex layout --}}
                        <p class="text-red-500 text-sm -mt-4">{{ $message }}</p>
                     @enderror
                    
                    <div>
                        <button type="submit" 
                            class="w-full bg-[#3D8D7A] hover:bg-emerald-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Sudah memiliki akun? 
                        <a href="{{ route('login') }}" class="text-[#3D8D7A] hover:text-emerald-600 font-medium">
                            Login sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loadKelurahan(kecamatanId, selectedKelurahanId = null) {
                var kelurahanSelect = $('#kelurahan');
                kelurahanSelect.html('<option value="" disabled selected class="text-gray-500">Loading...</option>');
                kelurahanSelect.prop('disabled', true);

                if (kecamatanId) {
                    $.ajax({
                        url: '/get-kelurahan/' + kecamatanId, // Pastikan route ini benar
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            kelurahanSelect.html('<option value="" disabled selected class="text-gray-500">Pilih Kelurahan</option>');
                            if (data.length > 0) {
                                $.each(data, function(index, kelurahan) {
                                    var option = $('<option></option>')
                                        .val(kelurahan.id_kelurahan)
                                        .text(kelurahan.nama_kelurahan);
                                    if (selectedKelurahanId && kelurahan.id_kelurahan == selectedKelurahanId) {
                                        option.prop('selected', true);
                                    }
                                    kelurahanSelect.append(option);
                                });
                            } else {
                                kelurahanSelect.append('<option value="" disabled>Tidak ada kelurahan tersedia</option>');
                            }
                            kelurahanSelect.prop('disabled', false);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading kelurahan:', error);
                            kelurahanSelect.html('<option value="" disabled selected class="text-gray-500">Error loading data</option>');
                            kelurahanSelect.prop('disabled', false);
                        }
                    });
                } else {
                    kelurahanSelect.html('<option value="" disabled selected class="text-gray-500">Pilih Kelurahan</option>');
                    kelurahanSelect.prop('disabled', true); // Biarkan disable jika tidak ada kecamatan terpilih
                }
            }

            // Handle kecamatan change
            $('#kecamatan').change(function() {
                var selectedKecamatan = $(this).val();
                loadKelurahan(selectedKecamatan);
            });

            // On page load, if there's an old kecamatan value, load its kelurahan and select old kelurahan if any
            var oldKecamatan = "{{ old('kecamatan') }}";
            var oldKelurahan = "{{ old('kelurahan') }}";
            if (oldKecamatan) {
                $('#kecamatan').val(oldKecamatan); // Ensure kecamatan dropdown shows the old value
                loadKelurahan(oldKecamatan, oldKelurahan);
            } else {
                 $('#kelurahan').prop('disabled', true); // Disable kelurahan if no kecamatan is selected initially
            }


            // Handle form submission client-side validation for privacy policy (SweetAlert will show server errors)
            $('form').on('submit', function(e) {
                // Validasi client-side untuk privacy policy sudah ditangani oleh atribut 'required' pada checkbox
                // Namun, jika ingin pesan custom dengan alert, bisa ditambahkan di sini
                // if (!$('#privacy_policy').is(':checked')) {
                //     e.preventDefault();
                //     Swal.fire({
                //        title: 'Perhatian!',
                //        text: 'Anda harus menyetujui Kebijakan Privasi untuk melanjutkan registrasi.',
                //        icon: 'warning',
                //        confirmButtonText: 'OK',
                //        confirmButtonColor: '#3D8D7A'
                //     });
                //     return false;
                // }
            });

            $('#nomor-telepon').on('input', function() {
                var phoneNumber = $(this).val();
                phoneNumber = phoneNumber.replace(/[^0-9\s\-\+\(\)]/g, '');
                $(this).val(phoneNumber);
            });

            // Image preview for foto
            $('#foto').change(function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    $('#image-preview').attr('src', reader.result).show();
                    $('#image-preview-container').show();
                }
                if (event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                } else {
                     $('#image-preview').attr('src', '#').hide();
                     $('#image-preview-container').hide();
                }
            });

            $('#remove-image-btn').click(function() {
                $('#foto').val(''); // Clear the file input
                $('#image-preview').attr('src', '#').hide();
                $('#image-preview-container').hide();
            });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success') && session('show_popup'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3D8D7A' // Warna hijau yang konsisten
            }).then((result) => {
                if (result.isConfirmed) {
                    // Ganti 'register' dengan nama route yang benar jika berbeda
                    // window.location.href = "{{ route('register') }}"; 
                    // Atau reset form jika masih di halaman yang sama
                    if (typeof document.querySelector('form').reset === 'function') {
                        document.querySelector('form').reset();
                    }
                     $('#image-preview').attr('src', '#').hide(); // Sembunyikan preview
                     $('#image-preview-container').hide();
                     $('#kelurahan').html('<option value="" disabled selected class="text-gray-500">Pilih Kelurahan</option>').prop('disabled', true);

                }
            });
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Gagal!',
                html: `{!! session('error') !!}`, // Gunakan html untuk memproses <br> jika ada
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545' // Warna merah
            });
        });
    </script>
    @endif

    {{-- SweetAlert untuk menampilkan semua error validasi dari server --}}
    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += `{{ $error }}<br>`;
            @endforeach
            Swal.fire({
                title: 'Oops! Ada Kesalahan',
                html: errorMessages,
                icon: 'error',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#3D8D7A'
            });
        });
    </script>
    @endif
</body>
</html>