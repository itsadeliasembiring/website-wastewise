<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSetorSampahModel extends Model
{
    protected $table = 'detail_setor';
    protected $primaryKey = 'id_detail';
    public $incrementing = false;
    public $timestamps = false;

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

    // Event listeners untuk auto-update parent totals
    protected static function boot()
    {
        parent::boot();

        // Ketika detail dibuat
        static::created(function ($detail) {
            // Delay sedikit untuk memastikan data tersimpan
            static::updateParentTotals($detail->id_setor);
        });

        // Ketika detail diupdate
        static::updated(function ($detail) {
            static::updateParentTotals($detail->id_setor);
            
            // Jika id_setor berubah, update juga setor sampah yang lama
            if ($detail->isDirty('id_setor')) {
                $originalIdSetor = $detail->getOriginal('id_setor');
                if ($originalIdSetor) {
                    static::updateParentTotals($originalIdSetor);
                }
            }
        });

        // Ketika detail dihapus
        static::deleted(function ($detail) {
            static::updateParentTotals($detail->id_setor);
        });
    }

    // Static method untuk update total pada parent (setor sampah)
    protected static function updateParentTotals($idSetor)
    {
        if (!$idSetor) return;
        
        try {
            $setorSampah = SetorSampahModel::find($idSetor);
            if ($setorSampah) {
                $setorSampah->updateTotals();
            }
        } catch (\Exception $e) {
            \Log::error('Error updating parent totals for id_setor: ' . $idSetor . ' - ' . $e->getMessage());
        }
    }

    // Instance method untuk update parent totals (untuk backward compatibility)
    public function refreshParentTotals()
    {
        static::updateParentTotals($this->id_setor);
    }
}