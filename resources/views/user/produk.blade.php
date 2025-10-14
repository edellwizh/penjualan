<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Beranda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/user1.css') }}">
</head>
<body>

<!-- Hero Section -->
<section class="hero d-flex justify-content-between flex-wrap">
  <div class="col-lg-5 welcome">
    <h2>Hallo, Selamat Datang {{ Auth::user()->name }}.</h2>
    <p>Disini, Kamu dapat berbelanja berbagai pakaian yang kamu butuhkan.</p>
  </div>
  <div class="col-lg-6 hero-img-box d-flex justify-content-center gap-3 flex-wrap">
    <img src="#" alt="">
    <img src="#" alt="">
    <img src="#" alt="">
    <img src="#" alt="">
  </div>
</section>

<!-- View 2 produk diatas -->
<div class="container my-5">
  @foreach($kategorisAtas as $kategori)
    @if ($kategori->produks->count() > 0)
      <h5 class="mb-4 text-dark">{{ $kategori->nama_kategori }}</h5>
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 mb-5">
        @foreach($kategori->produks as $produk)
          <div class="col">
            <a href="{{ url(Auth::user()->role. '/produk/detail/' . $produk->kode_produk) }}" class="text-decoration-none">
              <div class="product-card text-center h-100 d-flex flex-column justify-content-between shadow-sm">
                <div class="product-image mb-3 d-flex justify-content-center align-items-center">
                  <img src="{{ asset('storage/images/' . $produk->image) }}" alt="{{ $produk->nama_produk }}" class="img-fluid">
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

<!-- Testimoni Carousel Section -->
<div class="container my-5">
  <div id="testimoniCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      @forelse($testimonis as $index => $t)
        @if($t->status)
          <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <div class="d-flex justify-content-center">
              <div class="testimoni-box text-center">
                <p class="mb-3">{{ $t->pesan }}</p>

                {{-- Rating Bintang --}}
                <div class="mb-3 text-warning">
                  @for($i = 1; $i <= 5; $i++)
                    @if($i <= $t->rating)
                      ★
                    @else
                      ☆
                    @endif
                  @endfor
                </div>

                {{-- Gambar Profil Bulat --}}
                <div class="gambar-lingkaran-small mx-auto mb-2"></div>

                {{-- Nama & lokasi --}}
                <strong class="d-block">{{ $t->user->name }}</strong>
                <small class="text-muted">Jakarta Barat, Indonesia</small>
              </div>
            </div>
          </div>
        @endif
      @empty
        <div class="carousel-item active">
          <div class="text-center text-muted">Belum ada testimoni.</div>
        </div>
      @endforelse
    </div>
  </div>

  <!-- View 2 produk dibawah -->
  <div class="container my-5">
    @foreach($kategorisBawah as $kategori)
      @if ($kategori->produks->count() > 0)
        <h5 class="mb-4 text-dark">{{ $kategori->nama_kategori }}</h5>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 mb-5">
          @foreach($kategori->produks as $produk)
            <div class="col">
              <a href="{{ url(Auth::user()->role. '/produk/detail/' . $produk->kode_produk) }}" class="text-decoration-none">
                <div class="product-card text-center h-100 d-flex flex-column justify-content-between shadow-sm">
                  <div class="product-image mb-3 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('storage/images/' . $produk->image) }}" alt="{{ $produk->nama_produk }}" class="img-fluid">
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
</div>

@include('sidebar.footer')