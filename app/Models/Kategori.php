<?php

namespace App\Models;

use App\Models\Jenis;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = [
        'nama',
        'deskripsi',
        'jenis_id'
    ];

    public function jenis(){
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
}
