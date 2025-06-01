<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSampahModel extends Model
{
    // Nama tabel
    protected $table = 'jenis_sampah';

    // Primary key
    protected $primaryKey = 'id_jenis_sampah';

    // Tipe primary key
    protected $keyType = 'string';

    // Primary key bukan auto increment
    public $incrementing = false;

    // Tidak pakai timestamps (created_at, updated_at)
    public $timestamps = false;

    // Field yang bisa diisi
    protected $fillable = [
        'id_jenis_sampah',
        'nama_jenis_sampah',
        'warna_tempat_sampah'
    ];
}
