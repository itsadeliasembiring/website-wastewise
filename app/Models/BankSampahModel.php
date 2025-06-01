<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankSampahModel extends Model
{
    protected $table = 'bank_sampah';
    protected $primaryKey = 'id_bank_sampah';
    public $incrementing = false; // karena primary key-nya bukan auto-increment
    protected $keyType = 'string'; // karena 'id_bank_sampah' bertipe char/string
    public $timestamps = false; // karena tidak ada kolom created_at dan updated_at

    protected $fillable = [
        'id_bank_sampah',
        'nama_bank_sampah',
        'tanggal_berdiri',
        'nomor_telepon',
        'surat_legalitas',
        'foto',
        'detail_alamat',
        'id_kelurahan',
        'kontak',
        'id_akun'
    ];

    // Relasi dengan model Akun
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }

    // Relasi dengan model Kelurahan
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }

    // Relasi ke model SetorSampah
    public function SetorSampah()
    {
        return $this->hasMany(SetorSampahModel::class, 'id_bank_sampah', 'id_bank_sampah');
    }
}

