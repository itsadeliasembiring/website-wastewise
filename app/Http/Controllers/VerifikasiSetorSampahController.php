<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SetorSampahModel;
use App\Models\DetailSetorSampahModel;
use App\Models\SampahModel;
use App\Models\PenggunaModel;
use App\Models\BankSampahModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class VerifikasiSetorSampahController extends Controller
{
    protected $setorSampahModel;
    protected $detailSetorSampahModel;
    protected $sampahModel;
    protected $bankSampahModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->setorSampahModel = new SetorSampahModel;
        $this->detailSetorSampahModel = new DetailSetorSampahModel;
        $this->sampahModel = new SampahModel;
        $this->bankSampahModel = new BankSampahModel;
        $this->penggunaModel = new PenggunaModel;
    }

    /**
     * Menampilkan halaman verifikasi setor sampah
     */
    public function index()
    {
        return view('admin.verifikasi-setor-sampah');
    }

    /**
     * Mencari data setor sampah berdasarkan kode verifikasi
     */
    public function cariKodeVerifikasi(Request $request)
    {
        try {
            $request->validate([
                'kode_verifikasi' => 'required|string'
            ]);

            $kodeVerifikasi = $request->kode_verifikasi;

            // Cari data setor sampah berdasarkan kode verifikasi
            $setorSampah = $this->setorSampahModel
                ->with(['pengguna', 'bankSampah', 'detailSetorSampah.sampah'])
                ->where('kode_verifikasi', $kodeVerifikasi)
                ->where('status_verifikasi', false) // Hanya yang belum diverifikasi
                ->first();

            if (!$setorSampah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode verifikasi tidak ditemukan atau sudah diverifikasi'
                ], 404);
            }

            // Format data untuk response
            $responseData = [
                'id_setor' => $setorSampah->id_setor,
                'waktu_setor' => $setorSampah->waktu_setor,
                'metode_setor' => $setorSampah->metode_setor,
                'lokasi_penjemputan' => $setorSampah->lokasi_penjemputan,
                'waktu_penjemputan' => $setorSampah->waktu_penjemputan,
                'status_setor' => $setorSampah->status_setor,
                'catatan' => $setorSampah->catatan,
                'pengguna' => [
                    'id_pengguna' => $setorSampah->pengguna->id_pengguna,
                    'nama_lengkap' => $setorSampah->pengguna->nama_lengkap,
                    'nomor_telepon' => $setorSampah->pengguna->nomor_telepon,
                    'total_poin' => $setorSampah->pengguna->total_poin
                ],
                'bank_sampah' => [
                    'id_bank_sampah' => $setorSampah->bankSampah->id_bank_sampah,
                    'nama_bank_sampah' => $setorSampah->bankSampah->nama_bank_sampah ?? 'N/A'
                ],
                'detail_setor' => $setorSampah->detailSetorSampah->map(function ($detail) {
                    return [
                        'id_detail' => $detail->id_detail,
                        'berat_kg' => $detail->berat_kg,
                        'sampah' => [
                            'id_sampah' => $detail->sampah->id_sampah,
                            'nama_sampah' => $detail->sampah->nama_sampah,
                            'bobot_poin' => $detail->sampah->bobot_poin,
                            'jenis_sampah' => $detail->sampah->jenis_sampah
                        ],
                        'total_poin_item' => $detail->berat_kg * $detail->sampah->bobot_poin
                    ];
                }),
                'total_berat_calculated' => $setorSampah->detailSetorSampah->sum('berat_kg'),
                'total_poin_calculated' => $setorSampah->detailSetorSampah->sum(function ($detail) {
                    return $detail->berat_kg * $detail->sampah->bobot_poin;
                })
            ];

            return response()->json([
                'success' => true,
                'message' => 'Data setor sampah ditemukan',
                'data' => $responseData
            ]);

        } catch (Exception $e) {
            Log::error('Error dalam pencarian kode verifikasi: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencari data'
            ], 500);
        }
    }

    /**
     * Update berat sampah pada detail setor
     */
    public function updateBeratSampah(Request $request)
    {
        try {
            $request->validate([
                'id_detail' => 'required|string|exists:detail_setor,id_detail',
                'berat_kg' => 'required|numeric|min:0'
            ]);

            $detailSetor = $this->detailSetorSampahModel->find($request->id_detail);
            
            if (!$detailSetor) {
                return response()->json([
                    'success' => false,
                    'message' => 'Detail setor tidak ditemukan'
                ], 404);
            }

            // Cek apakah setor sampah sudah diverifikasi
            $setorSampah = $this->setorSampahModel->find($detailSetor->id_setor);
            if ($setorSampah->status_verifikasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data sudah diverifikasi, tidak dapat diubah'
                ], 400);
            }

            // Update berat
            $detailSetor->berat_kg = $request->berat_kg;
            $detailSetor->save();

            // Hitung ulang total poin untuk item ini
            $sampah = $this->sampahModel->find($detailSetor->id_sampah);
            $totalPoinItem = $request->berat_kg * $sampah->bobot_poin;

            return response()->json([
                'success' => true,
                'message' => 'Berat sampah berhasil diupdate',
                'data' => [
                    'id_detail' => $detailSetor->id_detail,
                    'berat_kg' => $detailSetor->berat_kg,
                    'total_poin_item' => $totalPoinItem
                ]
            ]);

        } catch (Exception $e) {
            Log::error('Error dalam update berat sampah: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupdate berat sampah'
            ], 500);
        }
    }

    /**
     * Verifikasi setor sampah dan update poin pengguna
     */
    public function verifikasiSetor(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $request->validate([
                'id_setor' => 'required|string|exists:setor_sampah,id_setor'
            ]);

            $setorSampah = $this->setorSampahModel->find($request->id_setor);
            
            if (!$setorSampah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data setor sampah tidak ditemukan'
                ], 404);
            }

            // Cek apakah sudah diverifikasi
            if ($setorSampah->status_verifikasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data sudah diverifikasi sebelumnya'
                ], 400);
            }

            // Update totals pada setor sampah dulu
            $setorSampah->updateTotals();
            
            // Refresh data setor sampah
            $setorSampah->refresh();

            // Ambil pengguna
            $pengguna = $this->penggunaModel->find($setorSampah->id_pengguna);
            if (!$pengguna) {
                throw new Exception('Pengguna tidak ditemukan');
            }

            // Update status verifikasi dan status setor
            $setorSampah->status_verifikasi = true;
            $setorSampah->status_setor = 'selesai';
            $setorSampah->save();

            // Update total poin pengguna
            $poinBaru = $pengguna->total_poin + $setorSampah->total_poin;
            $pengguna->total_poin = $poinBaru;
            $pengguna->save();

            DB::commit();

            // Log aktivitas
            Log::info("Verifikasi setor sampah berhasil - ID: {$setorSampah->id_setor}, Poin: {$setorSampah->total_poin}, Pengguna: {$pengguna->nama_lengkap}");

            return response()->json([
                'success' => true,
                'message' => 'Setor sampah berhasil diverifikasi',
                'data' => [
                    'id_setor' => $setorSampah->id_setor,
                    'total_berat' => $setorSampah->total_berat,
                    'total_poin' => $setorSampah->total_poin,
                    'pengguna_total_poin_baru' => $poinBaru,
                    'status_verifikasi' => $setorSampah->status_verifikasi,
                    'status_setor' => $setorSampah->status_setor
                ]
            ]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error('Error dalam verifikasi setor sampah: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memverifikasi setor sampah: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Batalkan detail setor sampah (hapus item)
     */
    public function hapusDetailSetor(Request $request)
    {
        try {
            $request->validate([
                'id_detail' => 'required|string|exists:detail_setor,id_detail'
            ]);

            $detailSetor = $this->detailSetorSampahModel->find($request->id_detail);
            
            if (!$detailSetor) {
                return response()->json([
                    'success' => false,
                    'message' => 'Detail setor tidak ditemukan'
                ], 404);
            }

            // Cek apakah setor sampah sudah diverifikasi
            $setorSampah = $this->setorSampahModel->find($detailSetor->id_setor);
            if ($setorSampah->status_verifikasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data sudah diverifikasi, tidak dapat dihapus'
                ], 400);
            }

            // Hapus detail setor
            $detailSetor->delete();

            return response()->json([
                'success' => true,
                'message' => 'Detail setor sampah berhasil dihapus'
            ]);

        } catch (Exception $e) {
            Log::error('Error dalam hapus detail setor: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus detail setor'
            ], 500);
        }
    }

    /**
     * Get semua data sampah untuk dropdown/select
     */
    public function getDaftarSampah()
    {
        try {
            $sampahList = $this->sampahModel
                ->with('jenisSampah')
                ->orderBy('nama_sampah')
                ->get()
                ->map(function ($sampah) {
                    return [
                        'id_sampah' => $sampah->id_sampah,
                        'nama_sampah' => $sampah->nama_sampah,
                        'bobot_poin' => $sampah->bobot_poin,
                        'jenis_sampah' => $sampah->jenis_sampah,
                        'nama_jenis' => $sampah->jenisSampah->nama_jenis ?? 'N/A'
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $sampahList
            ]);

        } catch (Exception $e) {
            Log::error('Error dalam get daftar sampah: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil daftar sampah'
            ], 500);
        }
    }

    /**
     * Tambah detail setor baru
     */
   public function tambahDetailSetor(Request $request)
    {
        try {
            $request->validate([
                'id_setor' => 'required|string|exists:setor_sampah,id_setor',
                'id_sampah' => 'required|string|exists:sampah,id_sampah',
                'berat_kg' => 'required|numeric|min:0.1'
            ]);

            // Cek apakah setor sampah sudah diverifikasi
            $setorSampah = $this->setorSampahModel->find($request->id_setor);
            if (!$setorSampah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data setor sampah tidak ditemukan'
                ], 404);
            }

            if ($setorSampah->status_verifikasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data sudah diverifikasi, tidak dapat menambah item'
                ], 400);
            }

            // Cek apakah kombinasi id_setor dan id_sampah sudah ada
            $existingDetail = $this->detailSetorSampahModel
                ->where('id_setor', $request->id_setor)
                ->where('id_sampah', $request->id_sampah)
                ->first();

            if ($existingDetail) {
                // Update berat yang sudah ada
                $existingDetail->berat_kg += $request->berat_kg;
                $existingDetail->save();

                // Ambil data sampah untuk response
                $sampah = $this->sampahModel->find($request->id_sampah);
                $totalPoinItem = $existingDetail->berat_kg * $sampah->bobot_poin;

                return response()->json([
                    'success' => true,
                    'message' => 'Berat sampah berhasil ditambahkan ke item yang sudah ada',
                    'data' => [
                        'id_detail' => $existingDetail->id_detail,
                        'berat_kg' => $existingDetail->berat_kg,
                        'sampah' => [
                            'id_sampah' => $sampah->id_sampah,
                            'nama_sampah' => $sampah->nama_sampah,
                            'bobot_poin' => $sampah->bobot_poin
                        ],
                        'total_poin_item' => $totalPoinItem
                    ]
                ]);
            }

            // Hitung index untuk ID detail baru
            $existingCount = $this->detailSetorSampahModel
                ->where('id_setor', $request->id_setor)
                ->count();
            
            $nextIndex = $existingCount + 1;
            $idDetail = $this->generateIdDetail($request->id_setor, $nextIndex);

            // Pastikan ID detail unik (jika ada konflik, increment index)
            while ($this->detailSetorSampahModel->where('id_detail', $idDetail)->exists()) {
                $nextIndex++;
                $idDetail = $this->generateIdDetail($request->id_setor, $nextIndex);
            }

            // Ambil data sampah terlebih dahulu untuk validasi
            $sampah = $this->sampahModel->find($request->id_sampah);
            if (!$sampah) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data sampah tidak ditemukan'
                ], 404);
            }

            // Buat detail setor baru dengan database transaction
            DB::beginTransaction();
            
            $detailSetor = $this->detailSetorSampahModel->create([
                'id_detail' => $idDetail,
                'berat_kg' => $request->berat_kg,
                'id_setor' => $request->id_setor,
                'id_sampah' => $request->id_sampah
            ]);

            DB::commit();

            $totalPoinItem = $request->berat_kg * $sampah->bobot_poin;

            return response()->json([
                'success' => true,
                'message' => 'Detail setor berhasil ditambahkan',
                'data' => [
                    'id_detail' => $detailSetor->id_detail,
                    'berat_kg' => $detailSetor->berat_kg,
                    'sampah' => [
                        'id_sampah' => $sampah->id_sampah,
                        'nama_sampah' => $sampah->nama_sampah,
                        'bobot_poin' => $sampah->bobot_poin
                    ],
                    'total_poin_item' => $totalPoinItem
                ]
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error dalam tambah detail setor: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambah detail setor'
            ], 500);
        }
    }

    private function generateIdDetail($idSetor, $index)
    {
        // Format: ID_SETOR + nomor urut 2 digit
        // Contoh: ST001 + 01 = ST00101
        return $idSetor . str_pad($index, 2, '0', STR_PAD_LEFT);
    }
}