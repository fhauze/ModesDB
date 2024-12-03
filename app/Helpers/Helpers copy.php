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
        $menus = Menu::whereNull('parent_id')
            ->with('subMenus') // Ensure this relation exists in the Menu model
            ->get();
        $userPermissions = auth()->user()->getAllPermissions()->pluck('name')->toArray();
        $modules = Module::with('permissions')->get();
        $userPermissions = array_map(function($item){
            return substr($item,0,strlen($item) -7);
        }, $userPermissions);
        $sidebarMenu = [];
        $sidebar = [];
        foreach ($modules as $module) {
            $modulePermissions = $module->permissions->pluck('name')->toArray();
            // dd([$modulePermissions,$userPermissions, array_intersect($modulePermissions, $userPermissions)]);
            if (array_intersect($modulePermissions, $userPermissions)) {
                $sidebar[] = [
                    'name' => $module->name,
                    'permissions' => [
                        'read' => in_array('read_module', $modulePermissions) && in_array('read_module', $userPermissions),
                        'create' => in_array('create_module', $modulePermissions) && in_array('create_module', $userPermissions),
                        'edit' => in_array('edit_module', $modulePermissions) && in_array('edit_module', $userPermissions),
                        'delete' => in_array('delete_module', $modulePermissions) && in_array('delete_module', $userPermissions),
                    ]
                ];
            }
        }
        
        // dd($modulePermissions);
        foreach ($menus as $menu) {
            $modules = Module::with('permissions')->get();
            $modulePermissions = $module->permissions;
            
            foreach ($modulePermissions as $permission) {
                $usersWithPermission = $permission->users;
                dd($usersWithPermission);
            }
            
            if ($user->can('view menus') || $user->hasRole('administrator')) {
                $items = $menu->subMenus->map(function ($subMenu) use ($user) {
                    if ($user->can('view menus') || $user->hasRole('administrator')) {
                        return [
                            'route' => $subMenu->route_name ?? '/',
                            'icon' => $subMenu->icon ?? '/', 
                            'label' => $subMenu->display_name ?? '/',
                        ];
                    }
                    return null;
                })->filter()->values()->toArray();

                $sidebarMenu[$menu->display_name] = $items;
                // dd(var_dump($sidebarMenu));
            }
        }
        
        return $sidebarMenu;
    }

    if (!function_exists('userCan')) {
        function userCan($moduleId, $permissionName)
        {
            $user = Auth::user();
            
            if (!$user) {
                return false; // User belum login
            }
    
            // Ambil permission berdasarkan module dan permission name
            $permission = Module::find($moduleId)
                ->permissions()
                ->where('name', $permissionName)
                ->first();

            if (!$permission) {
                return false; // Permission tidak ditemukan
            }
    
            // Periksa apakah user memiliki permission ini
            return $user->permissions()->where('id', $permission->id)->exists();
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
