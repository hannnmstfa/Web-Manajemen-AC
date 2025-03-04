<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';
    protected $fillable = [
        'tanggal',
        'kategori',
        'ac_id'
    ];
    public $timestamps = true;
    public function ac(){
        return $this->belongsTo(AC::class);
    }
}
