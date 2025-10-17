<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $pesanan->invoice_number }}</title>
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

@include('sidebar.admin')

<div class="main-content">
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h3>Detail Pesanan</h3>
            <p>Invoice: {{ $pesanan->invoice_number }}</p>
        </div>

        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle me-2"></i> Produk yang dibeli dalam pesanan ini
        </div>

        @if($pesanan->detailPesanan->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->detailPesanan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total:</td>
                            <td class="fw-bold">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                Tidak ada produk dalam pesanan ini
            </div>
        @endif

        <div class="mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

@include('sidebar.footer')

