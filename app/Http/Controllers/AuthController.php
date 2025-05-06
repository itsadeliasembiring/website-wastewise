<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun; 

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('beranda-edukasi');
        }

        return view('auth/login');
    }

    public function authenticating(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
        ]);
        
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Log authentication attempt
        Log::info('Attempting authentication for: ' . $request->email);
        
        if(Auth::attempt($credentials)){
            // Log successful authentication
            Log::info('Authentication successful for: ' . $request->email);
            
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Log user level
            Log::info('User level: ' . $user->id_level);
            
            if($user->id_level == 1) {
                Log::info('Redirecting to dashboard-admin');
                return redirect()->intended(route('dashboard-admin'))->with('success', 'Login Berhasil');
            } else if($user->id_level == 2) {
                Log::info('Redirecting to kelola-bank-sampah');
                return redirect()->intended(route('kelola-bank-sampah'))->with('success', 'Login Berhasil');
            } else {
                Log::info('Redirecting to beranda-edukasi');
                return redirect()->intended(route('beranda-edukasi'))->with('success', 'Login Berhasil');
            }
        } else {
            // Log failed authentication
            Log::warning('Authentication failed for: ' . $request->email);
            
            return redirect()->route('login')
                ->withInput($request->only('email'))
                ->with('error', 'Email atau password salah');
        }   
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('landing-page')->with('success', 'Logout Berhasil');
    }
}