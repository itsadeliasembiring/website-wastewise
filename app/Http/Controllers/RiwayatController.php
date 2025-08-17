<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;
use App\Models\BarangModel;
use App\Models\PenukaranBarangModel;
use App\Models\PenggunaModel; 
use App\Models\AkunModel;
use App\Models\DonasiModel;
use App\Models\PenukaranDonasiModel;
use App\Models\KelurahanModel;
use App\Models\KecamatanModel;
use App\Models\SetorSampahModel;
use App\Models\DetailSetorSampahModel;
use App\Models\SampahModel;

class RiwayatController extends Controller
{
    /**
     * Menampilkan riwayat setor sampah berdasarkan pengguna yang login
     */
    public function getRiwayatSetorSampah(Request $request)
    {
        try {
            // Mendapatkan ID pengguna yang login
            $idPengguna = Auth::id();
            
            if (!$idPengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengguna tidak terautentikasi'
                ], 401);
            }

            // Ambil data setor sampah dengan relasi
            $riwayatSetor = SetorSampahModel::with([
                'detailSetorSampah.sampah',
                'bankSampah'
            ])
            ->where('id_pengguna', $idPengguna)
            ->orderBy('waktu_setor', 'desc')
            ->get();

            // Format data untuk response
            $formattedData = $riwayatSetor->map(function ($setor) {
                return [
                    'id_setor' => $setor->id_setor,
                    'waktu_setor' => $setor->waktu_setor,
                    'total_berat' => $setor->total_berat,
                    'total_poin' => $setor->total_poin,
                    'lokasi_penjemputan' => $setor->lokasi_penjemputan,
                    'waktu_penjemputan' => $setor->waktu_penjemputan,
                    'kode_verifikasi' => $setor->kode_verifikasi,
                    'status_verifikasi' => $setor->status_verifikasi,
                    'status_setor' => $setor->status_setor,
                    'metode_setor' => $setor->metode_setor,
                    'catatan' => $setor->catatan,
                    'bank_sampah' => $setor->bankSampah ? [
                        'id_bank_sampah' => $setor->bankSampah->id_bank_sampah,
                        'nama_bank_sampah' => $setor->bankSampah->nama_bank_sampah,
                        'alamat' => $setor->bankSampah->alamat,
                    ] : null,
                    'detail_sampah' => $setor->detailSetorSampah->map(function ($detail) {
                        return [
                            'id_detail' => $detail->id_detail,
                            'berat_kg' => $detail->berat_kg,
                            'sampah' => $detail->sampah ? [
                                'id_sampah' => $detail->sampah->id_sampah,
                                'nama_sampah' => $detail->sampah->nama_sampah,
                                'bobot_poin' => $detail->sampah->bobot_poin,
                                'jenis_sampah' => $detail->sampah->jenis_sampah,
                                'poin_per_detail' => $detail->berat_kg * $detail->sampah->bobot_poin
                            ] : null
                        ];
                    })
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Riwayat setor sampah berhasil diambil',
                'data' => $formattedData,
                'total_records' => $formattedData->count()
            ], 200);

        } catch (Exception $e) {
            Log::error('Error getting riwayat setor sampah: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil riwayat setor sampah',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan riwayat tukar poin (gabungan penukaran barang dan donasi) berdasarkan pengguna yang login
     */
    public function getRiwayatTukarPoin(Request $request)
    {
        try {
            // Mendapatkan ID pengguna yang login
            $idPengguna = Auth::id();
            
            if (!$idPengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengguna tidak terautentikasi'
                ], 401);
            }

            // Ambil data penukaran barang
            $penukaranBarang = PenukaranBarangModel::with('barang')
                ->where('id_pengguna', $idPengguna)
                ->get()
                ->map(function ($penukaran) {
                    return [
                        'id' => $penukaran->id_penukaran_barang,
                        'waktu' => $penukaran->waktu,
                        'jumlah_poin' => $penukaran->jumlah_poin,
                        'jenis_penukaran' => 'barang',
                        'kode_redeem' => $penukaran->kode_redeem,
                        'status_redeem' => $penukaran->status_redeem,
                        'item' => $penukaran->barang ? [
                            'id' => $penukaran->barang->id_barang,
                            'nama' => $penukaran->barang->nama_barang,
                            'deskripsi' => $penukaran->barang->deskripsi,
                            'foto' => $penukaran->barang->foto,
                            'harga_poin' => $penukaran->barang->harga_poin,
                            'stok' => $penukaran->barang->stok,
                        ] : null
                    ];
                });

            // Ambil data penukaran donasi
            $penukaranDonasi = PenukaranDonasiModel::with('donasi')
                ->where('id_pengguna', $idPengguna)
                ->get()
                ->map(function ($penukaran) {
                    return [
                        'id' => $penukaran->id_penukaran_donasi,
                        'waktu' => $penukaran->waktu,
                        'jumlah_poin' => $penukaran->jumlah_poin,
                        'jenis_penukaran' => 'donasi',
                        'kode_redeem' => null,
                        'status_redeem' => 'completed', // Donasi biasanya langsung selesai
                        'item' => $penukaran->donasi ? [
                            'id' => $penukaran->donasi->id_donasi,
                            'nama' => $penukaran->donasi->nama_donasi,
                            'deskripsi' => $penukaran->donasi->deskripsi,
                            'foto' => $penukaran->donasi->foto,
                            'harga_poin' => $penukaran->donasi->harga_poin,
                            'target_donasi' => $penukaran->donasi->target_donasi ?? null,
                        ] : null
                    ];
                });

            // Gabungkan kedua data dan urutkan berdasarkan waktu
            $riwayatTukarPoin = collect($penukaranBarang)
                ->merge($penukaranDonasi)
                ->sortByDesc('waktu')
                ->values();

            // Hitung total poin yang sudah ditukar
            $totalPoinDitukar = $riwayatTukarPoin->sum('jumlah_poin');
            
            // Hitung statistik
            $statistik = [
                'total_transaksi' => $riwayatTukarPoin->count(),
                'total_poin_ditukar' => $totalPoinDitukar,
                'total_penukaran_barang' => $penukaranBarang->count(),
                'total_penukaran_donasi' => $penukaranDonasi->count(),
                'poin_barang' => $penukaranBarang->sum('jumlah_poin'),
                'poin_donasi' => $penukaranDonasi->sum('jumlah_poin'),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Riwayat tukar poin berhasil diambil',
                'data' => $riwayatTukarPoin,
                'statistik' => $statistik,
                'total_records' => $riwayatTukarPoin->count()
            ], 200);

        } catch (Exception $e) {
            Log::error('Error getting riwayat tukar poin: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil riwayat tukar poin',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan riwayat lengkap (gabungan setor sampah dan tukar poin)
     */
    public function getRiwayatLengkap(Request $request)
    {
        try {
            // Mendapatkan ID pengguna yang login
            $idPengguna = Auth::id();
            
            if (!$idPengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengguna tidak terautentikasi'
                ], 401);
            }

            // Ambil riwayat setor sampah
            $riwayatSetor = SetorSampahModel::with(['detailSetorSampah.sampah', 'bankSampah'])
                ->where('id_pengguna', $idPengguna)
                ->get()
                ->map(function ($setor) {
                    return [
                        'id' => $setor->id_setor,
                        'waktu' => $setor->waktu_setor,
                        'tipe_aktivitas' => 'setor_sampah',
                        'poin' => $setor->total_poin,
                        'status' => $setor->status_setor,
                        'detail' => [
                            'total_berat' => $setor->total_berat,
                            'metode_setor' => $setor->metode_setor,
                            'bank_sampah' => $setor->bankSampah->nama_bank_sampah ?? null,
                            'jumlah_jenis_sampah' => $setor->detailSetorSampah->count()
                        ]
                    ];
                });

            // Ambil riwayat penukaran barang
            $riwayatPenukaranBarang = PenukaranBarangModel::with('barang')
                ->where('id_pengguna', $idPengguna)
                ->get()
                ->map(function ($penukaran) {
                    return [
                        'id' => $penukaran->id_penukaran_barang,
                        'waktu' => $penukaran->waktu,
                        'tipe_aktivitas' => 'tukar_barang',
                        'poin' => -$penukaran->jumlah_poin, // Negatif karena mengurangi poin
                        'status' => $penukaran->status_redeem,
                        'detail' => [
                            'nama_barang' => $penukaran->barang->nama_barang ?? null,
                            'kode_redeem' => $penukaran->kode_redeem
                        ]
                    ];
                });

            // Ambil riwayat penukaran donasi
            $riwayatPenukaranDonasi = PenukaranDonasiModel::with('donasi')
                ->where('id_pengguna', $idPengguna)
                ->get()
                ->map(function ($penukaran) {
                    return [
                        'id' => $penukaran->id_penukaran_donasi,
                        'waktu' => $penukaran->waktu,
                        'tipe_aktivitas' => 'tukar_donasi',
                        'poin' => -$penukaran->jumlah_poin, // Negatif karena mengurangi poin
                        'status' => 'completed',
                        'detail' => [
                            'nama_donasi' => $penukaran->donasi->nama_donasi ?? null
                        ]
                    ];
                });

            // Gabungkan semua data dan urutkan berdasarkan waktu
            $riwayatLengkap = collect($riwayatSetor)
                ->merge($riwayatPenukaranBarang)
                ->merge($riwayatPenukaranDonasi)
                ->sortByDesc('waktu')
                ->values();

            // Hitung saldo poin saat ini
            $totalPoinMasuk = $riwayatSetor->sum('poin');
            $totalPoinKeluar = abs($riwayatPenukaranBarang->sum('poin') + $riwayatPenukaranDonasi->sum('poin'));
            $saldoPoin = $totalPoinMasuk - $totalPoinKeluar;

            $statistik = [
                'saldo_poin_saat_ini' => $saldoPoin,
                'total_poin_masuk' => $totalPoinMasuk,
                'total_poin_keluar' => $totalPoinKeluar,
                'total_aktivitas' => $riwayatLengkap->count(),
                'total_setor_sampah' => $riwayatSetor->count(),
                'total_tukar_barang' => $riwayatPenukaranBarang->count(),
                'total_tukar_donasi' => $riwayatPenukaranDonasi->count(),
            ];

            return response()->json([
                'success' => true,
                'message' => 'Riwayat lengkap berhasil diambil',
                'data' => $riwayatLengkap,
                'statistik' => $statistik,
                'total_records' => $riwayatLengkap->count()
            ], 200);

        } catch (Exception $e) {
            Log::error('Error getting riwayat lengkap: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil riwayat lengkap',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan detail riwayat setor sampah berdasarkan ID
     */
    public function getDetailSetorSampah(Request $request, $idSetor)
    {
        try {
            $idPengguna = Auth::id();
            
            if (!$idPengguna) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengguna tidak terautentikasi'
                ], 401);
            }

            $setorSampah = SetorSampahModel::with([
                'detailSetorSampah.sampah',
                'bankSampah',
                'pengguna'
            ])
            ->where('id_setor', $idSetor)
            ->where('id_pengguna', $idPengguna)
            ->first();

            if (!$setorSampah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data setor sampah tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail setor sampah berhasil diambil',
                'data' => [
                    'id_setor' => $setorSampah->id_setor,
                    'waktu_setor' => $setorSampah->waktu_setor,
                    'total_berat' => $setorSampah->total_berat,
                    'total_poin' => $setorSampah->total_poin,
                    'lokasi_penjemputan' => $setorSampah->lokasi_penjemputan,
                    'waktu_penjemputan' => $setorSampah->waktu_penjemputan,
                    'kode_verifikasi' => $setorSampah->kode_verifikasi,
                    'status_verifikasi' => $setorSampah->status_verifikasi,
                    'status_setor' => $setorSampah->status_setor,
                    'metode_setor' => $setorSampah->metode_setor,
                    'catatan' => $setorSampah->catatan,
                    'bank_sampah' => $setorSampah->bankSampah ? [
                        'id_bank_sampah' => $setorSampah->bankSampah->id_bank_sampah,
                        'nama_bank_sampah' => $setorSampah->bankSampah->nama_bank_sampah,
                        'alamat' => $setorSampah->bankSampah->alamat,
                    ] : null,
                    'detail_sampah' => $setorSampah->detailSetorSampah->map(function ($detail) {
                        return [
                            'id_detail' => $detail->id_detail,
                            'berat_kg' => $detail->berat_kg,
                            'sampah' => $detail->sampah ? [
                                'id_sampah' => $detail->sampah->id_sampah,
                                'nama_sampah' => $detail->sampah->nama_sampah,
                                'bobot_poin' => $detail->sampah->bobot_poin,
                                'jenis_sampah' => $detail->sampah->jenis_sampah,
                                'poin_per_detail' => $detail->berat_kg * $detail->sampah->bobot_poin
                            ] : null
                        ];
                    })
                ]
            ], 200);

        } catch (Exception $e) {
            Log::error('Error getting detail setor sampah: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil detail setor sampah',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}