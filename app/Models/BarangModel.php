<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PenukaranBarangModel;

class BarangModel extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'barang';

    // Primary key dari tabel
    protected $primaryKey = 'id_barang';

    // Karena primary key bukan auto increment dan bukan integer
    public $incrementing = false;
    protected $keyType = 'string';

    // Menonaktifkan timestamps (created_at & updated_at)
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_barang',
        'nama_barang',
        'bobot_poin',
        'stok',
        'foto',
        'deskripsi_barang',
    ];

    public function penukaranBarang()
    {
        return $this->hasMany(PenukaranBarangModel::class, 'id_barang', 'id_barang');
    }
}
