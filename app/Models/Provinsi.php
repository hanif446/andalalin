<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    public function alamat_pemohons()
    {
        return $this->hasOne(PengajuanPermohonan::class, 'provinsi_id');
    }

    public function alamat_perusahaans()
    {
        return $this->hasOne(PengajuanPermohonan::class, 'provinsi_id');
    }
}
