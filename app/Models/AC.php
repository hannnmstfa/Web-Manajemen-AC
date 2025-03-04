<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AC extends Model
{
    protected $table = 'ac';
    protected $fillable = [
        'kode_inv',
        'tgl_pemasangan',
        'nama_ac',
        'ruangan_id',
        'plant',
        'pk',
        'spesifikasi',
        'tempat_beli',
        'foto_nota',
        'foto_petugas',
        'foto_pemasangan',
        'foto_pemeriksa',
        'foto_indoor',
        'foto_outdoor',
        'status'
    ];
    public $timestamps = true;
    public function ruangan(){
        return $this->belongsTo(Ruangan::class);
    }
}
