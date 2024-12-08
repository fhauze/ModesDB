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
        <form action="{{ $mode === 'ubah' ? route('adm.produksi.update', $data->id ?? '') : route('adm.produksi.store') }}" method="POST">
            @csrf
            @if($mode === 'ubah' || $mode === 'view')
                @method('PUT')
            @endif

            <div class="row row-sm">
                <div class="col-md-6 mb-3">
                    <label for="usaha_id" class="form-label">Usaha</label>
                    <select class="form-select" name="usaha_id" id="usaha_id" required {{ $mode === 'edit' ? 'disabled' : '' }}>
                        <option value="" selected>Pilih salah satu</option>
                        @foreach($usaha as $u)
                            <option value="{{$u->id}}" selected>{{$u->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                    <select class="form-select" name="jenis_id" id="jenis_id" required {{ $mode === 'edit' ? 'disabled' : '' }}>
                        <option value="" selected>Pilih salah satu</option>
                        @foreach($jenis as $j)
                            <option value="{{$j->id}}" selected>{{$j->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="kategori_usaha" class="form-label">Kategori Usaha</label>
                    <select class="form-select" name="kategori_id" id="kategori_id" required {{ $mode === 'edit' ? 'disabled' : '' }}>
                        <option value="" selected>Pilih salah satu</option>
                        @foreach($kategoris as $k){
                            <option value="{{$k->id}}" selected>{{$k->nama}}</option>
                        }
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tahun" class="form-label">Tahun Produksi</label>
                    <input type="number" class="form-control" id="tahun" name="tahun" value="{{ old('tahun', $data ? $data->th : '') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="pekerja" class="form-label">Jumlah Pekerja</label>
                    <input type="number" class="form-control" id="pekerja" name="pekerja" value="{{ old('pekerja', $data ? $data->pekerja : '') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="vol_produksi" class="form-label">Volume Produksi</label>
                    <input type="number" class="form-control" id="vol_produksi" name="vol_produksi" value="{{ old('vol_produksi', $data ? $data->vol_produksi : '') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="bahan_baku" class="form-label">Bahan Baku</label>
                    <input type="text" class="form-control" id="bahan_baku" name="bahan_baku" value="{{ old('bahan_baku', $data ? $data->bahan_baku : '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="persentase_bahan_lokal" class="form-label">Persentase Bahan Lokal (%)</label>
                    <input type="number" class="form-control" id="persentase_bahan_lokal" name="persentase_bahan_lokal" value="{{ old('persentase_bahan_lokal', $data ? $data->persentase_bahan_lokal : '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="persentase_bahan_impor" class="form-label">Persentase Bahan Impor (%)</label>
                    <input type="number" class="form-control" id="persentase_bahan_impor" name="persentase_bahan_impor" value="{{ old('persentase_bahan_impor', $data ? $data->persentase_bahan_impor : '') }}">
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
    });
</script>
@endsection