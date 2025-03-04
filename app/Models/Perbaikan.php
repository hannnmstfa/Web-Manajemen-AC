<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    protected $table = 'perbaikan';
    protected $fillable = [
        'ac_id',
        'vendor_id',
        'tgl_pengajuan',
        'tgl_selesai',
        'foto_petugas',
        'foto_pemeriksa',
        'foto_perbaikan',
        'permasalahan',
        'indikasi',
        'status'
    ];
    public $timestamps = true;
    public function ac(){
        return $this->belongsTo(AC::class);
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
