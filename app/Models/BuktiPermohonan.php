<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPermohonan extends Model
{
    use HasFactory;

    protected $fillable = ['pemohon_id','dokumen_standar_teknis','bukti_kepemilikan','bukti_kesesuaian_tata_letak','foto_kondisi_lokasi'];

    public function pemohon(){
        return $this->belongsTo(PengajuanPermohonan::class, 'pemohon_id');
    }
}
