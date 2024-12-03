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
    <h4 class="text-start">Kategori Usaha</h4>
    <p class="tx-color-03 tx-12 mg-b-0">Daftar kategori usaha</p>
    <br/>
    <fieldset class="form-fieldset">
        <div class="d-flex justify-content-end mb-4">
            <a class='btn border border-danger' href="{{ route('adm.kategori.create') }}"> <i class='fa fa-plus-circle'></i><span class="m-2">Tambah</span></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered w-100">
                        <thead>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Jenis Usaha</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php $num = 1; ?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td>{{ $data->jenis->nama ?? 'N/A' }}</td>
                                    <td class="text-end">
                                        <a href="#" style="margin-right: 10px;" id="kategori-edit" data-id="{{ $data->id }}"><i class='fa fa-edit'></i> </a>
                                        <a href="#" style="margin-right: 10px;" id="kategori-delete" data-id="{{ $data->id }}"><i class="fa fa-trash"></i></a>
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

<!-- Modal Edit Kategori -->
<div class="modal" id="editKategoriModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modal-kategori" method="POST" action="#">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editKategoriId" name="id">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="editNama" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="editDeskripsi" name="deskripsi" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jenis_id">Jenis</label>
                        <select id="editJenisId" name="jenis_id" class="form-control">
                            <!-- Options will be populated dynamically via AJAX -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editSave">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Delete Kategori -->
<div class="modal fade" id="deleteModal" name="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel6">Delete Kategori</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this category?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger tx-13" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const btnKategoriEdit = document.querySelector('#kategori-edit');
        const btnKategoriDelete = document.querySelector('#kategori-delete');
        const modal = document.querySelector('#deleteModal');
        const modalEdit = document.querySelector('#editKategoriModal');
        const modalEditEl = new bootstrap.Modal(modalEdit, {keyboard: true, backdrop: true});
        const modalDelete = new bootstrap.Modal(modal, {keyboard: true, backdrop: true});
        const confirmDelete = document.querySelector('#confirmDelete');
        const idKategori = document.querySelector('#editKategoriId');
        const editSave = document.querySelector('#editSave');

        // DELETE KATEGORI
        // btnKategoriDelete.addEventListener('click', () => {
        //     modalDelete.show();
        //     const delId = btnKategoriDelete.getAttribute('data-id');
        //     const urlDel = `{{ url('adm/kategori') }}/${delId}`;
        //     confirmDelete.addEventListener('click', function() {
        //         fetch(urlDel, {
        //             method: 'DELETE',
        //             headers: {
        //                 'Content-type': 'application/json',
        //                 'X-CSRF-TOKEN': _token,
        //             }
        //         }).then(response => {
        //             if (response.ok) {
        //                 modalDelete.hide();
        //                 window.location.reload();
        //             } else {
        //                 alert('Failed to delete category');
        //             }
        //         }).catch(error => {
        //             console.log(error);
        //             alert('Error occurred while deleting category');
        //         });
        //     });
        // });

        // SAVE EDIT KATEGORI
        editSave.addEventListener('click', function() {
            const id = idKategori.getAttribute('value');
            const urlEdit = `{{ url('adm/kategori') }}/${id}`;
            const form = document.querySelector('#modal-kategori');
            const data = {
                nama: document.querySelector('#editNama').value,
                deskripsi: document.querySelector('#editDeskripsi').value,
                jenis_id: document.querySelector('#editJenisId').value
            };

            fetch(urlEdit, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': _token
                },
                body: JSON.stringify(data)
            }).then(response => {
                console.log(response)
                if (response.ok) {

                    response.json().then(data => {
                        if (data.status == 'success') {
                            modalEditEl.hide();
                            window.location.reload();
                        } else {
                            alert('Error updating category');
                        }
                    });
                } else {
                    alert('Failed to update category');
                }
            })
            .catch(error => {
                console.log(error);
                alert('Error occurred while updating category');
            });
        });

        document.addEventListener('click', function(ev){
            let dismis = ev.target.closest('button[data-dismiss="modal"]');
            const btnedit = ev.target.closest('a[id="kategori-edit"]');
            const bdelete = ev.target.closest('a[id="kategori-delete"]');
            
            if(btnedit){
                btnedit.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    idKategori.setAttribute('value', id);
                    modalEditEl.show();

                    const nama = $('#editNama');
                    const deskripsi = $('#editDeskripsi');
                    const jenis_id = $('#editJenisId');

                    const url = `{{ url('api/kategori/by-id/') }}/${id}`;
                    fetch(url, {
                        method: "GET",
                        headers: {
                            'Content-type': 'application/json',
                            'X-CSRF-TOKEN': _token,
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const resp = data.data;
                        nama.val(resp.nama);
                        deskripsi.val(resp.deskripsi);
                        const jenisIdSelect = document.querySelector('#editJenisId');
                        const jenisUrl = `{{ route('/') }}/api/jenis/all`;  // Updated URL using the 'jenis.by-id' route
                        fetch(jenisUrl, {
                            method: "GET",
                            headers: {
                                'Content-type': 'application/json',
                                'X-CSRF-TOKEN': _token,
                            }
                        })
                        .then(response => response.json())
                        .then(jenisData => {
                            // Clear the select options first
                            jenisIdSelect.innerHTML = '';
                            // Check if the response contains the expected data
                            console.log(typeof(jenisData));
                            if (jenisData.data && Array.isArray(jenisData.data)) {
                                // Populate options dynamically
                                jenisData.data.forEach(jenis => {
                                    console.log(jenis);
                                    const option = document.createElement('option');
                                    option.value = jenis.id;  // Assuming 'id' is the value for each option
                                    option.textContent = jenis.nama;  // Assuming 'name' is the label for each option
                                    jenisIdSelect.appendChild(option);
                                });
                            }

                            // Set the selected value for "jenis_id"
                            jenisIdSelect.value = resp.jenis_id;  // This will set the selected option based on the fetched data
                        })
                        .catch(error => {
                            console.log('Error fetching jenis options:', error);
                        });
                    }).catch(error => {
                        console.log(error);
                        alert('Error fetching category details');
                    });
                });
            }
            if(bdelete){
                // DELETE KATEGORI
                bdelete.addEventListener('click', () => {
                    modalDelete.show();
                    const delId = btnKategoriDelete.getAttribute('data-id');
                    const urlDel = `{{ url('adm/kategori') }}/${delId}`;
                    confirmDelete.addEventListener('click', function() {
                        fetch(urlDel, {
                            method: 'DELETE',
                            headers: {
                                'Content-type': 'application/json',
                                'X-CSRF-TOKEN': _token,
                            }
                        }).then(response => {
                            if (response.ok) {
                                modalDelete.hide();
                                window.location.reload();
                            } else {
                                alert('Failed to delete category');
                            }
                        }).catch(error => {
                            console.log(error);
                            alert('Error occurred while deleting category');
                        });
                    });
                });
            }
            if(dismis){
                if (modalEditEl && modalEditEl.hide) {
                    console.log("Modal sedang ditutup");
                    modalEditEl.hide(); // Menutup modal secara manual
                }
            }
        });
    });
</script>

@endsection
