<?php

namespace App\Models\base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class Organization extends Model
{
    //
    // use HasFactory;

    protected $table = 'organization';

    protected $fillable = [
        'nama_usaha',
        'nomor_telepon',
        'email',
        'ig_fb',
        'alamat',
        'tahun_memulai_usaha',
        'nib',
        'pekerja'
    ];

    // Relasi dengan Perusahaan (One to Many)
    public function perusahaan()
    {
        return $this->hasMany(Perusahaan::class);
    }
}
