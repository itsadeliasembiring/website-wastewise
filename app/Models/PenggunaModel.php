<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'id_pengguna',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'nomor_telepon',
        'total_poin',
        'foto',
        'detail_alamat',
        'id_akun',
        'id_kelurahan',
        'updated_at',
        'created_at',
    ];

    // Relasi ke tabel akun
    public function akun(): BelongsTo
    {
        return $this->belongsTo(AkunModel::class, 'id_akun', 'id_akun');
    }

    // Relasi ke tabel kelurahan
    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(KelurahanModel::class, 'id_kelurahan', 'id_kelurahan');
    }
    
    public function penukaranDonasi()
    {
        return $this->hasMany(PenukaranDonasiModel::class, 'id_pengguna', 'id_pengguna');
    }
    public function penukaranBarang()
    {
        return $this->hasMany(PenukaranBarangModel::class, 'id_pengguna', 'id_pengguna');
    }
    
}
