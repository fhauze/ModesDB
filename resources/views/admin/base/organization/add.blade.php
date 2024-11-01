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
    </div>
    @endsection
    <div class="container">
        <fieldset class="form-fieldset">
            <form id="formAdd" class="needs-validation was-validated" novalidate action="{{route('adm.org.store')}}" method="POST">
                @csrf
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">NIB</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder=" @error('nib') {{ $message }} @else {{'NIB Contoh:99089098'}} @enderror state" 
                            name="nib" 
                            value="{{old('nib')}}"
                            {{ in_array('nib', session('requiredFields', [])) ? 'required' : '' }}>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">Nama Usaha</label>
                        <input 
                            type="text" 
                            class="form-control state" 
                            placeholder="@error('nama_usaha') {{ $message }} @else {{'Valid'}} @enderror" 
                            name="nama_usaha" 
                            value="{{old('nama_usaha')}}"
                            {{ in_array('nama_usaha', session('requiredFields', [])) ? 'required' : '' }}>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">No.HP</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">US (+62)</span>
                            </div>
                            <input
                                type="text" 
                                class="form-control state" 
                                placeholder="@error('nomor_telepon') {{ $message }} @else {{'Enter phone number'}} @enderror" 
                                name="nomor_telepon" 
                                value="{{old('nomor_telepon')}}"
                                {{ in_array('nomor_telepon', session('requiredFields', [])) ? 'required' : '' }}>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">Email</label>
                        <input
                         type="text" 
                         class="form-control state" 
                         placeholder="@error('email') {{ $message }} @else {{'exp@gmail.com'}} @enderror" 
                         name="email" 
                         value="{{old('email')}}"
                         {{ in_array('email', session('requiredFields', [])) ? 'required' : '' }}>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">Akun Social Media</label>
                        <input 
                            type="text" 
                            class="form-control state" 
                            placeholder="@akunanda" 
                            name="ig_fb" 
                            value="{{old('ig_fb')}}"
                            {{ in_array('ig_fb', session('requiredFields', [])) ? 'required' : '' }}>
                    </div>
                    <div class="col-sm-6 mg-t-10 form-group">
                        <label for="alamat">Alamat. Usaha</label>
                        <textarea 
                            class="form-control state" 
                            rows="2" 
                            placeholder="@error('alamat') {{ $message }} @else {{'Alamat Usaha'}} @enderror" 
                            name="alamat" {{ in_array('alamat', session('requiredFields', [])) ? 'required' : '' }}> {{old('alamat')}}
                        </textarea>
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">Tahun</label>
                        <input type="text" 
                        class="form-control yearpicker @error('nibtahun_memulai_usaha') {{ $message }} @else {{'Tahun Operasi contoh : 2023'}} @enderror state" 
                        placeholder="Tahun Operasi" 
                        name="tahun_memulai_usaha" 
                        id="tahun_memulai_usaha" 
                        value="{{old('tahun_memulai_usaha')}}"
                        {{ in_array('tahun_memulai_usaha', session('requiredFields', [])) && $errors->has('tahun_memulai_usaha') ? 'required' : '' }}>
                    </div>
                    <div class="justify-content-between">
                        <button type="submit" class="btn btn-primary btn-block">Button</button>
                        <button type="button" class="btn btn-secondary btn-block">Cancel</button>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
@endsection
@section('scripts')
<script>
    $('#tahun').yearpicker({
        onChange : function(value){
            // YOUR CODE COMES_HERE
        }
    });
</script>
@endsection