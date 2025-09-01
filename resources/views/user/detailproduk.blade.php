<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user.css') }}">
    <style>
        /* Gaya tambahan yang mungkin dibutuhkan */
        .hero.detail-produk-section {
            background-color: #b3e5fc;
            padding: 60px 20px;
            text-align: center;
        }
        .judul-utama {
            font-size: 2.5rem;
            font-weight: 600;
        }
        .slogan-header {
            font-size: 1rem;
            color: #6c757d;
        }
        .product-detail {
            margin-top: 40px;
        }
        .produk-gambar {
            padding-right: 30px;
        }
        .produk-gambar .img-placeholder-lg {
            width: 100%;
            height: 400px;
            background-color: #e0f7fa;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .produk-gambar .img-placeholder-lg img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }
        .produk-info {
            padding-left: 30px;
        }
        .produk-info h2 {
            font-weight: bold;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .rating {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .rating-text {
            margin-left: 10px;
            color: #6c757d;
            font-size: 0.9rem;
        }
        .harga {
            color: #e91e63;
            font-weight: bold;
            font-size: 1.8rem;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        .stok {
            font-size: 1rem;
            color: #555;
        }
        .btn-keranjang,
        .btn-pesan {
            background-color: #000;
            color: #fff;
            font-weight: bold;
            border-radius: 50px;
            padding: 10px 20px;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-keranjang:hover,
        .btn-pesan:hover {
            background-color: #81d4fa;
        }
        .deskripsi-produk {
            background-color: #e0f7fa;
            padding: 30px;
            border-radius: 12px;
            margin-top: 40px;
        }
        .judul-deskripsi {
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .isi-deskripsi p {
            line-height: 1.6;
        }
        .product-card {
            background-color: #e0f7fa;
        }
        .product-image {
            height: 150px;
            background-color: #ccc;
        }
        .bg-blue-light {
            background-color: #b3e5fc;
        }
    </style>
</head>
<body>

@include('sidebar.user')

<div class="hero detail-produk-section">
    <div class="container">
        <h1 class="text-center judul-utama">Detail Produk</h1>
        <p class="text-center slogan-header">by Sandang Sehat Indonesia</p>
    </div>
</div>

<div class="container my-5">
    <div class="row product-detail">
        <div class="col-md-6 produk-gambar">
            <div class="img-placeholder-lg">
                <img src="{{ asset('storage/images/' . $produks->image) }}" alt="{{ $produks->nama_produk }}">
            </div>
        </div>
        <div class="col-md-6 produk-info">
            <div class="kategori">{{ $produks->kategoris->nama_kategori }}</div>
            <h2>{{ $produks->nama_produk }}</h2>
            <div class="rating">
                <span class="text-warning">
                    ★★★★★
                </span>
                <span class="rating-text">4.9 (101 review)</span>
            </div>
            <div class="harga">Rp {{ number_format($produks->harga, 0, ',', '.') }}</div>
            <div class="stok">Stok: {{ $produks->jumlah_produk }}</div>
            <div class="d-flex gap-2 mt-4">

                <form action="{{ url(Auth::user()->role.'/keranjang/tambah/') }}" method="POST">
                    @csrf

                    {{-- Input hidden untuk mengirim kode_produk --}}
                    <input type="hidden" name="kode_produk" value="{{ $produks->kode_produk }}">
                    
                    {{-- Input hidden untuk mengirim jumlah produk (default 1) --}}
                    <input type="hidden" name="quantity" value="1">

                    <button type="submit" class="btn-keranjang flex-grow-1">
                        <i class="bi bi-cart"></i> Tambah Keranjang
                    </button>
                </form>

                <button class="btn-pesan flex-grow-1">
                   Pesan Sekarang
                </button>
            </div>
            @include('sidebar.pesansukses')
        </div>
    </div>

    <div class="deskripsi-produk">
        <h3 class="judul-deskripsi">Deskripsi</h3>
        <div class="isi-deskripsi">
            <p>{!! nl2br(e($produks->deskripsi)) !!}</p>
        </div>
    </div>
</div>

<div class="container mt-5 px-4">
    <h4 class="text-center fw-bold text-dark mb-5">Produk Lainnya</h4>
    
    @foreach($kategoris as $kategori)
        @if ($kategori->produks->count() > 0)
            <h5 class="mb-4 text-dark">{{ $kategori->nama_kategori }}</h5>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 mb-5">
                @foreach($kategori->produks as $produk)
                    <div class="col">
                        <a href="{{ url('/user/produk/detail/' . $produk->kode_produk) }}" class="text-decoration-none">
                            <div class="product-card bg-blue-light p-3 rounded-xl text-center h-100 d-flex flex-column justify-content-between shadow-sm">
                                <div class="product-image mb-3 rounded-lg overflow-hidden d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('storage/images/' . $produk->image) }}" alt="{{ $produk->nama_produk }}" class="img-fluid rounded-lg">
                                </div>
                                <h6 class="mt-2 text-dark fw-semibold">{{ $produk->nama_produk }}</h6>
                                <p class="text-primary fw-bold mb-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                <p class="text-warning mb-0">★★★★★</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
</div>

@include('sidebar.footer')