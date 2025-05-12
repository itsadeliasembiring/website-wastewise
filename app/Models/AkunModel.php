<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AkunModel extends Authenticatable
{
    protected $table = 'akun';
    protected $primaryKey = 'id_akun'; 
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom-kolom yang bisa diisi (fillable)
    protected $fillable = [
        'id_akun',
        'id_level',
        'email',
        'password',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function level_akun()
    {
        return $this->belongsTo(LevelAkunModel::class, 'id_level', 'id_level');
    }
}
