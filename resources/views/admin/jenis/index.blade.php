@extends('layouts.admin.base')
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
    <h4 class="text-start">Jenis Usaha</h4>
    <p class="tx-color-03 tx-12 mg-b-0">Daftar jenis usaha</p>
    <br/>
    <fieldset class="form-fieldset">
        <div class="d-flex justify-content-end mb-4">
            <a class='btn border border-danger' href="{{route('adm.jenis.create')}}"> <i class='fa fa-plus-circle'></i><span class="m-2">Tambah</span></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered w-100">
                        <head>
                            <th>No.</th>
                            <th>Jenis</th>
                            <th>Deskripsi</th>
                            <th></th>
                        </head>
                        <body>
                            <?php $num =1; ?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$num}}</td>
                                    <td>{{$data->nama}}</td>
                                    <td>{{$data->deskripsi}}</td>
                                    <td class="text-end">
                                        {{-- <a href="{{route('adm.jenis.show',$data->id)}}" style="margin-right: 10px;"><i class="fa fa-eye"></i> </a> --}}
                                        <a href="#" style="margin-right: 10px;" id="jenis-edit" data-id="{{$data->id}}"><i class='fa fa-edit'></i> </a>
                                        <a href="#" style="margin-right: 10px;" id="jenis-delete" data-id="{{$data->id}}"><i class="fa fa-trash"> </i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <table class="w-100 table">
                                            <thead>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <?php $i =1;?>
                                                @foreach($data->kategori as $sub)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td>{{ $sub->nama }}</td>
                                                        <td>{{ $sub->deskripsi }}</td>
                                                        <td class="text-start">
                                                            {{-- <a href="" style="margin-right: 10px;"><i class="fa fa-eye"></i> </a>
                                                            <a href="#" style="margin-right: 10px;" id="kategori-edit"><i class='fa fa-edit'></i> </a>
                                                            <a href="#" style="margin-right: 10px;" id="kategori-delete" data-id=""><i class="fa fa-trash"> </i></a> --}}
                                                        </td>
                                                    </tr>
                                                    <?php $i++ ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php $num++; ?>
                            @endforeach
                        </body>
                    </table>  
                </div>
            </div>
        </div>
    </fieldset>
</div>
<div class="modal fade" id="jenisModalEdit" name="jenisModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
            <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
            <div class="media align-items-center">
                <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
                <div class="media-body mg-sm-l-20">
                <h4 class="tx-18 tx-sm-20 mg-b-2">Enter Sub-menu</h4>
                <p class="tx-13 tx-color-03 mg-b-0">Enter all required information in these field.</p>
                </div>
            </div><!-- media -->
            </div><!-- modal-header -->
            <form id ="modal-sub-menu">
                <input type="hidden" value="" id="id-jenis">
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <div class="row row-sm mg-b-10 sb-div">
                        <div class="col-sm-12 form-group p-name">
                            <label for="sub_name">Nama</label>
                            <input 
                            type="text" 
                            class="form-control" 
                            placeholder="" 
                            name="nama"
                            id="nama"
                            value="{{old('nama')}}"
                            required minlength="3">
                        </div>
                        <div class="col-sm-12 form-group p-type">
                            <label for="sub_name">Deskripsi</label>
                            <textarea 
                            class="form-control" 
                            name="deskripsi"
                            id="deskripsi"
                            value=""
                            required minlength="3"> {{old('deskripsi')}} </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="modal-edit-btn-save">Save</button>
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
        const _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const btnJenisEdit = document.querySelector('#jenis-edit');
        const btnJenisDelete = document.querySelector('#jenis-delete');
        const btnKategEdit = document.querySelector('#kategori-edit');
        const btnKategDelete = document.querySelector('#kategori-delete')
        const modal = document.querySelector('#deleteModal');
        const modalEdit = document.querySelector('#jenisModalEdit');
        const modalEditEl = new bootstrap.Modal(modalEdit, {keyboard:true, backdrop:true});
        const modalDelete = new bootstrap.Modal(modal, {keyboard:true, backdrop:true});
        const confirmDelete = document.querySelector('#confirmDelete');
        const idJenis = document.querySelector('#id-jenis');
        const editSave = document.querySelector('#modal-edit-btn-save');

        btnJenisDelete.addEventListener('click',() => {
            modalDelete.show();
            let delId = btnJenisDelete.getAttribute('data-id');
            let urlDel = `{{url('adm/jenis/')}}/${delId}`; 
            confirmDelete.addEventListener('click', function(){
                fetch(urlDel, {
                    method:'DELETE',
                    headers: {
                        'Content-type' : 'application/json',
                        'X-CSRF-TOKEN' :_token,
                    }
                }).then(response => {
                    if(response.ok){
                        console.log(response)
                        // modalDelete.hide();
                        // window.location.reload();
                    }
                }).catch(error => {
                    console.log(error);
                });
            });
        });

        btnJenisEdit.addEventListener('click', function(){
            let id = this.getAttribute('data-id');
            idJenis.setAttribute('value', id);
            modalEditEl.show();

            let nama = $('#nama');
            let deskripsi = $('#deskripsi');

            let _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let url = `{{url('api/jenis/by-id')}}/${id}`;
            fetch(url,{
                method: "GET",
                headers:{
                    'Content-type' : 'application/json',
                    'X-CSRF-TOKEN' : _token,
                }
            })
            .then(response => {
                console.log(response)
                return response.json();
            })
            .then(data => {
                let resp = data.data
                nama.val(resp.nama)
                deskripsi.val(resp.deskripsi)
            })
            .catch(error => {});
        });

        editSave.addEventListener('click', function(){
            let _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let id = idJenis.getAttribute('value');
            let urlEdit = `{{url('adm/jenis/')}}/${id}`;

            let datapost = {
                nama : $('#nama').val(),
                deskripsi : $('#deskripsi').val()
            }

            fetch(urlEdit,{
                method: "PUT",
                headers:{
                    'Content-type' : 'application/json',
                    'X-CSRF-TOKEN' : _token,
                },
                body : JSON.stringify(datapost)
            })
            .then(response => {
                console.log(response);
                if(response.ok){
                    modalEditEl.hide();
                    window.location.reload();
                }
            })
            .then(data => {})
            .catch(error => {});
        });

        document.addEventListener('click', function(event){
            let diss = event.target.closest('[data-dismiss="modal"]');
            if(diss){
                modalEditEl.hide();
            }
        });
    });
</script>
@endsection