<?php

namespace App\Models;

use App\Models\Negara;
use App\Models\kabupaten;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $fillable = [
        'nama',
        'kode',
        'negara_id',
    ];

    public function negara(){
        return $this->belongsTo(Negara::class, 'negara_id');
    }

    public function kabupatens(){
        return $this->hasMany(Kabupaten::class);
    }
}
