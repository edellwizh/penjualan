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
            <h3>Detail Pendapatan Harian & Status Pemesanan</h3>
            <p>Tanggal: {{ date('d F Y', strtotime($tanggal)) }}</p>
        </div>

        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle me-2"></i> Menampilkan semua pesanan pada tanggal {{ date('d F Y', strtotime($tanggal)) }}
        </div>

        @if($transaksiHariItu->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Nama Pelangggan</th>
                            <th>Total</th>
                            <th>Alamat Pengiriman</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksiHariItu as $index => $pesanan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pesanan->invoice_number }}</td>
                                <td>{{ $pesanan->user ? $pesanan->user->name : '–' }}</td>
                                <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                <td>{{ $pesanan->alamat_pengiriman ?? '–' }}</td>
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
                                    <!-- Detail Pesanan -->
                                    <a href="{{ url('admin/detailpesanan/' . $pesanan->id) }}" class="btn btn-info btn-sm text-white me-1">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>

                                    <!-- Aksi Update Status -->
                                    @if($pesanan->status == 'pesanan_diproses')
                                        <form action="{{ url('admin/pesanan/status/' . $pesanan->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="pengiriman">
                                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                                        </form>
                                    @elseif($pesanan->status == 'pengiriman')
                                        <form action="{{ url('admin/pesanan/status/' . $pesanan->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="selesai">
                                            <button type="submit" class="btn btn-sm btn-success">Selesai</button>
                                        </form>
                                    @else
                                        <span class="text-muted">–</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                Tidak ada pesanan pada tanggal ini
            </div>
        @endif

        <div class="mt-3">
            <a href="{{ url('admin/report-pendapatan/' . $tanggal) }}" class="btn btn-success me-2"> Export to PDF
            </a>

            <a href="{{ url('admin/pendapatan') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        </div>
    </div>
</div>

@include('sidebar.footer')

