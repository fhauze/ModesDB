<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class PermissionMenuSeeder extends Seeder
{
    public function run()
    {
        $menus = Menu::all();
        $permissions = Permission::all();
        $roles = Role::all();

        foreach ($roles as $role) {
            foreach ($menus as $menu) {
                foreach ($permissions as $permission) {
                    DB::table('menu_permission')->insert([
                        'menu_id' => $menu->id,
                        'permission_id' => $permission->id,
                        'role_id' => $role->id, // Tambahkan role_id
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
