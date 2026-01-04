@extends('layout.main')

@section('bredcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Supplier</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Supplier</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-12 d-flex no-block">
            <button class="btn m-t-20 btn-info" onclick="addForm()">
                <i class="ti-plus"></i> Tambah
            </button>
            <button class="btn m-t-20 m-l-20 btn-danger">
                <i class="mdi mdi-export" onclick="exportData()"></i> Export
            </button>
        </div>
    </div>

    <!-- Modal Add Category -->
    <div class="modal fade none-border" id="add_supplier">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formTambah">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label class="control-label">Nama Supplier</label>
                                <input class="form-control form-white" type="text" id="nama_supplier"
                                    name="nama_supplier">
                            </div>
                            <div class="col-12">
                                <label class="control-label">Alamat</label>
                                <input class="form-control form-white" type="text" id="alamat" name="alamat">
                            </div>
                            <div class="col-12">
                                <label class="control-label">Email</label>
                                <input class="form-control form-white" type="text" id="email" name="email">
                            </div>
                            <div class="col-12">
                                <label class="control-label">Telp</label>
                                <input class="form-control form-white" type="text" id="telepon" name="telepon">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success ml-auto">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL -->
</div>
@endsection
@section('kontainer')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Supplier</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Supplier</th>
                                    <th>ALamat</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                        <td>Tiger Nixon</td>
                                        <td>$320,800</td>
                                    </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('csss')
<link href="{{ asset('matrix-admin-master') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css"
    rel="stylesheet">
@endpush
@push('jss')
<script src="{{ asset('matrix-admin-master') }}/assets/extra-libs/DataTables/datatables.min.js"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    // $('#zero_config').DataTable();

    $(document).ready(function() {
        var table = $('#zero_config').DataTable({
            processing: true,
            serverSide: false,
            ajax: "{{ route('supplier.getsupplier') }}",
            columns: [{
                    data: 'nama_supplier'
                }, {
                    data: 'alamat'
                }, {
                    data: 'email'
                }, {
                    data: 'telepon'
                },
                {
                    data: 'id_supplier',
                    render: function(data) {
                        return `
                            <button onclick="editForm(${data})" class="btn btn-warning btn-sm">Edit</button>
                            <button onclick="deleteProduct(${data})" class="btn btn-danger btn-sm">Hapus</button>
                            `;
                    }
                }
            ]
        });

        $('#formTambah').on('submit', function(e) {
            e.preventDefault();
            let id = $('#id').val();
            let url = id ? "{{ url('supplier/update') }}/" + id :
                "{{ route('supplier.store') }}";
            $.ajax({
                url: url,
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.success);
                    table.ajax.reload(); // Refresh tabel tanpa reload halaman
                    $('#add_supplier').modal('hide');
                },
            });
        });
    })

    function deleteProduct(id) {
        if (confirm("Yakin hapus?")) {
            $.ajax({
                url: "{{ url('supplier') }}/" + id,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#zero_config').DataTable().ajax.reload();
                }
            });
        }
    }

    function addForm() {
        $('#id').val('');
        $('#formTambah')[0].reset();
        $('#add_supplier').modal('show');
    }

    function editForm(id) {
        $('#formTambah')[0].reset();
        $.get("{{ url('supplier/edit') }}/" + id, function(data) {
            $('#id').val(data.id_supplier);
            $('#nama_supplier').val(data.nama_supplier);
            $('#alamat').val(data.alamat);
            $('#email').val(data.email);
            $('#telepon').val(data.telepon);
            $('#add_supplier').modal('show');
        });
    }

    function exportData() {
        console.log('export');
        // Gunakan window.open agar PDF terbuka di tab baru
        window.open("{{ route('supplier.export_pdf') }}", '_blank');
    }
</script>
@endpush