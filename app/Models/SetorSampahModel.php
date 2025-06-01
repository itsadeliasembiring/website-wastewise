<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetorSampahModel extends Model
{
    protected $table = 'setor_sampah';
    protected $primaryKey = 'id_setor';
    public $incrementing = false; // Karena primary key-nya bukan auto-increment
    public $timestamps = false; // Karena tidak ada created_at dan updated_at

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
}
