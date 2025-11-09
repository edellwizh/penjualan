<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user1.css') }}">
</head>
<body>

@include('sidebar.user')

<div class="hero hero-detail-produk">
    <div class="container">
        <h1 class="text-center judul-utama">Detail Produk</h1>
        <p class="text-center slogan-header">by Katalog Kita</p>
    </div>
</div>

<div class="container my-5">
    <div class="row produk-detail-section">
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
                    <input type="hidden" name="kode_produk" value="{{ $produks->kode_produk }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-keranjang flex-grow-1">
                        <i class="bi bi-cart"></i> Tambah Keranjang
                    </button>
                </form>

                <form action="{{ url(Auth::user()->role.'/pesan/sekarang/'. $produks->kode_produk) }}" method="POST">
                    @csrf
                    <input type="hidden" name="kode_produk" value="{{ $produks->kode_produk }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-keranjang flex-grow-1" onclick="return confirm('Yakin ingin memesan {{ $produks->nama_produk }} sekarang?')">
                        <i class="bi bi-cart"></i> Pesan Sekarang
                    </button>
                </form>

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