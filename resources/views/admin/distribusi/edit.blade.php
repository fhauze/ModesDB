@extends('layouts.admin.base')
@section('content')
    @section('crumb')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{route('adm.org.index')}}">Distribusi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
            </ol>
        </nav>
        </div>
    </div>
    @endsection
    <div class="container">
        <fieldset class="form-fieldset">
        <form action="{{ route('usaha.update', $usaha) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Usaha</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $usaha->nama }}" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $usaha->alamat }}" required>
            </div>

            <div class="mb-3">
                <label for="provinsi_id" class="form-label">Provinsi</label>
                <input type="number" class="form-control" id="provinsi_id" name="provinsi_id" value="{{ $usaha->provinsi_id }}" required>
            </div>

            <div class="mb-3">
                <label for="kabkot_id" class="form-label">Kab/Kota</label>
                <input type="number" class="form-control" id="kabkot_id" name="kabkot_id" value="{{ $usaha->kabkot_id }}" required>
            </div>

            <div class="mb-3">
                <label for="teknologi" class="form-label">Teknologi</label>
                <input type="text" class="form-control" id="teknologi" name="teknologi" value="{{ $usaha->teknologi }}">
            </div>

            <div class="mb-3">
                <label for="pekerja" class="form-label">Jumlah Pekerja</label>
                <input type="number" class="form-control" id="pekerja" name="pekerja" value="{{ $usaha->pekerja }}">
            </div>

            <div class="mb-3">
                <label for="sertifikasi" class="form-label">Sertifikasi</label>
                <input type="text" class="form-control" id="sertifikasi" name="sertifikasi" value="{{ $usaha->sertifikasi }}">
            </div>

            <div class="mb-3">
                <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                <input type="number" class="form-control" id="tahun_berdiri" name="tahun_berdiri" value="{{ $usaha->tahun_berdiri }}">
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $usaha->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label for="social_media" class="form-label">Media Sosial</label>
                <input type="text" class="form-control" id="social_media" name="social_media" value="{{ $usaha->social_media }}">
            </div>

            <div class="mb-3">
                <label for="sosmed_accoutn" class="form-label">Akun Media Sosial</label>
                <input type="text" class="form-control" id="sosmed_accoutn" name="sosmed_accoutn" value="{{ $usaha->sosmed_accoutn }}">
            </div>

            <div class="mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="url" class="form-control" id="website" name="website" value="{{ $usaha->website }}">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
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