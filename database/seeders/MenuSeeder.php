<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\SubMenu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed the main menu items (parent menus)
        $menus = [
            [
                'name' => 'home',
                'display_name' => 'Home',
                'type' => 'link',
                'parent_id' => null,
            ],
            [
                'name' => 'pertanian_peternakan',
                'display_name' => 'Pertanian dan Peternakan',
                'type' => 'link',
                'parent_id' => null,
            ],
            [
                'name' => 'industri',
                'display_name' => 'Industri',
                'type' => 'link',
                'parent_id' => null,
            ],
            [
                'name' => 'setting',
                'display_name' => 'Settings',
                'type' => 'dropdown',
                'parent_id' => null,
            ],
        ];

        // Insert the parent menu items into the 'menus' table
        foreach ($menus as $menuData) {
            $menu = Menu::create([
                'name' => $menuData['name'],
                'display_name' => $menuData['display_name'],
                'type' => $menuData['type'],
                'parent_id' => $menuData['parent_id'],
            ]);

            // Check if submenus are defined for each menu
            if ($menuData['name'] === 'home') {
                // Add submenus for Home
                $smHome = [
                    ['name' => 'dashboard','display_name' => 'Dashboard', 'type' => 'link']
                ];
                foreach ($smHome as $m) {
                    SubMenu::create([
                        'name' => $m['name'],
                        'display_name' => $m['display_name'],
                        'type' => $m['type'],
                        'menu_id' => $menu->id,
                    ]);
                }
            }

            // Check if submenus are defined for each menu
            if ($menuData['name'] === 'pertanian_peternakan') {
                // Add submenus for Pertanian
                $smTani = [
                    ['name' => 'serat_nanas', 'display_name' => 'Serat Nanas', 'type' => 'link'],
                    ['name' => 'sutera',  'display_name' => 'Ulat Sutera' ,'type' => 'link'],
                ];
                foreach ($smTani as $t) {
                    SubMenu::create([
                        'name' => $t['name'],
                        'display_name' => $t['display_name'],
                        'type' => $t['type'],
                        'menu_id' => $menu->id,
                    ]);
                }
            }

            if ($menuData['name'] === 'industri') {
                // Add submenus for Industri
                $smI = [
                    ['name' => 'pakaian', 'display_name' => 'Pakaian Jadi', 'type' => 'link'],
                ];
                foreach ($smI as $i) {
                    SubMenu::create([
                        'name' => $i['name'],
                        'display_name' => $i['display_name'],
                        'type' => $i['type'],
                        'menu_id' => $menu->id,
                    ]);
                }
            }

            if ($menuData['name'] === 'setting') {
                // Add submenus for Settings
                $st = [
                    ['name' => 'menu', 'display_name' => 'Pengaturan Menu', 'type' => 'link', 'route_name' => 'adm.menu.index'],
                    ['name' => 'jenis', 'display_name' => 'Jenis', 'type' => 'link', 'route_name' => 'adm.jenis.index'],
                    ['name' => 'kategori', 'display_name' => 'Kategori', 'type' => 'link', 'route_name' => 'adm.jenis.index'],
                    ['name' => 'negara', 'display_name' => 'Negara', 'type' => 'link', 'route_name' => 'adm.jenis.index'],
                    ['name' => 'provinsi', 'display_name' => 'Provinsi', 'type' => 'link', 'route_name' => 'adm.provinsi.index'],
                    ['name' => 'kabkota', 'display_name' => 'Kabupaten / Kota', 'type' => 'link', 'route_name' => 'adm.jenis.index'],
                    ['name' => 'user_akses', 'display_name' => 'User & Hak Akses', 'type' => 'link', 'route_name' => 'adm.roles.index'],
                ];
                foreach ($st as $s) {
                    SubMenu::create([
                        'name' => $s['name'],
                        'display_name' => $s['display_name'],
                        'type' => $s['type'],
                        'menu_id' => $menu->id,
                        'route_name' => $s['route_name'],
                    ]);
                }
            }
        }
    }
}
