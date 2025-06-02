<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PenggunaModel;
use App\Models\AkunModel;
use App\Models\KelurahanModel;
use App\Models\KecamatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Seharusnya sudah ada, tapi pastikan
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log; // Tambahkan ini jika belum ada

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        $kecamatans = KecamatanModel::all();
        // Ambil kelurahans berdasarkan kecamatan yang dipilih pertama kali (jika ada old input)
        // atau biarkan kosong jika tidak ada old input kecamatan.
        // Ini akan ditangani oleh AJAX, jadi mengirim semua kelurahan di awal tidak efisien.
        // $kelurahans = KelurahanModel::all(); // Baris ini bisa dihapus atau dibiarkan jika ada fallback
        
        $kelurahans = collect(); // Inisialisasi sebagai koleksi kosong
        if (old('kecamatan')) {
            $kelurahans = KelurahanModel::where('id_kecamatan', old('kecamatan'))->get();
        }

        return view('auth.register', compact('kecamatans', 'kelurahans'));
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        // Validasi input
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Generate unique IDs
            $lastAkun = AkunModel::orderBy('id_akun', 'desc')->first();
            $newAkunId = 'U0001';
            if ($lastAkun) {
                $lastIdNum = intval(substr($lastAkun->id_akun, 1));
                $newIdNum = $lastIdNum + 1;
                $newAkunId = 'U' . str_pad($newIdNum, 4, '0', STR_PAD_LEFT);
            }
            
            $lastPengguna = PenggunaModel::orderBy('id_pengguna', 'desc')->first();
            $newPenggunaId = 'PG0001';
            if ($lastPengguna) {
                $lastIdNum = intval(substr($lastPengguna->id_pengguna, 2));
                $newIdNum = $lastIdNum + 1;
                $newPenggunaId = 'PG' . str_pad($newIdNum, 4, '0', STR_PAD_LEFT);
            }

            // Create akun first
            $akun = new AkunModel;
            $akun->id_akun = $newAkunId;
            $akun->email = $request->input("email");
            $akun->password = Hash::make($request->input("password")); // Gunakan Hash::make
            $akun->id_level = '3'; // Assuming level 3 is for customers
            $akun->email_verified_at = now();
            $akun->save();

            // Handle file upload
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                // Pastikan folder 'pengguna' ada di dalam 'storage/app/public/'
                // Dan Anda sudah menjalankan `php artisan storage:link`
                $fotoPath = $request->file('foto')->store('pengguna', 'public');
            }

            // Create pengguna
            $pengguna = new PenggunaModel;
            $pengguna->id_pengguna = $newPenggunaId;
            $pengguna->nama_lengkap = $request->input("nama");
            $pengguna->jenis_kelamin = $request->input("jenis-kelamin");
            $pengguna->tanggal_lahir = $request->input("tanggal-lahir");
            $pengguna->nomor_telepon = $request->input("nomor-telepon");
            $pengguna->total_poin = $request->input("total_poin", 0);
            $pengguna->foto = $fotoPath; // Simpan path foto atau null
            $pengguna->detail_alamat = $request->input("alamat-lengkap");
            $pengguna->id_akun = $newAkunId;
            $pengguna->id_kelurahan = $request->input("kelurahan");
            $pengguna->save();

            // Redirect with success message
            return redirect()->route('register') // Asumsi nama route untuk form registrasi adalah 'register'
                ->with('success', 'Registrasi berhasil! Akun Anda telah dibuat.')
                ->with('show_popup', true);

        } catch (Exception $e) {
            Log::error('Registration error: ' . $e->getMessage() . ' Stack Trace: ' . $e->getTraceAsString()); // Log lebih detail
            
            // Redirect back with error message
            return redirect()->back()
                ->with('error', 'Gagal melakukan registrasi: Terjadi kesalahan pada sistem. Silakan coba lagi nanti.') // Pesan error lebih umum untuk user
                // ->with('error', 'Gagal melakukan registrasi: ' . $e->getMessage()) // Baris ini bisa untuk debugging
                ->withInput();
        }
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'jenis-kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'tanggal-lahir' => ['required', 'date', 'before:today'],
            'alamat-lengkap' => ['required', 'string', 'max:500'],
            'kecamatan' => ['required', 'string', 'exists:kecamatan,id_kecamatan'], // Pastikan kecamatan ada di DB
            'kelurahan' => ['required', 'string', 'exists:kelurahan,id_kelurahan'], // Pastikan kelurahan ada di DB
            'nomor-telepon' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:akun,email'],
            'password' => ['required', 'string', 'min:8'],
            'konfirmasi-password' => ['required', 'string', 'same:password'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], // Validasi untuk foto
            'privacy_policy' => ['required'], // Tambahkan validasi untuk privacy policy
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'jenis-kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'tanggal-lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal-lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'alamat-lengkap.required' => 'Alamat lengkap wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib dipilih.',
            'kecamatan.exists' => 'Kecamatan tidak valid.',
            'kelurahan.required' => 'Kelurahan wajib dipilih.',
            'kelurahan.exists' => 'Kelurahan tidak valid.',
            'nomor-telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor-telepon.regex' => 'Format nomor telepon tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'konfirmasi-password.required' => 'Konfirmasi password wajib diisi.',
            'konfirmasi-password.same' => 'Konfirmasi password tidak cocok.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto.max' => 'Ukuran gambar maksimal 2MB.',
            'privacy_policy.required' => 'Anda harus menyetujui Kebijakan Privasi.', // Pesan untuk privacy policy
        ]);
    }

    /**
     * Get kelurahan by kecamatan (AJAX endpoint).
     */
    public function getKelurahanByKecamatan($kecamatanId)
    {
        // Tambahkan validasi untuk $kecamatanId jika perlu
        $kelurahans = KelurahanModel::where('id_kecamatan', $kecamatanId)->orderBy('nama_kelurahan', 'asc')->get();
        return response()->json($kelurahans);
    }
}