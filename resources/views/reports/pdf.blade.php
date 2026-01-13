<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pemesanan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">Laporan Pemesanan</h1>
    <table>
        <thead>
            <tr style="font-size:11px;">
                <th>Kode Pemesanan</th>
                <th>Paket Tour</th>
                <th>Nama Pemesan</th>
                <th>Status</th>
                <th>Status Pembayaran</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemesanans as $pemesanan)
                <tr style="font-size:11px; text-transform: uppercase;">
                    <td>{{ $pemesanan->kode_pemesanan }}</td>
                    <td>{{ $pemesanan->package->nama_paket }}</td>
                    <td>{{ $pemesanan->nama_pemesan }}</td>
                    <td>{{ $pemesanan->status }}</td>
                    <td>{{ $pemesanan->status_pembayaran }}</td>
                    <td style="text-align: right">{{ 'Rp ' . number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
