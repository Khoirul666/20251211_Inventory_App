<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Masuk</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .badge-masuk {
            color: green;
            font-weight: bold;
        }

        .badge-keluar {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LAPORAN BARANG MASUK</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Supplier</th>
                <th rowspan="2">Tanggal</th>
                <th colspan="4">Barang</th>
                <th rowspan="2">Total harga</th>
            </tr>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                @if ($row->barangmasuk->count()==1)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->supplier->nama_supplier}}</td>
                        <td>{{$row->tgl_cetak}}</td>
                        @foreach($row->barangmasuk as $barangmasuk)
                        <td>{{$barangmasuk->nama_barang}}</td>
                        <td>{{$barangmasuk->jumlah}}</td>
                        <td>Rp {{number_format($barangmasuk->harga_beli,0,',','.')}}</td>
                        <td>Rp {{number_format($barangmasuk->jumlah*$barangmasuk->harga_beli,0,',','.')}}</td>
                        @endforeach
                        <td>Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @else
                    @php
                    $counn = $row->barangmasuk->count();
                    $num = $loop->iteration;
                    @endphp
                    @foreach($row->barangmasuk as $brg_masuk)
                        @if($loop->first)
                        <tr>
                            <td rowspan="@php echo $counn; @endphp">{{$num}}</td>
                            <td rowspan="@php echo $counn; @endphp">{{$row->supplier->nama_supplier}}</td>
                            <td rowspan="@php echo $counn; @endphp">{{$row->tgl_cetak}}</td>
                            <td>{{$brg_masuk->nama_barang}}</td>
                            <td>{{$brg_masuk->jumlah}}</td>
                            <td>Rp {{number_format($brg_masuk->harga_beli,0,',','.')}}</td>
                            <td>Rp {{number_format($brg_masuk->jumlah*$brg_masuk->harga_beli,0,',','.')}}</td>
                            <td rowspan="@php echo $counn; @endphp">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{$brg_masuk->nama_barang}}</td>
                            <td>{{$brg_masuk->jumlah}}</td>
                            <td>Rp {{number_format($brg_masuk->harga_beli,0,',','.')}}</td>
                            <td>Rp {{number_format($brg_masuk->jumlah*$brg_masuk->harga_beli,0,',','.')}}</td>
                        </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>