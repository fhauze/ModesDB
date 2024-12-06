@extends('layouts.admin.base')
@section('crumb')
<div class="mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div class="d-sm-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item active" aria-current="page">Daftar Module</li>
            </ol>
        </nav>
        <a href="{{route('adm.menu.index')}}" class="btn btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kembali">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>
</hr>
@endsection
<button class="btn btn-primary" data-toggle="modal" data-target="#addModuleModal">Tambah Module</button>
@section('content')
<div class="container-fluid">
    <h4 class="text-start">Daftar Modules</h4>
    <p class="tx-color-03 tx-12 mg-b-0">Daftar Module di aplikasi</p>
    <br/>
    <div class="d-flex justify-content-end mb-4">
        <a class='btn border border-danger btn-add'> <i class='fa fa-plus-circle'></i><span class="m-2">Tambah</span></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Module</th>
                    <th>Slug</th>
                    <th>Model</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modules as $key => $module)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $module->name }}</td>
                    <td>{{ $module->slug }}</td>
                    <td>{{ $module->model }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#editModuleModal" 
                            data-module="{{ $module }}">Ubah</button>
                        <form action="{{ route('adm.modules.destroy', $module->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus module ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Module -->
<div class="modal fade" id="addModuleModal" tabindex="-1" role="dialog" aria-labelledby="addModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('adm.modules.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModuleModalLabel">Tambah Module</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Module</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Model</label>
                        <input type="text" name="model" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Ubah Module -->
<div class="modal fade" id="editModuleModal" tabindex="-1" role="dialog" aria-labelledby="editModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editModuleForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModuleModalLabel">Ubah Module</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Module</label>
                        <input type="text" id="editName" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" id="editSlug" name="slug" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Model</label>
                        <input type="text" id="editModel" name="model" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const modalAddEl = document.querySelector('#addModuleModal');
        const modalEditEl = document.querySelector('#editModuleModal');
        const modalAdd = new bootstrap.Modal(modalAddEl, {keyboard:true, backdrop:true});
        const modalEdit = new bootstrap.Modal(modalEditEl, {keyboard:true, backdrop:true});
        document.addEventListener('click', function(evt){
            btnAdd = evt.target.closest('.btn-add');
            btnEdit = evt.target.closest('.btn-edit');
            dismissModal = evt.target.closest('button[data-dismiss="modal"');
            if(btnAdd){
                modalAdd.show();
            }

            if(btnEdit){
                var data = btnEdit.getAttribute('data-module');
                editModule(data);
                modalEdit.show();
            }
            if(dismissModal){
                modalAdd.hide();
                modalEdit.hide();
            }
        });
        function editModule(module) {
            var data = JSON.parse(module)
            var name = document.getElementById('editName').value = data.name;
            var slug = document.getElementById('editSlug').value = data.slug;
            var model = document.getElementById('editModel').value = data.model;
            var action = document.getElementById('editModuleForm').action = `modules/${data.id}`;
        }
    });
</script>
@endsection