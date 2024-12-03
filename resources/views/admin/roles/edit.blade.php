@extends('layouts.admin.base')

@section('content')
    <div class="container">
        <h2>Edit Role: {{ $role->name }}</h2>
        
        <form id="role-menu-form">
            @csrf
            <input type="hidden" name="role_id" id="role_id" value="{{ $role->id }}">

            <div class="form-group">
                <label for="role_name">Role Name</label>
                <input type="text" class="form-control" id="role_name" name="role_name" value="{{ $role->name }}" required>
            </div>

            <h4>Assign Permissions to Menus</h4>
            <div class="row">
                @foreach ($menus as $menu)
                    <div class="col-md-4">
                        {{-- Periksa apakah role memiliki permission pada menu ini --}}
                        @php
                            $hasMenuPermission = DB::table('menu_permission')
                                ->where('menu_id', $menu->id)
                                ->where('role_id', $role->id)
                                ->exists();
                        @endphp

                        {{-- Menu Checkbox --}}
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="menu-{{ $menu->id }}" 
                                name="menus[]" 
                                value="{{ $menu->id }}"
                                @if($hasMenuPermission)
                                    checked
                                @endif
                            >
                            <label class="form-check-label" for="menu-{{ $menu->id }}">{{ $menu->name }}</label>
                        </div>
                        
                        {{-- Submenus --}}
                        @foreach ($menu->submenus as $subMenu)
                            <div class="form-check ml-3 ms-4 ps-4">
                                <input 
                                    type="checkbox" 
                                    class="form-check-input" 
                                    id="submenu-{{ $subMenu->id }}" 
                                    name="submenus[]" 
                                    value="{{ $subMenu->id }}"
                                    @if($hasMenuPermission)
                                        checked
                                    @endif
                                disabled>
                                <label class="form-check-label" for="submenu-{{ $subMenu->id }}">{{ $subMenu->name }}</label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#role-menu-form').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serializeArray();

            $.ajax({
                url: '{{ route("roles.updateRole") }}',
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    role_id: $('#role_id').val(), // Role ID
                    role_name: $('#role_name').val(), // Role Name
                    menus: $('input[name="menus[]"]:checked').map(function() {
                        return $(this).val();
                    }).get(), // Menus
                    submenus: $('input[name="submenus[]"]:checked').map(function() {
                        return $(this).val();
                    }).get() // Submenus
                }),
                success: function(response) {
                    alert('Role and menu permissions updated successfully!');
                },
                error: function(xhr) {
                    alert('An error occurred while updating.');
                }
            });
        });
    });
</script>
@endsection
