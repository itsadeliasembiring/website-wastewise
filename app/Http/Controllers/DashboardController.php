<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SetorSampahModel;
use App\Models\DetailSetorSampahModel;
use App\Models\SampahModel; // Pastikan model ini ada dan benar
use App\Models\PenggunaModel;
use App\Models\PenukaranBarangModel;
use App\Models\PenukaranDonasiModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Penting untuk logging error

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with statistics
     */
    public function index()
    {
        try {
            // Hitung total transaksi (setor sampah + transaksi barang + transaksi donasi)
            $totalTransaksi = $this->getTotalTransaksi();
            
            // Hitung total sampah (sesuaikan unit jika perlu, misal Kg atau Ton)
            $totalSampah = $this->getTotalSampah(); 
            
            // Hitung total pengguna
            $totalPengguna = PenggunaModel::count();
            
            // Data statistik jenis sampah
            $statistikSampah = $this->getStatistikSampah(); // Mengembalikan Collection
            
            return view('admin.dashboard', compact(
                'totalTransaksi',
                'totalSampah', 
                'totalPengguna',
                'statistikSampah'
            ));
            
        } catch (\Exception $e) {
            // Log error untuk investigasi
            Log::error('Error in DashboardController@index: ' . $e->getMessage());
            
            // Kembalikan view dengan nilai default jika terjadi error
            // Penggunaan collect([]) sangat penting di sini agar view tidak error
            // saat mencoba memanggil method collection pada $statistikSampah.
            return view('admin.dashboard', [
                'totalTransaksi' => 0,
                'totalSampah' => 0.0, // Sesuai dengan unit (misal Ton)
                'totalPengguna' => 0,
                'statistikSampah' => collect([]) // INI ADALAH PERBAIKAN KUNCI
            ]);
        }
    }
    
    /**
     * Hitung total transaksi dari berbagai sumber
     */
    private function getTotalTransaksi()
    {
        try {
            $totalSetorSampah = SetorSampahModel::count();
            // $totalTransaksiBarang = PenukaranBarangModel::count();
            // $totalPenukaranDonasi = PenukaranDonasiModel::count();
            
            return $totalSetorSampah;
        } catch (\Exception $e) {
            Log::error('Error getting total transaksi: ' . $e->getMessage());
            return 0; // Kembalikan nilai default jika error
        }
    }
    
    /**
     * Hitung total sampah dalam Ton.
     * Jika ingin dalam Kg, hilangkan pembagian dengan 1000.
     */
    private function getTotalSampah()
    {
        try {
            // Ambil total berat dari detail setor sampah dalam kg
            $totalBeratKg = DetailSetorSampahModel::sum('berat_kg');
            return $totalBeratKg;
        } catch (\Exception $e) {
            Log::error('Error getting total sampah: ' . $e->getMessage());
            return 0.0; // Kembalikan nilai default jika error
        }
    }
    
    /**
     * Dapatkan statistik sampah berdasarkan jenis
     * Mengembalikan Collection, kosong jika error atau tidak ada data.
     */
    private function getStatistikSampah()
    {
        try {
            $statistik = DB::table('detail_setor')
                ->join('sampah', 'detail_setor.id_sampah', '=', 'sampah.id_sampah')
                ->select(
                    'sampah.nama_sampah',
                    DB::raw('SUM(detail_setor.berat_kg) as total_berat') // berat dalam Kg
                )
                ->groupBy('sampah.nama_sampah')
                ->orderBy('total_berat', 'desc')
                ->get(); // Hasilnya sudah Collection
                
            return $statistik;
            
        } catch (\Exception $e) {
            Log::error('Error getting statistik sampah: ' . $e->getMessage());
            return collect([]); // Kembalikan Collection kosong jika error
        }
    }
    
    /**
     * API endpoint untuk data chart pie
     */
    public function getChartData()
    {
        try {
            $statistik = $this->getStatistikSampah(); // Ini sudah Collection
            
            // Memastikan label unik dan data sesuai
            $labels = $statistik->pluck('jenis_sampah')->map(function($item) {
                return ucfirst($item); // Mengkapitalkan huruf pertama jenis sampah
            })->toArray();
            
            $data = $statistik->pluck('total_berat')->map(function($item) {
                return (float) $item; // Pastikan data adalah float/numeric
            })->toArray();
            
            // Warna untuk chart, bisa diperluas jika jenis sampah lebih banyak
            $colors = ['#3D8D7A', '#2196F3', '#FF9800', '#9C27B0', '#795548', '#4CAF50', '#F44336', '#E91E63', '#607D8B', '#00BCD4'];
            // Ambil warna sejumlah label yang ada, atau ulangi jika label lebih banyak dari warna
            $backgroundColor = [];
            if (count($labels) > 0) {
                for ($i = 0; $i < count($labels); $i++) {
                    $backgroundColor[] = $colors[$i % count($colors)];
                }
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'labels' => $labels,
                    'datasets' => [
                        [
                            'data' => $data,
                            'backgroundColor' => $backgroundColor,
                            'borderWidth' => 0 // Biasanya 0 atau 1 untuk pie chart
                        ]
                    ]
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error getting chart data for API: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data chart: ' . $e->getMessage()
            ], 500); // HTTP 500 untuk server error
        }
    }
    
    /**
     * API endpoint untuk refresh dashboard stats
     */
    public function refreshStats()
    {
        try {
            $stats = [
                'totalTransaksi' => $this->getTotalTransaksi(),
                'totalSampah' => $this->getTotalSampah(), // Unit (Kg atau Ton) harus konsisten dengan view
                'totalPengguna' => PenggunaModel::count(),
                'statistikSampah' => $this->getStatistikSampah()->map(function($item) { // Kirim data statistik sampah untuk di-render ulang di frontend
                    return [
                        'jenis_sampah' => ucfirst($item->jenis_sampah),
                        'total_berat' => (float) $item->total_berat
                    ];
                })->toArray()
            ];
            
            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error refreshing stats for API: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal me-refresh statistik: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get monthly transaction trends (contoh tambahan, tidak digunakan di view saat ini)
     */
    public function getMonthlyTrends()
    {
        try {
            $trends = DB::table('setor_sampah')
                ->select(
                    DB::raw('MONTH(tanggal_setor) as bulan'),
                    DB::raw('YEAR(tanggal_setor) as tahun'),
                    DB::raw('COUNT(*) as total_transaksi'),
                    // Subquery untuk total berat bisa lebih kompleks, pastikan performanya baik
                    // Atau, jika memungkinkan, denormalisasi atau join dengan tabel detail.
                    DB::raw('SUM((SELECT SUM(dss.berat) FROM detail_setor_sampah dss WHERE dss.id_setor_sampah = setor_sampah.id_setor_sampah)) as total_berat_bulanan')
                )
                ->where('tanggal_setor', '>=', now()->subMonths(12)) // Data 12 bulan terakhir
                ->groupBy('tahun', 'bulan')
                ->orderBy('tahun', 'asc')
                ->orderBy('bulan', 'asc')
                ->get();
                
            return response()->json([
                'success' => true,
                'data' => $trends
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error getting monthly trends: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil tren bulanan: ' . $e->getMessage()
            ], 500);
        }
    }
}