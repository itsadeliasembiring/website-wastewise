<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampahModel extends Model
{
    // Nama tabel
    protected $table = 'sampah';

    // Primary key
    protected $primaryKey = 'id_sampah';

    // Tipe primary key
    protected $keyType = 'string';

    // Primary key bukan auto increment
    public $incrementing = false;

    // Tidak pakai timestamps
    public $timestamps = false;

    // Field yang bisa diisi
    protected $fillable = [
        'id_sampah',
        'nama_sampah',
        'detail_ciri',
        'detail_manfaat',
        'bobot_poin',
        'foto',
        'jenis_sampah',
    ];

    // Relasi ke model JenisSampahModel
    public function jenisSampah()
    {
        return $this->belongsTo(JenisSampahModel::class, 'jenis_sampah', 'id_jenis_sampah');
    }

    public function sampah()
    {
        return $this->hasMany(SampahModel::class, 'jenis_sampah', 'id_jenis_sampah');
    }
}
