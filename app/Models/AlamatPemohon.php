<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPemohon extends Model
{
    use HasFactory;

    protected $fillable = ['pemohon_id','alamat_pemohon','kecamatan_pemohon','kota_pemohon','provinsi_id', 'kode_pos_pemohon'];

    public function pemohon(){
        return $this->belongsTo(PengajuanPermohonan::class, 'pemohon_id');
    }

    public function provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }
}
