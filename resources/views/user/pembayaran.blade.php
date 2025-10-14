<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Sandang Sehat Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user1.css') }}">
</head>
<body>

@include('sidebar.user')

<div class="hero hero-checkout">
    <h1 class="fw-bold">Selesaikan Pembayaran Anda</h1>
    <p class="mb-0">Silakan scan QR code di bawah untuk menyelesaikan pembayaran.</p>
</div>

<div class="container my-5">
    <div class="pembayaran-card">
        <h4 class="fw-bold mb-4">Nomor Faktur: {{ $pesanan->invoice_number }}</h4>
        <p class="text-muted">Total Pembayaran: Rp. {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
        <p class="mb-4">
            <small>Scan QR code ini dengan aplikasi pembayaran Anda.<br>Pembayaran akan diverifikasi secara otomatis.</small>
        </p>

        <div class="qr-code">
            <img src="{{ asset('img/qr_dummy.jpg') }}" alt="QR Code Pembayaran">
        </div>
        
        <p>Silahkan klik tombol berikut, supaya status pesanan kamu berubah.</p>
        <a href="{{ route('user.riwayat_pesanan', $pesanan->id) }}" class="btn btn-view-order w-100 mt-4">Lihat Pesanan Kamu</a>
    </div>
</div>

@include('sidebar.footer')