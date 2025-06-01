<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSetorSampahModel extends Model
{
    protected $table = 'detail_setor';
    protected $primaryKey = 'id_detail';
    public $incrementing = false; // karena id_detail bukan auto-increment
    public $timestamps = false; // karena tidak ada created_at dan updated_at

    protected $fillable = [
        'id_detail',
        'berat_kg',
        'id_setor',
        'id_sampah',
    ];

    // Relasi ke model SetorSampahModel
    public function setorSampah()
    {
        return $this->belongsTo(SetorSampahModel::class, 'id_setor', 'id_setor');
    }

    // Relasi ke model Sampah
    public function sampah()
    {
        return $this->belongsTo(SampahModel::class, 'id_sampah', 'id_sampah');
    }
}
