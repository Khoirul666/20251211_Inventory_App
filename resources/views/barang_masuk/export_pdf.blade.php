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
            text-align: left;
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
                <th>No</th>
                <th>Supplier</th>
                <th>Tanggal</th>
                <th>Total Item</th>
                <th>Total harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->supplier->nama_supplier }}</td>
                <td>{{ $row->tgl_cetak }} Item</td>
                <td>{{ $row->barangmasuk->sum('jumlah') }} Item</td>
                <td>Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>