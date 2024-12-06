<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;
use App\Models\ModulePermission;
use Spatie\Permission\Models\Role;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        $homeModule = Module::create(['name' => 'users','slug' => 'users', 'model' => 'App\Models\User']);
        $dbModule = Module::create(['name' => 'menu', 'slug' => 'menu','model' => 'App\Models\Menu']);
        $roles = Role::all();


        // Add permissions for the 'home' module
        foreach ([
            ['name' => 'create', 'guard_name' => 'web'],
            ['name' => 'read', 'guard_name' => 'web'],
            ['name' => 'edit', 'guard_name' => 'web'],
            ['name' => 'delete', 'guard_name' => 'web'],
        ] as $permissionData) {
            // Check and create the permission for the 'home' module
            $a = Permission::where(['permissions.name' => $permissionData['name'],'guard_name' => $permissionData['guard_name']])->first();
            
            if(!$a){
                $pr = Permission::create(['name' => $permissionData['name'],'guard_name' => $permissionData['guard_name']]);
                if($pr){
                    foreach($roles as $role){
                        ModulePermission::create(['module_id' => $homeModule->id, 'permission_id' => $pr->id, 'role_id' => $role->id]);
                    }
                }
            }
            
        }

        // Add permissions for the 'dashboard' module
        foreach ([
            ['name' => 'read', 'guard_name' => 'web'],
            ['name' => 'edit', 'guard_name' => 'web'],
        ] as $permissionData) {
            // Check and create the permission for the 'dashboard' module
            $a = Permission::where(['name' => $permissionData['name'],'guard_name' => $permissionData['guard_name']])->first();
            
            if(!$a){
                $pr = Permission::create(['name' => $permissionData['name'],'guard_name' => $permissionData['guard_name']]);
                if($pr){
                    foreach($roles as $role){
                        ModulePermission::create(['module_id' => $dbModule->id, 'permission_id' => $pr->id, 'role_id' => $role->id]);
                    }
                }
            }
        }
    }
}
