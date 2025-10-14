<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan - Sandang Sehat Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user1.css') }}">
</head>
<body>

@include('sidebar.user')

<div class="hero-riwayat">
    <h1 class="fw-bold">
        @if(isset($invoiceNumber) && $invoiceNumber)
            Detail Pesanan
        @else
            Riwayat Pesanan Anda
        @endif
    </h1>
    <p class="mb-0">
        @if(isset($invoiceNumber) && $invoiceNumber)
            Detail pesanan terbaru Anda
        @else
            Lihat semua pesanan yang telah Anda lakukan
        @endif
    </p>
</div>

<div class="container my-5">
    @if(isset($pesanans) && $pesanans->count() > 0)
        @foreach($pesanans as $pesanan)
            <div class="kartu-pesanan">
                <div class="header-pesanan">
                    <div>
                        <h5 class="fw-bold mb-1">Nomor Faktur: <span class="text-primary">{{ $pesanan->invoice_number }}</span></h5>
                        <p class="text-muted mb-0"><small>Tanggal Pemesanan: {{ $pesanan->created_at->format('d F Y') }}</small></p>
                    </div>
                    @if($pesanan->status == 'menunggu_pembayaran')
                        <a href="{{ route('user.pembayaran', $pesanan->id) }}" 
                           class="tombol-status status-menunggu">
                            {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}
                        </a>
                    @else
                        <a href="{{ url(Auth::user()->role.'/detailstatus-pemesanan/' . $pesanan->id) }}" 
                           class="tombol-status 
                            @if($pesanan->status == 'pesanan_diproses') status-pengiriman
                            @elseif($pesanan->status == 'selesai') status-selesai
                            @elseif($pesanan->status == 'pengiriman') status-pengiriman
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}
                        </a>
                    @endif
                </div>
                <div class="isi-pesanan">
                    <h6 class="fw-bold mb-3">Total Pembayaran: Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</h6>
                    
                    @foreach($pesanan->detailPesanan as $detail)
                        <div class="item-produk-pesanan">
                            @if($detail->produk && $detail->produk->image)
                                <img src="{{ asset('storage/' . $detail->produk->image) }}" alt="{{ $detail->produk->nama_produk }}">
                            @else
                                <img src="https://via.placeholder.com/70" alt="Gambar Produk">
                            @endif
                            <div>
                                <h6 class="mb-1">{{ $detail->produk ? $detail->produk->nama_produk : 'Produk tidak ditemukan' }}</h6>
                                <p class="mb-0 text-muted">Jumlah: {{ $detail->quantity }} x Rp {{ number_format($detail->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> Belum ada riwayat pesanan
        </div>
    @endif
</div>

@include('sidebar.footer')