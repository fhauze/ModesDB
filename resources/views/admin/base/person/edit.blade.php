@extends('layouts.admin.base')
@section('styles')
<style>
    .input-group.date input {
        border-radius: 0px;
        border: 1px solid #007bff;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
        padding: 12px;
        font-size:inherit;
    }

    .input-group.date input:focus {
        border-color: #28a745;
        /* box-shadow: 0 0 10px rgba(40, 167, 69, 0.5); */
    }

    /* Styling untuk ikon kalender */
    .input-group-text {
        border-radius: 10px;
        background-color: #007bff;
        color: white;
        font-size: inherit;
    }

    /* Styling popup datepicker */
    .datepicker {
        background-color: inherit;
        border-radius: 4px;
        padding: 5px;
        /* box-shadow: 0 4px 10px rgba(0,0,0,0.2); */
        z-index: 9999;
    }

    /* Menambahkan animasi pada tanggal saat dipilih */
    .datepicker table tr td.today {
        background-color: #28a745;
        color: white;
    }

    .datepicker table tr td,
    .datepicker table tr th {
        padding: 5px;
        font-size: inherit;
        border: 1px solid #e4e4e4;
        text-align: center;
    }

    /* Styling tombol navigasi bulan di popup */
    .datepicker .datepicker-days th {
        background-color: #faf1f0; /* Mengubah warna header bulan */
        color: #333;
    }

    .datepicker .datepicker-days td {
        cursor: pointer;
    }

    .datepicker .datepicker-days td:hover {
        background-color: #007bff;
        color: white;
    }

    /* Mengubah styling bagian ganti bulan dan tahun (month navigation) */
    .datepicker .datepicker-months th {
        background-color: #faf1f0; /* Mengubah warna background header bulan */
        color: #333;  /* Mengubah warna teks header bulan */
    }

    /* Styling untuk tanggal yang dipilih */
    .datepicker table tr td.active,
    .datepicker table tr td.active:hover {
        background-color: #28a745;
        color: white;
    }

    /* Menambahkan border dan padding pada tombol navigasi */
    .datepicker .prev, .datepicker .next {
        background-color: #faf1f0; /* Mengubah warna tombol */
        color: #333; /* Mengubah warna ikon tombol */
        border-radius: 50%;
        padding: 8px;
    }

    /* Menambahkan ukuran dan efek pada tombol close */
    .datepicker .datepicker-close {
        background-color: #dc3545;
        color: white;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 14px;
    }

    /* Responsif untuk perangkat kecil */
    @media (max-width: 576px) {
        .datepicker-dropdown {
            width: 100% !important;
        }
    }
