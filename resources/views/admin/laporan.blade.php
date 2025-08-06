<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan per Kategori</title>
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>

@include('sidebar.admin')

<!-- Main content -->
<div class="main-content">

    <div class="container mt-4">
        <div class="text-center mb-4">
            <h3>Laporan Produk Berdasarkan Kategori</h3>
        </div>

        @foreach($kategoris as $kategori)
            @if ($kategori->produks->count() > 0)
                <div class="mb-4">
                    <h5 class="mb-3 text-primary">{{ $kategori->nama_kategori }}</h5>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah Produk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategori->produks as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>Rp{{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td>{{ $product->jumlah_produk }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach

        <a href="{{ url('/admin/report') }}" class="btn btn-secondary w-100 d-flex justify-content-center align-items-center text-white cursor-pointer">Export to PDF</a>
    </div>
</div>

@include('sidebar.footer')

