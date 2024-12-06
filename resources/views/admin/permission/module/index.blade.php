@extends('layouts.admin.base')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Role Permissions</h1>
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
                                class="permission-access" 
                                data-role-id="{{ $role->id }}" 
                                data-module-id="{{ $module->id }}" 
                                data-permission-type="{{ $permissionType }}"
                                @php
                                    // Cek apakah role memiliki permission untuk module dan permissionType
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
@endsection



@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.permission-access');

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
@endsection
