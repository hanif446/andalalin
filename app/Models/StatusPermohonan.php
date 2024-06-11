<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPermohonan extends Model
{
    use HasFactory;

    protected $fillable = ['pemohon_id','status'];

    public function pemohon(){
        return $this->belongsTo(PengajuanPermohonan::class, 'pemohon_id');
    }
}
