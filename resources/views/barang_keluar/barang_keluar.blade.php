@extends('layout.main')

@section('bredcrum')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Barang Keluar</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Barang Keluar</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-12 d-flex no-block">
            <button class="btn m-t-20 btn-info" onclick="addForm()">
                <i class="ti-plus"></i> Tambah
            </button>
            <button class="btn m-t-20 m-l-20 btn-danger" onclick="exportData()">
                <i class="mdi mdi-export"></i> Export
            </button>
        </div>
    </div>

    <!-- Modal Add Category -->
    <div class="modal fade none-border" id="add_customer">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formTambah" method="POST" action="{{ url('barang_keluar') }}">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label class="control-label">Customer</label>
                                <select class="form-control" data-placeholder="Pilih Customer" id="customer"
                                    name="id_customer">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success ml-auto">Pilih</button>
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
                    <h5 class="card-title">Tabel Barang Keluar</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Tanggal</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
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
            ajax: "{{ url('invoice_penjualan/get_data') }}",
            order: [
                [4, 'desc']
            ],
            columns: [{
                // 1. Kolom Nomor Urut
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }, {
                data: 'customer.nama_customer',
            }, {
                data: 'tgl_cetak',
            }, {
                name: 'barangkeluar',
                render: function(data, type, row) {
                    // return row.barangkeluar.length;

                    if (row.barangkeluar && Array.isArray(row.barangkeluar)) {

                        // Opsi A: Jika ingin menghitung TOTAL JUMLAH (sum of qty)
                        let totalQty = row.barangkeluar.reduce((total, item) => {
                            return total + parseInt(item.jumlah);
                        }, 0);

                        // Opsi B: Jika ingin menghitung JUMLAH JENIS BARANG (count)
                        // let totalJenis = row.barang_keluar.length;

                        return `${totalQty} Item`;
                    }
                    return '0';
                }
            },{
                data: 'total_harga',
                render: function(data) {
                    return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                }
            }, ]
        });
    })

    function addForm() {
        $('#id').val('');
        $('#formTambah')[0].reset();
        $('#customer').empty();
        $('#customer').append('<option value="">-- Pilih Customer --</option>');
        $.get("{{ route('customer.getcustomer') }}", function(data) {
            $.each(data.data, function(key, value) {
                $('#customer').append('<option value="' + value.id_customer + '">' + value
                    .nama_customer + '</option>');
            });
        });
        $('#add_customer').modal('show');
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
            $('#add_customer').modal('show');
        });
    }

    function exportData() {
        console.log('export');
        // Gunakan window.open agar PDF terbuka di tab baru
        window.open("{{ route('barang_keluar.export_pdf') }}", '_blank');
    }
</script>
@endpush