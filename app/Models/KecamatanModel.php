<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KecamatanModel extends Model
{
    // Nama tabel
    protected $table = 'kecamatan';

    // Primary key
    protected $primaryKey = 'id_kecamatan';

    // Tipe primary key bukan auto-increment (karena 'char')
    public $incrementing = false;

    // Tipe data primary key
    protected $keyType = 'string';

    // Nonaktifkan timestamps
    public $timestamps = false;

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'id_kecamatan',
        'nama_kecamatan',
    ];

    public function kelurahan()
    {
        return $this->hasMany(KelurahanModel::class, 'id_kecamatan', 'id_kecamatan');
    }
}
