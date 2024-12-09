@extends('layouts.admin.base')
@section('crumb')
<div class="mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div class="d-sm-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item active" aria-current="page">Produksi</li>
            </ol>
        </nav>
    </div>
</div>
</hr>
@endsection
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-end mb-4">
        <a class='btn border border-danger' href="{{ route('adm.produksi.mode', ['mode' => 'create']) }}"> 
            <i class='fa fa-plus-circle'></i>
            <span class="m-2">Tambah</span>
        </a>
    </div>
    <div class="row">
        <div class="row">
            <div class="col-md-12 p-2 ps-0 pr-1">
                <fieldset class="row form-fieldset m-1">
                    <legend>Filters</legend>
                        <div class="parsley-select form-group col-2">
                            <label for="type">Jenis</label>
                            <select class="form-select" name="jenis" id="jenis">
                                <option value="" selected>Choose one</option>
                               
                            </select>
                        </div>
                        <div class="parsley-select form-group col-2">
                            <label for="type">Kategori</label>
                            <select class="form-select" name="jenis" id="jenis">
                                <option value="" selected>Choose one</option>
                                
                            </select>
                        </div>
                        <div class="parsley-select form-group col-2">
                            <label for="type">Tahun</label>
                            <select class="form-select" name="jenis" id="jenis">
                                <option value="" selected>Choose one</option>
                                
                            </select>
                        </div>
                        <div class="parsley-select form-group col-2">
                            <label for="type">Produksi</label>
                            <select class="form-select" name="jenis" id="jenis">
                                <option value="" selected>Choose one</option>
                                
                            </select>
                        </div>
                        <div class="parsley-select form-group col-2">
                            <label for="type">Distribusi</label>
                            <select class="form-select" name="jenis" id="jenis">
                                <option value="" selected>Choose one</option>
                                
                            </select>
                        </div>
                    <!-- </div> -->
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 pd-2">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama Usaha</th>
                                <th>Jenis Usaha</th>
                                <th>Kategori</th>
                                <th>Jml. Pekeraja</th>
                                <th>Vol. Produksi</th>
                                <th>Bahan Baku</th>
                                <th>Bahan Impor (%)</th>
                                <th>Bahan Lokal (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->jenis->nama ?? ''}}</td>
                                    <td>{{ $data->kategori->nama ?? ''}}</td>
                                    <td>{{ $data->pekerja ?? ''}}</td>
                                    <td>{{ $data->vol_produksi ?? ''}}</td>
                                    <td>{{ $data->bahan_baku ?? '-' }}</td>
                                    <td>{{ $data->persentase_bahan_lokal ?? '-' }}</td>
                                    <td>{{ $data->persentase_bahan_impor ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('adm.produksi.mode', ['mode' => 'view']) }}?id={{$data->id}}" class="btn text-success btn-sm" title="Edit">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <!-- Edit Button -->
                                            <a href="{{ route('adm.produksi.mode', ['mode' => 'ubah']) }}?id={{$data->id}}" class="btn text-warning btn-sm" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('adm.produksi.destroy', $data->usaha) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus usaha ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <a type="submit" class="btn btn-icon btn-sm text-danger" title="Hapus">
                                                    <i class="fa fa-trash"> </i>
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data usaha.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="menuModalEdit" name="menuModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
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
            <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                <div class="row row-sm mg-b-10 sb-div">
                    <div class="col-sm-12 form-group p-name">
                        <label for="sub_name">Name</label>
                    </div>
                    <div class="col-sm-12 form-group p-type">
                        <label for="sub_name">Type</label>
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

    let deleteUrl = '';
    
    function deleteRecord(url) {
        deleteUrl = url; // Store the URL to use when confirming the deletion
        $('#deleteModal').modal('show'); // Show the modal
    }
    document.addEventListener('DOMContentLoaded', ()=>{
        const modalDelete = document.getElementById('deleteModal');
        const modalEdit = document.getElementById('menuModalEdit');
        let _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const modalEditElement = new bootstrap.Modal(modalEdit,{keyboard:true,backdrop:true});
        const modalDeleteElement = new bootstrap.Modal(modalDelete,{keyboard:true,backdrop:true});
        const ename = createEl('input', {class:'form-control', id:'e-name', name:'e-name', required:true});
        const etype = createDropdown("e-type",[{id:'link', name:'Link'}, {id:'dropdown', name:'Dropdown'}]);
        const btnModalEditSave = document.querySelector('.modal-edit-btn-save')
        document.querySelector('.p-name').appendChild(ename);
        document.querySelector('.p-type').appendChild(etype);

        //select2
        $('#jenis').select2({dropdownAutoWidth : true});
        
        document.addEventListener('click', function(event){
            let diss = event.target.closest('[data-dismiss="modal"]');
            let btnDel = event.target.closest('#btn-menu-delete');
            let btnEdit = event.target.closest('#menu-btn-edit');
            
            if(btnEdit){
                modalEditElement.show();
                let editId = btnEdit.getAttribute('data-id');
                let url = `{{url('api/menu/by-id/')}}/${editId}`
                editId = btnEdit.getAttribute('data-id');
                fetch(url, {
                    method:'GET',
                    headers: {
                        'Content-type':'application/json',
                        'X-CSRF-TOKEN' : _token,
                    }
                }).then(response => {
                    if(!response == 422){
                        console.log('error');
                    }else{
                        return response.json();
                    }
                }).then(data => {
                    let dataResponse = data.data
                    ename.value=dataResponse.name
                    etype.value = dataResponse.type
                    
                    let url = `{{url('adm/menu')}}/${dataResponse.id}`;
                    console.log('error');
                    $("#modal-sub-menu").attr('action', url);
                    console.log('error');
                    $("#modal-sub-menu").attr('method', "PATCH");
                    console.log('error');
                    btnModalEditSave.addEventListener('click', function(e){
                    console.log("toSave",dataResponse.id)
                    e.preventDefault();
                    
                    let data = {
                        name : $('#e-name').val(),
                        type : $('#e-type').val(),
                    }
                    fetch(url,{
                        method:"PATCH",
                        headers:{
                            'Content-Type' : 'application/json',
                            'X-CSRF-TOKEN' : _token
                        },
                        body :JSON.stringify(data)
                    }).then(response => {
                        if(response.ok){
                            modalEditElement.hide();
                            window.location.reload();
                        }
                    }).catch(error => {
                        console.log("error", error)
                    });
                });
                })
                .catch(error =>{
                });
            }
            if(btnDel){
                menuId = btnDel.getAttribute('data-id');
                let url = `{{url('adm/menu/')}}/${menuId}`
                
                $('#deleteModal').modal('show');
                $('#confirmDelete').on('click', function(){
                    fetch(url,{
                        method:"DELETE",
                        headers:{
                            'Content-type' : 'application/json',
                            'X-CSRF-TOKEN' : _token
                        },
                    }).then(response =>{
                        if(response.ok){
                            location.reload();
                            $('#deleteModal').modal('hide');
                        }
                    }).catch(error => {
                        console.log('error')
                    });
                })
            }
            if(diss){
                modalEditElement.hide();
                modalDeleteElement.hide();
            }
        });
        
        // function element creator
        function createDropdown(/** containerId, */ name,options) {
            const select = document.createElement('select');
            select.setAttribute('class','form-control')
            select.setAttribute('name',name)
            select.setAttribute('id',name)
            options.forEach(optionData => {
                const option = document.createElement('option');
                option.value = optionData.id;
                option.textContent = optionData.name;
                select.appendChild(option);
            });
            return select;
        }

        // create element input
        function createEl(tag, attributes = {} /** , children = []*/) {
            const element = document.createElement(tag);
            for (const [key, value] of Object.entries(attributes)) {
                if (key.startsWith('data-')) {
                    element.setAttribute(key, value);
                } else if(key === 'id' || key === 'name'){
                    element.setAttribute(key,value)
                }else if (key === 'class') {
                    element.className = value;
                } else if (key === 'style') {
                    Object.assign(element.style, value);
                } else {
                    element[key] = value;
                }
            }
            return element;
        }
    })
</script>
@endsection