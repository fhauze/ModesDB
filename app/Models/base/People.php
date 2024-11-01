<?php

namespace App\Models\base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class People extends Model
{
    //
    use HasFactory;

    protected $table = 'orang';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'email',
        'no_telepon',
        'jenis_orang',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
