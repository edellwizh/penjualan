<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendapatan</title>
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

@include('sidebar.admin')

<div class="main-content">
    <div class="container mt-4">
        <h3 class="mb-4">Detail Pendapatan</h3>
        
        <div class="alert alert-primary" role="alert">
            <i class="fas fa-info-circle me-2"></i> Menampilkan detail pendapatan harian dari transaksi yang sudah selesai
        </div>

        <div class="mt-4">
            <h5 class="mb-3 text-primary">Riwayat Pendapatan Harian</h5>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Total Pendapatan</th>
                        <th>Jumlah Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendapatanPerTanggal as $index => $pendapatan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ date('d F Y', strtotime($pendapatan->tanggal)) }}</td>
                        <td>Rp {{ number_format($pendapatan->total_pendapatan, 0, ',', '.') }}</td>
                        <td>{{ $pendapatan->jumlah_transaksi }} transaksi</td>
                        <td>
                            <a href="{{ url(Auth::user()->role . '/pendapatan/' . $pendapatan->tanggal) }}" class="btn btn-info btn-sm text-white">Lihat Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada pendapatan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('sidebar.footer')