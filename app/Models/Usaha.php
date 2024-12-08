<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Organization;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Usaha;

class Usaha extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'usaha';
    protected $fillable = [
        'nama',
        'alamat',
        // 'jenis_id', // produksi
        'teknologi',
        'pekerja',
        'sertifikasi',
        'tahun_berdiri',
        'deskripsi',
        'social_media',
        'sosmed_accoutn',
        'website',
        'provinsi_id',
        'kabkot_id',
        'org_id',
        'person_id',
        //'kategori_id' // sudah ada di produksi
    ];

    public function organzation(){
        return $this->belongsTo(Organization::Class, 'org_id');
    }

    public function owner(){
        return $this->belongsTo('App\Models\Person','person_id');
    }

    public function karyawans(){
        return [];
    }

    public function tahuns(){
        return $this->select('tahun_berdiri')
            ->distinct()
            ->get()
            ->toArray();
    }

    public static function jenis()
    {
        return self::join('jenis', 'usaha.jenis_id', '=', 'jenis.id')
            ->distinct()
            ->select('jenis.id', 'jenis.nama')
            ->from('usaha')
            ->get()
            ->toArray();
    }

    public function jenisUsaha(){
        return $this->belongsTo(Usaha::class, 'jenis_id');
    }

    public function provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kabkota(){
        return $this->belongsTo(Kabupaten::class, 'kabkot_id');
    }
}