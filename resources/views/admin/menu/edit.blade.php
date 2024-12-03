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
        <h4 class="text-start">Ubah Menu</h4>
        <p class="tx-color-03 tx-12 mg-b-0">Perubaha menu di sidebar</p>
        <br/>
        <fieldset class="form-fieldset">
            <form id="formAdd" class="needs-validation was-validated" novalidate action="{{route('adm.org.update',$data->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                        <label for="nib">NIB</label>
                        <input type="text" 
                            class="form-control state" 
                            placeholder="Valid" 
                            name="nib" 
                            value="{{ old('nib', $data->nib) }}"
                            {{ in_array('nib', session('requiredFields', [])) ? 'required' : '' }}>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="nama_usaha">Nama Usaha</label>
                        <input type="text" 
                            class="form-control state" 
                            placeholder="Valid" 
                            name="nama_usaha" 
                            value="{{ old('nama_usaha', $data->nama_usaha) }}"
                            {{ in_array('nama_usaha', session('requiredFields', [])) ? 'required' : '' }}>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="nomor_telepon">No.HP</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">US (+62)</span>
                            </div>
                            <input type="text" 
                                class="form-control" 
                                placeholder="Enter phone number" 
                                name="nomor_telepon" 
                                value="{{ old('nomor_telepon', $data->nomor_telepon) }}"
                                {{ in_array('nomor_telepon', session('requiredFields', [])) ? 'required' : '' }}>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="email">Email</label>
                        <input type="text" 
                            class="form-control state" 
                            placeholder="contoh : user@gmail.com" 
                            name="email" 
                            value="{{ in_array('email', session('requiredFields', [])) || $errors->has('email') ? '' : $data->email }}"
                            {{ in_array('email', session('requiredFields', [])) && $errors->has('email') ? 'required' : '' }}>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="ig_fb">Akun Social Media</label>
                        <input 
                            type="text" 
                            class="form-control state" 
                            placeholder="@akunanda" 
                            name="ig_fb" 
                            value="{{ old('ig_fb', $data->ig_fb) }}"
                            {{ in_array('ig_fb', session('requiredFields', [])) ? 'required' : '' }}>
                    </div>
                    <div class="col-sm-6 mg-t-10 form-group">
                        <label for="alamat">Alamat. Usaha</label>
                        <textarea 
                            class="form-control" 
                            rows="2" 
                            placeholder="Valid state" 
                            name="alamat" 
                            {{ in_array('alamat', session('requiredFields', [])) ? 'required' : '' }}>
                            {{ old('alamat', $data->alamat) }}
                        </textarea>
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">Tahun</label>
                        <input 
                            type="text" 
                            class="form-control yearpicker" 
                            placeholder="Valid" 
                            name="tahun_memulai_usaha" 
                            id="tahun_memulai_usaha" 
                            value="{{ old('tahun_memulai_usaha', $data->tahun_memulai_usaha) }}"
                            {{ in_array('tahun_memulai_usaha', session('requiredFields', [])) ? 'required' : '' }}>
                    </div>
                    <div class="justify-content-between">
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        <a type="button" href="{{route('adm.org.index')}}" class="btn btn-secondary btn-block">Batal</a>
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