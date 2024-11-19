<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan modul
        $postModule = Module::create(['name' => 'Post']);
        $commentModule = Module::create(['name' => 'Comment']);

        // Tambahkan permission untuk Post
        $postModule->permissions()->createMany([
            ['name' => 'read'],
            ['name' => 'edit'],
            ['name' => 'delete'],
        ]);

        // Tambahkan permission untuk Comment
        $commentModule->permissions()->createMany([
            ['name' => 'read'],
            ['name' => 'edit'],
        ]);
    }
}
