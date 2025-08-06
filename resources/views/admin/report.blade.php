<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan PDF Produk</title>
    <style>
        body{
            font-family: Arial, sans-serif;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td{
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th{
            background-color: #f2f2f2;
        }
        h2, h3{
            text-align: center;
        }
        .kategori-title {
            margin-top: 30px;
            font-size: 16px;
            font-weight: bold;
        }
        .date{
            text-align: right;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="date">
        Tanggal: {{ now()->format('d-m-Y H:i') }}
    </div>

    <h2>Laporan Produk Berdasarkan Kategori</h2>

    @foreach($kategoris as $kategori)
        @if($kategori->produks->count() > 0)
            <div class="kategori-title">
                {{ $kategori->nama_kategori }}
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah Produk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori->produks as $i => $product)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $product->nama_produk }}</td>
                            <td>Rp{{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td>{{ $product->jumlah_produk }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</body>
</html>
