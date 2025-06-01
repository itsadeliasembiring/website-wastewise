<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\SampahModel;
use App\Models\JenisSampahModel;

class SampahController extends Controller
{
    protected $SampahModel;
    protected $JenisSampahModel;

    public function __construct()
    {
        $this->SampahModel = new SampahModel;
        $this->JenisSampahModel = new JenisSampahModel;
    }
    
    public function kelolaSampah(Request $request)
    {
        $sampah = $this->SampahModel::query()
        ->join('jenis_sampah', 'sampah.jenis_sampah', '=', 'jenis_sampah.id_jenis_sampah')
        ->with(['jenisSampah'])
        ->get();

        $jenis_sampah = $this->JenisSampahModel->get();

        return view("admin/kelola-sampah", ['sampah' => $sampah, 'jenis_sampah' => $jenis_sampah]);
    }

    public function sampahData(Request $request)
    {
        if(request()->ajax()) {
            $sampah = $this->SampahModel::query()
                    ->join('jenis_sampah', 'sampah.jenis_sampah', '=', 'jenis_sampah.id_jenis_sampah')
                    ->select('sampah.*', 'jenis_sampah.nama_jenis_sampah')
                    ->with(['jenisSampah']);

            // Filter berdasarkan jenis sampah
            if(!empty($request->jenis) && $request->jenis != 'all') {
                $sampah = $sampah->where('sampah.jenis_sampah', $request->jenis);
            }

            try {
                return Datatables::of($sampah)
                    ->addIndexColumn()
                    ->addColumn('foto', function($row) {
                        if($row->foto) {
                            return '<img src="'.asset('storage/sampah/'.$row->foto).'" alt="Foto Sampah" class="w-16 h-16 object-cover rounded">';
                        }
                        return '<span class="text-gray-400">Tidak ada foto</span>';
                    })
                    ->addColumn('action', function($row) {
                        return '
                            <div class="flex space-x-2 items-center justify-center">
                                <a href="#edit-sampah/'.$row->id_sampah.'" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a> 
                                <a href="#delete-sampah/'.$row->id_sampah.'" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                            ';
                    })
                    ->rawColumns(['foto', 'action'])
                    ->make(true);
            } catch (Exception $e) {
                // Log error for debugging
                \Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
    
    public function addSampah(Request $request)
    {
        try {
            request()->validate(
                [
                    'nama_sampah' => 'required|string|max:255',
                    'detail_ciri' => 'required|string',
                    'detail_manfaat' => 'required|string',
                    'bobot_poin' => 'required|numeric|min:0',
                    'jenis_sampah' => 'required|exists:jenis_sampah,id_jenis_sampah',
                    'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ],
                [
                    'nama_sampah.required' => 'Nama sampah tidak boleh kosong!',
                    'nama_sampah.max' => 'Nama sampah maksimal 255 karakter!',
                    'detail_ciri.required' => 'Detail ciri tidak boleh kosong!',
                    'detail_manfaat.required' => 'Detail manfaat tidak boleh kosong!',
                    'bobot_poin.required' => 'Bobot poin tidak boleh kosong!',
                    'bobot_poin.numeric' => 'Bobot poin harus berupa angka!',
                    'bobot_poin.min' => 'Bobot poin tidak boleh negatif!',
                    'jenis_sampah.required' => 'Jenis sampah tidak boleh kosong!',
                    'jenis_sampah.exists' => 'Jenis sampah tidak valid!',
                    'foto.image' => 'File harus berupa gambar!',
                    'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif!',
                    'foto.max' => 'Ukuran gambar maksimal 2MB!',
                ]
            );
            
            // Generate a unique 5-character id_sampah
            $lastId = $this->SampahModel->orderBy('id_sampah', 'desc')->first();
            $newId = 'S01';
            
            if ($lastId) {
                $lastIdNum = intval(substr($lastId->id_sampah, 1));
                $newIdNum = $lastIdNum + 1;
                $newId = 'S' . str_pad($newIdNum, 2, '0', STR_PAD_LEFT);
            }
            
            $fotoName = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('sampah', $fotoName, 'public');
            }
            
            $sampah = new SampahModel;
            $sampah->id_sampah = $newId;
            $sampah->nama_sampah = $request->input("nama_sampah");
            $sampah->detail_ciri = $request->input("detail_ciri");
            $sampah->detail_manfaat = $request->input("detail_manfaat");
            $sampah->bobot_poin = $request->input("bobot_poin");
            $sampah->jenis_sampah = $request->input("jenis_sampah");
            $sampah->foto = $fotoName;
            $sampah->save();
            
            return redirect()->back()->with("success", "Data sampah berhasil disimpan!");
        } catch (Exception $e) {
            \Log::error('Add sampah error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal menyimpan data: " . $e->getMessage());
        }
    }

    public function editSampah(Request $request)
    {
        try {
            request()->validate(
                [
                    'id_sampah' => 'required|exists:sampah,id_sampah',
                    'nama_sampah' => 'required|string|max:255',
                    'detail_ciri' => 'required|string',
                    'detail_manfaat' => 'required|string',
                    'bobot_poin' => 'required|numeric|min:0',
                    'jenis_sampah' => 'required|exists:jenis_sampah,id_jenis_sampah',
                    'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ],
                [
                    'id_sampah.required' => 'ID sampah tidak ditemukan!',
                    'id_sampah.exists' => 'ID sampah tidak valid!',
                    'nama_sampah.required' => 'Nama sampah tidak boleh kosong!',
                    'nama_sampah.max' => 'Nama sampah maksimal 255 karakter!',
                    'detail_ciri.required' => 'Detail ciri tidak boleh kosong!',
                    'detail_manfaat.required' => 'Detail manfaat tidak boleh kosong!',
                    'bobot_poin.required' => 'Bobot poin tidak boleh kosong!',
                    'bobot_poin.numeric' => 'Bobot poin harus berupa angka!',
                    'bobot_poin.min' => 'Bobot poin tidak boleh negatif!',
                    'jenis_sampah.required' => 'Jenis sampah tidak boleh kosong!',
                    'jenis_sampah.exists' => 'Jenis sampah tidak valid!',
                    'foto.image' => 'File harus berupa gambar!',
                    'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif!',
                    'foto.max' => 'Ukuran gambar maksimal 2MB!',
                ]
            );
            
            $sampah = $this->SampahModel->where('id_sampah', $request->input('id_sampah'))->first();
            
            if (!$sampah) {
                return redirect()->back()->with("error", "Data sampah tidak ditemukan!");
            }
            
            $fotoName = $sampah->foto; 
            
            if ($request->hasFile('foto')) {
                // Delete old photo if exists
                if ($sampah->foto && Storage::disk('public')->exists($sampah->foto)) {
                    Storage::disk('public')->delete($sampah->foto);
                }
                
                $foto = $request->file('foto');
                $fotoName = time() . '_' . $foto->getClientOriginalName();
                $foto->storeAs('sampah', $fotoName, 'public');
            }
            
            $datasampah = [
                'nama_sampah' => $request->input('nama_sampah'),
                'detail_ciri' => $request->input('detail_ciri'),
                'detail_manfaat' => $request->input('detail_manfaat'),
                'bobot_poin' => $request->input('bobot_poin'),
                'jenis_sampah' => $request->input('jenis_sampah'),
                'foto' => $fotoName
            ];
            
            $updateSampah = $this->SampahModel
                ->where('id_sampah', $request->input('id_sampah'))
                ->update($datasampah);
                
            if ($updateSampah) {
                return redirect()->back()->with("success", "Data sampah berhasil diperbarui!");
            }
            
            return redirect()->back()->with("error", "Tidak ada perubahan data!");
        } catch (Exception $e) {
            \Log::error('Edit sampah error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal memperbarui data: " . $e->getMessage());
        }
    }

    public function deleteSampah($id = null)
    {
        try {
            if (!$id) {
                return redirect()->back()->with("error", "ID sampah tidak ditemukan!");
            }
            
            $sampah = $this->SampahModel->where('id_sampah', $id)->first();
            
            if (!$sampah) {
                return redirect()->back()->with("error", "Data sampah tidak ditemukan!");
            }
            
            // Delete photo if exists
            if ($sampah->foto && \Storage::exists('public/sampah/' . $sampah->foto)) {
                \Storage::delete('public/sampah/' . $sampah->foto);
            }
            
            $hapus = $sampah->delete();
                
            if ($hapus) {
                return redirect()->back()->with("success", "Data sampah berhasil dihapus!");
            }
            
            return redirect()->back()->with("error", "Gagal menghapus data!");
        } catch (Exception $e) {
            \Log::error('Delete sampah error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal menghapus data: " . $e->getMessage());
        }
    }

    // JENIS SAMPAH METHODS
    public function addJenisSampah(Request $request)
    {
        try {
            request()->validate(
                [
                    'nama_jenis_sampah' => 'required|string|max:255',
                    'warna_tempat_sampah' => 'required|string|max:7', // hex color format
                ],
                [
                    'nama_jenis_sampah.required' => 'Nama jenis sampah tidak boleh kosong!',
                    'nama_jenis_sampah.max' => 'Nama jenis sampah maksimal 255 karakter!',
                    'warna_tempat_sampah.required' => 'Warna tempat sampah tidak boleh kosong!',
                    'warna_tempat_sampah.max' => 'Format warna tidak valid!',
                ]
            );
            
            // Generate a unique id_jenis_sampah
            $lastId = $this->JenisSampahModel->orderBy('id_jenis_sampah', 'desc')->first();
            $newId = 'J01';
            
            if ($lastId) {
                $lastIdNum = intval(substr($lastId->id_jenis_sampah, 2));
                $newIdNum = $lastIdNum + 1;
                $newId = 'J' . str_pad($newIdNum, 2, '0', STR_PAD_LEFT);
            }
            
            $jenisSampah = new JenisSampahModel;
            $jenisSampah->id_jenis_sampah = $newId;
            $jenisSampah->nama_jenis_sampah = $request->input("nama_jenis_sampah");
            $jenisSampah->warna_tempat_sampah = $request->input("warna_tempat_sampah");
            $jenisSampah->save();
            
            return redirect()->back()->with("success", "Data jenis sampah berhasil disimpan!");
        } catch (Exception $e) {
            \Log::error('Add jenis sampah error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal menyimpan data: " . $e->getMessage());
        }
    }

    public function editJenisSampah(Request $request)
    {
        try {
            request()->validate(
                [
                    'id_jenis_sampah' => 'required|exists:jenis_sampah,id_jenis_sampah',
                    'nama_jenis_sampah' => 'required|string|max:255',
                    'warna_tempat_sampah' => 'required|string|max:7',
                ],
                [
                    'id_jenis_sampah.required' => 'ID jenis sampah tidak ditemukan!',
                    'id_jenis_sampah.exists' => 'ID jenis sampah tidak valid!',
                    'nama_jenis_sampah.required' => 'Nama jenis sampah tidak boleh kosong!',
                    'nama_jenis_sampah.max' => 'Nama jenis sampah maksimal 255 karakter!',
                    'warna_tempat_sampah.required' => 'Warna tempat sampah tidak boleh kosong!',
                    'warna_tempat_sampah.max' => 'Format warna tidak valid!',
                ]
            );
            
            $jenisSampah = $this->JenisSampahModel->where('id_jenis_sampah', $request->input('id_jenis_sampah'))->first();
            
            if (!$jenisSampah) {
                return redirect()->back()->with("error", "Data jenis sampah tidak ditemukan!");
            }
            
            $dataJenisSampah = [
                'nama_jenis_sampah' => $request->input('nama_jenis_sampah'),
                'warna_tempat_sampah' => $request->input('warna_tempat_sampah'),
            ];
            
            $updateJenisSampah = $this->JenisSampahModel
                ->where('id_jenis_sampah', $request->input('id_jenis_sampah'))
                ->update($dataJenisSampah);
                
            if ($updateJenisSampah) {
                return redirect()->back()->with("success", "Data jenis sampah berhasil diperbarui!");
            }
            
            return redirect()->back()->with("error", "Tidak ada perubahan data!");
        } catch (Exception $e) {
            \Log::error('Edit jenis sampah error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal memperbarui data: " . $e->getMessage());
        }
    }

    public function deleteJenisSampah($id = null)
    {
        try {
            if (!$id) {
                return redirect()->back()->with("error", "ID jenis sampah tidak ditemukan!");
            }
            
            // Check if jenis sampah is being used by any sampah
            $sampahCount = $this->SampahModel->where('jenis_sampah', $id)->count();
            
            if ($sampahCount > 0) {
                return redirect()->back()->with("error", "Jenis sampah tidak dapat dihapus karena masih digunakan oleh {$sampahCount} data sampah!");
            }
            
            $jenisSampah = $this->JenisSampahModel->where('id_jenis_sampah', $id)->first();
            
            if (!$jenisSampah) {
                return redirect()->back()->with("error", "Data jenis sampah tidak ditemukan!");
            }
            
            $hapus = $jenisSampah->delete();
                
            if ($hapus) {
                return redirect()->back()->with("success", "Data jenis sampah berhasil dihapus!");
            }
            
            return redirect()->back()->with("error", "Gagal menghapus data!");
        } catch (Exception $e) {
            \Log::error('Delete jenis sampah error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal menghapus data: " . $e->getMessage());
        }
    }
}