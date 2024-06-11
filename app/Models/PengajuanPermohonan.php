<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPermohonan extends Model
{
    use HasFactory;

    protected $table = 'pemohons';
    protected $fillable = ['user_id','permohonan_id','nama_pemohon','nama_perusahaan','nama_objek','lokasi_objek'];

    public function scopeSearch($query, $nama_pemohon)
    {
        return $query->where('nama_pemohon',"LIKE", "%{$nama_pemohon}%");
    }

    public function permohonan(){
        return $this->belongsTo(Permohonan::class, 'permohonan_id');
    }

    public function bukti_permohonan(){
        return $this->hasOne(BuktiPermohonan::class, 'pemohon_id');
    }

    public function alamat_pemohon(){
        return $this->hasOne(AlamatPemohon::class, 'pemohon_id');
    }

    public function alamat_perusahaan(){
        return $this->hasOne(AlamatPerusahaan::class, 'pemohon_id');
    }

    public function status_permohonan(){
        return $this->hasOne(StatusPermohonan::class, 'pemohon_id');
    }
}
