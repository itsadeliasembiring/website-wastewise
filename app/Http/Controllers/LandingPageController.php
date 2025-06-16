<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;
use Yajra\DataTables\DataTables;
use App\Models\ArtikelModel;

class LandingPageController extends Controller
{
    protected $ArtikelModel;

    public function __construct()
    {
        $this->ArtikelModel = new ArtikelModel();
    }

    public function index()
    {
        try {
            // Ambil 3 artikel terbaru untuk ditampilkan di beranda
            $artikel = $this->ArtikelModel->orderBy('created_at', 'desc')->limit(3)->get();
            
            return view('landing-page.landing-page', [
                'artikel' => $artikel
            ]);

        } catch (Exception $e) {
            \Log::error('Landing page error: ' . $e->getMessage());
            return view('landing-page.landing-page', [
                'artikel' => collect([]) // Empty collection jika error
            ]);
        }
    }

    public function daftarArtikel(Request $request)
    {
        try {
            $query = $this->ArtikelModel->orderBy('created_at', 'desc');

            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('judul_artikel', 'like', '%' . $search . '%')
                      ->orWhere('detail_artikel', 'like', '%' . $search . '%')
                      ->orWhere('kategori_artikel', 'like', '%' . $search . '%');
                });
            }

            // Pagination
            $artikel = $query->paginate(6); // 6 artikel per halaman

            return view('landing-page.daftar-artikel', [
                'artikel' => $artikel,
                'search' => $request->search
            ]);

        } catch (Exception $e) {
            \Log::error('Daftar artikel error: ' . $e->getMessage());
            return view('landing-page.daftar-artikel', [
                'artikel' => $this->ArtikelModel->paginate(6),
                'search' => $request->search ?? ''
            ]);
        }
    }

    public function detailArtikelPengguna($id)
    {
        try {
            $artikel = $this->ArtikelModel->where('id_artikel', $id)->first();
            
            if (!$artikel) {
                return redirect()->route('beranda')->with('error', 'Artikel tidak ditemukan!');
            }

            // Ambil 2 artikel lainnya untuk "Baca Artikel Lainnya" (exclude artikel saat ini)
            $artikelLainnya = $this->ArtikelModel
                ->where('id_artikel', '!=', $id)
                ->orderBy('created_at', 'desc')
                ->limit(2)
                ->get();

            return view('landing-page.detail-artikel', [
                'artikel' => $artikel,
                'artikelLainnya' => $artikelLainnya
            ]);

        } catch (Exception $e) {
            \Log::error('Detail artikel pengguna error: ' . $e->getMessage());
            return redirect()->route('beranda')->with('error', 'Gagal menampilkan detail artikel!');
        }
    }

    public function tentangKami()
    {
        return view('landing-page.tentang-kami');
    }
    
    public function detailLayanan()
    {
        return view('landing-page.detail-layanan');
    }

}