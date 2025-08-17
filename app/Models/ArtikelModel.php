<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtikelModel extends Model
{
    // Nama tabel
    protected $table = 'artikel';

    // Primary key custom
    protected $primaryKey = 'id_artikel';

    // Tipe primary key bukan incrementing dan bukan integer
    public $incrementing = false;
    protected $keyType = 'string';

    // Tidak memakai timestamps
    public $timestamps = false;

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'id_artikel',
        'judul_artikel',
        'detail_artikel',
        'foto',
        'created_at',
        'updated_at',
        // 'penulis_artikel', // jika kolom ini nanti diaktifkan
    ];
}
