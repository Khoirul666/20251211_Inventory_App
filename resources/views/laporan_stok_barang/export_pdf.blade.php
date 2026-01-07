<!DOCTYPE html>
<html>

<head>
    <title>Laporan Stok Barang {{$jenis}}</title>
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
        <h2>LAPORAN MUTASI STOK BARANG {{$jenis}}</h2>
        <p>Periode: {{ $tgl_awal }} s/d {{ $tgl_akhir }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->tgl }}</td>
                    <td>{{ $row->nama_barang }}</td>
                    <td class="{{ $row->tipe == 'masuk' ? 'badge-masuk' : 'badge-keluar' }}">
                        {{ strtoupper($row->tipe) }}
                    </td>
                    <td>{{ number_format($row->jumlah) }}</td>
                    <td class="text-right">Rp {{ number_format($row->harga) }}</td>
                    <td class="text-right">Rp {{ number_format($row->total) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #eee;">
                <td colspan="3" align="right"><strong>TOTAL KESELURUHAN</strong></td>
                <td><strong>{{ number_format($total_jumlah) }}</strong></td>
                <td></td>
                <td class="text-right"><strong>Rp {{ number_format($grand_total) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
