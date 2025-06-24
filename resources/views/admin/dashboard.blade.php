<!DOCTYPE html>
<html lang="en" class="h-full bg-[#E6E6E6] dark:bg-[#E6E6E6]">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Dashboard Admin - WasteWise</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full w-full">
    <header class="fixed top-0 left-0 right-0 z-50 h-16 bg-white shadow-sm w-full">
        <x-header.admin/>
    </header>

    <aside class="fixed left-0 top-20 bottom-0 transition-all duration-300 bg-white">
        <x-sidebar.admin />
    </aside>

    <main class="min-h-screen pt-16 overflow-y-auto sm:pl-[70px] xl:pl-15">
        <div class="p-8">
            <div class="text-center mb-8">
                <h1 class="text-[#3D8D7A] font-semibold text-xl sm:text-2xl">
                    Halo, Selamat Datang di WasteWise sebagai Admin
                </h1>
                <p class="text-gray-600 mt-2 hidden sm:block">
                    Disini anda dapat mengelola operasional dan data Bank Sampah WasteWise Surabaya
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <a href="{{ route('riwayat-setor-sampah') }}" class="flex items-center justify-between">
                        <x-fas-home class="w-16 h-16 text-[#3D8D7A]" />
                        <div class="text-center">
                            <p class="text-[#3D8D7A] text-4xl font-bold" id="total-transaksi">{{ $totalTransaksi ?? 0 }}</p>
                            <p class="text-gray-700 text-lg">Transaksi</p>
                        </div>
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <a href="{{ route('riwayat-setor-sampah') }}" class="flex items-center justify-between">
                        <x-fas-recycle class="w-16 h-16 text-[#3D8D7A]" />
                        <div class="text-center">
                            <p class="text-[#3D8D7A] text-4xl font-bold" id="total-sampah">{{ $totalSampah ?? 0 }}</p>
                            <p class="text-gray-700 text-lg">Kg Sampah</p> </div>
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <a href="{{ route('kelola-pengguna') }}" class="flex items-center justify-between">
                        <x-fas-user-alt class="w-16 h-16 text-[#3D8D7A]" />
                        <div class="text-center">
                            <p class="text-[#3D8D7A] text-4xl font-bold" id="total-pengguna">{{ $totalPengguna ?? 0 }}</p>
                            <p class="text-gray-700 text-lg">Pengguna</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- <div class="flex justify-end mb-4">
                <button onclick="refreshStats()" class="bg-[#3D8D7A] text-white px-4 py-2 rounded-lg hover:bg-[#2d6b5d] transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Refresh Data
                </button>
            </div> -->

            <section class="mb-8">
                <h2 class="text-[#464748] text-xl font-semibold mb-4">Statistik Setor Sampah</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4 text-center text-[#3D8D7A]">Jenis Sampah Terkumpul (kg)</h3>
                        <div id="sampah-stats" class="grid grid-cols-3 gap-4 h-48">
                            @if(isset($statistikSampah) && $statistikSampah->count() > 0)
                                @php
                                    $colors = ['#3D8D7A', '#2196F3', '#FF9800', '#9C27B0', '#795548', '#4CAF50'];
                                    $colorIndex = 0;
                                @endphp
                                @foreach($statistikSampah->take(3) as $item)
                                    <div class="rounded-lg flex flex-col justify-center text-white text-center p-4" 
                                        style="background-color: {{ $colors[$colorIndex % count($colors)] }}">
                                        <span class="text-3xl font-bold">{{ number_format($item->total_berat, 0) }}</span>
                                        <span>{{ ucfirst($item->nama_sampah) }}</span>
                                    </div>
                                    @php $colorIndex++; @endphp
                                @endforeach
                            @else
                                <div class="col-span-3 text-center text-gray-500 py-8">
                                    Belum ada data sampah
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('riwayat-setor-sampah') }}" class="text-[#3D8D7A] block text-center mt-4 hover:underline">Lihat Detail</a>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4 text-center text-[#3D8D7A]">Persentase Jenis Sampah</h3>
                        <div class="relative h-64">
                            <canvas id="persentaseJenis"></canvas>
                            <div id="chart-loading" class="absolute inset-0 flex items-center justify-center bg-gray-50 rounded">
                                <div class="text-gray-500">
                                    <svg class="animate-spin h-8 w-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <p>Memuat data...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center space-x-3">
                    <svg class="animate-spin h-6 w-6 text-[#3D8D7A]" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-gray-700">Memperbarui data...</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    @include('sweetalert::alert')

    <script>
        // Global variables
        let pieChart = null;
        
        // CSRF Token setup for AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            initializePieChart();
            loadDashboardData(); // Memuat data ringkasan aktivitas tambahan
        });

        // Initialize Pie Chart
        function initializePieChart() {
            const chartLoadingDiv = document.getElementById('chart-loading');
            const persentaseJenisCanvas = document.getElementById('persentaseJenis');

            @if(isset($statistikSampah) && $statistikSampah->count() > 0)
                const chartData = {
                    labels: {!! json_encode($statistikSampah->pluck('nama_sampah')->map(function($item) { return ucfirst($item); })) !!},
                    datasets: [{
                        data: {!! json_encode($statistikSampah->pluck('total_berat')) !!},
                        backgroundColor: ['#3D8D7A', '#2196F3', '#FF9800', '#9C27B0', '#795548', '#4CAF50', '#F44336'], // Warna bisa diperluas jika jenis sampah > 7
                        borderWidth: 0
                    }]
                };

                const chartConfig = {
                    type: 'pie',
                    data: chartData,
                    plugins: [ChartDataLabels],
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 15,
                                    padding: 20
                                }
                            },
                            datalabels: {
                                formatter: (value, ctx) => {
                                    const total = ctx.chart.data.datasets[0].data.reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
                                    return total > 0 ? `${((parseFloat(value)/total)*100).toFixed(1)}%` : '0%';
                                },
                                color: '#fff',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                }
                            }
                        }
                    }
                };
                
                if (pieChart) {
                    pieChart.destroy(); // Hancurkan chart lama jika ada sebelum membuat yang baru
                }
                pieChart = new Chart(persentaseJenisCanvas, chartConfig);
                chartLoadingDiv.style.display = 'none';
            @else
                // Show no data message if $statistikSampah is empty or not set properly
                if (persentaseJenisCanvas) {
                     persentaseJenisCanvas.style.display = 'none'; // Sembunyikan canvas jika tidak ada data
                }
                chartLoadingDiv.innerHTML = '<div class="text-gray-500 text-center py-8">Belum ada data untuk ditampilkan pada chart</div>';
                chartLoadingDiv.style.display = 'flex'; // Pastikan loading div terlihat untuk pesan
            @endif
        }

        // Refresh statistics
        async function refreshStats() {
            const loadingOverlay = document.getElementById('loading-overlay');
            loadingOverlay.classList.remove('hidden');

            try {
                const response = await fetch('{{ route("admin.api.refresh.stats") }}', {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const result = await response.json();
                    
                    if (result.success) {
                        // Update stats cards
                        document.getElementById('total-transaksi').textContent = result.data.totalTransaksi;
                        document.getElementById('total-sampah').textContent = result.data.totalSampah; // Pastikan unitnya konsisten (Kg atau Ton)
                        document.getElementById('total-pengguna').textContent = result.data.totalPengguna;

                        // Update "Jenis Sampah Terkumpul" section
                        const sampahStatsDiv = document.getElementById('sampah-stats');
                        sampahStatsDiv.innerHTML = ''; // Kosongkan dulu
                        if (result.data.statistikSampah && result.data.statistikSampah.length > 0) {
                            const colors = ['#3D8D7A', '#2196F3', '#FF9800', '#9C27B0', '#795548', '#4CAF50'];
                            let colorIndex = 0;
                            result.data.statistikSampah.slice(0, 3).forEach(item => { // Ambil 3 teratas
                                const statItemDiv = document.createElement('div');
                                statItemDiv.className = 'rounded-lg flex flex-col justify-center text-white text-center p-4';
                                statItemDiv.style.backgroundColor = colors[colorIndex % colors.length];
                                statItemDiv.innerHTML = `
                                    <span class="text-3xl font-bold">${Number(item.total_berat).toLocaleString('id-ID')}</span>
                                    <span>${item.nama_sampah.charAt(0).toUpperCase() + item.nama_sampah.slice(1)}</span>
                                `;
                                sampahStatsDiv.appendChild(statItemDiv);
                                colorIndex++;
                            });
                        } else {
                            sampahStatsDiv.innerHTML = '<div class="col-span-3 text-center text-gray-500 py-8">Belum ada data sampah</div>';
                        }


                        // Update chart data
                        await updateChart(); 
                        
                        showNotification('Data berhasil diperbarui!', 'success');
                    } else {
                        showNotification(result.message || 'Gagal memperbarui data', 'error');
                    }
                } else {
                    const errorData = await response.json().catch(() => null); // Coba parse error response
                    const errorMessage = errorData?.message || `Gagal menghubungi server (Status: ${response.status})`;
                    throw new Error(errorMessage);
                }
            } catch (error) {
                console.error('Error refreshing stats:', error);
                showNotification(error.message || 'Terjadi kesalahan saat memperbarui data', 'error');
            } finally {
                loadingOverlay.classList.add('hidden');
            }
        }

        // Update chart data by fetching from its dedicated endpoint
        async function updateChart() {
            const chartLoadingDiv = document.getElementById('chart-loading');
            const persentaseJenisCanvas = document.getElementById('persentaseJenis');
            chartLoadingDiv.style.display = 'flex'; // Tampilkan loading saat chart diupdate
            persentaseJenisCanvas.style.display = 'none'; // Sembunyikan canvas lama

            try {
                const response = await fetch('{{ route("admin.api.chart.data") }}', {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const result = await response.json();
                    
                    if (result.success && result.data.datasets[0].data.length > 0) {
                        if (pieChart) {
                            pieChart.data = result.data;
                            pieChart.update();
                        } else {
                            // Jika chart belum ada, inisialisasi dengan data baru
                            // Ini seharusnya tidak terjadi jika initializePieChart dipanggil di DOMContentLoaded
                            // Tapi sebagai fallback:
                            const chartData = result.data;
                            const chartConfig = { /* ... konfigurasi chart seperti di initializePieChart ... */
                                type: 'pie',
                                data: chartData,
                                plugins: [ChartDataLabels],
                                options: { /* ... options ... */ }
                            };
                            pieChart = new Chart(persentaseJenisCanvas, chartConfig);
                        }
                        persentaseJenisCanvas.style.display = 'block'; // Tampilkan canvas lagi
                        chartLoadingDiv.style.display = 'none';
                    } else {
                        if (pieChart) {
                            pieChart.destroy(); // Hancurkan chart jika data baru kosong
                            pieChart = null;
                        }
                        persentaseJenisCanvas.style.display = 'none';
                        chartLoadingDiv.innerHTML = '<div class="text-gray-500 text-center py-8">Belum ada data untuk ditampilkan pada chart</div>';
                        chartLoadingDiv.style.display = 'flex';
                    }
                } else {
                     const errorData = await response.json().catch(() => null);
                     throw new Error(errorData?.message || `Gagal mengambil data chart (Status: ${response.status})`);
                }
            } catch (error) {
                console.error('Error updating chart:', error);
                if (pieChart) { pieChart.destroy(); pieChart = null; } // Hancurkan chart jika error
                persentaseJenisCanvas.style.display = 'none';
                chartLoadingDiv.innerHTML = `<div class="text-gray-500 text-center py-8">Gagal memuat chart: ${error.message}</div>`;
                chartLoadingDiv.style.display = 'flex';
            }
        }

        // Show notification
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-20 right-4 z-[100] p-4 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'} text-white transition-opacity duration-300 opacity-0`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Trigger fade in
            setTimeout(() => {
                notification.classList.remove('opacity-0');
                notification.classList.add('opacity-100');
            }, 10); 
            
            // Remove after 3 seconds with fade out
            setTimeout(() => {
                notification.classList.remove('opacity-100');
                notification.classList.add('opacity-0');
                setTimeout(() => {
                    notification.remove();
                }, 300); // Wait for fade out transition
            }, 3000);
        }

        // Auto refresh every 5 minutes (jika diperlukan)
        // Nonaktifkan jika refresh manual lebih disukai atau jika ada potensi masalah performa
        /*
        setInterval(() => {
            console.log('Auto refreshing stats...');
            refreshStats();
        }, 300000); // 5 minutes
        */
    </script>
</body>
</html>