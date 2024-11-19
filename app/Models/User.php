<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends  Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens,HasRoles;

    protected $table = 'users';

    protected $fillable = ['orang_id', 'email', 'password','name'];

    // Relasi dengan Orang (parent)
    public function orang()
    {
        return $this->belongsTo(Orang::class);
    }
}
