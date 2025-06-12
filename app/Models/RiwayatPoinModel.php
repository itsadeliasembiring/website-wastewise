<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPoinModel extends Model
{
    protected $table = 'riwayat_poin';
    protected $primaryKey = 'id_riwayat';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_riwayat',
        'waktu',
        'jenis_perubahan',
        'jumlah_poin',
        'id_pengguna',
    ];

    public function pengguna()
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'id_pengguna');
    }
}
