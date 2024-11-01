<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'perusahaan_id',
        'person_id',
        'jenis_usaha',
        'pekerja',
        'vol_produksi',
        'ekspor',
        'tujuan_ekspor',
        'volume_ekspor',
        'distribusi_ke',
        'lokasi_usaha'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function person()
    {
        return $this->belongsTo(Orang::class);
    }
}
