@extends('layouts.admin.base')
@section('content')
    @section('crumb')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{route('adm.menu.index')}}">Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Data</li>
            </ol>
        </nav>
        </div>
    </div>
    @endsection
    <div class="container">
        <fieldset class="form-fieldset">
            <form id="formAdd" class="needs-validation was-validated" novalidate action="{{route('adm.menu.store')}}" method="POST">
                <input type="hidden" name="id" id="id">
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                        <label for="name">Name</label>
                        <input 
                            type="text" 
                            class="form-control disabled" 
                            placeholder=" @error('nib') {{ $message }} @else {{'Menu name'}} @enderror" 
                            name="name"
                            id="name"
                            value="{{old('name', $data->name)}}"
                            disabled>
                    </div>
                    <div class="parsley-select col-sm-6 form-group">
                        <input type="hidden" name="idme" id="idme" value="{{$data->id}}"/>
                        <label for="type">Type</label>
                        <select class="form-select" name="type" id="type" required>
                            <option value="" selected>Choose one</option>
                            @foreach($types as $type)
                                <option value="{{$type['value']}}" {{$type['value'] == $data->type ? 'selected' :''}}>{{$type['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="justify-content-between btn-add-sub" hidden="hidden">
                    <input 
                        type="hidden" 
                        placeholder="" 
                        name="name"
                        id="name"
                        value="1">
                    <a class="btn btn-primary btn-block" name="btn-simpan">Sub Menu</a>
                </div>
                <hr/>                
            </form>
        </fieldset>
        <div class="divider-text">Sub Menu</div>
        <fieldset class="form-fieldset">
            <legend>Sub Menu</legend>
            <div class="d-flex justify-content-end mb-4">
                <a class='btn border border-danger modal-tambah-sub' href="#"> <i class='fa fa-plus-circle'></i><span class="m-2">Tambah</span></a>
            </div>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered w-100">
                    <thead>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Route</th>
                    </thead>
                    <tbody>
                        @foreach($data->subMenus as $sub)
                            <tr>
                                <td>{{ $sub->name }}</td>
                                <td>{{ $sub->type }}</td>
                                <td>{{ $sub->route_name }}</td>
                                <td class="text-end">
                                    <a href="#" style="margin-right: 10px;" id="btn-sub-edit" data-id="{{$sub->id}}"><i class='fa fa-edit'></i> </a>
                                    <a href="#" style="margin-right: 10px;" id="btn-sub-delete" data-id="{{$sub->id}}" data-nama="{{$data->name}}"><i class="fa fa-trash"> </i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>     
            </div>
        </fieldset>
    </div>

    <div class="modal fade" id="subModal" name="subModal" tabindex="-1" role="dialog" aria-hidden="true">
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
          <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
            <form id="modal-sub-menu" name="modal-sub-menu">
            <div class="row row-sm mg-b-10 sb-div">
                <div class="col-sm-12 form-group a-p-name">
                    <label for="sub_name">Name</label>
                </div>
                <div class="col-sm-12 form-group a-p-disp_name">
                    <label for="sub_name">Display Name</label>
                </div>
                <div class="col-sm-12 form-group a-p-type">
                    <label for="sub_name">Type</label>
                </div>
                <div class="parsley-select col-sm-12 form-group a-p-parent">
                    <label for="parent">Parent menu</label>
                    <select class="form-control" name="parent_id" id="parent_id" disabled>
                        <option value="{{$data->id}}">{{$data->name}}</option>
                    </select>
                </div>
                <div class="col-sm-12 form-group a-p-route">
                    <label for="route_name">Route Name</label>
                </div>
                 <div class="justify-content-between a-p-btn">
                    {{--<button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    <a href="{{route('adm.org.index')}}" type="button" class="btn btn-secondary btn-block">Batal</a>--}}
                </div> 
            </div>
            </form>
          </div><!-- modal-body -->
          <div class="modal-footer pd-x-20 pd-y-15">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary modal-add-btn-save">Save</button>
          </div>
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div>
    <div class="modal fade" id="subModalEdit" name="subModalEdit" tabindex="-1" role="dialog" aria-hidden="true">
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
          <form id="form-sub-menu" name="form-sub-menu">
            @csrf
          <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
            <input type="hidden" name="editId">
            <div class="row row-sm mg-b-10 sb-div">
                <div class="col-sm-12 form-group p-name">
                    <label for="sub_name">Name</label>
                </div>
                <div class="col-sm-12 form-group p-disp_name">
                    <label for="sub_name">Display Name</label>
                </div>
                <div class="col-sm-12 form-group p-type">
                    <label for="sub_name">Type</label>
                </div>
                <div class="parsley-select col-sm-12 form-group p-parent">
                    <label for="parent">Parent menu</label>
                    <select class="form-control" name="e-parent_id" id="e-parent_id" disabled>
                        <option value="{{$data->id}}">{{$data->name}}</option>
                    </select>
                </div>
                <div class="col-sm-12 form-group p-route">
                    <label for="route_name">Route Name</label>
                </div>
                 <div class="justify-content-between p-btn">
                    {{--<button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    <a href="{{route('adm.org.index')}}" type="button" class="btn btn-secondary btn-block">Batal</a>--}}
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
    <div class="modal fade" id="subModalDelete" name="subModalDelete" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
          <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
            <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </a>
            <div class="media align-items-center">
              <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
              <div class="media-body mg-sm-l-20">
                <h4 class="tx-18 tx-sm-20 mg-b-2">Confirm</h4>
                <p class="tx-13 tx-color-03 mg-b-0">Are you sure want to delete this data ?</p>
              </div>
            </div><!-- media -->
          </div><!-- modal-header -->
          <div class="modal-footer pd-x-20 pd-y-15">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary btn-modal-delete-confirm">Save</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnAdd = document.querySelector('.modal-tambah-sub');
        const btnSubEdit = document.querySelector('#btn-sub-edit')
        const modal = document.getElementById('subModal');
        const modalEdit = document.getElementById('subModalEdit');
        const modalDelete = document.getElementById('subModalDelete');
        const modalElement = new bootstrap.Modal(modal,{keyboard:true,backdrop:true});
        const modalEditElement = new bootstrap.Modal(modalEdit,{keyboard:true,backdrop:true});
        const modalDeleteElement = new bootstrap.Modal(modalDelete,{keyboard:true,backdrop:true});
        const btnModalAddSave = document.querySelector('.modal-add-btn-save');
        const btnModalEditSave = document.querySelector('.modal-edit-btn-save');
        const btnConfirmModalDelete = document.querySelector('.btn-modal-delete-confirm');
        let _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        //components
        const iname = createEl('input', {class:'form-control', id:'sb-name', name:'sb-name', required:true});
        const idisp_name = createEl('input', {class:'form-control', id:'sb-disp_name', name:'sb-disp_name', required:true});
        const iroute = createEl('input', {class:'form-control', id:'sb-route', name:'sb-route', required:true});
        const itype = createDropdown("sb-type",[{id:'link', name:'Link'}, {id:'dropdown', name:'Dropdown'}]);
        let dataParent = @json($parents);
        const iparent = document.querySelector('#parent_id');

        document.querySelector('.a-p-name').appendChild(iname);
        document.querySelector('.a-p-disp_name').appendChild(idisp_name);
        document.querySelector('.a-p-type').appendChild(itype);
        document.querySelector('.a-p-parent').appendChild(iparent);
        document.querySelector('.a-p-route').appendChild(iroute)

        // Edit
        const ename = createEl('input', {class:'form-control', id:'e-name', name:'e-name', required:true});
        const edisp_name = createEl('input', {class:'form-control', id:'e-disp_name', name:'e-disp_name', required:true});
        const eroute = createEl('input', {class:'form-control', id:'e-route', name:'e-route', required:true});
        const etype = createDropdown("e-type",[{id:'link', name:'Link'}, {id:'dropdown', name:'Dropdown'}]);
        const eparent = document.querySelector('#e-parent_id');

        document.querySelector('.p-name').appendChild(ename);
        document.querySelector('.p-disp_name').appendChild(edisp_name);
        document.querySelector('.p-type').appendChild(etype);
        document.querySelector('.p-parent').appendChild(eparent);
        document.querySelector('.p-route').appendChild(eroute)

        btnAdd.addEventListener('click', () => {
            modalElement.show();
        });

        document.addEventListener('click', function(event){
            const editButton = event.target.closest('#btn-sub-edit');
            const btnSubDelete = event.target.closest('#btn-sub-delete');
            if(editButton){
                let dataId = editButton.getAttribute('data-id');
                let id = document.getElementById('idme').value
                let url =`{{url('api/menu/sub/') }}/${dataId}`;

                modalEditElement.show();

                fetch(url, {
                    method:"GET",
                    headers:{
                        'Content-type' : 'application/json',
                        'X-CSRF-TOKEN': _token
                    }
                }).then(response => {
                    console.log("res");
                    if(response.status == 422){
                        document.getElementById('name')
                        return response.json()
                        .then(data => {
                            console.log(data);
                            
                            Object.entries(data.errors).forEach(([field, messages]) => {
                                let fieldEl = document.querySelector(`[name="sb-${field}"]`);
                                fieldEl.classList.add('is-invalid');
                                let errorMessageEl = document.createElement('span');
                                errorMessageEl.style.color = 'red'; 
                                errorMessageEl.textContent = messages;

                                fieldEl.parentNode.appendChild(errorMessageEl);
                                console.log(`Error di ${field}: ${messages.join(', ')}`);
                            });
                        })
                    }
                    if(!response.ok){
                        throw new Error(`HTTP Error: ${response.status}`);
                    }
                    return response.json();
                }).then(data => {
                    let resData =data.data
                    console.log(resData);
                    ename.value = resData.name || '';
                    edisp_name.value = resData.display_name || '';
                    eroute .value = resData.route_name || '';
                    etype.value = resData.type || '';
                    eparent.value = resData.menu_id ||'';
                    console.log(resData.id);
                    let url = `{{url('adm/sub-menu')}}/${resData.id}`;

                    const formEdit = document.querySelector('#form-sub-menu');
                    formEdit.setAttribute('action',url);
                    $('#form-sub-menu').attr('method','PATCH');
                    
                    console.log("yeah")
                    btnModalEditSave.addEventListener('click' , () => {
                        let toSave = {
                            name : $('#e-name').val(),
                            display_name : $('#e-disp_name').val(),
                            type : $('#e-type').val(),
                            route_name : $('#e-route').val(),
                            menu_id : $('#e-parent_id').val(),
                        }
                        fetch(url,{
                            method:"PATCH",
                            headers:{
                                'Content-Type' : 'application/json',
                                'X-CSRF-TOKEN' : _token
                            },
                            body :JSON.stringify(toSave)
                        }).then(response => {
                            if(response.ok){
                                modalEditElement.hide();
                                window.location.reload();
                            }
                        }).catch(error => {
                            console.log("error", error)
                        });
                    },{ once: true });
                })
                .catch(error => {
                });
            }

            if(btnSubDelete){
                let subId = btnSubDelete.getAttribute('data-id');
                let subName = btnSubDelete.getAttribute('data-nama');
                let url = `{{url('adm/sub-menu/')}}/${subId}`;

                modalDeleteElement.show();
                btnConfirmModalDelete.addEventListener('click', () =>{
                    fetch(url, {
                        method:"DELETE",
                        headers:{
                            'Content-type' : 'application/json',
                            'X-CSRF-TOKEN' : _token
                        }
                    })
                    .then(response => {
                        if(response.status == 422 ){
                            console.log('error')
                        }
                        if(response.ok){
                            modalDeleteElement.hide();
                            window.location.href = "{{route('adm.menu.show',$data->id)}}";
                        }
                    })
                    .catch(error => {
                        console.log("error boy")
                    });
                });
            }
        });

        
        btnModalAddSave.addEventListener('click', ()=> {
            let id = document.getElementById('idme').value
            let url ="{{ route('adm.sub-menu.store') }}";
            let data = {
                name: iname.value,
                type:itype.value,
                menu_id: id,
                route_name:iroute.value
            };

            fetch(url, {
                method:"POST",
                headers:{
                    'Content-type' : 'application/json',
                    'X-CSRF-TOKEN': _token
                },
                body:JSON.stringify(data)
            })
            .then(response => {
                console.log(response);
                if(response.status == 422){
                    document.getElementById('name')
                    response.json()
                    .then(data => {
                        console.log(data);
                        
                        Object.entries(data.errors).forEach(([field, messages]) => {
                            let fieldEl = document.querySelector(`[name="sb-${field}"]`);
                            fieldEl.classList.add('is-invalid');
                            let errorMessageEl = document.createElement('span');
                            errorMessageEl.style.color = 'red'; 
                            errorMessageEl.textContent = messages;

                            fieldEl.parentNode.appendChild(errorMessageEl);
                            console.log(`Error di ${field}: ${messages.join(', ')}`);
                        });
                    })
                }
                if(response.ok){
                    console.log('oke')
                    modalElement.hide();
                    window.location.href = "{{route('adm.menu.show',$data->id)}}";
                }
            }).then(data => {
                console.log(data)
                $(this).closest('.modal').modal('hide');
            })
            .catch(error => {
                console.log('Error')
            });
        });

        $(document).on('click', '[data-dismiss="modal"]', function(){
            modalEditElement.hide();
            modalDeleteElement.hide();
            modalElement.hide();
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