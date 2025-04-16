<!DOCTYPE html>
<html lang="en" class="h-full bg-[#E6E6E6] dark:bg-[#E6E6E6]">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="h-full w-full">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 h-16 bg-white shadow-sm w-full">
        <x-header.admin/>
    </header>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-20 bottom-0 transition-all duration-300 bg-white">
        <x-sidebar.admin />
    </aside>

    <!-- Main Content -->
    <main class="min-h-screen pt-16 overflow-y-auto sm:pl-[70px] xl:pl-15">
        <div class="p-8">
            <!-- Title Section -->
            <div class="text-center mb-8">
                <h1 class="text-[#3D8D7A] font-semibold text-xl sm:text-2xl">
                    Halo, Selamat Datang di WasteWise sebagai Admin
                </h1>
                <p class="text-gray-600 mt-2 hidden sm:block">
                    Disini anda dapat mengelola operasional dan data Bank Sampah WasteWise Surabaya
                </p>
            </div>

            <!-- Stats Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <!-- Bank Sampah Card -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <a href="#" class="flex items-center justify-between">
                        <x-fas-home class="w-16 h-16 text-[#3D8D7A]" />
                        <div class="text-center">
                            <p class="text-[#3D8D7A] text-4xl font-bold">42</p>
                            <p class="text-gray-700 text-lg">Bank Sampah</p>
                        </div>
                    </a>
                </div>

                <!-- Total Sampah Card -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <a href="#" class="flex items-center justify-between">
                        <x-fas-recycle class="w-16 h-16 text-[#3D8D7A]" />
                        <div class="text-center">
                            <p class="text-[#3D8D7A] text-4xl font-bold">12.5</p>
                            <p class="text-gray-700 text-lg">Ton Sampah</p>
                        </div>
                    </a>
                </div>

                <!-- Pengguna Card -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                    <a href="#" class="flex items-center justify-between">
                        <x-fas-user-alt class="w-16 h-16 text-[#3D8D7A]" />
                        <div class="text-center">
                            <p class="text-[#3D8D7A] text-4xl font-bold">875</p>
                            <p class="text-gray-700 text-lg">Pengguna</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Statistics Section -->
            <section class="mb-8">
                <h2 class="text-[#464748] text-xl font-semibold mb-4">Statistik Setor Sampah</h2>
                
                <!-- Charts Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Jenis Sampah Terkumpul -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4 text-center text-[#3D8D7A]">Jenis Sampah Terkumpul (kg)</h3>
                        <div class="grid grid-cols-3 gap-4 h-48">
                            <div class="bg-[#3D8D7A] rounded-lg flex flex-col justify-center text-white text-center p-4">
                                <span class="text-3xl font-bold">5428</span>
                                <span>Plastik</span>
                            </div>
                            <div class="bg-[#2196F3] rounded-lg flex flex-col justify-center text-white text-center p-4">
                                <span class="text-3xl font-bold">3215</span>
                                <span>Kertas</span>
                            </div>
                            <div class="bg-[#FF9800] rounded-lg flex flex-col justify-center text-white text-center p-4">
                                <span class="text-3xl font-bold">1742</span>
                                <span>Logam</span>
                            </div>
                        </div>
                        <a href="#" class="text-[#3D8D7A] block text-center mt-4">Lihat Detail</a>
                    </div>

                    <!-- Pie Chart -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold mb-4 text-center text-[#3D8D7A]">Persentase Jenis Sampah</h3>
                        <div class="relative h-64">
                            <canvas id="persentaseJenis"></canvas>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    @include('sweetalert::alert')

    <script>
        // Pie Chart Implementation
        const chartData = {
            labels: ['Plastik', 'Kertas', 'Logam', 'Kaca', 'Organik'],
            datasets: [{
                data: [5428, 3215, 1742, 1105, 1010],
                backgroundColor: ['#3D8D7A', '#2196F3', '#FF9800', '#9C27B0', '#795548'],
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
                            const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            return `${((value/total)*100).toFixed(1)}%`;
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

        window.addEventListener('DOMContentLoaded', () => {
            new Chart(document.getElementById('persentaseJenis'), chartConfig);
        });
    </script>
</body>
</html>