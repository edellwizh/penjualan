<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendapatan {{ date('d F Y', strtotime($tanggal)) }}</title>
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

@include('sidebar.admin')

<div class="main-content">
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h3>Detail Pendapatan</h3>
            <p>Tanggal: {{ date('d F Y', strtotime($tanggal)) }}</p>
        </div>

        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle me-2"></i> Menampilkan semua pesanan yang selesai pada tanggal {{ date('d F Y', strtotime($tanggal)) }}
        </div>

        @if($transaksiHariItu->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Waktu Transaksi</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksiHariItu as $index => $pesanan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pesanan->invoice_number }}</td>
                                <td>{{ date('H:i:s', strtotime($pesanan->created_at)) }}</td>
                                <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total Pendapatan Hari Ini:</td>
                            <td class="fw-bold">Rp {{ number_format($transaksiHariItu->sum('total_harga'), 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                Tidak ada pesanan selesai pada tanggal ini
            </div>
        @endif

        <div class="mt-3">
            <a href="{{ url(Auth::user()->role . '/pendapatan') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

@include('sidebar.footer')
