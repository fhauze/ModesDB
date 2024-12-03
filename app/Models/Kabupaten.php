<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table ='kabupatens';
    protected $fillable = [
        'nama',
        'kode',
        'provinsi_id'
    ];
}
