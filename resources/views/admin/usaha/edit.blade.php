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
    <div class="container col-md-10">
        <h4 class="text-start">Form Ubah Data Usaha</h4>
        <p class="tx-color-03 tx-12 mg-b-0">Form untuk menambah data usaha.</p>
        <br/>
        <fieldset class="form-fieldset">
            <form action="{{ route('adm.usaha.update', $usaha->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                        <label for="nama" class="form-label">Nama Usaha</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $usaha->nama) }}" required>
                    </div>
                </div>
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-12 form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea type="text" class="form-control" id="alamat" name="alamat">{{ old('alamat', $usaha->alamat)}}</textarea>
                    </div>
                </div>
                <div class="parsley-select col-sm-6 form-group">
                    <label for="type">Jenis</label>
                    <select class="form-select" name="jenis_id" id="jenis_id" required>
                        <option value="" selected>Choose one</option>
                        @foreach($jenis as $type)
                            <option value="{{$type['id'] }}" {{ old('jenis_id')}} {{ $usaha->jenis_id == $type['id'] ? 'selected' :''}} >{{$type['nama']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                        <label for="provinsi_id" class="form-label">Provinsi</label>
                        <select class="form-select" name="provinsi_id" id="provinsi_id" required>
                            <option value="" selected>Choose one</option>
                            @foreach($provinsi as $prov)
                                <option value="{{$prov['id']}}" {{$usaha->provinsi_id == $prov['id'] ? 'selected' : ''}}>{{$prov['nama']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="kabkot_id" class="form-label">Kab/Kota</label>
                        <select class="form-select" name="kabkot_id" id="kabkot_id" required>
                            <option value="" selected>Choose one</option>
                            @foreach($kabupatens as $kabkota)
                                <option 
                                    value="{{$kabkota['id']}}" 
                                    {{ (null != $usaha->kabkot_id) ? ($usaha->kabkot_id == $kabkota->id ? 'selected' : '') :''}}>
                                    {{$kabkota['nama']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                        <label for="teknologi" class="form-label">Teknologi</label>
                        <input type="text" class="form-control" id="teknologi" name="teknologi" value="{{ old('teknologi', $usaha->teknologi) }}">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="pekerja" class="form-label">Jumlah Pekerja</label>
                        <input type="number" class="form-control" id="pekerja" name="pekerja" value="{{ old('pekerja', $usaha->pekerja) }}">
                    </div>
                </div>
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                        <label for="sertifikasi" class="form-label">Sertifikasi</label>
                        <input type="text" class="form-control" id="sertifikasi" name="sertifikasi" value="{{ old('sertifikasi', $usaha->sertifikasi) }}">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                        <input type="number" class="form-control" id="tahun_berdiri" name="tahun_berdiri" value="{{ old('tahun_berdiri', $usaha->tahun_berdiri) }}">
                    </div>
                </div>
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-12 form-group">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $usaha->deskripsi) }}</textarea>
                    </div>
                </div>
                <div class="row row-sm mg-b-10">
                    <div class="col-sm-6 form-group">
                    <label for="social_media" class="form-label">Media Sosial</label>
                        <select class="form-select" name="social_media" id="social_media" required>
                            <option value="" selected>Choose one</option>
                            @foreach($socials as $sos)
                                <option value="{{$sos['id']}}" {{(null != $usaha->social_media && $usaha->social_media == $sos['id']) ?  'selected' : ''}}>{{$sos['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="sosmed_accoutn" class="form-label">Akun Media Sosial</label>
                        <input type="text" class="form-control" id="sosmed_accoutn" name="sosmed_accoutn" value="{{ old('sosmed_accoutn', $usaha->sosmed_accoutn ?? '') }}">
                    </div>
                </div>
                <div class="row row-sm mg-b-10 mb-4">
                    <div class="col-sm-6 form-group">
                        <label for="website" class="form-label">Website</label>
                        <input type="url" class="form-control" id="website" name="website" value="{{ old('website', $usaha->website ?? '') }}">
                    </div>
                </div>
                <div class="row row-sm mg-b-10 mb-4">
                    <div class="col-sm-6 form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
@endsection
@section('scripts')
@endsection