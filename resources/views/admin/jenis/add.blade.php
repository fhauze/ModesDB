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
            <form id="formAdd" class="needs-validation was-validated" novalidate action="{{route('adm.jenis.store')}}" method="POST">
                @csrf
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                        <label for="nama">Nama</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="" 
                            name="nama"
                            id="nama"
                            value="{{old('nama')}}"
                            required minlength="3">
                    </div>
                    <div class="parsley-select col-sm-8 form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required minlength="4">{{old('deskripsi')}}</textarea>
                    </div>
                    <div class="parsley-select col-sm-8 form-group">
                        <label for="deskripsi">Industri</label>
                        <select id="industri_id" name="industri_id" class="form-control select2">
                            @forelse($profesis as $profesi)
                            <option value="{{$industri->id ?? ''}}" {{ old('industri_id') == $industri->id ? 'selected' : '' }}>{{$industri->nama}}</option>
                            @empty
                            <option></option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <hr/> 
                <div class="justify-content-between">
                    <button type="submit" class="btn btn-primary btn-block" id="btnSave">Simpan</button>
                    <a type="button" href="{{route('adm.org.index')}}" class="btn btn-secondary btn-block">Batal</a>
                </div>               
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
                   
                </tbody>
            </table>  
        </div>
    </div>
@endsection
@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById('formAdd');
        const btnSave = document.getElementById('btnSave');
        let comps = document.querySelectorAll('.form-control[required]');

        btnSave.disabled = true;
        comps.forEach(comp => {
           comp.addEventListener('blur' , () => {
                validateInput(comp);
                checkValid();
            });
        });

        const industri = document.querySelector('.select2');
        $(industri).select2({
            placeholder: 'Pilih..'
        });
        $(industri).on('change', () => {
            if (industri.value) {
                industri.classList.remove('is-invalid');
                industri.classList.add('is-valid');
            } else {
                industri.classList.remove('is-valid');
                industri.classList.add('is-invalid');
            }
            checkValid();
        });
        // validation
        function validateInput(comp) {
            if (comp.checkValidity()) {
                    comp.classList.remove('is-invalid');
                    comp.classList.add('is-valid');
                } else {
                    comp.classList.remove('is-valid');
                    comp.classList.add('is-invalid');
                }
            }
        function checkValid(){
            let isValid = true;
            
            comps.forEach(comp => {
                if(!comp.classList.contains('is-valid')){
                    isValid = false;
                }
            })

            btnSave.disabled =!isValid;
        }
    });
</script>
@endsection