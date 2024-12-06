<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
    ];
    
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_permission', 'permission_id', 'menu_id');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }

    // public function modules()
    // {
    //     return $this->belongsToMany(Module::class, 'module_permission')
    //                 ->withPivot('id')
    //                 ->using(ModulePermission::class);
    // }
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_permission', 'permission_id', 'module_id')
            ->withPivot('role_id');
    }

    public function modulepermissions()
    {
        return $this->belongsToMany(Permission::class, 'module_permission', 'module_id', 'permission_id');
    }
}
