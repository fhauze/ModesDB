<?php

namespace App\Models;

use App\Models\Provinsi;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table ='kabupatens';
    protected $fillable = [
        'nama',
        'kode',
        'provinsi_id'
    ];

    public function provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }
}
