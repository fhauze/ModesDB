<?php
namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permission.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil ditambahkan.');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil diupdate.');
    }

    /**
     * Module permission
     */
    // public function ModulePermissionIndex(){
    //     // Ambil data Module dan Role
    //     $datas = \App\Models\Module::with('permissions')->get();
    //     $roles = \App\Models\Role::with('permissionsToModule')->get();

    //     // Array kosong untuk menyimpan role yang sudah diproses
    //     $rolesArray = [];
    
    //     // Iterasi setiap role
    //     foreach($roles as $role){
    //         $intersectedPermissions = [];
    //         foreach($datas as $data){
    //             $intersectedPermissions[$data->id] = array_intersect(
    //                 $role->permissionsToModule->pluck('name')->toArray(), // Ambil permissions dari role
    //                 $data->getPermissionsByRoleAndPermission()->pluck('name')->toArray()          // Ambil permissions dari module
    //             );
    //         }
    //         // dd($intersectedPermissions);
    //         $role->permissions = array_unique(array_merge(...$intersectedPermissions));
    //         $rolesArray[$role->id] = $intersectedPermissions;
    //     }
    //     dd($rolesArray);
    //     return view('admin.permission.module.index', compact('datas','rolesArray', 'roles'));
    // }    

    // public function ModulePermissionCreate(Request $request){

    // }

    public function ModulePermissionIndex()
    {
        $datas = \App\Models\Module::with('permissions')->get();
        $roles = \App\Models\Role::all();
        $rolesArray = [];
        foreach ($roles as $role) {
            foreach ($datas as $data) {
                foreach (['create', 'read', 'edit', 'delete'] as $permissionType) {
                    $permission = $data->permissions->where('name', $permissionType)->first();
                    $permissionId = $permission ? $permission->id : null;

                    if ($permissionId) {
                        $permissions = $data->getPermissionsByRoleAndPermission($permissionId, $role->id);
                        if ($permissions->isNotEmpty()) {
                            $rolesArray[$role->id][$data->id][] = $permissionType;
                        }
                    }
                }
            }
        }
        
        return view('admin.permission.module.index', compact('datas', 'roles', 'rolesArray'));
    }




    public function ModulePermissionUpdate(Request $request, $roleID, $moduleID)
    {
        $request->validate([
            'permissionType' => 'required|string|in:create,read,edit,delete',
            'isChecked' => 'required|boolean',
        ]);

        // Temukan role berdasarkan ID
        $role = Role::find($roleID);
        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found.'], 404);
        }

        $permissionID = Permission::where('name',$request->permissionType)->first();
        
        $exists = \App\Models\ModulePermission::where('role_id', $roleID)
            ->where('permission_id', $permissionID->id)
            ->where('module_id', $moduleID)
            ->first();

        if (!$exists) {
            $process = \App\Models\ModulePermission::create([
                'module_id' => $moduleID,
                'permission_id' => $permissionID->id,
                'role_id' => $roleID,
            ]);
            if($process){
                return response()->json([
                    'success' => true,
                    'message' => 'Permission ccrceata successfully.',
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating permission.']);
        }else{
            $exists->delete();
        }

        // Perbarui permission
        try {
            if ($request->isChecked) {
                $role->givePermissionTo($permissionID);
            } else {
                $role->revokePermissionTo($permissionID);
            }

            return response()->json([
                'success' => true,
                'message' => 'Permission updated successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating permission.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function ModulePermissionDelete(\App\Models\ModulePermssion $modulePermission){

    }
}
