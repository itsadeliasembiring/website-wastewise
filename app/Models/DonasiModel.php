<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PenukaranDonasiModel;

class DonasiModel extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'donasi';

    // Primary key tabel
    protected $primaryKey = 'id_donasi';

    // Tipe primary key bukan auto-increment
    public $incrementing = false;

    // Tipe data primary key adalah string
    protected $keyType = 'string';

    // Kolom-kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'id_donasi',
        'nama_donasi',
        'deskripsi_donasi',
        'total_donasi',
        'foto',
    ];

    // Jika tidak memakai timestamps (created_at & updated_at)
    public $timestamps = false;

    public function penukaranDonasi()
    {
        return $this->hasMany(PenukaranDonasiModel::class, 'id_donasi', 'id_donasi');
    }

    public function getTotalDonasiCalculatedAttribute()
    {
        return $this->penukaranDonasi()->sum('jumlah_poin');
    }
}
