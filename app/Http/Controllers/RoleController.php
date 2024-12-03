<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Menu;
use App\Models\SubMenu;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $allUser = array();
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        if(!empty($users)){
            foreach($users as $u){
                $roleadd = [];
                if(null != $u->getRoleNames()){
                    $roleadd = $u->getRoleNames();
                }
                $allUser[$u->id] = $roleadd;
            }
        }
        
        return view('admin.roles.index')->with(['users' => $users, 'roles' => $roles, 'permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->syncRoles($request->roles); // Menyinkronkan roles yang dipilih
        $user->syncPermissions($request->permissions); // Menyinkronkan permissions yang dipilih

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updatePermissionAccess(Request $request, $roleId, $permissionId)
    {
        $role = Role::findOrFail($roleId);
        $permission = Permission::findOrFail($permissionId);

        if ($request->isChecked) {
            $role->givePermissionTo($permission->name);
        } else {
            $role->revokePermissionTo($permission->name);
        }

        return response()->json(['success' => true]);
    }

    public function editRole($roleId)
    {
        $role = Role::find($roleId);
        $role_permission_ids = $role->permissions->pluck('id')->toArray();
        // dd($role_permission_ids);
        $menus = DB::table('menus')
            ->select('menus.id', 'menus.name', 'menus.display_name')
            ->join('menu_permission', 'menu_permission.menu_id', '=', 'menus.id')
            ->join('permissions', 'permissions.id', '=', 'menu_permission.permission_id') // Bergabung dengan tabel permissions
            ->whereIn('menu_permission.permission_id', $role_permission_ids)
            ->distinct()
            ->get()
            ->map(function ($menu) {
                $menu->submenus = SubMenu::where('menu_id', $menu->id)->get();
                
                $menu->permissions = DB::table('permissions')
                    ->join('menu_permission', 'menu_permission.permission_id', '=', 'permissions.id')
                    ->where('menu_permission.menu_id', $menu->id)
                    ->get();
                
                return $menu;
            });

        // dd([$role->permissions->pluck('name'), $menus[0]->permissions->pluck('name')]);
        return view('admin.roles.edit', compact('role', 'menus','role_permission_ids'));
    }

    public function updateRole(Request $request)
    {
        $data = $request->json()->all();

        if (!isset($data['role_id'])) {
            return response()->json(['error' => 'Role ID is required'], 400);
        }

        // Find role by ID
        $role = Role::find($data['role_id']);
        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }

        // Update role name
        $role->name = $data['role_name'];
        $role->save();

        $menus = $data['menus'] ?? [];
        $permissions = [];
        $roleId = $role->id;

        // Delete all existing menu_permission for this role
        DB::table('menu_permission')->where('role_id', $roleId)->delete();

        // Insert new permissions for menus
        foreach ($menus as $menuId) {
            $menu = Menu::find($menuId);

            if ($menu && $menu->permissions->isNotEmpty()) {
                foreach ($menu->permissions as $perm) {
                    DB::table('menu_permission')->insert([
                        'menu_id' => $menu->id,
                        'permission_id' => $perm->id,
                        'role_id' => $roleId,
                    ]);
                }
                $permissions = array_merge($permissions, $menu->permissions->pluck('name')->toArray());
            }
        }

        // Sync the role permissions
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        // Update submenu permissions
        if (!empty($data['submenus'])) {
            foreach ($data['submenus'] as $submenuId) {
                $submenu = SubMenu::find($submenuId);

                if ($submenu) {
                    $submenuPermissions = $data["permissions_{$submenuId}"] ?? [];
                    if (!empty($submenuPermissions)) {
                        foreach ($submenuPermissions as $permissionId) {
                            DB::table('menu_permission')->insert([
                                'menu_id' => $submenu->id,
                                'permission_id' => $permissionId,
                                'role_id' => $roleId,
                            ]);
                        }
                    }
                }
            }
        }

        // Fetch updated role with permissions to send to frontend
        $updatedRole = Role::with('permissions')->find($roleId);

        return response()->json([
            'success' => true,
            'role' => $updatedRole,
        ]);
    }

}
