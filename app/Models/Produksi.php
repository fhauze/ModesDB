<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usaha;

class Produksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'usaha_id',
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

    public function usaha()
    {
        return $this->belongsTo(Usaha::class);
    }

    public function person()
    {
        return $this->belongsTo(Orang::class);
    }
}
