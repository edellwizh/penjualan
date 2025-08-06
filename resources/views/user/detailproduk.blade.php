<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user.css') }}">
    <style>
        /* Tambahkan font Inter jika belum ada */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>

@include('sidebar.user')

<!-- Detail Produk Hero Section -->
<section class="hero-contact py-5 text-center bg-blue-light">
    <h2 class="fw-bold text-dark"><strong>Detail Produk</strong></h2>
    <p class="text-muted">by Sandang Sehat Indonesia</p>
</section>

<div class="container product-detail my-5 px-4">
    <div class="row align-items-center">
        <!-- Gambar Produk dalam card -->
        <div class="col-md-5 col-lg-4 mb-4 mb-md-0">
            <div class="card p-3 text-center h-100 d-flex flex-column justify-content-center align-items-center rounded-xl shadow-lg">
                <img src="{{ asset('storage/images/' . $produks->image) }}" alt="{{ $produks->nama_produk }}" class="img-fluid produk-gambar rounded-lg">
            </div>
        </div>
        
        <!-- Info Produk -->
        <div class="col-md-7 col-lg-8 produk-info">
            <p class="kategori text-muted mb-1">{{ $produks->kategoris->nama_kategori }}</p>
            <h3 class="fw-bold text-dark mb-2">{{ $produks->nama_produk }}</h3>
            <p class="rating mb-2">
                <span class="text-warning">★★★★☆</span>
                <span class="rating-text text-muted">4.9 (101 review)</span>
            </p>
            <h4 class="harga text-danger fw-bold mb-3">Rp {{ number_format($produks->harga, 0, ',', '.') }}</h4>
            <p class="stok text-muted mb-4">Stok: {{ $produks->jumlah_produk }}</p>
            
            <!-- Tombol Beli Sekarang dan Keranjang -->
            <div class="d-flex flex-wrap gap-3 mt-3">
                <form action="{{ url('/user/produk/beli/' . $produks->kode_produk) }}" method="POST">
                    @csrf
                    <input type="hidden" name="jumlah" value="1">
                    <button type="submit" class="btn btn-secondary btn-sm rounded-pill px-4 py-2 shadow-sm">Beli Sekarang</button>
                </form>

                <form action="{{ url('/user/keranjang/tambah/' . $produks->kode_produk) }}" method="POST">
                    @csrf
                    <input type="hidden" name="jumlah" value="1">
                    <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill px-4 py-2 shadow-sm">
                        <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                    </button>
                </form>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <!-- Deskripsi Produk -->
    <div class="deskripsi-produk bg-light-gray p-4 rounded-lg mt-5 shadow-sm">
        <h4 class="judul-deskripsi text-center fw-bold text-dark mb-4">Deskripsi Produk</h4>
        <p class="isi-deskripsi text-dark-gray">
            {!! nl2br(e($produks->deskripsi)) !!}
        </p>
    </div>
</div>

<!-- Produk Lainnya -->
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
