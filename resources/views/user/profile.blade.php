<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/user.css') }}">
</head>
<body>

@include('sidebar.user')

<!-- Profile -->
<div class="hero d-flex justify-content-center align-items-center text-center">
  <div>
    <div class="img-circle mx-auto mb-3"></div>
    <h5 class="mb-0 fw-bold">{{ auth()->user()->name }}</h5>

    @if (auth()->user()->alamat)
      <p class="mb-0"><i class="bi bi-geo-alt-fill"></i> {{ auth()->user()->alamat }}</p>
    @else
      <p class="mb-2"><i class="bi bi-geo-alt-fill"></i> Alamat belum diisi</p>
       <a href="{{ url(Auth::user()->role.'/profile/tambah/alamat') }}" class="btn btn-primary mb-3">Isi Alamat</a>
      </button>
    @endif

    <div class="d-flex justify-content-center gap-2 mt-3">
      <a href="{{ url(Auth::user()->role.'/profile/edit') }}" class="btn btn-outline-primary">
        <i class="bi bi-pencil-square"></i> Edit Profil
      </a>

      <form action="{{ url('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-outline-danger">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
    </div>
@include('sidebar.pesansukses')
  </div>

  

</div>
<!-- Riwayat Pesanan -->
<div class="container py-5">
  <h5 class="mb-4">
    <i class="bi bi-journal-text me-2"></i> Riwayat Pesanan Saya
  </h5>

  <!-- Satu kolom vertikal -->
  <div class="row g-4">
    <!-- Produk 1 -->
    <div class="col-12">
      <div class="product-card">
        <div class="row g-3 align-items-center">
          <div class="col-md-3">
            <div class="product-image">
              <img src="https://via.placeholder.com/150" alt="Produk A">
            </div>
          </div>
          <div class="col-md-9 text-start">
            <h6 class="fw-bold">Produk A</h6>
            <p class="mb-1 kategori">Kategori: Minuman</p>
            <p class="harga">Rp 15.000</p>
            <p class="text-muted mb-0">Jumlah: 2</p>
            <p class="text-muted">Tanggal: 1 Agustus 2025</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk 2 -->
    <div class="col-12">
      <div class="product-card">
        <div class="row g-3 align-items-center">
          <div class="col-md-3">
            <div class="product-image">
              <img src="https://via.placeholder.com/150" alt="Produk B">
            </div>
          </div>
          <div class="col-md-9 text-start">
            <h6 class="fw-bold">Produk B</h6>
            <p class="mb-1 kategori">Kategori: Makanan</p>
            <p class="harga">Rp 25.000</p>
            <p class="text-muted mb-0">Jumlah: 1</p>
            <p class="text-muted">Tanggal: 30 Juli 2025</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk 3 -->
    <div class="col-12">
      <div class="product-card">
        <div class="row g-3 align-items-center">
          <div class="col-md-3">
            <div class="product-image">
              <img src="https://via.placeholder.com/150" alt="Produk C">
            </div>
          </div>
          <div class="col-md-9 text-start">
            <h6 class="fw-bold">Produk C</h6>
            <p class="mb-1 kategori">Kategori: Snack</p>
            <p class="harga">Rp 10.000</p>
            <p class="text-muted mb-0">Jumlah: 3</p>
            <p class="text-muted">Tanggal: 28 Juli 2025</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('sidebar.footer')
