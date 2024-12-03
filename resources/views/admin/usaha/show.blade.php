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
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">{{ $usaha->nama }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">Nama Usaha:</th>
                                <td>{{ $usaha->nama }}</td>
                            </tr>
                            <tr>
                                <th>Alamat:</th>
                                <td>{{ $usaha->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Provinsi:</th>
                                <td>{{ $usaha->provinsi_id }}</td>
                            </tr>
                            <tr>
                                <th>Kab/Kota:</th>
                                <td>{{ $usaha->kabkot_id }}</td>
                            </tr>
                            <tr>
                                <th>Teknologi:</th>
                                <td>{{ $usaha->teknologi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pekerja:</th>
                                <td>{{ $usaha->pekerja }}</td>
                            </tr>
                            <tr>
                                <th>Sertifikasi:</th>
                                <td>{{ $usaha->sertifikasi ?? 'Tidak Ada' }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Berdiri:</th>
                                <td>{{ $usaha->tahun_berdiri ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi:</th>
                                <td>{{ $usaha->deskripsi ?? 'Tidak Ada' }}</td>
                            </tr>
                            <tr>
                                <th>Social Media:</th>
                                <td>{{ $usaha->social_media ?? 'Tidak Ada' }}</td>
                            </tr>
                            <tr>
                                <th>Akun Sosial Media:</th>
                                <td>{{ $usaha->sosmed_accoutn ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Website:</th>
                                <td>
                                    @if ($usaha->website)
                                        <a href="{{ $usaha->website }}" target="_blank" class="text-decoration-none">
                                            {{ $usaha->website }}
                                        </a>
                                    @else
                                        Tidak Ada
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <!-- Back Button -->
                    <a href="{{ route('usaha.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <!-- Edit Button -->
                    <a href="{{ route('usaha.edit', $usaha) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </fieldset>
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
        const iroute = createEl('input', {class:'form-control', id:'sb-route', name:'sb-route', required:true});
        const itype = createDropdown("sb-type",[{id:'link', name:'Link'}, {id:'dropdown', name:'Dropdown'}]);
        let dataParent = @json($parents);
        const iparent = document.querySelector('#parent_id');

        document.querySelector('.a-p-name').appendChild(iname);
        document.querySelector('.a-p-type').appendChild(itype);
        document.querySelector('.a-p-parent').appendChild(iparent);
        document.querySelector('.a-p-route').appendChild(iroute)

        // Edit
        const ename = createEl('input', {class:'form-control', id:'e-name', name:'e-name', required:true});
        const eroute = createEl('input', {class:'form-control', id:'e-route', name:'e-route', required:true});
        const etype = createDropdown("e-type",[{id:'link', name:'Link'}, {id:'dropdown', name:'Dropdown'}]);
        const eparent = document.querySelector('#e-parent_id');

        document.querySelector('.p-name').appendChild(ename);
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
                    return response.json();
                }).then(data => {
                    data =data.data
                    ename.value = data.name 
                    eroute .value = data.route_name
                    etype.value = data.type
                    eparen.value = data.parent_id
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