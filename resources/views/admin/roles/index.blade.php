@extends('layouts.admin.base')

@section('content')
<div class="container">
    <h3 class="mb-4">Manage Role Permissions</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Role</th>
                    @foreach ($permissions as $permission)
                        <th>{{ ucfirst($permission->name) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    @foreach ($permissions as $permission)
                    <td>
                        <input 
                            type="checkbox" 
                            class="permission-access role-permission" 
                            data-role-id="{{ $role->id }}" 
                            data-permission-id="{{ $permission->id }}" 
                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                        >
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="container">
    <h3 class="mb-4">Manage Module Permissions</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2" class="text-center pb-4">Module</th>
                @foreach($roles ?? [] as $role)
                    <th colspan="4" class="text-center">{{ ucfirst($role->name) }}</th> <!-- Teks di tengah juga untuk setiap role -->
                @endforeach
            </tr>
            <tr>
                @foreach($roles ?? [] as $role)
                    <th>Create</th>
                    <th>Read</th>
                    <th>Edit</th>
                    <th>Delete</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach ($datas as $keyMod => $module)
            <tr>
                <td>{{ $module->name }}</td>
                @foreach ($roles as $keyRole => $role)
                    @foreach (['create', 'read', 'edit', 'delete'] as $permissionType)
                        <td>
                            <input 
                                type="checkbox" 
                                class="permission-access module-permission" 
                                data-role-id="{{ $role->id }}" 
                                data-module-id="{{ $module->id }}" 
                                data-permission-type="{{ $permissionType }}"
                                @php
                                    $hasPermission = isset($rolesArray[$role->id][$module->id]) && 
                                                    in_array($permissionType, $rolesArray[$role->id][$module->id]);
                                @endphp
                                @if($hasPermission)
                                    checked
                                @endif
                            >
                        </td>
                    @endforeach
                @endforeach
            </tr>
        @endforeach


        </tbody>
        </table>
    </div>
</div>
<hr/>
<div class="container">
    <h3 class="mb-4">Manage Menu Permissions</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2" class="text-center pb-4">Menu</th>
                @foreach($roles ?? [] as $role)
                    <th colspan="4" class="text-center">{{ ucfirst($role->name) }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach($roles ?? [] as $role)
                    <th>Create</th>
                    <th>Read</th>
                    <th>Edit</th>
                    <th>Delete</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $keyMod => $menu)
                <tr>
                    <td>{{ $menu->name }}</td>
                    @foreach ($roles as $keyRole => $acc)
                        @foreach (['create', 'read', 'edit', 'delete'] as $permissionType)
                            <td>
                                <input 
                                    type="checkbox" 
                                    class="permission-access menu-permission" 
                                    data-role-id="{{ $acc->id }}" 
                                    data-menu-id="{{ $menu->id }}" 
                                    data-permission-type="{{ $permissionType }}"
                                    @php
                                        $menuPermission = isset($menuArray[$acc->id][$menu->id]) && 
                                                        in_array($permissionType, $menuArray[$acc->id][$menu->id]);
                                    @endphp
                                    @if($menuPermission)
                                        checked
                                    @endif
                                >
                            </td>
                        @endforeach
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.role-permission');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const roleId = this.dataset.roleId;
                const permissionId = this.dataset.permissionId;
                const isChecked = this.checked;
                console.log(`/admin/roles/${roleId}/permissions/${permissionId}`);
                // Kirim AJAX request untuk menyimpan perubahan
                fetch(`/admin/roles/${roleId}/permissions/${permissionId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ isChecked }),
                })
                .then(response => {
                    console.log(response)
                    if (!response.ok) {
                        throw new Error('Failed to update permissions.');
                    }
                })
                .catch(error => {
                    alert(error.message);
                    this.checked = !isChecked; // Rollback checkbox on error
                });
            });
        });
    });
</script>
//
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.module-permission');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const roleId = this.dataset.roleId;
                const moduleId = this.dataset.moduleId;
                const permissionType = this.dataset.permissionType;
                const isChecked = this.checked;

                // Validasi input
                if (!roleId || !moduleId || !permissionType) {
                    console.error('Invalid data attributes for the checkbox.');
                    alert('Invalid data. Please refresh the page and try again.');
                    this.checked = !isChecked; // Rollback checkbox
                    return;
                }

                // Indikator proses
                this.disabled = true;

                console.log(`Updating permission for role ${roleId}, module ${moduleId}, permission ${permissionType}: ${isChecked ? 'add' : 'remove'}`);

                // Kirim request AJAX
                fetch(`/adm/permission/modules/${roleId}/${moduleId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        permissionType: permissionType,
                        isChecked: isChecked,
                        module_id : moduleId,
                        role_id : roleId
                    }),
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to update permissions.'); // Jika respons bukan 200-299
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            console.log(data.message);
                        } else {
                            throw new Error(data.message || 'Failed to update permissions.');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert(`Error: ${error.message}`);
                        this.checked = !isChecked; // Rollback checkbox jika ada error
                    })
                    .finally(() => {
                        this.disabled = false; // Aktifkan kembali checkbox
                    });
            });
        });
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.menu-permission');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const roleId = this.dataset.roleId;
                const menuId = this.dataset.menuId;
                const permissionType = this.dataset.permissionType;
                const isChecked = this.checked;

                // Validasi input
                if (!roleId || !menuId || !permissionType) {
                    console.error('Invalid data attributes for the checkbox.');
                    alert('Invalid data. Please refresh the page and try again.');
                    this.checked = !isChecked; // Rollback checkbox
                    return;
                }

                // Indikator proses
                this.disabled = true;

                console.log(`Updating permission for role ${roleId}, module ${menuId}, permission ${permissionType}: ${isChecked ? 'add' : 'remove'}`);

                // Kirim request AJAX
                fetch(`/adm/permission/menu/${roleId}/${menuId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        permissionType: permissionType,
                        isChecked: isChecked,
                        menu_id : menuId,
                        role_id : roleId
                    }),
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to update permissions.'); // Jika respons bukan 200-299
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            console.log(data.message);
                        } else {
                            throw new Error(data.message || 'Failed to update permissions.');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert(`Error: ${error.message}`);
                        this.checked = !isChecked; // Rollback checkbox jika ada error
                    })
                    .finally(() => {
                        this.disabled = false; // Aktifkan kembali checkbox
                    });
            });
        });
    });

</script>
@endsection
