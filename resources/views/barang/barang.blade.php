@extends('layout.main')

@section('bredcrum')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Barang</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Barang</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-12 d-flex no-block">
                <button class="btn m-t-20 btn-info" onclick="addForm()">
                    <i class="ti-plus"></i> Tambah
                </button>
                <button class="btn m-t-20 m-l-20 btn-danger">
                    <i class="mdi mdi-export"></i> Eksport
                </button>
            </div>
        </div>

        <!-- Modal Add Category -->
        <div class="modal fade none-border" id="add_barang">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formTambah">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label class="control-label">Kategori</label>
                                    <select class="form-control" data-placeholder="Pilih Kategori" id="kategori"
                                        name="id_kategori">
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="control-label">Nama Barang</label>
                                    <input class="form-control" type="text" id="nama_barang" name="nama_barang">
                                </div>
                                <div class="col-12">
                                    <label class="control-label">Jumlah</label>
                                    <input class="form-control" type="number" id="jumlah" name="jumlah">
                                </div>
                                <div class="col-12">
                                    <label class="control-label">Harga Jual</label>
                                    <input class="form-control" type="number" id="harga_jual" name="harga_jual">
                                </div>
                                <div class="col-12">
                                    <label class="control-label">Harga Beli</label>
                                    <input class="form-control" type="number" id="harga_beli" name="harga_beli">
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
                        <h5 class="card-title">Barang</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
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
                ajax: "{{ route('getbarang') }}",
                columns: [{
                        data: 'kategori.nama_kategori',
                        name: 'kategori.nama_kategori'
                    }, {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    }, {
                        data: 'jumlah',
                        render: function(data) {
                            return parseInt(data).toLocaleString('id-ID') + ' Item';
                        }
                    }, {
                        data: 'harga_beli',
                        render: function(data) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    }, {
                        data: 'harga_jual',
                        render: function(data) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'id_barang',
                        render: function(data, type, row) {
                            // console.log(data);
                            return `
                            <button onclick="editForm(${row.id_barang})" class="btn btn-warning btn-sm">Edit</button>
                            <button onclick="deleteProduct(${row.id_barang})" class="btn btn-danger btn-sm">Hapus</button>
                            `;
                        }
                    }
                ]
            });

            $('#formTambah').on('submit', function(e) {
                e.preventDefault();
                let id = $('#id').val();
                let url = id ? "{{ url('barang/update') }}/" + id :
                    "{{ route('barang.store') }}";
                $.ajax({
                    url: url,
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response);
                        alert(response.success);
                        table.ajax.reload(); // Refresh tabel tanpa reload halaman
                        $('#add_barang').modal('hide');
                    },
                });
            });
        })

        function deleteProduct(id) {
            if (confirm("Yakin hapus?")) {
                $.ajax({
                    url: "{{ url('barang') }}/" + id,
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
            $('#kategori').empty();
            $('#kategori').append('<option value="">-- Pilih Kategori --</option>');
            $.get("{{ route('barang.getkategori') }}", function(data) {
                $.each(data, function(key, value) {
                    $('#kategori').append('<option value="' + value.id_kategori + '">' + value
                        .nama_kategori + '</option>');
                });
            });
            $('#add_barang').modal('show');
        }

        function editForm(id) {
            $.get("{{ url('barang/edit') }}/" + id, function(data) {
                $('#formTambah')[0].reset();
                $('#id').val(data.id_barang);
                $('#kategori').empty();
                $('#kategori').append('<option value="">-- Pilih Kategori --</option>');
                $.get("{{ route('barang.getkategori') }}", function(datax) {
                    $.each(datax, function(key, value) {
                        if (data.id_kategori == value.id_kategori) {
                            $('#kategori').append('<option value="' + value.id_kategori +
                                '" selected>' +
                                value
                                .nama_kategori + '</option>');
                        } else {
                            $('#kategori').append('<option value="' + value.id_kategori +
                                '">' +
                                value
                                .nama_kategori + '</option>');
                        }
                    });
                });

                $('#nama_barang').val(data.nama_barang);
                $('#jumlah').val(data.jumlah);
                $('#harga_jual').val(data.harga_jual);
                $('#harga_beli').val(data.harga_beli);
                $('#add_barang').modal('show');
            });
        }
    </script>
@endpush
