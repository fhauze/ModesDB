@extends('layouts.admin.base')
@section('content')
    @section('crumb')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{route('adm.org.index')}}">Organisai</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Data</li>
            </ol>
        </nav>
        </div>
    </div>
    @endsection
    <div class="container">
        <fieldset class="form-fieldset">
            <form id="formAdd" class="needs-validation was-validated" novalidate action="{{route('adm.org.update',$data->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">NIB</label>
                        <input type="text" class="form-control state" placeholder="Valid" name="nib" value="{{ old('nib', $data->nib) }}">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">Nama Usaha</label>
                        <input type="text" class="form-control state" placeholder="Valid" name="nama_usaha" value="{{ old('nama_usaha', $data->nama_usaha) }}">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">No.HP</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">US (+62)</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Enter phone number" name="nomor_telepon" value="{{ old('nomor_telepon', $data->nomor_telepon) }}">
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">Email</label>
                        <input type="text" class="form-control state" placeholder="Valid" name="email" value="{{ old('email', $data->email) }}">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">Akun Social Media</label>
                        <input type="text" class="form-control state" placeholder="Valid" name="ig_fb" value="{{ old('ig_fb', $data->ig_fb) }}">
                    </div>
                    <div class="col-sm-6 mg-t-10 form-group">
                        <label for="alamat">Alamat. Usaha</label>
                        <textarea class="form-control" rows="2" placeholder="Valid state" name="alamat">{{ old('alamat', $data->alamat) }}</textarea>
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="inputEmail4">Tahun</label>
                        <input type="text" class="form-control yearpicker" placeholder="Valid" name="tahun_memulai_usaha" id="tahun_memulai_usaha" value="{{ old('tahun_memulai_usaha', $data->tahun_memulai_usaha) }}">
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