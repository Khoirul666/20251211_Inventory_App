@extends('layout.main')

@section('bredcrum')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Customer {{ $customer->nama_customer }}</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Tambah Barang</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-12 d-flex no-block">
                <button class="btn m-t-20 btn-info" onclick="addForm()">
                    <i class="ti-plus"></i> Tambah
                </button>
                <a class="btn m-t-20 m-l-20 btn-danger" href="{{ url('barang_keluar/batal/pilih_barang') }}">
                    <i class="mdi mdi-export"></i> Batal
                </a>
                <button class="btn m-t-20 m-l-20 btn-primary" onclick="checkout()">
                    <i class="mdi mdi-cart"></i> CheckOut
                </button>
            </div>
        </div>

        <!-- Modal Add Barang -->
        <div class="modal fade none-border" id="add_barang">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formTambah">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            @csrf
                            <div class="row">
                                <div class="col-12" id="data_barang">
                                    <label class="control-label">Pilih Barang</label>
                                    <select class="form-control" data-placeholder="Pilih Barang" id="barang"
                                        name="id_barang">
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="control-label">Jumlah</label>
                                    <input class="form-control" type="number" id="jumlah" name="jumlah">
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Stok Barang</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Barang</h5>
                        <div class="table-responsive">
                            <table id="list_barang" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Total</th>
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
                    name: 'jumlah'
                }, {
                    data: 'harga_beli',
                    name: 'harga_beli'
                }, {
                    data: 'harga_jual',
                    name: 'harga_jual'
                }]
            });

            var list = $('#list_barang').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{ route('list_barang') }}",
                columns: [{
                    data: 'nama_kategori'
                }, {
                    data: 'nama_barang'
                }, {
                    data: 'jumlah_beli',
                }, {
                    data: 'harga_jual',
                }, {
                    data: 'total',
                }, {
                    data: 'id_barang',
                    render: function(data, type, row) {
                        // console.log(data);
                        return `
                            <button onclick="editForm(${row.id_barang})" class="btn btn-warning btn-sm">Edit</button>
                            <button onclick="deleteProduct(${row.id_barang})" class="btn btn-danger btn-sm">Hapus</button>
                            `;
                    }
                }]
            });

            $('#formTambah').on('submit', function(e) {
                e.preventDefault();
                let id = $('#id').val();
                let url = id ? "{{ url('barang_keluar/pilih_barang/edit/') }}/" + id :
                    "{{ route('pilih_barang.store') }}";
                $.ajax({
                    url: url,
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response.success);
                        list.ajax.reload(); // Refresh tabel tanpa reload halaman
                        $('#add_barang').modal('hide');
                    },
                });
            });
        })

        function deleteProduct(id) {
            if (confirm("Yakin hapus?")) {
                $.ajax({
                    url: "{{ url('barang_keluar/pilih_barang/edit') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.success);
                        $('#list_barang').DataTable().ajax.reload();
                    }
                });
            }
        }

        function checkout() {
            $.get("{{ url('checkout') }}", function(response) {
                if (response.data_barang && Object.keys(response.data_barang).length > 0) {
                    // window.location.href = "{{ url('getcheckout') }}";
                    $.get("{{ url('getcheckout') }}", function(response) {
                        alert(response.message);
                        location.reload();
                    });
                } else {
                    alert("Keranjang masih kosong!");
                }
            });
        }

        function addForm() {
            $('#id').val('');
            $('#formTambah')[0].reset();
            $('#data_barang').show();
            $('#barang').empty();
            $('#barang').append('<option value="">-- Pilih Barang --</option>');
            $.get("{{ route('getbarang') }}", function(data) {
                $.each(data.data, function(key, value) {
                    $('#barang').append('<option value="' + value.id_barang + '">' + value
                        .nama_barang + '</option>');
                });
            });
            $('#add_barang').modal('show');
        }

        function editForm(id) {
            $.get("{{ url('barang_keluar/pilih_barang/edit') }}/" + id, function(data) {
                // console.log(data);
                $('#formTambah')[0].reset();
                $('#id').val(data.id_barang);
                $('#data_barang').hide();
                $('#barang').empty();
                $('#barang').append('<option value="">-- Pilih Barang --</option>');
                $.get("{{ route('getbarang') }}", function(response) {
                    // console.log(response.data);
                    $.each(response.data, function(key, value) {
                        if (data.id_barang == value.id_barang) {
                            $('#barang').append('<option value="' + value.id_barang +
                                '" selected>' +
                                value
                                .nama_barang + '</option>');
                        } else {
                            $('#barang').append('<option value="' + value.id_barang +
                                '">' +
                                value
                                .nama_barang + '</option>');
                        }
                    });
                });

                $('#jumlah').val(data.jumlah_beli);
                $('#add_barang').modal('show');
            });
        }
    </script>
@endpush
