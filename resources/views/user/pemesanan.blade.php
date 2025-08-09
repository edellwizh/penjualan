<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ringkasan Pesanan - Sandang Sehat Indonesia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/user.css') }}">
  <style>
    /* CSS tambahan untuk halaman checkout */
    .hero-checkout {
      background-color: #b3e5fc;
      padding: 60px 20px;
      text-align: center;
    }
    .ringkasan-card {
      background-color: #e0f7fa; /* Warna latar belakang biru muda */
      padding: 20px;
      border-radius: 12px;
      max-width: 500px; /* Lebar maksimum untuk ringkasan */
      margin: 0 auto; /* Tengah-tengah halaman */
    }
    .item-ringkasan {
      padding: 10px 0;
      border-bottom: 1px solid #ced4da;
    }
    .item-ringkasan:last-child {
      border-bottom: none;
    }
    .img-produk-checkout {
      width: 60px;
      height: 60px;
      background-color: #ccc;
      border-radius: 8px;
    }
    .total-ringkasan {
      border-top: 2px solid #000;
      padding-top: 15px;
      margin-top: 15px;
    }
    .btn-checkout {
      background-color: #000;
      color: #fff;
      font-weight: bold;
      border-radius: 50px;
      padding: 10px 20px;
      transition: background-color 0.3s ease;
    }
    .btn-checkout:hover {
      background-color: #81d4fa;
    }
    .info-pesanan {
      background-color: #ffffff;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    .info-pesanan p {
      margin-bottom: 5px;
    }
  </style>
</head>
<body>

@include('sidebar.user')

<div class="hero-checkout">
    <h1 class="fw-bold">Ringkasan Pesanan</h1>
    <p class="mb-0">Berikut adalah detail pesanan Anda</p>
</div>

<div class="container my-5">
    <div class="ringkasan-card">
        <h4 class="fw-bold mb-4">Detail Pesanan</h4>
        
        <div class="info-pesanan">
            <p><strong>Nomor Resi:</strong> #SS-123456789</p>
            <p><strong>Tanggal:</strong> 10 Agustus 2025</p>
            <p><strong>Alamat:</strong> Jalan Cendrawasih No. 25, Surabaya, Jawa Timur, 60112</p>
            <p><strong>Telepon:</strong> 0812-3456-7890</p>
        </div>
        <div class="item-ringkasan d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="img-produk-checkout"></div>
                <div class="ms-3">
                    <p class="fw-semibold mb-0">Kaos Polos Sandang Sehat</p>
                    <small class="text-muted">Ukuran: L, Warna: Hitam</small>
                </div>
            </div>
            <p class="mb-0 fw-semibold">Rp150.000</p>
        </div>
        
        <div class="item-ringkasan d-flex justify-content-between align-items-center mt-3">
            <div class="d-flex align-items-center">
                <div class="img-produk-checkout"></div>
                <div class="ms-3">
                    <p class="fw-semibold mb-0">Celana Jogger Santai</p>
                    <small class="text-muted">Ukuran: M, Warna: Abu-abu</small>
                </div>
            </div>
            <p class="mb-0 fw-semibold">Rp200.000</p>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <p class="mb-0">Subtotal</p>
            <p class="mb-0 fw-semibold">Rp350.000</p>
        </div>
        <div class="d-flex justify-content-between">
            <p class="mb-0">Biaya Pengiriman</p>
            <p class="mb-0 fw-semibold">Rp25.000</p>
        </div>

        <div class="total-ringkasan d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Total</h5>
            <h5 class="mb-0 fw-bold">Rp375.000</h5>
        </div>
        
        <button class="btn btn-checkout w-100 mt-4">Lanjutkan Pembayaran</button>
    </div>
</div>

@include('sidebar.footer')
