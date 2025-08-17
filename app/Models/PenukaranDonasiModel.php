<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenukaranDonasiModel extends Model
{
    // Nama tabel
    protected $table = 'penukaran_donasi';

    // Primary key
    protected $primaryKey = 'id_penukaran_donasi';

    // Primary key bukan auto-increment
    public $incrementing = false;

    // Primary key bertipe string
    protected $keyType = 'string';

    // Tidak menggunakan timestamps
    public $timestamps = false;

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_penukaran_donasi',
        'waktu',
        'jumlah_poin',
        'id_donasi',
        'id_pengguna',
    ];

    // Relasi ke DonasiModel
    public function donasi()
    {
        return $this->belongsTo(DonasiModel::class, 'id_donasi', 'id_donasi');
    }

    // Relasi ke PenggunaModel (asumsinya kamu punya model ini)
    public function pengguna()
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'id_pengguna');
    }
}
