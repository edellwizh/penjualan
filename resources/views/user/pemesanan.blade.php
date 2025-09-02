<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Pesanan - Sandang Sehat Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user1.css') }}">
</head>
<body>

@include('sidebar.user')

<div class="hero hero-checkout">
    <h1 class="fw-bold">Ringkasan Pesanan</h1>
    <p class="mb-0">Berikut adalah detail pesanan Anda</p>
</div>

<div class="container my-5">
    <div class="ringkasan-card">
        <h4 class="fw-bold mb-4">Detail Pesanan</h4>
        
        <div class="info-pesanan">
            <p><strong>Nomor Faktur:</strong> {{ $invoiceNumber }}</p>
            <p><strong>Telepon:</strong> {{ Auth::user()->telepon }}</p>
            <p><strong>Alamat Pengiriman:</strong> {{ Auth::user()->alamat }}</p>
            <a href="{{ url(Auth::user()->role.'/profile/edit') }}" class="ms-2"><small>(Edit Alamat)</small></a>
        </div>
        
        @foreach($keranjang as $item)
        <div class="item-ringkasan d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="img-produk-checkout">
                    @if($item->produk->image)
                        <img src="{{ asset('storage/images/' . $item->produk->image) }}" alt="{{ $item->produk->nama_produk }}">
                    @else
                        <i class="bi bi-image" style="font-size: 2rem;"></i>
                    @endif
                </div>
                <div class="ms-3">
                    <p class="fw-semibold mb-0">{{ $item->produk->nama_produk }}</p>
                    <small class="text-muted">Jumlah: {{ $item->quantity }}</small>
                </div>
            </div>
            <p class="mb-0 fw-semibold">Rp. {{ number_format($item->quantity * $item->produk->harga, 0, ',', '.') }}</p>
        </div>
        @endforeach

        <div class="d-flex justify-content-between mt-4">
            <p class="mb-0">Subtotal</p>
            <p class="mb-0 fw-semibold">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</p>
        </div>
        <div class="d-flex justify-content-between">
            <p class="mb-0">Biaya Pengiriman</p>
            <p class="mb-0 fw-semibold">Rp. 0</p>
        </div>

        <div class="total-ringkasan d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Total</h5>
            <h5 class="mb-0 fw-bold">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h5>
        </div>
        
        <form action="{{ url(Auth::user()->role.'/pesan') }}" method="POST">
            @csrf
            <input type="hidden" name="invoice_number" value="{{ $invoiceNumber }}">
            <button type="submit" class="btn-checkout w-100 mt-4" onclick="return confirm('Yakin ingin melakukan pembayaran?')">Lanjutkan Pembayaran</button>
        </form>
    </div>
</div>

@include('sidebar.footer')