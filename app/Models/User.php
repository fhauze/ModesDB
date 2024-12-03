<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\base\Person;

class User extends  Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens,HasRoles;

    protected $table = 'users';

    protected $fillable = ['orang_id', 'email', 'password','name'];

    // Relasi dengan Orang (parent)
    public function person()
    {
        return $this->hasOne(Person::class);
    }

    public function updateRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        return redirect()->route('users.index');
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }
}
