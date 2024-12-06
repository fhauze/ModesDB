@extends('layouts.admin.base')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Role Permissions</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>Module</th>
                @foreach($datas->first()->permissions ?? [] as $permission)
                    <th>{{ ucfirst($permission->name) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
            <tr>
                <td>{{ $data->name }}</td>
                @foreach ($data->permissions as $dt)
                <td>
                    <input 
                        type="checkbox" 
                        class="permission-access" 
                        data-role-id="{{ $role->id }}" 
                        data-permission-id="{{ $dt->id }}"
                    >
                </td>
                @endforeach
                @foreach (\App\Models\Permission::whereNotIn('id', $data->permissions->pluck('id'))->get() as $missingPermission)
                <td>
                    <input 
                        type="checkbox" 
                        class="permission-access" 
                        data-role-id="{{ $role->id }}" 
                        data-permission-id="{{ $missingPermission->id }}" 
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

                // Tampilkan log untuk debugging
                console.log(`Updating permission for role ${roleId}, permission ${permissionId}: ${isChecked ? 'add' : 'remove'}`);

                // Kirim AJAX request untuk menyimpan perubahan
                fetch(`/admin/roles/${roleId}/permissions/${permissionId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ isChecked }),
                })
                    .then(response => response.json()) // Konversi respons menjadi JSON
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
                        this.checked = !isChecked; // Rollback checkbox on error
                    });
            });
        });
    });

</script>
@endsection
