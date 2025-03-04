<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cleaning extends Model
{
    protected $table = 'cleaning';
    protected $fillable = [
        'ac_id',
        'vendor_id',
        'tgl_planing',
        'tgl_actual',
        'foto_petugas',
        'foto_cleaning',
        'foto_pemeriksa',
        'status',
    ];
    public $timestamps = true;
    public function ac(){
        return $this->belongsTo(AC::class);
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
