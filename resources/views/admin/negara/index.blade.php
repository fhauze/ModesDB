@extends('layouts.admin.base')

@section('crumb')
<div class="mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div class="d-sm-flex justify-content-between">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item active" aria-current="page">Menu</li>
            </ol>
        </nav>
    </div>
</div>
</hr>
@endsection

@section('content')
<div class="container-fluid">
    <h4 class="text-start">Kategori Negara</h4>
    <p class="tx-color-03 tx-12 mg-b-0">Daftar negara beserta kode negara</p>
    <br/>
    <fieldset class="form-fieldset">
        <div class="d-flex justify-content-end mb-4">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="negara" class="table table-bordered w-100">
                        <thead>
                            <th>No.</th>
                            <th>Nama Negara</th>
                            <th>Kode</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php $num = 1; ?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->kode }}</td>
                                    <td class="text-end">
                                        {{-- <a href="#" style="margin-right: 10px;" id="kategori-edit" data-id="{{ $data->id }}"><i class='fa fa-edit'></i> </a>
                                        <a href="#" style="margin-right: 10px;" id="kategori-delete" data-id="{{ $data->id }}"><i class="fa fa-trash"></i></a> --}}
                                    </td>
                                </tr>
                            <?php $num++; ?>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </fieldset>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('#negara').DataTable({});
    });
</script>

@endsection
