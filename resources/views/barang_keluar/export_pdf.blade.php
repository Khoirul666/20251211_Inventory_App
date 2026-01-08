<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Keluar</title>
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
        table thead tr th{
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LAPORAN BARANG KELUAR</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Customer</th>
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
                @if ($row->barangkeluar->count()==1)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->customer->nama_customer}}</td>
                        <td>{{$row->tgl_cetak}}</td>
                        @foreach($row->barangkeluar as $barangkeluar)
                        <td>{{$barangkeluar->nama_barang}}</td>
                        <td>{{$barangkeluar->jumlah}}</td>
                        <td>Rp {{number_format($barangkeluar->harga_jual,0,',','.')}}</td>
                        <td>Rp {{number_format($barangkeluar->jumlah*$barangkeluar->harga_jual,0,',','.')}}</td>
                        @endforeach
                        <td>Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @else
                    @php
                    $counn = $row->barangkeluar->count();
                    $num = $loop->iteration;
                    @endphp
                    @foreach($row->barangkeluar as $brg_keluar)
                        @if($loop->first)
                        <tr>
                            <td rowspan="@php echo $counn; @endphp">{{$num}}</td>
                            <td rowspan="@php echo $counn; @endphp">{{$row->customer->nama_customer}}</td>
                            <td rowspan="@php echo $counn; @endphp">{{$row->tgl_cetak}}</td>
                            <td>{{$brg_keluar->nama_barang}}</td>
                            <td>{{$brg_keluar->jumlah}}</td>
                            <td>Rp {{number_format($brg_keluar->harga_jual,0,',','.')}}</td>
                            <td>Rp {{number_format($brg_keluar->jumlah*$brg_keluar->harga_jual,0,',','.')}}</td>
                            <td rowspan="@php echo $counn; @endphp">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{$brg_keluar->nama_barang}}</td>
                            <td>{{$brg_keluar->jumlah}}</td>
                            <td>Rp {{number_format($brg_keluar->harga_jual,0,',','.')}}</td>
                            <td>Rp {{number_format($brg_keluar->jumlah*$brg_keluar->harga_jual,0,',','.')}}</td>
                        </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>