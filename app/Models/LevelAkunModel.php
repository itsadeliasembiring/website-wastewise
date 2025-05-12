<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelAkunModel extends Model
{
    protected $table = 'level_akun';     
    protected $primaryKey = 'id_level';   
    public $incrementing = false;           
    protected $keyType = 'string';         
    public $timestamps = false;             

    protected $fillable = [
        'id_level',
        'nama_level',
    ];

    // Relasi ke tabel akun (jika dibutuhkan)
    public function akun()
    {
        return $this->hasMany(AkunModel::class, 'id_level', 'id_level');
    }
}
