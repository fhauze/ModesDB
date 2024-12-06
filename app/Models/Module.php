<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Permission;
use App\Models\ModulePermission;
class Module extends Model
{
    use HasFactory;

    protected $table ='modules';
    protected $fillable = [
        'name','slug','model',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'module_permission')
                    ->withPivot('role_id')
                    ->using(ModulePermission::class);
    }

    public function getPermissionsByRoleAndPermission($permissionId, $roleId)
    {
        return $this->permissions()
                    ->wherePivot('permission_id', $permissionId) // Menambahkan kondisi untuk permission_id
                    ->wherePivot('role_id', $roleId) // Menambahkan kondisi untuk role_id
                    ->get();
    }
}
