<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SetorSampahModel extends Model
{
    protected $table = 'setor_sampah';
    protected $primaryKey = 'id_setor';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_setor',
        'waktu_setor',
        'total_berat',
        'total_poin',
        'lokasi_penjemputan',
        'waktu_penjemputan',
        'kode_verifikasi',
        'status_verifikasi',
        'status_setor',
        'metode_setor',
        'catatan',
        'id_bank_sampah',
        'id_pengguna',
    ];

    // Append calculated totals to model attributes
    protected $appends = ['calculated_total_berat', 'calculated_total_poin'];

    // Relasi ke model BankSampah
    public function bankSampah()
    {
        return $this->belongsTo(BankSampahModel::class, 'id_bank_sampah', 'id_bank_sampah');
    }

    // Relasi ke model Pengguna
    public function pengguna()
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'id_pengguna');
    }

    // Relasi ke model DetailSetorSampah
    public function detailSetorSampah()
    {
        return $this->hasMany(DetailSetorSampahModel::class, 'id_setor', 'id_setor');
    }

    // Alias untuk relasi (untuk backward compatibility)
    public function detailSetor()
    {
        return $this->detailSetorSampah();
    }

    // Accessor untuk menghitung total berat dari detail
    public function getCalculatedTotalBeratAttribute()
    {
        return $this->detailSetorSampah()->sum('berat_kg');
    }

    // Accessor untuk menghitung total poin dari detail
    public function getCalculatedTotalPoinAttribute()
    {
        return $this->detailSetorSampah()
            ->join('sampah', 'detail_setor.id_sampah', '=', 'sampah.id_sampah')
            ->selectRaw('SUM(detail_setor.berat_kg * sampah.bobot_poin) as total_poin')
            ->value('total_poin') ?? 0;
    }

    // Method untuk update total berat dan poin berdasarkan detail - FIXED VERSION
    public function updateTotals()
    {
        try {
            // Hitung total berat langsung dari database untuk akurasi
            $totalBerat = DB::table('detail_setor')
                ->where('id_setor', $this->id_setor)
                ->sum('berat_kg') ?? 0;
            
            // Hitung total poin dengan join ke tabel sampah
            $totalPoin = DB::table('detail_setor')
                ->join('sampah', 'detail_setor.id_sampah', '=', 'sampah.id_sampah')
                ->where('detail_setor.id_setor', $this->id_setor)
                ->selectRaw('SUM(detail_setor.berat_kg * sampah.bobot_poin) as total_poin')
                ->value('total_poin') ?? 0;

            // Update ke database dengan menggunakan DB::table untuk memastikan update
            $updated = DB::table('setor_sampah')
                ->where('id_setor', $this->id_setor)
                ->update([
                    'total_berat' => $totalBerat,
                    'total_poin' => $totalPoin
                ]);

            // Update juga attribut model instance ini
            $this->total_berat = $totalBerat;
            $this->total_poin = $totalPoin;

            \Log::info("Updated totals for setor_sampah {$this->id_setor}: berat={$totalBerat}, poin={$totalPoin}, affected_rows={$updated}");

            return $this;
            
        } catch (\Exception $e) {
            \Log::error('Error updating totals for setor_sampah ' . $this->id_setor . ': ' . $e->getMessage());
            return $this;
        }
    }

    // Method alternatif menggunakan Eloquent (jika DB::table tidak diinginkan)
    public function updateTotalsEloquent()
    {
        try {
            $totalBerat = $this->detailSetorSampah()->sum('berat_kg') ?? 0;
            
            $totalPoin = $this->detailSetorSampah()
                ->join('sampah', 'detail_setor.id_sampah', '=', 'sampah.id_sampah')
                ->selectRaw('SUM(detail_setor.berat_kg * sampah.bobot_poin) as total_poin')
                ->value('total_poin') ?? 0;

            // Gunakan updateQuietly untuk menghindari trigger event
            $this->updateQuietly([
                'total_berat' => $totalBerat,
                'total_poin' => $totalPoin
            ]);

            return $this;
            
        } catch (\Exception $e) {
            \Log::error('Error updating totals (eloquent) for setor_sampah ' . $this->id_setor . ': ' . $e->getMessage());
            return $this;
        }
    }

    // Scope untuk mengambil data dengan calculated totals
    public function scopeWithCalculatedTotals($query)
    {
        return $query->selectRaw('
            setor_sampah.*,
            COALESCE(SUM(detail_setor.berat_kg), 0) as calculated_total_berat,
            COALESCE(SUM(detail_setor.berat_kg * sampah.bobot_poin), 0) as calculated_total_poin
        ')
        ->leftJoin('detail_setor', 'setor_sampah.id_setor', '=', 'detail_setor.id_setor')
        ->leftJoin('sampah', 'detail_setor.id_sampah', '=', 'sampah.id_sampah')
        ->groupBy('setor_sampah.id_setor');
    }

    // Method untuk refresh totals secara manual (bisa dipanggil dari controller)
    public static function refreshTotalsForId($idSetor)
    {
        $setorSampah = static::find($idSetor);
        if ($setorSampah) {
            return $setorSampah->updateTotals();
        }
        return null;
    }
}