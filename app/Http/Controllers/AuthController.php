<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AkunModel;
use App\Models\LevelAkunModel;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticating(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi'
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirect berdasarkan role
            if ($user->isAdmin()) {
                return redirect()->intended('/dashboard')->with('success', 'Selamat datang, Admin!');
            } elseif ($user->isPengguna()) {
                return redirect()->intended('/user/setor-sampah')->with('success', 'Selamat datang!');
            }
            
            // Default redirect jika role tidak dikenali
            return redirect()->intended('/')->with('success', 'Login berhasil!');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Anda telah berhasil logout!');
    }
}