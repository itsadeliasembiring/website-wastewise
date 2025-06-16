<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Setor Sampah</title>
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

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>

    <!-- Main Content -->
    <main class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-teal-700">Setor Langsung</h2>
                <div class="flex space-x-2">
                    <button 
                        class="px-4 py-2 rounded-lg font-medium transition duration-200 text-white" 
                        style="background-color: #3D8D7A;"
                        onclick="window.location.href='{{ route('setor-langsung') }}'">
                        Setor Langsung
                    </button>

                    <button 
                        class="px-4 py-2 rounded-lg font-medium transition duration-200 text-gray-700 border border-gray-400"
                        onclick="window.location.href='{{ route('jemput-sampah') }}'">
                        Jemput Sampah
                    </button>
                </div>
            </div>

            <!-- Form Setor Sampah -->
            <form id="setorSampahForm">
                @csrf
                <div class="flex flex-col gap-6 items-stretch">
                    <!-- Input Sampah -->
                    <div class="bg-white w-full p-6 rounded-xl shadow min-h-[600px] flex flex-col justify-between">
                        <h3 class="text-xl font-semibold mb-4 text-center">Input Sampah</h3>
                        <div class="flex-1">
                            <div class="space-y-4">
                                @forelse($jenisSampah as $index => $sampah)
                                <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ asset('storage/sampah/'.$sampah->foto) }}"
                                             alt="{{ $sampah->nama_sampah }}" 
                                             class="w-10 h-10">
                                        <div>
                                            <h4 class="font-semibold text-base">{{ $sampah->nama_sampah }}</h4>
                                            <p class="text-sm text-gray-500">{{ $sampah->bobot_poin }} Poin/Kg</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <input type="number" 
                                               name="sampah[{{ $index }}][berat_kg]" 
                                               data-id-sampah="{{ $sampah->id_sampah }}"
                                               data-bobot-poin="{{ $sampah->bobot_poin }}"
                                               value="0" 
                                               min="0" 
                                               step="0.1" 
                                               class="w-20 border rounded px-2 py-1 text-right sampah-input">
                                        <span class="text-sm text-gray-500">Kg</span>
                                    </div>
                                    <input type="hidden" name="sampah[{{ $index }}][id_sampah]" value="{{ $sampah->id_sampah }}">
                                </div>
                                @empty
                                <div class="text-center py-8">
                                    <p class="text-gray-500">Tidak ada data jenis sampah tersedia</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan dan Catatan -->
                    <div class="bg-white w-full p-6 rounded-xl shadow">
                        <h3 class="text-xl font-semibold mb-4">Ringkasan</h3>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="bg-teal-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Total Berat</p>
                                <p class="text-2xl font-bold text-teal-700"><span id="totalBerat">0</span> Kg</p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Estimasi Poin</p>
                                <p class="text-2xl font-bold text-green-700"><span id="totalPoin">0</span> Poin</p>
                            </div>
                        </div>
                        
                        <!-- Catatan -->
                        <div class="mb-4">
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                            <textarea name="catatan" id="catatan" rows="3" 
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500" 
                                      placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" id="submitBtn" 
                            class="text-white px-6 py-2 rounded-lg hover:bg-green-800 active:bg-green-900 transition duration-150 ease-in-out disabled:bg-gray-400" 
                            style="background-color: #3D8D7A;" 
                            disabled>
                        <span id="submitText">Submit</span>
                        <span id="loadingText" class="hidden">Memproses...</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
    <!-- Kontak -->
    <x-footer.pengguna id="kontak"/>


    <!-- Modal Sukses -->
    <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-2">Berhasil!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500" id="successMessage">Sampah berhasil disetor!</p>
                    <div class="mt-4 space-y-2 text-sm">
                        <p><strong>ID Setor:</strong> <span id="idSetor"></span></p>
                        <p><strong>Kode Verifikasi:</strong> <span id="kodeVerifikasi" class="font-mono bg-gray-100 px-2 py-1 rounded"></span></p>
                        <p><strong>Total Berat:</strong> <span id="totalBeratResult"></span> Kg</p>
                        <p><strong>Total Poin:</strong> <span id="totalPoinResult"></span> Poin</p>
                    </div>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeModal" class="px-4 py-2 bg-teal-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-300">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Setup CSRF token untuk AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Perhitungan total berat dan poin
        function updateTotals() {
            const inputs = document.querySelectorAll('.sampah-input');
            let totalBerat = 0;
            let totalPoin = 0;
            let hasInput = false;

            inputs.forEach(input => {
                const berat = parseFloat(input.value) || 0;
                const bobotPoin = parseFloat(input.dataset.bobotPoin) || 0;
                
                if (berat > 0) {
                    hasInput = true;
                    totalBerat += berat;
                    totalPoin += berat * bobotPoin;
                }
            });

            document.getElementById('totalBerat').textContent = totalBerat.toFixed(1);
            document.getElementById('totalPoin').textContent = Math.round(totalPoin);
            
            // Enable/disable submit button
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = !hasInput;
        }

        // Event listener untuk input sampah
        document.querySelectorAll('.sampah-input').forEach(input => {
            input.addEventListener('input', updateTotals);
        });

        // Form submission
        document.getElementById('setorSampahForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingText = document.getElementById('loadingText');
            
            // Disable button dan show loading
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');

            try {
                const formData = new FormData(this);
                
                // Convert FormData ke format yang diharapkan controller
                const sampahData = [];
                const inputs = document.querySelectorAll('.sampah-input');
                
                inputs.forEach(input => {
                    const berat = parseFloat(input.value) || 0;
                    if (berat > 0) {
                        sampahData.push({
                            id_sampah: input.dataset.idSampah,
                            berat_kg: berat
                        });
                    }
                });

                // Validasi jika tidak ada sampah yang diinput
                if (sampahData.length === 0) {
                    alert('Silakan masukkan minimal satu jenis sampah dengan berat > 0');
                    return;
                }

                const requestData = {
                    sampah: sampahData,
                    catatan: document.getElementById('catatan').value
                };

                const response = await fetch('{{ route("proses-setor-langsung") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                });

                const result = await response.json();

                if (result.success) {
                    // Tampilkan modal sukses
                    document.getElementById('idSetor').textContent = result.data.id_setor;
                    document.getElementById('kodeVerifikasi').textContent = result.data.kode_verifikasi;
                    document.getElementById('totalBeratResult').textContent = result.data.total_berat;
                    document.getElementById('totalPoinResult').textContent = result.data.total_poin;
                    
                    document.getElementById('successModal').classList.remove('hidden');
                } else {
                    alert('Error: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim data. Silakan coba lagi.');
            } finally {
                // Reset button
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
            }
        });

        // Modal handler
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('successModal').classList.add('hidden');
            // Reset form
            document.getElementById('setorSampahForm').reset();
            updateTotals();
        });

        // Initial calculation
        updateTotals();
    </script>
</body>
</html>