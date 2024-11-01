@extends('layouts.admin.base')
@section('content')
    @section('crumb')
    <div class="mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div class="d-sm-flex justify-content-between">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item active" aria-current="page">Organisai</li>
                </ol>
            </nav>
        </div>
    </div>
    </hr>
    @endsection
    <div class="container-fluid">
        <fieldset class="form-fieldset">
        <div class="d-flex justify-content-end mb-4">
            <a class='btn border border-danger' href="{{route('adm.org.create')}}"> <i class='fa fa-plus-circle'></i><span class="m-2">Tambah</span></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="example1" class="table table table-striped table-hover w-100"></table>  
                    </div>
            </div>
        </div>
        </fieldset>
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
    $('#example1').DataTable({
        'ajax': {
            'url': '{{ route("api.org.data") }}',
            'dataSrc': 'data', // This indicates where the data is located in the response
            'error': function(xhr, error, code) {
                console.log('Error:', error);
                console.log('Code:', code);
                console.log(xhr.responseText);
            }
        },
        "columns": [
            { "data": "nama_usaha","title" : "Nama Usaha" },
            { "data": "nib", "title": "NIB" },
            { "data": "nomor_telepon", "title": "Telepon / HP" },
            { "data": "email", "title" : "E-Mail" },
            { "data": "tahun_memulai_usaha", "title" : "Tahun Mulai" },
            { "data": "id",
                "title" : "Action",
                "render": function(data, type, row){
                    const urledit = `{{ route('adm.org.edit',':id') }}`.replace(':id', data);
                    const urlview = `{{ route('adm.org.show',':id') }}`.replace(':id', data);
                    const urldelete = `{{ route('adm.org.destroy',':id') }}`.replace(':id', data);
                    
                    const edit = `<a href="${urledit}" class='btn border border-success'> <ion-icon name='pencil-sharp'></ion-icon></a>`;
                    const view = `<a href="${urlview}" class='btn border border-success'> <i class='fa fa-eye'></i></a>`;
                    // const del = `<a href="${urldelete}" class='btn border border-danger'> <i class='fa fa-trash'></i></a>`;
                    const del = `<button class='btn border border-danger' onclick="deleteRecord('${urldelete}')"> <i class='fa fa-trash'></i></button>`;
                    return `<div class="d-flex justify-content-center"> ${edit} ${view} ${del}</div>` 
                },
                "className": "text-center"
            }
        ],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
        },
        responsive: true,

    });

    let deleteUrl = '';
    
    function deleteRecord(url) {
        deleteUrl = url; // Store the URL to use when confirming the deletion
        $('#deleteModal').modal('show'); // Show the modal
    }
    document.getElementById('confirmDelete').onclick = function() {
        fetch(deleteUrl, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include the CSRF token
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                // alert('Record deleted successfully!');
                location.reload(); // Reload the page or refresh the data table
            } else {
                alert('Failed to delete the record. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the record. Please try again.');
        });
    };
    
</script>
@endsection