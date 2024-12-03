<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Role
        $this->call([
            RoleSeeder::class,
            MenuSeeder::class,
            ModuleSeeder::class,
            PermissionMenuSeeder::class,
        ]);

        $user = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'adm@test.com',
            'password' => Hash::make('asalada123')
        ]);

        $user->assignRole('administrator');
    }
}
