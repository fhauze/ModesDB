<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $fillable = [
        'deskripsi',
        'kategori_id',
        'usaha_id',
        'jenis_distribusi',
        'kabkot_id',
        'negara_id',
        'volume',
        'stuan'
    ];
}
