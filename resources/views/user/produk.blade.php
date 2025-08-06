<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Beranda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/user.css') }}">
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

<!-- Produk Sections -->
<div class="container my-5">

  @foreach($kategorisAtas as $kategori)
  @if ($kategori->produks->count() > 0)
    <h5 class="mb-3">{{ $kategori->nama_kategori }}</h5>
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 mb-5">
        @foreach($kategori->produks as $produk)
        <div class="col">
          <a href="{{ url('/user/produk/detail/' . $produk->kode_produk) }}">
          <div class="product-card">
            <div class="product-image mb-2">
                  <img src="{{ asset('storage/images/' . $produk->image) }}" alt="{{ $produk->nama_produk }}">
                </div>            
            <h6 class="mt-2">{{ $produk->nama_produk }}</h6>
            <p class="text-primary mb-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            <p class="text-warning">★★★★★</p>
          </div>
           </a>
        </div>
        @endforeach
      </div>
    @endif
  @endforeach

  <!-- Testimoni Carousel Section -->
<div class="container my-5">
  <div id="testimoniCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      @forelse($testimonis as $index => $t)
        @if($t->status)
          <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <div class="d-flex justify-content-center">
              <div class="p-4 rounded-4 text-center" style="background-color: #ddd; width: 70%;">
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

                {{-- Gambar Profil Bulat (placeholder hitam) --}}
                <div class="mx-auto mb-2" style="width: 50px; height: 50px; background-color: #000; border-radius: 50%;"></div>

                {{-- Nama dan lokasi (lokasi bisa kamu ganti dari database jika ada field-nya) --}}
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

    <!-- Navigasi panah -->
    <button class="carousel-control-prev" type="button" data-bs-target="#testimoniCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" style="background-color: black;" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#testimoniCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" style="background-color: black;" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

  @foreach($kategorisBawah as $kategori)
  @if ($kategori->produks->count() > 0)
    <h5 class="mb-3">{{ $kategori->nama_kategori }}</h5>
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 mb-5">
        @foreach($kategori->produks as $produk)
        <div class="col">
          <div class="product-card">
            <div class="mb-2" style="height: 150px;"></div>
            <h6 class="mt-2">{{ $produk->nama_produk }}</h6>
            <p class="text-primary mb-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            <p class="text-warning">★★★★★</p>
          </div>
        </div>
        @endforeach
      </div>
    @endif
  @endforeach
  
</div>

@include('sidebar.footer')