</style>
@endsection
@section('content')
    @section('crumb')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Organisai</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
            </ol>
        </nav>
        </div>
    </div>
    @endsection
    <div class="container d-flex flex-column">
        <h4 class="text-start">User Profile</h4>
        <p class="tx-color-03 tx-12 mg-b-0">Profile dari user sebagai info user</p>
        <br/>
        {{-- <div class="d-flex p-1" style="gap: 2px"> --}}
            <form id="formAdd" class="needs-validation was-validated" novalidate action="{{route('adm.person.update',$data->id ?? 0)}}" method="POST">
            @csrf
            @method('PUT')
            <fieldset class="form-fieldset col-md-8">
                <legend> Basic Data</legend>
                <div class="row row-sm mg-b-4">
                    <input type="hidden" 
                            class="form-control form-control-sm state @error('user_id') is-invalid @enderror" 
                            placeholder="user_id" 
                            name="user_id" 
                            id="user_id" 
                            value="{{ old('user_id', $data->user_id  ?? '' ) }}">
                            @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    <input type="hidden" 
                            class="form-control form-control-sm state @error('person_id') is-invalid @enderror" 
                            placeholder="person_id" 
                            name="person_id" 
                            id="person_id"
                            value="{{ old('user_id', $data->id  ?? '' ) }}">
                            @error('person_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div class=" form-group">
                        <label for="nib">Nama</label>
                        <input type="text" 
                            class="form-control form-control-sm state @error('Nama') is-invalid @enderror" 
                            placeholder="Nama" 
                            name="nama" 
                            id="nama"
                            value="{{ old('nama', $data ? $data->nama :'' ) }}">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class=" form-group" id="div-kelamin" aria-hidden="true">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control form-control-md select2 @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                            <option label="Pilih satu"></option>
                            <option value="l" @if($data->jenis_kelamin == 'l') {{ 'selected' }} @endif>Laki-Laki</option>
                            <option value="p" @if($data->jenis_kelamin == 'p') {{ 'selected' }} @endif>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row row-sm mg-b-4 mt-4">
                    <div class=" form-group" id="div-tgl-lahir">
                        <label for="tanggal_lahir">Tgl Lahir</label>
                        <input 
                            type="text" 
                            class="form-control form-control-sm datepicker @error('tanggal_lahir') is-invalid @enderror" 
                            id="tanggal_lahir" 
                            name="tanggal_lahir" 
                            placeholder="Masukkan tanggal lahir" 
                            value="{{ old('tanggal_lahir', $data->tanggal_lahir ?? '') }}">
                            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class=" mg-t-1 form-group">
                        <label for="alamat">Alamat</label>
                        <textarea 
                            class="form-control form-control-sm @error('alamat') is-invalid @enderror" 
                            rows="2" 
                            placeholder="Alamat sesuai tanda pengenal" 
                            name="alamat" id="alamat">{{ old('alamat', $data->alamat ?? '') }}</textarea>
                            <div class="valid-feedback">Looks good!</div>
                            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="divider-text text-left "> Info Perusahaan </div>
                <div class="row row-sm mg-b-4">
                    <div class=" form-group" id="div-kelamin" aria-hidden="true">
                        <label for="usaha_id">Perusahaan</label>
                        <select class="form-control form-control-sm select2 @error('usaha_id') is-invalid @enderror" name="usaha_id" id="usaha_id">
                            <!-- <option label="Pilih satu">Perusahaan</option> -->
                        </select>
                        @error('usaha_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="divider-text text-left "> Keahlian </div>
                <div class="row row-sm mg-b-4">
                    <div class=" form-group" id="div-kelamin" aria-hidden="true">
                        <label for="sertifikasi">Sertifikasi</label>
                        <textarea 
                            class="form-control form-control-sm @error('sertifikasi') is-invalid @enderror" 
                            rows="4" 
                            placeholder="Tulis keterangan sertifikasi yang diikuti" 
                            name="sertifikasi" id="sertifikasi">{{ old('sertifikasi' , $data->profile->sertifikasi ?? '') }}</textarea>
                            @error('sertifikasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="divider-text "> Info Kontak</div>
                <div class="row row-sm mg-b-4">
                    <div class=" form-group">
                        <label for="no_telepon">Hp</label>
                        <input type="text" 
                            class="form-control form-control-sm @error('no_telepon') is-invalid @enderror" 
                            placeholder="contoh : +628111077" 
                            name="no_telepon"
                            id="no_telepon" 
                            value="{{old('no_telepon', $data->no_telepon ?? '')}}">
                            @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row row-sm mg-b-4 mt-4">
                    <div class=" form-group">
                        <label for="email">Email</label>
                        <input type="email" 
                            class="form-control form-control-sm @error('email') is-invalid @enderror" 
                            placeholder="contoh : user@gmail.com" 
                            name="email" 
                            id="email" 
                            value="{{old('email', $data->email ?? '')}}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div> 
                </div>
                <div class="row row-sm mg-b-4 mt-4 mb-3">
                    <div class="col-mb-3">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Facebook @</span>
                            <input type="text" class="form-control form-control-sm @error('fbid') is-invalid @enderror " 
                            name="fbid" id="fbid" aria-describedby="basic-addon3" value="{{ old('fbid', $data->profile->fbid ?? '')}}">
                            @error('fbid') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="row row-sm mg-b-4">
                    <div class="col-mb-3 ">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">Instagram @</span>
                            <input type="text" class="form-control form-control-sm @error('igid') is-invalid @enderror" 
                            name="igid" id="igid" aria-describedby="basic-addon3" value="{{ old('igid', $data->profile->igid ?? '')}}">
                            @error('igid') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="row pt-4">    
                    <div class="justify-centent-start">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        {{-- <a type="button" href="{{route('adm.org.index')}}" class="btn btn-secondary">Batal</a> --}}
                    </div>
                </div>
            </fieldset>
            </form>
        </div>
    {{-- </div> --}}
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dropdownDiv = document.getElementById('div-kelamin');
        const dropdown = dropdownDiv.querySelector('select');

        $('.select2').select2({
            placeholder: 'Choose one',
            searchInputPlaceholder: 'Search options'
        });
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,     
            todayHighlight: true,
            language: 'id',      
            todayBtn: "linked",  
            weekStart: 1,  
        });
        
        // function createDropdown(name,options) {
        //     const select = document.createElement('select');
        //     select.setAttribute('class','form-control')
        //     select.setAttribute('name',name)
        //     select.setAttribute('id',name)
        //     options.forEach(optionData => {
        //         const option = document.createElement('option');
        //         option.value = optionData.id;
        //         option.textContent = optionData.name;
        //         select.appendChild(option);
        //     });
        //     return select;
        // }
    });
</script>
@endsection