<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public function permissionsToModule()
    {
        return $this->belongsToMany(Permission::class, 'module_permission', 'module_id', 'permission_id');
    }

}
