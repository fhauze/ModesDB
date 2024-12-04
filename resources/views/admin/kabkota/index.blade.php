@extends('layouts.admin.base')
@section('styels')
<style>
    .select2-container {
        z-index: 1050; /* Pastikan berada di atas modal */
    }
</style>
@endsection
@section('crumb')
<div class="mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div class="d-sm-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item active" aria-current="page">Menu</li>
            </ol>
        </nav>
    </div>
</div>
</hr>
@endsection
@section('content')
<div class="container-fluid">
    <h4 class="text-start">Daftar Provinsi</h4>
    <p class="tx-color-03 tx-12 mg-b-0">Daftar provinsi.</p>
    <br/>
    <fieldset class="form-fieldset">
    <div class="d-flex justify-content-end mb-4">
        <a class='btn border border-danger main-add' href="#" data-mode="create"> <i class='fa fa-plus-circle'></i><span class="m-2">Tambah</span></a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered w-100">
                    <head>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Provinsi</th>
                        <th>Negara</th>
                        <th></th>
                    </head>
                    <body>
                        @php $no=1; @endphp
                        @foreach($data as $data)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$data->kode}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->provinsi->nama ?? ''}}</td>
                                <td class="text-end">
                                    {{-- <a href="#" style="margin-right: 10px;"><i class="fa fa-eye"></i> </a> --}}
                                    <a href="#" style="margin-right: 10px;" 
                                        id="menu-btn-edit" 
                                        name="menu-btn-edit" 
                                        data-id="{{$data->id}}" 
                                        data-nama="{{$data->nama}}"
                                        data-kode="{{$data->kode}}"
                                        data-provinsi="{{$data->provinsi_id}}"
                                        data-mode="edit">
                                        <i class='fa fa-edit'></i> 
                                    </a>
                                    <a href="#" style="margin-right: 10px;" id="btn-kabkot-delete" data-mode="delete" data-id="{{$data->id}}"><i class="fa fa-trash"> </i></a>
                                </td>
                            </tr>
                        @php $no++; @endphp
                        @endforeach
                    </body>
                </table>  
            </div>
        </div>
    </div>
    </fieldset>
</div>
<div class="modal fade" id="modalForm" name="modalForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
    <div class="modal-content">
        <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
        <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </a>
        <div class="media align-items-center">
            <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
            <div class="media-body mg-sm-l-20">
            <h4 class="tx-18 tx-sm-20 mg-b-2">Kabupaten / Kota</h4>
            <p class="tx-13 tx-color-03 mg-b-0">Enter all required information in these field.</p>
            </div>
        </div><!-- media -->
        </div><!-- modal-header -->
        <form id ="modal-sub-menu">
            <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                <div class="row row-sm mg-b-10 sb-div">
                    <div class="col-sm-12 form-group p-name">
                        <label for="sub_name">Name</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="col-sm-12 form-group p-type">
                        <label for="kode">Kode</label>
                        <input type="text" name="kode" class="form-control">
                    </div>
                    <div class="col-sm-12 form-group p-type">
                        <label for="negara_id">Provinsi</label>
                        <select name="provinsi_id" style="width: 100%;"  id="provinsi_id" class="form-control">
                            @foreach($provinsi as $p)
                                <option value="{{$p->id}}">{{$p->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer pd-x-20 pd-y-15">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary modal-edit-btn-save">Save</button>
            </div>
        </form>
    </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" name="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content tx-14">
        <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel6">Modal Title</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
        </div>
        <div class="modal-body">
        <p class="mg-b-0">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. T</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger tx-13" id="confirmDelete"> Hapus </button>
        </div>
    </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', ()=>{
        var mainAdd = document.querySelector('.main-add');
        var btnEdit = document.querySelector('menu-btn-edit');
        var modalElement = document.querySelector('#modalForm');
        var modalAdd = new bootstrap.Modal(modalElement,{keyboard:true, backdrop:true});
        var deleteMdl = document.querySelector('#deleteModal');
        var modalDelete = new bootstrap.Modal(deleteMdl,{keyboard:true, backdrop:true});
        let _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $('#provinsi_id').select2({
            placeholder: "Pilih negara",
            allowClear: true // Opsi untuk membersihkan pilihan
        });

        document.querySelectorAll('.main-add, #menu-btn-edit, #btn-kabkot-delete').forEach(button => {
            button.addEventListener('click', function (event) {
                const mode = button.getAttribute('data-mode');
                const id = button.getAttribute('data-id') || null;
                const nama = button.getAttribute('data-nama') || '';
                const kode = button.getAttribute('data-kode') || '';
                const provinsi = button.getAttribute('data-provinsi') || '';

                let form = modalElement.querySelector('form');
                form.reset();

                if (mode === 'edit') {
                    modalElement.querySelector('.modal-edit-btn-save').textContent = 'Update';
                    form.querySelector('input[name="nama"]').value = nama;
                    form.querySelector('input[name="kode"]').value = kode;
                    form.querySelector('select[name="provinsi_id"]').value = provinsi;
                    form.setAttribute('data-id', id);
                    modalAdd.show();
                } else if (mode === 'delete') {
                    modalDelete.show();
                }else {
                    modalElement.querySelector('.modal-edit-btn-save').textContent = 'Save';
                    form.removeAttribute('data-id');
                    modalAdd.show();
                }

                $('.modal-edit-btn-save').off('click').click(function () {
                    let data = $(form).serialize();
                    let base = '{{route("adm.kabupaten.index")}}';
                    
                    if (id) {
                        $.ajax({
                            url: `${base}/${id}`,
                            method: 'PUT',
                            headers:{
                                'X-CSRF-TOKEN' : _token
                            },
                            data: data,
                            success: function (response) {
                                location.reload();
                            },
                            error: function (error) {
                                alert('Failed to update data.');
                            }
                        });
                    } else {
                        $.ajax({
                            url: base,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': _token
                            },
                            data: data,
                            success: function (response) {
                                location.reload();
                            },
                            error: function (error) {
                                alert('Failed to create data.');
                            }
                        });
                    }
                });
                // delete action
                $('#confirmDelete').off('click').click(function () {
                    let data = $(form).serialize();
                    let base = '{{url("adm/kabupaten")}}';
                    console.log
                    if (id) {
                        $.ajax({
                            url: `${base}/${id}`,
                            method: 'DELETE',
                            headers:{
                                'X-CSRF-TOKEN' : _token
                            },
                            success: function (response) {
                                location.reload();
                            },
                            error: function (error) {
                                alert('Failed to delete data.');
                            }
                        });
                    }
                });

            });
        });


        document.addEventListener('click', function(evt){
            let ds = evt.target.closest('[data-dismiss="modal"]');
            if(ds){
                modalAdd.hide();
            }
        });
    });
</script>
@endsection