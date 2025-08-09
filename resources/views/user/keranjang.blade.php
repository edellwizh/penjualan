<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user.css') }}">
</head>
<body>

@include('sidebar.user')

<section class="hero detail-produk-section">
    <div class="container">
        <div class="header-keranjang">
            <h1 class="text-center judul-utama">Keranjang Belanja</h1>
            <p class="text-center slogan-header">by Sandang Sehat Indonesia</p>
        </div>

        <div class="keranjang-card">
            <div class="card-header-keranjang d-flex justify-content-between align-items-center">
                <span>Keranjang Kamu</span>
                <span class="badge rounded-pill bg-light text-dark">3 item</span>
            </div>
            <div class="card-body-keranjang">
                <div class="item-keranjang d-flex align-items-center mb-3">
                    <div class="img-produk-keranjang img-placeholder"></div>
                    <div class="info-produk-keranjang flex-grow-1 ms-3">
                        <div class="nama-produk">Baju Dokter</div>
                        <div class="kategori-produk">Ukuran: L</div>
                        <div class="harga-produk">Rp. 150.000</div>
                    </div>
                    <div class="qty-control">
                        <input type="number" class="form-control" value="2" min="1">
                    </div>
                </div>

                <div class="item-keranjang d-flex align-items-center">
                    <div class="img-produk-keranjang img-placeholder"></div>
                    <div class="info-produk-keranjang flex-grow-1 ms-3">
                        <div class="nama-produk">Baju Dokter</div>
                        <div class="kategori-produk">Ukuran: M</div>
                        <div class="harga-produk">Rp. 150.000</div>
                    </div>
                    <div class="qty-control">
                        <input type="number" class="form-control" value="1" min="1">
                    </div>
                </div>
            </div>
        </div>

        <div class="total-keranjang d-flex justify-content-between align-items-center mt-4">
            <h4 class="m-0">Total:</h4>
            <h4 class="m-0 harga-total">Rp. 450.000</h4>
        </div>

        <div class="d-grid mt-4">
            <button class="btn-pesan">Pesan</button>
        </div>
    </div>
</section>

@include('sidebar.footer')