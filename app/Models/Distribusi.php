<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $fillable = [
        'usaha_id',
        'jenis_id',
        'kategori_id',
        'deskripsi',
        'jenis_distribusi', //local/inter
        'negara_id',
        'provinsi_id',
        'kabkot_id',
        'tahun',
        'volume',
        'satuan',
    ];

    public function usaha(){
        return $this->belongsTo(\App\Models\Usaha::class, 'usaha_id');
    }
    public function kategori(){
        return $this->belongsTo(\App\Models\Kategori::class, 'kategori_id');
    }
    public function jenis(){
        return $this->belongsTo(\App\Models\Jenis::class, 'jenis_id');
    }

    public function negara(){
        return $this->belongSto(\App\Models\Negara::class, 'negara_id');
    }
}
