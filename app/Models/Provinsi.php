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

    public function kabupatensByProvinsi($id){
        return Kabupaten::where('provinsi_id', $id)->get();
    }

    public function byNegara($negara_id){
        return $this->where('negara_id',$negara_id)->get();
    }
}
