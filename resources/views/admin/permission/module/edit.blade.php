@extends('layouts.admin.base')
@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Permission</h1>

        <!-- Menampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulir Edit Permission -->
        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Permission</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $permission->name) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Permission</button>
        </form>
    </div>
@endsection
