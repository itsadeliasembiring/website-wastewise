<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Jemput Sampah</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>

    <main class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-teal-700">Jemput Sampah</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('setor-langsung') }}" class="px-4 py-2 rounded-lg font-medium transition duration-200 text-gray-700 border border-gray-400 hover:bg-gray-100">
                        Setor Langsung
                    </a>
                    <a href="{{ route('jemput-sampah') }}" class="px-4 py-2 rounded-lg font-medium transition duration-200 text-white" style="background-color: #3D8D7A;">
                        Jemput Sampah
                    </a>
                </div>
            </div>

            <div id="alertMessage" class="hidden border-l-4 p-4 mb-6 rounded">
                <p id="alertText"></p>
            </div>

            <form id="jemputSampahForm">
                @csrf
                
                <div class="flex flex-col lg:flex-row gap-8 items-start">
                    <div class="bg-white w-full lg:w-1/3 p-6 rounded-xl shadow">
                        <h3 class="text-xl font-semibold mb-4">Input Sampah</h3>
                        <div class="space-y-4">
                            @forelse($jenisSampah as $index => $sampah)
                            <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ asset('assets/icon-sampah/' . strtolower(str_replace(' ', '-', $sampah->nama_sampah)) . '.png') }}" 
                                         alt="{{ $sampah->nama_sampah }}" 
                                         class="w-10 h-10">
                                    <div>
                                        <h4 class="font-semibold text-base">{{ $sampah->nama_sampah }}</h4>
                                        <p class="text-sm text-gray-500">{{ $sampah->bobot_poin }} Poin/Kg</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input 
                                        type="number" 
                                        name="sampah[{{ $index }}][berat_kg]"
                                        data-id-sampah="{{ $sampah->id_sampah }}"
                                        data-bobot-poin="{{ $sampah->bobot_poin }}"
                                        value="0"
                                        min="0" 
                                        step="0.1"
                                        class="w-20 border rounded px-2 py-1 text-right sampah-input focus:outline-none focus:ring-2 focus:ring-green-500"
                                        placeholder="0.0">
                                    <span class="text-sm text-gray-500">kg</span>
                                    <input type="hidden" name="sampah[{{ $index }}][id_sampah]" value="{{ $sampah->id_sampah }}">
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500">Tidak ada data jenis sampah tersedia</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="mt-6 pt-4 border-t">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold">Total Berat:</span>
                                <span class="font-bold text-green-600"><span id="totalBerat">0.0</span> kg</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-semibold">Estimasi Poin:</span>
                                <span class="font-bold text-green-600"><span id="totalPoin">0</span> poin</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white w-full lg:w-1/3 p-6 rounded-xl shadow">
                        <h3 class="text-xl font-semibold mb-4">Pilih Alamat Penjemputan</h3>
                        <div class="mb-4">
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer transition-all hover:bg-gray-50 bg-green-50 border-green-500" id="mainAddressLabel">
                                <input type="radio" name="alamat_type" value="main" class="form-radio w-5 h-5 text-green-600" id="useMainAddress" checked>
                                <div class="ml-3">
                                    <h4 class="font-semibold text-gray-800">Alamat Utama</h4>
                                    <p class="text-sm text-gray-600 mt-1" id="userMainAddress">
                                        @if($penggunaData && $penggunaData->detail_alamat)
                                            {{ $penggunaData->detail_alamat }}, Kel. {{ $penggunaData->nama_kelurahan }}, Kec. {{ $penggunaData->nama_kecamatan }}
                                        @else
                                            <span class="text-red-500">Alamat utama belum diatur. Silakan gunakan alamat lain atau lengkapi profil Anda.</span>
                                        @endif
                                    </p>
                                </div>
                            </label>
                        </div>
                        <div class="mb-4">
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer transition-all hover:bg-gray-50" id="customAddressLabel">
                                <input type="radio" name="alamat_type" value="custom" class="form-radio w-5 h-5 text-green-600" id="useCustomAddress"
                                @if(!$penggunaData || !$penggunaData->detail_alamat) checked @endif>
                                <span class="ml-3 font-semibold text-gray-800">Gunakan Alamat Lain</span>
                            </label>
                        </div>
                        <div id="customAddressForm" class="@if(!$penggunaData || !$penggunaData->detail_alamat) block @else hidden @endif space-y-4 border-t pt-4 mt-4">
                            <div>
                                <label for="alamatCustom" class="block text-sm font-medium text-gray-700 mb-1">Detail Alamat Lengkap</label>
                                <textarea name="alamat_custom" id="alamatCustom" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" rows="3" placeholder="Masukkan jalan, no. rumah, RT/RW"></textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="kecamatanCustom" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                    <select name="kecamatan_custom" id="kecamatanCustom" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach($kecamatanData as $kecamatan)
                                            <option value="{{ $kecamatan->id_kecamatan }}">{{ $kecamatan->nama_kecamatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="kelurahanCustom" class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                                    <select name="kelurahan_custom" id="kelurahanCustom" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" disabled>
                                        <option value="">Pilih Kecamatan Dulu</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="catatanAlamat" class="block text-sm font-medium text-gray-700 mb-1">Catatan Alamat (Opsional)</label>
                                <textarea name="catatan_alamat" id="catatanAlamat" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" rows="2" placeholder="Contoh: Rumah cat hijau, dekat masjid"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white w-full lg:w-1/3 p-6 rounded-xl shadow">
                        <h3 class="text-xl font-semibold mb-4 text-gray-800">Waktu Penjemputan</h3>
                        <div class="mb-4">
                            <label for="tanggalPenjemputan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                            <input type="date" name="tanggal_penjemputan" id="tanggalPenjemputan" class="block w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jam</label>
                            <div class="grid grid-cols-2 gap-4">
                                <select id="selectedHour" name="jam_penjemputan" class="w-full px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                                    <option value="">Pilih Jam</option>
                                    @for($hour = 8; $hour <= 16; $hour++)
                                        <option value="{{ sprintf('%02d', $hour) }}">{{ sprintf('%02d', $hour) }}</option>
                                    @endfor
                                </select>
                                <select id="selectedMinute" name="menit_penjemputan" class="w-full px-3 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                                    <option value="">Pilih Menit</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">* Penjemputan tersedia pukul 08.00 - 16.00 WIB</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg mb-4">
                            <p class="text-sm text-gray-700 mb-1">Waktu yang dipilih:</p>
                            <p class="font-semibold text-green-700" id="selectedDateTime">Belum dipilih</p>
                        </div>
                        <div>
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan (Opsional)</label>
                            <textarea name="catatan" id="catatan" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" rows="2" placeholder="Catatan untuk petugas..."></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end">
                    <div class="flex space-x-4">
                        <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors" onclick="history.back()">
                            Batal
                        </button>
                        <button type="submit" id="submitBtn" class="px-8 py-3 text-white font-medium rounded-lg transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed" style="background-color: #3D8D7A;" disabled>
                            <span id="submitText">Ajukan Penjemputan</span>
                            <span id="loadingText" class="hidden">Memproses...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    
    <!-- Kontak -->
    <x-footer.pengguna id="kontak"/>

    <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2">Berhasil!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="successMessage">Permintaan jemput sampah berhasil diajukan!</p>
                    <div class="mt-4 space-y-2 text-sm text-left bg-gray-50 p-4 rounded-lg">
                        <p><strong>ID Penjemputan:</strong> <span id="idPenjemputan" class="font-semibold"></span></p>
                        <p><strong>Kode Verifikasi:</strong> <span id="kodeVerifikasi" class="font-mono bg-gray-200 px-2 py-1 rounded font-bold text-lg"></span></p>
                        <p><strong>Total Berat:</strong> <span id="totalBeratResult" class="font-semibold"></span> Kg</p>
                        <p><strong>Estimasi Poin:</strong> <span id="totalPoinResult" class="font-semibold"></span> Poin</p>
                        <p><strong>Waktu Penjemputan:</strong> <span id="waktuPenjemputanResult" class="font-semibold"></span></p>
                    </div>
                </div>
                <div class="items-center px-4 py-3">
                    <div class="flex flex-col sm:flex-row-reverse gap-3">
                        <button id="closeModal" class="w-full px-4 py-2 bg-teal-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300">
                            Lihat Riwayat
                        </button>
                        <a id="whatsappLink" href="#" target="_blank" class="w-full px-4 py-2 bg-green-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-300 text-center inline-block">
                            Chat Petugas (WhatsApp)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === DEKLARASI ELEMEN ===
            const form = document.getElementById('jemputSampahForm');
            const submitBtn = document.getElementById('submitBtn');
            const totalBeratEl = document.getElementById('totalBerat');
            const totalPoinEl = document.getElementById('totalPoin');
            const selectedDateTimeEl = document.getElementById('selectedDateTime');
    
            // Elemen Alamat
            const useMainAddressRadio = document.getElementById('useMainAddress');
            const useCustomAddressRadio = document.getElementById('useCustomAddress');
            const customAddressForm = document.getElementById('customAddressForm');
            const mainAddressLabel = document.getElementById('mainAddressLabel');
            const customAddressLabel = document.getElementById('customAddressLabel');
            const kecamatanCustomSelect = document.getElementById('kecamatanCustom');
            const kelurahanCustomSelect = document.getElementById('kelurahanCustom');
            
            // Elemen Waktu
            const tanggalInput = document.getElementById('tanggalPenjemputan');
            const jamInput = document.getElementById('selectedHour');
            const menitInput = document.getElementById('selectedMinute');

            // Check if main address is available
            const hasMainAddress = {{ $penggunaData && $penggunaData->detail_alamat ? 'true' : 'false' }};
    
            // Set tanggal minimal penjemputan (besok)
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            tanggalInput.setAttribute('min', tomorrow.toISOString().split('T')[0]);
    
            // === FUNGSI-FUNGSI PEMBANTU ===
    
            // Fungsi untuk menghitung total berat & poin
            const updateTotals = () => {
                let totalBerat = 0;
                let totalPoin = 0;
                document.querySelectorAll('.sampah-input').forEach(input => {
                    const berat = parseFloat(input.value) || 0;
                    if (berat > 0) {
                        const bobotPoin = parseFloat(input.dataset.bobotPoin) || 0;
                        totalBerat += berat;
                        totalPoin += berat * bobotPoin;
                    }
                });
                totalBeratEl.textContent = totalBerat.toFixed(1);
                totalPoinEl.textContent = Math.round(totalPoin);
                validateForm();
            };
            
            // Fungsi untuk menampilkan tanggal & waktu yang dipilih
            const updateSelectedDateTime = () => {
                const tanggal = tanggalInput.value;
                const jam = jamInput.value;
                const menit = menitInput.value;
    
                if (tanggal && jam && menit) {
                    const date = new Date(tanggal);
                    date.setMinutes(date.getMinutes() + date.getTimezoneOffset());
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    const formattedDate = date.toLocaleDateString('id-ID', options);
                    selectedDateTimeEl.textContent = `${formattedDate}, pukul ${jam}:${menit} WIB`;
                } else {
                    selectedDateTimeEl.textContent = 'Belum dipilih';
                }
                validateForm();
            };
    
            // Fungsi untuk validasi keseluruhan form
            const validateForm = () => {
                const totalBerat = parseFloat(totalBeratEl.textContent) || 0;
                const isSampahValid = totalBerat > 0;
                
                let isAddressValid = false;

                if (useMainAddressRadio.checked) {
                    // Validasi alamat utama - harus ada data
                    isAddressValid = hasMainAddress;
                } else if (useCustomAddressRadio.checked) {
                    // Validasi alamat custom
                    const alamatCustom = document.getElementById('alamatCustom').value.trim();
                    const kecamatan = kecamatanCustomSelect.value;
                    const kelurahan = kelurahanCustomSelect.value;
                    isAddressValid = alamatCustom && kecamatan && kelurahan;
                }
    
                const isDateTimeValid = tanggalInput.value && jamInput.value && menitInput.value;
    
                submitBtn.disabled = !(isSampahValid && isAddressValid && isDateTimeValid);
            };
            
            // Fungsi untuk menampilkan pesan alert
            const showAlert = (type, message) => {
                const alertDiv = document.getElementById('alertMessage');
                const alertText = document.getElementById('alertText');
                alertDiv.className = `border-l-4 p-4 mb-6 rounded ${type === 'success' ? 'bg-green-100 border-green-500 text-green-700' : 'bg-red-100 border-red-500 text-red-700'}`;
                alertText.textContent = message;
                alertDiv.classList.remove('hidden');
                window.scrollTo(0, 0);
                setTimeout(() => alertDiv.classList.add('hidden'), 5000);
            };
    
            // === EVENT LISTENERS ===
    
            // Listener untuk input sampah, waktu, dan pilihan alamat
            document.querySelectorAll('.sampah-input').forEach(input => input.addEventListener('input', updateTotals));
            [tanggalInput, jamInput, menitInput].forEach(el => el.addEventListener('change', updateSelectedDateTime));
    
            useMainAddressRadio.addEventListener('change', () => {
                if (hasMainAddress) {
                    customAddressForm.classList.add('hidden');
                    mainAddressLabel.classList.add('bg-green-50', 'border-green-500');
                    customAddressLabel.classList.remove('bg-green-50', 'border-green-500');
                } else {
                    // Force to custom address if no main address
                    useCustomAddressRadio.checked = true;
                    showAlert('error', 'Alamat utama belum diatur. Silakan gunakan alamat lain.');
                }
                validateForm();
            });
    
            useCustomAddressRadio.addEventListener('change', () => {
                customAddressForm.classList.remove('hidden');
                customAddressLabel.classList.add('bg-green-50', 'border-green-500');
                mainAddressLabel.classList.remove('bg-green-50', 'border-green-500');
                validateForm();
            });
            
            // Listener untuk AJAX saat memilih Kecamatan
            kecamatanCustomSelect.addEventListener('change', async function() {
                const kecamatanId = this.value;
                kelurahanCustomSelect.innerHTML = '<option value="">Memuat...</option>';
                kelurahanCustomSelect.disabled = true;
    
                if (!kecamatanId) {
                    kelurahanCustomSelect.innerHTML = '<option value="">Pilih Kecamatan Dulu</option>';
                    validateForm();
                    return;
                }
    
                try {
                    const response = await fetch(`{{ url('/kelurahan') }}/${kecamatanId}`, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    });
                    
                    const result = await response.json();
                    
                    if (result.success && result.data) {
                        kelurahanCustomSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                        if (result.data.length > 0) {
                            result.data.forEach(kelurahan => {
                                const option = new Option(kelurahan.nama_kelurahan, kelurahan.id_kelurahan);
                                kelurahanCustomSelect.add(option);
                            });
                            kelurahanCustomSelect.disabled = false;
                        } else {
                            kelurahanCustomSelect.innerHTML = '<option value="">Data tidak ditemukan</option>';
                        }
                    } else {
                        kelurahanCustomSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                        console.error('API Error:', result);
                    }
                } catch (error) {
                    kelurahanCustomSelect.innerHTML = '<option value="">Terjadi kesalahan</option>';
                    console.error('Fetch Error:', error);
                }
                validateForm();
            });
    
            // Listener untuk validasi pada input lain
            document.getElementById('alamatCustom').addEventListener('input', validateForm);
            kelurahanCustomSelect.addEventListener('change', validateForm);
    
            // Listener untuk submit form
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const submitText = document.getElementById('submitText');
                const loadingText = document.getElementById('loadingText');
                
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');
    
                try {
                    // Prepare sampah data according to controller expectations
                    const sampahData = [];
                    document.querySelectorAll('.sampah-input').forEach(input => {
                        const berat = parseFloat(input.value) || 0;
                        if (berat > 0) {
                            sampahData.push({
                                id_sampah: input.dataset.idSampah,
                                berat_kg: berat
                            });
                        }
                    });

                    // Prepare form data according to controller validation
                    const requestData = {
                        sampah: sampahData,
                        alamat_type: document.querySelector('input[name="alamat_type"]:checked').value,
                        waktu_penjemputan: `${tanggalInput.value} ${jamInput.value}:${menitInput.value}:00`,
                        catatan: document.getElementById('catatan').value || null
                    };

                    // Add custom address fields if needed
                    if (useCustomAddressRadio.checked) {
                        requestData.alamat_custom = document.getElementById('alamatCustom').value;
                        requestData.kecamatan_custom = kecamatanCustomSelect.value;
                        requestData.kelurahan_custom = kelurahanCustomSelect.value;
                        requestData.catatan_alamat = document.getElementById('catatanAlamat').value || null;
                    }
                    
                    const response = await fetch('{{ route("proses-jemput-sampah") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(requestData)
                    });
    
                    const result = await response.json();
    
                    if (result.success && result.data) {
                        // Update modal with response data
                        document.getElementById('idPenjemputan').textContent = result.data.id_penjemputan;
                        document.getElementById('kodeVerifikasi').textContent = result.data.kode_verifikasi;
                        document.getElementById('totalBeratResult').textContent = result.data.total_berat;
                        document.getElementById('totalPoinResult').textContent = result.data.total_poin;
                        document.getElementById('waktuPenjemputanResult').textContent = result.data.waktu_penjemputan_formatted;
                        
                        // === BARIS BARU: Generate WhatsApp Link ===
                        const whatsappLink = document.getElementById('whatsappLink');
                        const nomorWhatsapp = '6281999743472'; // Ganti dengan nomor WA bank sampah
                        let pesanWhatsapp = `
                                Halo, Saya baru saja mengajukan permintaan jemput sampah dengan detail:
                                \n*- ID Penjemputan:* ${result.data.id_penjemputan}
                                \n*- Kode Verifikasi:* ${result.data.kode_verifikasi}
                                \n*- Total Berat:* ${result.data.total_berat} Kg
                                \n*- Estimasi Poin:* ${result.data.total_poin} Poin
                                \n*- Waktu Penjemputan:* ${result.data.waktu_penjemputan_formatted}
                                \nMohon konfirmasi untuk penjemputan sampah saya. Terima kasih!
                        `;
                        whatsappLink.href = `https://wa.me/${nomorWhatsapp}?text=${encodeURIComponent(pesanWhatsapp)}`;
                        // === AKHIR BARIS BARU ===

                        document.getElementById('successModal').classList.remove('hidden');
                    } else {
                        showAlert('error', result.message || 'Terjadi kesalahan saat memproses data.');
                    }
                } catch (error) {
                    console.error('Submission Error:', error);
                    showAlert('error', 'Terjadi kesalahan koneksi. Silakan coba lagi.');
                } finally {
                    submitBtn.disabled = false;
                    submitText.classList.remove('hidden');
                    loadingText.classList.add('hidden');
                }
            });
    
            // Listener untuk tombol tutup modal
            document.getElementById('closeModal').addEventListener('click', function() {
                document.getElementById('successModal').classList.add('hidden');
                window.location.href = '{{ route("pengguna-riwayat-setor-sampah") }}';
            });
    
            // Initialize form state
            if (!hasMainAddress) {
                useCustomAddressRadio.checked = true;
                useMainAddressRadio.disabled = true;
                customAddressForm.classList.remove('hidden');
                customAddressLabel.classList.add('bg-green-50', 'border-green-500');
                mainAddressLabel.classList.remove('bg-green-50', 'border-green-500');
                mainAddressLabel.classList.add('opacity-50', 'cursor-not-allowed');
            }
    
            // Panggil validasi pertama kali saat halaman dimuat
            updateTotals();
        });
    </script>

</body>
</html>