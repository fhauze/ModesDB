<?php

namespace App\Models\base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile;
use App\Models\Usaha;

class Person extends Model
{
    //
    use HasFactory;

    protected $table = 'person';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'email',
        'no_telepon',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function usaha(){
        return $this->hasMany(Usaha::class);
    }

    public function profesi()
    {
        return $this->belongsToMany(\App\Models\Profesi::class, 'person_profesis', 'person_id', 'profesi_id');
    }
}
