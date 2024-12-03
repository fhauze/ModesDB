@extends('layouts.admin.base')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Role Permissions</h1>
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
                            class="permission-access" 
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
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.permission-access');

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
@endsection
