@extends('layouts.admin.base')
@section('crumb')
<div class="mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div class="d-sm-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item active" aria-current="page">Daftar Usaha</li>
            </ol>
        </nav>
    </div>
</div>
</hr>
@endsection
@section('content')
<div class="container-fluid">
    @if (userCan('edit_module'))
    <div class="row">
        <div class="row mb-4">
            <div class="col-md-12 p-0 ps-0 pr-1 d-flex justify-content-end">
                <a class='btn border border-danger' href="{{route('adm.usaha.create')}}"> 
                    <i class='fa fa-plus-circle'></i>
                    <span class="m-2">Tambah</span>
                </a>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="row mb-4">
        <form method="GET" action="{{ route('adm.usaha.index') }}">
            <div class="col-md-12 p-0 ps-0 pr-1">
                <fieldset class="row form-fieldset m-1 gap-4">
                    <legend>Filters</legend>
                    <div class="parsley-select form-group col-3">
                        <label for="jenis">Jenis</label>
                        <select class="form-select" name="jenis" id="jenis" onchange="this.form.submit()">
                            <option value="" selected>Choose one</option>
                            @foreach($jenis as $type)
                                <option value="{{ $type['id'] }}" 
                                    {{ request('jenis') == $type['id'] ? 'selected' : '' }}>
                                    {{ $type['nama'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="parsley-select form-group col-3">
                        <label for="tahun">Tahun</label>
                        <select class="form-select" name="tahun" id="tahun" onchange="this.form.submit()">
                            <option value="" selected>Choose one</option>
                            @foreach($tahuns as $tahun)
                                <option value="{{ $tahun['tahun_berdiri'] }}" 
                                    {{ request('tahun') == $tahun['tahun_berdiri'] ? 'selected' : '' }}>
                                    {{ $tahun['tahun_berdiri'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </fieldset>
            </div>
        </form>
        </div>
        <div class="row">
            <div class="col-md-12 pd-2">
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-usaha">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Usaha</th>
                                <th>Alamat</th>
                                <th>Provinsi</th>
                                <th>Kab/Kota</th>
                                <th>Tahun Berdiri</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $usaha)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $usaha->nama }}</td>
                                    <td>{{ $usaha->alamat }}</td>
                                    <td>{{ $usaha->provinsi_id }}</td>
                                    <td>{{ $usaha->kabkot_id }}</td>
                                    <td>{{ $usaha->tahun_berdiri ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('adm.usaha.edit', $usaha) }}" class="btn" title="Edit">
                                                <i class='fa fa-edit'></i>
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('adm.usaha.destroy', $usaha) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus usaha ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn " title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" name="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content tx-14">
        <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel6">Modal Title</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
        </div>
        <div class="modal-body">
        <p class="mg-b-0">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. T</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger tx-13" id="confirmDelete"> Hapus </button>
        </div>
    </div>
    </div>
</div>
@endsection
@section('scripts')
<script>

    let deleteUrl = '';
    
    function deleteRecord(url) {
        deleteUrl = url; // Store the URL to use when confirming the deletion
        $('#deleteModal').modal('show'); // Show the modal
    }
    document.addEventListener('DOMContentLoaded', ()=>{
        //select2
        $('#jenis').select2({dropdownAutoWidth : true});
        $('#tahun').select2({dropdownAutoWidth : true});
        $('.table-usaha').DataTable({});
    })
</script>
@endsection