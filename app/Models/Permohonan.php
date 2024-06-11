<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $fillable = ['judul','jenis','ukuran','kategori'];

    public function scopeSearch($query, $judul)
    {
        return $query->where('judul',"LIKE", "%{$judul}%");
    }

    public function pemohon(){
        return $this->hasOne(PengajuanPermohonan::class, 'permohonan_id');
    }
}
