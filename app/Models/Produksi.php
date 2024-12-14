<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Usaha;

class Produksi extends Model
{
    use HasFactory;

    protected $table = 'produksi';
    protected $fillable = [
        'usaha_id', // harus ada tabel penghung usaha-dengan pemilik
        'jenis_id',
        'kategori_id',
        'tahun',
        'pekerja',
        'vol_produksi',
        'bahan_baku',
        'persentase_bahan_lokal',
        'persentase_bahan_impor',
    ];

    public function usaha()
    {
        return $this->belongsTo(Usaha::class, 'usaha_id');
    }

    public function jenis(){
        return $this->belongsTo(\App\Models\Jenis::class, 'jenis_id');
    }

    public function kategori(){
        return $this->belongsTo(\App\Models\Kategori::class,'kategori_id');
    }

    public function person()
    {
        return $this->belongsTo(\App\Models\base\Person::class);
    }

    public function tahuns(){
        return $this->select('tahun')
            ->distinct()
            ->get()
            ->toArray();
    }
}
