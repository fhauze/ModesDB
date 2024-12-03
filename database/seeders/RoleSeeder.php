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

        $admin = Role::create(['name' => 'administrator']);
        $contributor = Role::create(['name' => 'contributor']);
        $user = Role::create(['name' => 'user']);

        $admin->givePermissionTo(['read_module', 'create_module', 'edit_module', 'delete_module']);
        $contributor->givePermissionTo(['read_module', 'create_module', 'edit_module']);
        $user->givePermissionTo(['read_module']);
    }
}
