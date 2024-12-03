<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Organization;

class Usaha extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'usaha';
    protected $fillable = [
        'nama',
        'alamat',
        'jenis_id',
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
        'kategori_id'
    ];

    public function organzation(){
        return $this->belongsTo(Organization::Class, 'org_id');
    }

    public function person(){
        return $this->belongsTo('App\Models\Person','person_id');
    }
}