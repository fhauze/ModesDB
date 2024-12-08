<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Jenis extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'industri_id'
    ];

    public function kategori(){
        return $this->hasMany(Kategori::class ,'jenis_id');
    }
}
