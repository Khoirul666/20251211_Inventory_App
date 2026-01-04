<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Supplier</title>
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
        <h2>LAPORAN DATA SUPPLIER</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->nama_supplier }}</td>
                <td>{{ $row->alamat }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->telepon }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>