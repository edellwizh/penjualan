2<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendapatan Harian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        h2, h3 {
            text-align: center;
            margin-top: 20px;
        }
        .date {
            text-align: right;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <div class="date">
        Tanggal Cetak: {{ now()->format('d-m-Y H:i') }}
    </div>

    <h2>Laporan Pendapatan Harian</h2>
    <h3>Tanggal: {{ date('d F Y', strtotime($tanggal)) }}</h3>

    @if($transaksiHariItu->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Nama Pelanggan</th>
                    <th>Waktu Transaksi</th>
                    <th>Total</th>
                    <th>Alamat Pengiriman</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksiHariItu as $index => $pesanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pesanan->invoice_number }}</td>
                        <td>{{ $pesanan->user ? $pesanan->user->name : '–' }}</td>
                        <td>{{ date('H:i:s', strtotime($pesanan->created_at)) }}</td>
                        <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $pesanan->alamat_pengiriman ?? '–' }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4" style="text-align: right;">Total Pendapatan Hari Ini:</td>
                    <td colspan="2">Rp {{ number_format($transaksiHariItu->sum('total_harga'), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <p style="text-align: center; color: #666;">Tidak ada transaksi selesai pada tanggal ini.</p>
    @endif

</body>
</html>