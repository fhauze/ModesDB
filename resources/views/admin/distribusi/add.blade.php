@extends('layouts.admin.base')
@section('content')
    @section('crumb')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{route('adm.org.index')}}">Organisai</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                </ol>
            </nav>
        </div>
        <div style="padding-right:0% !important">
            <a href="{{route('adm.menu.index')}}" class="btn btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kembali" >
                <i class="fa fa-arrow-left"></i>
            </a>
        </div>
    </div>
    @endsection
    <div class="container">
        <fieldset class="form-fieldset">
            <form id="formAdd" class="needs-validation was-validated" novalidate action="{{route('adm.menu.store')}}" method="POST">
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                        <label for="name">Name</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder=" @error('nib') {{ $message }} @else {{'Menu name'}} @enderror" 
                            name="name"
                            id="name"
                            value="{{old('nib')}}"
                            required>
                    </div>
                    <div class="parsley-select col-sm-6 form-group">
                        <input type="hidden" name="idme"/>
                        <label for="type">Type</label>
                        <select class="form-select" name="type" id="type" required>
                            <option value="" selected>Choose one</option>
                            @foreach($types as $type)
                                <option value="{{$type['value']}}">{{$type['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="justify-content-between btn-parent">
                    <a class="btn btn-primary btn-block" name="btn-simpan">Simpan</a>
                    <a type="reset" class="btn btn-secondary btn-block">Batal</a>
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
        <div class="table-responsive">
            <table id="example1" class="table table-hover w-100">
                <head>
                    <th>Menu Name</th>
                    <th>Type</th>
                    <th>Parent</th>
                    <th>Route Name</th>
                    <th></th>
                </head>
                <tbody>
                    @foreach($parents as $parent)
                        <tr>
                            <td>{{ $parent->name }}</td>
                            <td>
                                <table>
                                    <thead>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Route</th>
                                    </thead>
                                    <tbody>
                                        @foreach($parent->subMenus as $sub)
                                            <tr>
                                                <td>{{ $sub->name }}</td>
                                                <td>{{ $sub->type }}</td>
                                                <td>{{ $sub->route_name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td>{{ $parent->parent_id ?? '' }}</td>
                            <td>{{ $parent->route_name ?? '' }}</td>
                            <td class="text-end">
                                <a href="" style="margin-right: 10px;"><i class="fa fa-eye"></i> </a>
                                <a href="" style="margin-right: 10px;"><i class='fa fa-edit'></i> </a>
                                <a href="" style="margin-right: 10px;"><i class="fa fa-trash"> </i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
    </div>
    <div class="modal fade" id="subModal" name="subModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
          <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
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
            <form id ="modal-sub-menu">
            <div class="row row-sm mg-b-10 sb-div">
                <div class="col-sm-12 form-group p-name">
                    <label for="sub_name">Name</label>
                </div>
                <div class="col-sm-12 form-group p-type">
                    <label for="sub_name">Type</label>
                </div>
                <div class="parsley-select col-sm-12 form-group p-parent">
                    <label for="parent">Parent menu</label>
                </div>
                <div class="col-sm-12 form-group p-route">
                    <label for="route_name">Route Name</label>
                </div>
                 <div class="justify-content-between p-btn">
                    {{--<button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    <a href="{{route('adm.org.index')}}" type="button" class="btn btn-secondary btn-block">Batal</a>--}}
                </div> 
            </div>
            </form>
          </div><!-- modal-body -->
          <div class="modal-footer pd-x-20 pd-y-15">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary modal-btn-save">Save</button>
          </div>
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div>
@endsection
@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const btnParent = document.getElementsByName('btn-simpan')[0];
        const subDiv = document.getElementsByClassName('sb-div')[0];
        const btnParentGroup = document.getElementsByClassName('btn-parent')[0];
        const btnSubAdd = document.getElementsByClassName('btn-add-sub')[0];
        const modalBtnSave = document.querySelector('.modal-btn-save')
        btnSubAdd.removeAttribute('hidden')

        // create Modla Element
        const modal = document.getElementById('subModal');
        const modalElement = bootstrap.Modal.getOrCreateInstance('#subModal');
        const pName = document.querySelector('.p-name');
        const pType = document.querySelector('.p-type');
        const pParent = document.getElementsByClassName('p-parent')[0];
        const pRoute = document.getElementsByClassName('p-route')[0];

        btnSubAdd.addEventListener('click', () => {
            let open = modalElement.show();
            const iname = createEl('input', {class:'form-control', id:'sb-name', name:'sb-name', required:true});
            const iroute = createEl('input', {class:'form-control', id:'sb-route', name:'sb-route', required:true});
            const itype = createDropdown("sb-type",[{id:'link', name:'Link'}, {id:'dropdown', name:'Dropdown'}]);
            let dataParent = @json($parents);
            // dataParent = dataParent.json();
            const iparent = createDropdown("sb-parent",dataParent);

            pName.appendChild(iname);
            pType.appendChild(itype);
            pParent.appendChild(iparent);
            pRoute.appendChild(iroute)
        });

        modalBtnSave.addEventListener('click', () => {
            let url = '{{route("adm.sub-menu.store")}}';
            console.log('token',_token)
            let data = {
                name:document.querySelector('#sb-name').value,
                type:document.querySelector('#sb-type').value,
                parent_id:document.querySelector('#sb-parent').value,
                route_name:document.querySelector('#sb-route').value
            }
            fetch(url,{
                method:'POST',
                headers:{
                    'Content-type' :'application/json',
                    'X-CSRF-TOKEN': _token
                    },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (response.status === 419) {
                    console.error('CSRF token mismatch');
                }
                if (!response.ok) {
                    console.error('HTTP Error:', response.status, response.statusText);
                    return;
                }
                return response.json();
            })
            .catch(error => {
                console.log('error', error)
            });
        });

        btnParent.addEventListener('click', function(e){
            // let _token = document.querySelector('#formAdd input[name="_token"]');
            //     _token = _token.value;
            const data = {
                name: document.getElementById('name').value,
                type: document.getElementById('type').value
            };
            e.preventDefault();
            fetch("{{route('adm.menu.store')}}",{
                method:"POST",
                headers:{
                    'Content-type' : 'application/json',
                    'X-CSRF-TOKEN': _token
                },
                body: JSON.stringify(data),
            })
            .then(response => {
                console.log(response)
                if(response.status == 422){
                    document.getElementById('name')
                    response.json()
                    .then(data => {
                        console.log(data);
                        
                        Object.entries(data.errors).forEach(([field, messages]) => {
                            let fieldEl = document.querySelector(`[name="${field}"]`);
                            fieldEl.classList.add('is-invalid');
                            let errorMessageEl = document.createElement('span');
                            errorMessageEl.style.color = 'red'; 
                            errorMessageEl.textContent = messages;

                            // Append the error message below the input field
                            fieldEl.parentNode.appendChild(errorMessageEl);
                            console.log(`Error di ${field}: ${messages.join(', ')}`);
                        });
                    })
                }
                if(response.ok){
                    btnParentGroup.setAttribute("hidden","hidden")
                    subDiv.removeAttribute('hidden')
                    btnSubAdd.removeAttribute('hidden')
                }
            })
            .catch(error => {
                console.log(error);
            })
        })

        // function element creator
        function createDropdown(/** containerId, */ name,options) {
            // const container = document.getElementById(containerId);
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
            // container.appendChild(select);
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
            /** 
            children.forEach(child => {
                if (typeof child === 'string') {
                    element.appendChild(document.createTextNode(child)); // Tambahkan teks
                } else {
                    element.appendChild(child); // Tambahkan elemen lain
                }
            });
            */
            return element;
        }

    });
    $('#tahun').yearpicker({
        onChange : function(value){
            // YOUR CODE COMES_HERE
        }
    });
</script>
@endsection