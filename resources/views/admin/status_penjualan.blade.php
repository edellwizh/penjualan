<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Penjualan Pelanggan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body>

@include('sidebar.admin')

<div class="main-content container mt-4">
    <header class="mb-3">
        <h2>Daftar Status Penjualan Pelanggan</h2>
    </header>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>No</th>
                <th>Invoice Number</th>
                <th>Nama User</th>
                <th>Total Harga</th>
                <th>Alamat Pengiriman</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $no => $pesanan)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $pesanan->invoice_number }}</td>
                <td>{{ $pesanan->user->name }}</td>
                <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                <td>{{ $pesanan->alamat_pengiriman ?? 'Alamat tidak tersedia' }}</td>
                <td>
                    @if($pesanan->status == 'menunggu_pembayaran')
                        <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                    @elseif($pesanan->status == 'pesanan_diproses')
                        <span class="badge bg-primary">Pesanan Diproses</span>
                    @elseif($pesanan->status == 'pengiriman')
                        <span class="badge bg-info">Pengiriman</span>
                    @elseif($pesanan->status == 'selesai')
                        <span class="badge bg-success">Selesai</span>
                    @endif
                </td>
                <td>
                    @if($pesanan->status == 'pesanan_diproses')
                        <form action="{{ url(Auth::user()->role.'/pesanan/status/' . $pesanan->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="pengiriman">
                            <button type="submit" class="btn btn-sm btn-primary">Kirim Pesanan</button>
                        </form>
                    @elseif($pesanan->status == 'pengiriman')
                        <form action="{{ url(Auth::user()->role.'/pesanan/status/' . $pesanan->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="selesai">
                            <button type="submit" class="btn btn-sm btn-success">Tandai Selesai</button>
                        </form>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('sidebar.footer')