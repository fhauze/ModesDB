<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    use HasPermissions; 

    protected $fillable = ['name','display_name', 'type', 'parent_id','route_name'];

    public function subMenus()
    {
        return $this->hasMany(SubMenu::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'menu_permission')
                    ->withPivot('role_id')
                    ->using(MenuPermission::class);
    }
    public function menuPermissions()
    {
        return $this->hasMany(MenuPermission::class, 'menu_id');
    }
    public function getPermissionsByRoleAndPermission($permissionId, $roleId)
    {
        return $this->permissions()
                    ->wherePivot('permission_id', $permissionId) // Menambahkan kondisi untuk permission_id
                    ->wherePivot('role_id', $roleId) // Menambahkan kondisi untuk role_id
                    ->get();
    }
}
