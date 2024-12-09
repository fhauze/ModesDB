@extends('layouts.admin.base')
@section('content')
@section('crumb')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('adm.profesi.index') }}">Profesi</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($mode) }} Data</li>
            </ol>
        </nav>
    </div>
    <div style="padding-right:0% !important">
        <a href="{{ route('adm.profesi.index') }}" class="btn btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kembali">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>
@endsection

<div class="container">
    <h4 class="text-start mb-2">{{ ucfirst($mode) }} Data Produksi</h4>
    <p class="tx-color-03 tx-12 mb-4">Gunakan form ini untuk menambah atau mengedit data profesi.</p>

    <fieldset class="form-fieldset">
        <form action="{{ $mode === 'ubah' ? route('adm.profesi.update', $data->id ?? '') : route('adm.profesi.store') }}" method="POST">
            @csrf
            @if($mode === 'ubah' || $mode === 'lihat')
                @method('PUT')
            @endif
            <div class="row row-sm">
                <div class="col-md-12 mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" value="{{old('nama', $data->nama ?? '')}}">
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-md-12 mb-3">
                    <label for="jenis_usaha" class="form-label">Jenis Usaha</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi">{{old('deskripsi', $data->deskripsi ?? '')}}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-start">
                @if($mode != 'lihat')
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