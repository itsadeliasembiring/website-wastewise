<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BarangModel;

class PenukaranBarangModel extends Model
{
    // Nama tabel
    protected $table = 'penukaran_barang';

    // Primary key
    protected $primaryKey = 'id_penukaran_barang';

    // Karena primary key bertipe char (string) dan bukan auto-increment
    public $incrementing = false;
    protected $keyType = 'string';

    // Nonaktifkan timestamps
    public $timestamps = false;

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_penukaran_barang',
        'waktu',
        'jumlah_poin',
        'kode_redeem',
        'id_barang',
        'id_pengguna',
        'status_redeem',
    ];

    // Relasi
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'id_barang', 'id_barang');
    }

    public function pengguna()
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'id_pengguna');
    }
}
