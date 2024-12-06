<?php

use App\Models\Menu;
use App\Models\Module;
// use App\Models\Role;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('generateMenu')) {
    function generateMenu()
    {
        $user = Auth::user();
        $userRoleIds = $user->roles->pluck('id'); // Ambil semua role ID untuk pengguna yang sedang login

        // Ambil menus yang memiliki menu_permission dengan role_id yang sesuai dengan role pengguna
        $menus = Menu::whereNull('parent_id')
            ->whereIn('id', function ($query) use ($userRoleIds) {
                $query->select('menu_id')
                    ->from('menu_permission')
                    ->whereIn('role_id', $userRoleIds);
            })
            ->with('subMenus') // Ambil submenus tanpa pengecekan permission untuk submenu
            ->get();

        $sidebarMenu = [];

        // Proses menu dan submenu
        foreach ($menus as $menu) {
            $subMenuItems = $menu->subMenus->map(function ($subMenu) {
                return [
                    'route' => $subMenu->route_name ?? '/',
                    'icon' => $subMenu->icon ?? '/',
                    'label' => $subMenu->display_name ?? '/',
                ];
            })->toArray();

            // Masukkan menu dan submenu ke dalam sidebar menu
            $sidebarMenu[] = [
                'label' => $menu->display_name,
                'icon' => $menu->icon ?? '/',
                'submenus' => $subMenuItems,
            ];
        }

        return $sidebarMenu;
    }




    if (!function_exists('userCan')) {
        function userCan(string $permission, int $userId = null)
        {
            $permission = \App\Models\Permission::where('name',$permission)->first();
            $user =\App\Models\User::find(2);
            // $user = $userId ? \App\Models\User::find($userId) : Auth::user();
            $userPermissions = \App\Models\Permission::get()->toArray();
            if(in_array($permission->name,$userPermissions)){}
            if (!$user) {
                return false;
            }
            dd([$user->can($permission), $permission, $user]);
            return $user->can($permission);
        }
    }

    /** 
     * Tidak digunakan
     */
    if (!function_exists('generateSidebarMenu')) {
        function generateSidebarMenu()
        {
            $user = Auth::user();
            if (!$user) {
                return [];
            }

            $permissions = $user->getAllPermissions()->pluck('id');
            $menus = Menu::with('subMenus') // We no longer need to filter subMenus by permissions
                ->whereHas('permissions', function ($q) use ($permissions) {
                    $q->whereIn('permissions.id', $permissions);
                })
                ->get();
            return $menus;
        }
    }    
    
}

// class MenuHelper
// {
//     public static function generateSidebarMenu($roleName)
//     {
//         // Ambil role berdasarkan nama
//         $role = Role::where('name', $roleName)->first();

//         if (!$role) {
//             return [];
//         }

//         // Ambil menu yang dapat diakses oleh role ini
//         $menus = Menu::with(['subMenus' => function ($query) use ($role) {
//             $query->whereHas('permissions', function ($q) use ($role) {
//                 $q->whereIn('role_id', $role->permissions->pluck('id'));
//             });
//         }])->get();

//         return $menus;
//     }
// }
