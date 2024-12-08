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
    <h4 class="text-start">Daftar Menu</h4>
    <p class="tx-color-03 tx-12 mg-b-0">Daftar menu dan turunannya.</p>
    <br/>
    <fieldset class="form-fieldset">
    <div class="d-flex justify-content-end mb-4">
        <a class='btn border border-danger' href="{{route('adm.menu.create')}}"> <i class='fa fa-plus-circle'></i><span class="m-2">Tambah</span></a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered w-100">
                    <head>
                        <th>Menu Name</th>
                        <th>Type</th>
                        <th>Parent</th>
                        <th>Route Name</th>
                        <th></th>
                    </head>
                    <body>
                        <?php $num =1; ?>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{$menu->display_name}}</td>
                                <td>{{$menu->type}}</td>
                                <td>{{$menu->parent_id ?? ''}}</td>
                                <td>{{$menu->route_name ?? ''}}</td>
                                <td class="text-end">
                                    <a href="{{route('adm.menu.show',$menu->id)}}" style="margin-right: 10px;"><i class="fa fa-eye"></i> </a>
                                    <a href="#" style="margin-right: 10px;" id="menu-btn-edit" data-id="{{$menu->id}}"><i class='fa fa-edit'></i> </a>
                                    <a href="#" style="margin-right: 10px;" id="btn-menu-delete" data-id="{{$menu->id}}"><i class="fa fa-trash"> </i></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <table class="w-100 table">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            <?php $i =1;?>
                                            @foreach($menu->subMenus as $sub)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{ $sub->display_name }}</td>
                                                    <td>{{ $sub->type }}</td>
                                                    <td>{{ $sub->route_name }}</td>
                                                    <td class="text-start">
                                                        {{-- <a href="" style="margin-right: 10px;"><i class="fa fa-eye"></i> </a>
                                                        <a href="#" style="margin-right: 10px;"><i class='fa fa-edit'></i> </a>
                                                        <a href="#" style="margin-right: 10px;" id="sub-menu-delete" data-id=""><i class="fa fa-trash"> </i></a> --}}
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
                    <div class="col-sm-12 form-group p-display">
                        <label for="sub_display_name">Display Name</label>
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
        const edispname = createEl('input', {class:'form-control', id:'e-display', name:'e-display', required:true});
        const etype = createDropdown("e-type",[{id:'link', name:'Link'}, {id:'dropdown', name:'Dropdown'}]);
        const btnModalEditSave = document.querySelector('.modal-edit-btn-save');
        document.querySelector('.p-name').appendChild(ename);
        document.querySelector('.p-type').appendChild(etype);
        document.querySelector('.p-display').appendChild(edispname);
        
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
                    edispname.value = dataResponse.display_name
                    
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
                            display_name : $('#e-display').val(),
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