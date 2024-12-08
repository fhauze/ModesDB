<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesi extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    public function person(){
        return $this->hasMany(\App\Models\base\Person::class, 'person_profesis','profesi_id', 'person_id');
    }
}
