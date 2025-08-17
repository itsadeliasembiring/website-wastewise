<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelurahanModel extends Model
{
    // Nama tabel
    protected $table = 'kelurahan';

    // Primary key
    protected $primaryKey = 'id_kelurahan';

    // Primary key bukan auto-increment
    public $incrementing = false;

    // Tipe primary key adalah string
    protected $keyType = 'string';

    // Timestamps dimatikan
    public $timestamps = false;

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_kelurahan',
        'nama_kelurahan',
        'kode_pos',
        'id_kecamatan',
    ];

    // Relasi ke model Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(KecamatanModel::class, 'id_kecamatan', 'id_kecamatan');
    }

    public function kelurahan()
    {
        return $this->hasMany(PenggunaModel::class, 'id_kelurahan', 'id_kelurahan');
    }

    public function bankSampah()
    {
        return $this->hasMany(BankSampahModel::class, 'id_kelurahan', 'id_kelurahan');
    }
}
