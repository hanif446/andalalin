<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPerusahaan extends Model
{
    use HasFactory;

    protected $fillable = ['pemohon_id','alamat_perusahaan','kecamatan_perusahaan','kota_perusahaan','provinsi_id', 'kode_pos_perusahaan'];

    public function pemohon(){
        return $this->belongsTo(PengajuanPermohonan::class, 'pemohon_id');
    }

    public function provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }
}
