@extends('layout.main')

@section('bredcrum')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Laporan Stok Barang</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Barang</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('kontainer')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 form-group row">
                                <div class="col-6">
                                    <input class="form-control" type="date" name="tanggal_awal" id="tanggal_awal"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-6">
                                    <input class="form-control" type="date" name="tanggal_akhir" id="tanggal_akhir"
                                        value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <select class="form-control" name="type" id="tipe">
                                    <option value="all">ALL</option>
                                    <option value="keluar">KELUAR</option>
                                    <option value="masuk">MASUK</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-info" onclick="loadData()">FILTER</button>
                                <button class="btn btn-danger" onclick="exportData()">EXPORT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Barang</h5>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Tipe</th>
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
        var table;

        $(document).ready(function() {
            // 1. Definisikan tanggal hari ini
            let today = new Date().toLocaleDateString('en-CA');

            // 2. Isi nilai input secara default SEBELUM datatable init
            $('#tanggal_awal').val(today);
            $('#tanggal_akhir').val(today);

            // 3. Inisialisasi DataTable
            console.log($('#tanggal_awal').val(), $('#tanggal_akhir').val(), $('#tipe').val())
            table = $('#zero_config').DataTable({
                processing: true,
                serverSide: true,
                // Tambahkan ini untuk mencegah error reinitialise jika fungsi terpanggil lagi
                destroy: true,
                ajax: {
                    url: "{{ route('laporan_stok_barang.get_data') }}",
                    data: function(d) {
                        // d.tgl_awal akan selalu mengambil nilai terbaru dari input
                        d.tgl_awal = $('#tanggal_awal').val();
                        d.tgl_akhir = $('#tanggal_akhir').val();
                        d.tipe = $('#tipe').val();
                    }
                },

                columns: [{
                        data: 'tgl',
                        name: 'tgl'
                    }, {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    }, {
                        data: 'jumlah',
                        render: function(data) {
                            return parseInt(data).toLocaleString('id-ID') + ' Item';
                        }
                    }, {
                        data: 'harga',
                        render: function(data) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    }, {
                        data: 'total',
                        render: function(data) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'tipe', // Menambahkan kolom tipe yang tadi terlewat di sintaks Anda
                        render: function(data) {
                            let color = data == 'masuk' ? 'success' : 'danger';
                            return `<span class="badge badge-${color}">${data.toUpperCase()}</span>`;
                        }
                    }
                ]
            });
        })

        function loadData() {
            var tanggal_awal = $('#tanggal_awal').val()
            var tanggal_akhir = $('#tanggal_akhir').val()
            var tipe = $('#tipe').val();
            // console.log(tanggal_awal, tanggal_akhir);
            // filterData(tanggal_awal, tanggal_akhir);
            table.ajax.reload();
        }

        function exportData() {
            var tgl_awal = $('#tanggal_awal').val();
            var tgl_akhir = $('#tanggal_akhir').val();
            var tipe = $('#tipe').val();

            // Gunakan window.open agar PDF terbuka di tab baru
            window.open("{{ route('laporan_stok_barang.export_pdf') }}?tgl_awal=" + tgl_awal + "&tgl_akhir=" + tgl_akhir +
                "&tipe=" + tipe,
                '_blank');
        }
    </script>
@endpush
