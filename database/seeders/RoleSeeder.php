<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Membuat Permissions
        Permission::create(['name' => 'read_module']);
        Permission::create(['name' => 'create_module']);
        Permission::create(['name' => 'edit_module']);
        Permission::create(['name' => 'delete_module']);

        // Membuat Roles
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $user = Role::create(['name' => 'user']);

        // Memberikan Permission ke Admin
        $admin->givePermissionTo(['read_module', 'create_module', 'edit_module', 'delete_module']);
        
        // Memberikan Permission ke Editor
        $editor->givePermissionTo(['read_module', 'create_module', 'edit_module']);
        
        // Memberikan Permission ke User
        $user->givePermissionTo(['read_module']);
    }
}
