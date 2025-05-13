<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\AkunModel;
use App\Models\LevelAkunModel;

class AdminController extends Controller
{
    protected $AkunModel;
    protected $LevelAkunModel;

    public function __construct()
    {
        $this->LevelAkunModel = new LevelAkunModel;
        $this->AkunModel = new AkunModel;
    }
    
    public function kelolaAkun(Request $request)
    {
        $akun = $this->AkunModel::query()
        ->join('level_akun', 'akun.id_level', '=', 'level_akun.id_level')
        ->with(['level_akun'])
        ->get();

        $level_akun = $this->LevelAkunModel->get();

        return view("admin/kelola-akun", ['akun' => $akun, 'level_akun' => $level_akun]);
    }

    public function akunData(Request $request)
    {
        if(request()->ajax()) {
            $akun = $this->AkunModel::query()
                    ->join('level_akun', 'akun.id_level', '=', 'level_akun.id_level')
                    ->with(['level_akun']);

            // Fix for level filtering
            if(!empty($request->level) && $request->level != 'all') {
                $akun = $akun->where('akun.id_level', $request->level);
            } else {
                $akun = $akun->where(function($query) {
                    $query->where('akun.id_level', '1')
                          ->orWhere('akun.id_level', '2')
                          ->orWhere('akun.id_level', '3');
                });
            } 

            try {
                return Datatables::of($akun)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $iconEdit = asset("Assets/edit-icon.svg");
                        $iconDelete = asset("Assets/delete-icon.svg");
                        // coco lop u
                        return '
                            <div class="flex space-x-2 items-center justify-center">
                                <a href="#edit-akun/'.$row->id_akun.'" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a> 
                                <a href="#delete-akun/'.$row->id_akun.'" class="btn !bg-transparent p-0 !border-none !min-h-[19px] !h-[19px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                            ';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (Exception $e) {
                // Log error for debugging
                \Log::error('DataTables error: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
    
    public function addAkun(Request $request)
    {
        try {
            request()->validate(
                [
                    'email' => 'required|email|unique:akun,email',
                    'password' => 'required|min:6',
                    'id_level' => 'required|exists:level_akun,id_level',
                ],
                [
                    'email.required' => 'Email tidak boleh kosong!',
                    'email.email' => 'Format email tidak valid!',
                    'email.unique' => 'Email sudah terdaftar!',
                    'password.required' => 'Password tidak boleh kosong!',
                    'password.min' => 'Password minimal 6 karakter!',
                    'id_level.required' => 'Level akun tidak boleh kosong!',
                    'id_level.exists' => 'Level akun tidak valid!',
                ]
            );
            
            // Generate a unique 5-character id_akun
            $lastId = $this->AkunModel->orderBy('id_akun', 'desc')->first();
            $newId = 'U0001';
            
            if ($lastId) {
                $lastIdNum = intval(substr($lastId->id_akun, 1));
                $newIdNum = $lastIdNum + 1;
                $newId = 'U' . str_pad($newIdNum, 4, '0', STR_PAD_LEFT);
            }
            
            $akun = new AkunModel;
            $akun->id_akun = $newId;
            $akun->email_verified_at = now();   
            $akun->email = $request->input("email");
            $akun->password = bcrypt($request->input("password"));
            $akun->id_level = $request->input("id_level");
            $akun->save();
            
            return redirect()->back()->with("success", "Data berhasil disimpan!");
        } catch (Exception $e) {
            \Log::error('Add akun error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal menyimpan data: " . $e->getMessage());
        }
    }

    public function editAkun(Request $request)
    {
        try {
            request()->validate(
                [
                    'id_akun' => 'required|exists:akun,id_akun',
                    'email' => 'required|email',
                    'password' => 'required|min:6',
                    'id_level' => 'required|exists:level_akun,id_level',
                ],
                [
                    'id_akun.required' => 'ID akun tidak ditemukan!',
                    'id_akun.exists' => 'ID akun tidak valid!',
                    'email.required' => 'Email tidak boleh kosong!',
                    'email.email' => 'Format email tidak valid!',
                    'password.required' => 'Password tidak boleh kosong!',
                    'password.min' => 'Password minimal 6 karakter!',
                    'id_level.required' => 'Level akun tidak boleh kosong!',
                    'id_level.exists' => 'Level akun tidak valid!',
                ]
            );
            
            // Check if email is already used by other account
            $existingAccount = $this->AkunModel
                ->where('email', $request->input('email'))
                ->where('id_akun', '!=', $request->input('id_akun'))
                ->first();
                
            if ($existingAccount) {
                return redirect()->back()->with("error", "Email sudah digunakan oleh akun lain!");
            }
            
            $dataakun = [
                'email' => $request->input('email'),
                'password' => bcrypt($request->input("password")),
                'id_level' => $request->input('id_level')
            ];
            
            $updateAkun = $this->AkunModel
                ->where('id_akun', $request->input('id_akun'))
                ->update($dataakun);
                
            if ($updateAkun) {
                return redirect()->back()->with("success", "Data berhasil diperbarui!");
            }
            
            return redirect()->back()->with("error", "Tidak ada perubahan data!");
        } catch (Exception $e) {
            \Log::error('Edit akun error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal memperbarui data: " . $e->getMessage());
        }
    }

    public function deleteAkun($id = null)
    {
        try {
            if (!$id) {
                return redirect()->back()->with("error", "ID akun tidak ditemukan!");
            }
            
            $akun = $this->AkunModel->where('id_akun', $id)->first();
            
            if (!$akun) {
                return redirect()->back()->with("error", "Akun tidak ditemukan!");
            }
            
            $hapus = $akun->delete();
                
            if ($hapus) {
                return redirect()->back()->with("success", "Data berhasil dihapus!");
            }
            
            return redirect()->back()->with("error", "Gagal menghapus data!");
        } catch (Exception $e) {
            \Log::error('Delete akun error: ' . $e->getMessage());
            return redirect()->back()->with("error", "Gagal menghapus data: " . $e->getMessage());
        }
    }
}