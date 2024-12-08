@extends('layouts.admin.base')
@section('content')
@section('crumb')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('adm.produksi.index') }}">Produksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($mode) }} Data</li>
            </ol>
        </nav>
    </div>
    <div style="padding-right:0% !important">
        <a href="{{ route('adm.produksi.index') }}" class="btn btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kembali">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>
@endsection

<div class="container">
    <h4 class="text-start mb-2">{{ ucfirst($mode) }} Data Produksi</h4>
    <p class="tx-color-03 tx-12 mb-4">Gunakan form ini untuk menambah atau mengedit data produksi.</p>

    <fieldset class="form-fieldset">
        <form action="{{ $mode === 'ubah' ? route('adm.distribusi.update', $data->id ?? '') : route('adm.distribusi.store') }}" method="POST">
            @csrf
            @if($mode === 'ubah' || $mode === 'view')
                @method('PUT')
            @endif

            <div class="row row-sm">
                <div class="col-md-12 mb-3">
                    <label for="usaha_id" class="form-label">Nama Distribusi</label>
                        <textarea 
                            class="form-control"
                            name="deskripsi" 
                            id="deskripsi" 
                            cols="30" 
                            rows="1">{{ old('deskripsi', $data ? $data->deskripsi : '') }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="usaha_id" class="form-label">Usaha</label>
                    <select class="form-select select2" name="usaha_id" id="usaha_id" required {{ $mode === 'edit' ? 'disabled' : '' }}>
                        <option ></option>
                        @foreach($usaha as $u)
                            <option value="{{$u->id}}" {{ (null != $data && $data->usaha_id == $u->id) ? 'selected' :''}}>{{$u->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                    <select class="form-select select2" name="jenis_id" id="jenis_id" required {{ $mode === 'edit' ? 'disabled' : '' }}>
                    <option ></option>
                        @foreach($jenis as $j)
                            <option value="{{$j->id}}"  {{ (null != $data && $data->jenis_id == $j->id) ? 'selected' :''}}>{{$j->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="kategori_usaha" class="form-label">Kategori Usaha</label>
                    <select class="form-select select2" name="kategori_id" id="kategori_id" required {{ $mode === 'edit' ? 'disabled' : '' }}>
                    <option ></option>
                        @foreach($kategoris as $k){
                            <option value="{{$k->id}}" {{ (null != $data && $data->kategori_id == $k->id) ? 'selected' :''}}>{{$k->nama}}</option>
                        }
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pekerja" class="form-label">Jenis Distribusi</label>
                    <select type="number" class="form-control select2" id="jenis_distribusi" name="jenis_distribusi">
                    <option ></option>
                        <option value="lokal" {{ (null != $data && $data->jenis_distribusi === 'lokal') ? 'selected' :''}}>Lokal</option>
                        <option value="internasional" {{ (null != $data && $data->jenis_distribusi === 'internasional') ? 'selected' :''}}>Internasional</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun', $data ? $data->th : '') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="vol_produksi" class="form-label">Volume</label>
                    <input type="number" class="form-control" id="volume" name="volume" value="{{ old('vol_produksi', $data ? $data->volume : '') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bahan_baku" class="form-label">Satuan</label>
                    <select type="text" class="form-control select2" id="satuan" name="satuan">
                    <option ></option>
                        <option value="ton" {{(null != $data && $data->satuan === 'ton') ?  'selected' : ''}} >Ton</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-start">
                @if($mode != 'view')
                    <button type="submit" class="btn btn-primary">Simpan</button>
                @endif
            </div>
        </form>
    </fieldset>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const tahunInput = $('#tahun');
        tahunInput.yearpicker();
        if (!tahunInput.val()) {
            tahunInput.val('{{ old('tahun', $data ? $data->tahun : '') }}');
        }

        const select2 = $('.select2');
        select2.select2({
            // closeOnSelect: true,
            // allowClear:true,
            placeholder: "Pilih..",
        });
    });
</script>
@endsection