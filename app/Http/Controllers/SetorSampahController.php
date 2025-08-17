<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\SetorSampahModel;
use App\Models\DetailSetorSampahModel;
use App\Models\SampahModel;
use App\Models\PenggunaModel;
use App\Models\BankSampahModel;
use App\Models\KelurahanModel;
use App\Models\KecamatanModel;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SetorSampahController extends Controller
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

    public function kelolaSetorSampah(Request $request)
    {
        $bank_sampah = $this->bankSampahModel->orderBy('nama_bank_sampah')->get();
        $pengguna = $this->penggunaModel->orderBy('nama_lengkap')->get();
        $sampah = $this->sampahModel->orderBy('nama_sampah')->get();

        return view("admin/riwayat-setor-sampah", [
            'bank_sampah' => $bank_sampah,
            'pengguna' => $pengguna,
            'sampah' => $sampah
        ]);
    }

    public function setorSampahData(Request $request)
    {
        if(request()->ajax()) {
            $query = $this->setorSampahModel::with(['bankSampah', 'pengguna'])
                ->withCalculatedTotals(); // Menggunakan scope yang sudah dibuat

            // Filter berdasarkan status_setor
            if(!empty($request->status) && $request->status != 'all') {
                $query->where('setor_sampah.status_setor', $request->status);
            }

            // Filter berdasarkan metode_setor
            if(!empty($request->metode) && $request->metode != 'all') {
                $query->where('setor_sampah.metode_setor', $request->metode);
            }

            // Filter berdasarkan bank sampah
            if(!empty($request->bank_sampah) && $request->bank_sampah != 'all') {
                $query->where('setor_sampah.id_bank_sampah', $request->bank_sampah);
            }

            try {
                return Datatables::of($query)
                    ->addIndexColumn()
                    ->addColumn('nama_lengkap', function($row) {
                        return $row->pengguna ? $row->pengguna->nama_lengkap : 'N/A';
                    })
                    ->addColumn('nama_bank_sampah', function($row) {
                        return $row->bankSampah ? $row->bankSampah->nama_bank_sampah : 'N/A';
                    })
                    ->addColumn('calculated_total_berat', function($row) {
                        return number_format($row->calculated_total_berat, 2) . ' kg';
                    })
                    ->addColumn('calculated_total_poin', function($row) {
                        return number_format($row->calculated_total_poin, 0) . ' poin';
                    })
                    ->addColumn('status_badge', function($row) {
                        $badgeClass = '';
                        $statusText = ucfirst($row->status_setor);
                        switch($row->status_setor) {
                            case 'Menunggu Konfirmasi':
                                $badgeClass = 'bg-yellow-100 text-yellow-800';
                                break;
                            case 'Di Proses':
                                $badgeClass = 'bg-blue-100 text-blue-800';
                                break;
                            case 'Selesai':
                                $badgeClass = 'bg-green-100 text-green-800';
                                break;
                            case 'Dibatalkan':
                                $badgeClass = 'bg-red-100 text-red-800';
                                break;
                            default:
                                $badgeClass = 'bg-gray-100 text-gray-800';
                        }
                        return '<span class="px-2 py-1 text-xs font-semibold rounded-full '.$badgeClass.'">'.$statusText.'</span>';
                    })
                    ->addColumn('waktu_setor_formatted', function($row) {
                        return date('d/m/Y H:i', strtotime($row->waktu_setor));
                    })
                    ->addColumn('waktu_penjemputan_formatted', function($row) {
                        return $row->waktu_penjemputan ? date('d/m/Y H:i', strtotime($row->waktu_penjemputan)) : '-';
                    })
                    ->addColumn('metode_setor_formatted', function($row) {
                        if ($row->metode_setor === 'Dijemput') return 'Dijemput';
                        if ($row->metode_setor === 'Setor Langsung') return 'Setor Langsung';
                        return ucfirst($row->metode_setor);
                    })
                    ->addColumn('action', function($row) {
                        $detailBtn = '<button data-id="'.$row->id_setor.'" data-action="detail" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]" title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>';
                        $editBtn = '<a href="#edit-setor/'.$row->id_setor.'" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>';
                        $deleteBtn = '<a href="#delete-setor/'.$row->id_setor.'" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>';
                        return '<div class="flex space-x-2 items-center justify-center">'.$detailBtn.$editBtn.$deleteBtn.'</div>';
                    })
                    ->rawColumns(['status_badge', 'action', 'calculated_total_berat', 'calculated_total_poin'])
                    ->make(true);
            } catch (Exception $e) {
                \Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
            }
        }
        return response()->json(['error' => 'Invalid request.'], 400);
    }

    public function addSetorSampah(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(),[
                'lokasi_penjemputan' => 'required|string|max:500',
                'waktu_penjemputan' => 'required|date',
                'catatan' => 'nullable|string|max:1000',
                'metode_setor' => 'required|in:Dijemput,Setor Langsung',
                'id_bank_sampah' => 'required|exists:bank_sampah,id_bank_sampah',
                'id_pengguna' => 'required|exists:pengguna,id_pengguna',
                'detail_sampah' => 'required|array|min:1',
                'detail_sampah.*.id_sampah' => 'required|exists:sampah,id_sampah',
                'detail_sampah.*.berat_kg' => 'required|numeric|min:0.01',
            ],
            [
                'lokasi_penjemputan.required' => 'Lokasi penjemputan tidak boleh kosong!',
                'waktu_penjemputan.required' => 'Waktu penjemputan/pengantaran tidak boleh kosong!',
                'metode_setor.required' => 'Metode setor tidak boleh kosong!',
                'id_bank_sampah.required' => 'Bank sampah tidak boleh kosong!',
                'id_pengguna.required' => 'Pengguna tidak boleh kosong!',
                'detail_sampah.required' => 'Detail sampah tidak boleh kosong!',
                'detail_sampah.min' => 'Minimal harus ada 1 jenis sampah!',
                'detail_sampah.*.id_sampah.required' => 'Jenis sampah harus dipilih!',
                'detail_sampah.*.berat_kg.required' => 'Berat sampah tidak boleh kosong!',
                'detail_sampah.*.berat_kg.min' => 'Berat sampah minimal 0.01 kg!',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Validasi gagal, periksa kembali input Anda.');
            }

            $lastId = $this->setorSampahModel->orderBy('id_setor', 'desc')->first();
            $newId = 'ST001';
            if ($lastId) {
                $lastIdNum = intval(substr($lastId->id_setor, 2));
                $newIdNum = $lastIdNum + 1;
                $newId = 'ST' . Str::padLeft($newIdNum, 3, '0');
            }
            

            $kodeVerifikasi = strtoupper(substr(md5(uniqid((string)rand(), true)), 0, 8));

            // Format waktu penjemputan
            $waktuPenjemputan = $request->input('waktu_penjemputan');
            if (strpos($waktuPenjemputan, 'T') !== false) {
                $waktuPenjemputan = Carbon::createFromFormat('Y-m-d\TH:i', $waktuPenjemputan)->format('Y-m-d H:i:s');
            } else {
                $waktuPenjemputan = Carbon::parse($waktuPenjemputan)->format('Y-m-d H:i:s');
            }

            // Buat setor sampah dengan total 0 dulu
            $setorSampah = $this->setorSampahModel->create([
                'id_setor' => $newId,
                'waktu_setor' => now(),
                'total_berat' => 0,  // Set 0 dulu, akan dihitung otomatis
                'total_poin' => 0,   // Set 0 dulu, akan dihitung otomatis
                'lokasi_penjemputan' => $request->input('lokasi_penjemputan'),
                'waktu_penjemputan' => $waktuPenjemputan,
                'kode_verifikasi' => $kodeVerifikasi,
                'status_verifikasi' => false,
                'status_setor' => 'Menunggu Konfirmasi',
                'metode_setor' => $request->input('metode_setor'),
                'catatan' => $request->input('catatan'),
                'id_bank_sampah' => $request->input('id_bank_sampah'),
                'id_pengguna' => $request->input('id_pengguna'),
            ]);

            // Buat detail sampah
            
            foreach ($request->detail_sampah as $index => $detail) {
                $detailId = $newId . Str::padLeft($index + 1, 2, '0');
                $this->detailSetorSampahModel->create([
                    'id_detail' => $detailId,
                    'berat_kg' => $detail['berat_kg'],
                    'id_setor' => $newId,
                    'id_sampah' => $detail['id_sampah'],
                ]);
            }

            usleep(100000); // 0.1 detik

            // Update total berat dan poin berdasarkan detail yang sudah disimpan
            $setorSampah->updateTotals();

            // TAMBAHAN: Verifikasi bahwa totals sudah terupdate
            $setorSampah->refresh(); // Refresh dari database
            $finalTotalBerat = $setorSampah->total_berat;
            $finalTotalPoin = $setorSampah->total_poin;

            \Log::info("Final totals after update - ID: {$newId}, Berat: {$finalTotalBerat}, Poin: {$finalTotalPoin}");

            DB::commit();
            return redirect()->route('riwayat-setor-sampah')->with("success", "Data setor sampah berhasil disimpan! Kode verifikasi: " . $kodeVerifikasi . " (Total: {$finalTotalBerat} kg, {$finalTotalPoin} poin)");
            
        } catch (Exception $e) {
            DB::rollback();
            \Log::error('Add setor sampah error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with("error", "Gagal menyimpan data: " . $e->getMessage());
        }
    }

    public function refreshTotals($id)
    {
        try {
            $setorSampah = $this->setorSampahModel->find($id);
            if (!$setorSampah) {
                return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
            }

            $setorSampah->updateTotals();
            $setorSampah->refresh();

            return response()->json([
                'success' => true, 
                'message' => 'Totals berhasil diperbarui',
                'data' => [
                    'total_berat' => $setorSampah->total_berat,
                    'total_poin' => $setorSampah->total_poin
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function editSetorSampah(Request $request, $id)
    {
        if ($request->isMethod('put') || $request->isMethod('patch')) {
            DB::beginTransaction();
            try {
                $validator = Validator::make($request->all(), [
                    'lokasi_penjemputan' => 'required|string|max:500',
                    'waktu_penjemputan' => 'required|date',
                    'status_setor' => 'required|in:Menunggu Konfirmasi,Di Proses,Dijemput,Selesai,Dibatalkan',
                    'status_verifikasi' => 'nullable|in:belum_verifikasi,terverifikasi',
                    'metode_setor' => 'required|in:Dijemput,Setor Langsung',
                    'catatan' => 'nullable|string|max:1000',
                    'id_bank_sampah' => 'required|exists:bank_sampah,id_bank_sampah',
                    'id_pengguna' => 'required|exists:pengguna,id_pengguna',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Validasi gagal.');
                }

                $setorSampah = $this->setorSampahModel->find($id);
                if (!$setorSampah) {
                    return redirect()->route('riwayat-setor-sampah')->with("error", "Data setor sampah tidak ditemukan!");
                }

                

                $dataUpdate = $request->only([
                    'lokasi_penjemputan', 'status_setor',
                    'metode_setor', 'catatan', 'id_bank_sampah', 'id_pengguna'
                ]);

                // Format waktu penjemputan untuk update
                $waktuPenjemputan = $request->input('waktu_penjemputan');
                if (strpos($waktuPenjemputan, 'T') !== false) {
                    $dataUpdate['waktu_penjemputan'] = Carbon::createFromFormat('Y-m-d\TH:i', $waktuPenjemputan)->format('Y-m-d H:i:s');
                } else {
                    $dataUpdate['waktu_penjemputan'] = Carbon::parse($waktuPenjemputan)->format('Y-m-d H:i:s');
                }

                if ($request->filled('status_verifikasi')) {
                    $dataUpdate['status_verifikasi'] = $request->input('status_verifikasi');
                }

                $setorSampah->update($dataUpdate);

                if ($request->has('recalculate_totals') || 
                    $request->has('detail_sampah_changed')) {
                    $setorSampah->updateTotals();
                }

                DB::commit();
                return redirect()->route('riwayat-setor-sampah')->with("success", "Data setor sampah berhasil diperbarui!");
            } catch (Exception $e) {
                DB::rollback();
                \Log::error('Edit setor sampah error: ' . $e->getMessage());
                return redirect()->back()->withInput()->with("error", "Gagal memperbarui data: " . $e->getMessage());
            }
        } else {
            $setorSampah = $this->setorSampahModel->with(['detailSetor.sampah', 'pengguna', 'bankSampah'])->find($id);
            if (!$setorSampah) {
                return redirect()->route('riwayat-setor-sampah')->with("error", "Data setor sampah tidak ditemukan!");
            }
            $bank_sampah_list = $this->bankSampahModel->orderBy('nama_bank_sampah')->get();
            $pengguna_list = $this->penggunaModel->orderBy('nama_lengkap')->get();
            $sampah_list = $this->sampahModel->orderBy('nama_sampah')->get();

            return redirect()->route('riwayat-setor-sampah')->with("info", "Halaman edit belum diimplementasikan. ID: " . $id);
        }
    }

    public function deleteSetorSampah($id = null)
    {
        DB::beginTransaction();
        try {
            if (!$id) {
                return redirect()->route('riwayat-setor-sampah')->with("error", "ID setor sampah tidak valid!");
            }

            $setorSampah = $this->setorSampahModel->find($id);
            if (!$setorSampah) {
                return redirect()->route('riwayat-setor-sampah')->with("error", "Data setor sampah tidak ditemukan!");
            }

            $this->detailSetorSampahModel->where('id_setor', $id)->delete();
            $setorSampah->delete();

            DB::commit();
            return redirect()->route('riwayat-setor-sampah')->with("success", "Data setor sampah berhasil dihapus!");
        } catch (Exception $e) {
            DB::rollback();
            \Log::error('Delete setor sampah error: ' . $e->getMessage());
            return redirect()->route('riwayat-setor-sampah')->with("error", "Gagal menghapus data: " . $e->getMessage());
        }
    }

    public function getDetailSetorSampah($id = null)
    {
        try {
            if (!$id) {
                return response()->json(['success' => false, 'message' => 'ID setor sampah tidak ditemukan!'], 400);
            }

            $setorSampah = $this->setorSampahModel
                ->with(['bankSampah', 'pengguna'])
                ->where('id_setor', $id)
                ->first();

            if (!$setorSampah) {
                return response()->json(['success' => false, 'message' => 'Data setor sampah tidak ditemukan!'], 404);
            }
            
            $setorSampah->waktu_setor_formatted = date('d/m/Y H:i', strtotime($setorSampah->waktu_setor));
            $setorSampah->waktu_penjemputan_formatted = $setorSampah->waktu_penjemputan ? date('d/m/Y H:i', strtotime($setorSampah->waktu_penjemputan)) : '-';

            $detailSetor = $this->detailSetorSampahModel
                ->with(['sampah'])
                ->where('id_setor', $id)
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'setor_sampah' => $setorSampah,
                    'detail_setor' => $detailSetor
                ]
            ]);
        } catch (Exception $e) {
            \Log::error('Get detail setor sampah error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal memuat detail: ' . $e->getMessage()], 500);
        }
    }

    public function updateStatusSetor(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_setor' => 'required|exists:setor_sampah,id_setor',
                'status_setor' => 'required|in:Menunggu Konfirmasi, Di Proses,Dijemput,Selesai,Dibatalkan',
            ]);

            $updateStatus = $this->setorSampahModel
                ->where('id_setor', $validated['id_setor'])
                ->update(['status_setor' => $validated['status_setor']]);

            if ($updateStatus) {
                return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui!']);
            }
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status!'], 400);
        } catch (Exception $e) {
            \Log::error('Update status setor error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    public function updateStatusVerifikasi(Request $request)
    {
         try {
            $validated = $request->validate([
                'id_setor' => 'required|exists:setor_sampah,id_setor',
                'status_verifikasi' => 'required|in:belum_verifikasi,terverifikasi',
            ]);

            $updateStatus = $this->setorSampahModel
                ->where('id_setor', $validated['id_setor'])
                ->update(['status_verifikasi' => $validated['status_verifikasi']]);

            if ($updateStatus) {
                return response()->json(['success' => true, 'message' => 'Status verifikasi berhasil diperbarui!']);
            }
            return response()->json(['success' => false,'message' => 'Gagal memperbarui status verifikasi!'], 400);
        } catch (Exception $e) {
            \Log::error('Update status verifikasi error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }


}


