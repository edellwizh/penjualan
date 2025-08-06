<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tentang Kami</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/user.css') }}">

</head>
<body>

    @include('sidebar.user')

  {{-- Header --}}
  <div class="hero text-center">
    <h1 class="fw-bold">Tentang Kami</h1>
    <p class="mb-0">by Sandang Sehat Indonesia</p>
  </div>

  {{-- Lokasi --}}
  <div class="lokasi d-flex gap-2 p-5">
    <i class="bi bi-geo-alt-fill"></i>
    <p>Jalan Cendrawasih No. 25, RT 03/RW 05, Kelurahan Mulyorejo, Kecamatan Sukunmanaggal, Kota Surabaya, Jawa Timur, 60112.</p>
  </div>

  {{-- Siapa Kami --}}
  <div class="container my-5">
    <div class="row">
      <div class="col-md-3 d-flex flex-column gap-3">
        <div class="img-placeholder" style="width: 100%; height: 150px;"></div>
      </div>
      <div class="col-md-3 d-flex flex-column gap-3">
        <div class="img-placeholder" style="width: 100%; height: 70px;"></div>
        <div class="img-placeholder" style="width: 100%; height: 70px;"></div>
      </div>
      <div class="col-md-6">
        <h4 class="fw-bold">Siapa Kami?</h4>
        <p>
          Sandang Sehat Indonesia adalah brand lokal yang fokus menyediakan pakaian dengan berkualitas tinggi untuk masyarakat lokal ataupun asing. Kami mengutamakan kenyamanan, fungsionalitas, dan tampilan agar setiap masyarakat bisa mengenakan pakaian dengan percaya diri dan leluasa. Dengan desain yang modern dan bahan yang dipilih dengan cermat, kami hadir sebagai wujud dukungan untuk para masyarakat.
        </p>
      </div>
    </div>
  </div>

    <div class="slogan mt-5">
    Sandang Sehat Indonesia — Nyaman dipakai, siap mengabdi.
  </div>

  {{-- Tim Kami --}}
<div class="bg-blue py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Tim Kami</h2>
    <p class="mb-5">Kami adalah tim yang berdedikasi dalam pengembangan aplikasi dan perusahaan ini.</p>

    <div class="row justify-content-center g-4">
      <!-- Tim Card 1 -->
      <div class="col-md-4">
        <div class="card border-0 shadow text-center p-3 h-100">
          <img src="{{ asset('img/timkami/Heni.jpg') }}" class="rounded-circle mx-auto mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Heni">
          <div class="card-body">
            <h5 class="card-title">Heni Kurniati</h5>
            <p class="text-muted mb-0">Founder Co</p>
          </div>
        </div>
      </div>

      <!-- Tim Card 2 -->
      <div class="col-md-4">
        <div class="card border-0 shadow text-center p-3 h-100">
          <img src="{{ asset('img/timkami/Budi.jpg') }}" class="rounded-circle mx-auto mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Budi">
          <div class="card-body">
            <h5 class="card-title">Budi Santoso</h5>
            <p class="text-muted mb-0">UI/UX Designer</p>
          </div>
        </div>
      </div>

      <!-- Tim Card 3 -->
      <div class="col-md-4">
        <div class="card border-0 shadow text-center p-3 h-100">
          <img src="{{ asset('img/timkami/Citra.jpg') }}" class="rounded-circle mx-auto mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Citra">
          <div class="card-body">
            <h5 class="card-title">Citra Dewi</h5>
            <p class="text-muted mb-0">Marketing Executive</p>
          </div>
        </div>
      </div>

      <!-- Tim Card 4 -->
      <div class="col-md-4">
        <div class="card border-0 shadow text-center p-3 h-100">
          <img src="{{ asset('img/timkami/Dani.jpg') }}" class="rounded-circle mx-auto mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Dani">
          <div class="card-body">
            <h5 class="card-title">Dani Saputra</h5>
            <p class="text-muted mb-0">Backend Developer</p>
          </div>
        </div>
      </div>

      <!-- Tim Card 5 -->
      <div class="col-md-4">
        <div class="card border-0 shadow text-center p-3 h-100">
          <img src="{{ asset('img/timkami/Elsa.jpg') }}" class="rounded-circle mx-auto mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Elsa">
          <div class="card-body">
            <h5 class="card-title">Elsa Rahma</h5>
            <p class="text-muted mb-0">Customer Support</p>
          </div>
        </div>
      </div>

      <!-- Tim Card 6 -->
      <div class="col-md-4">
        <div class="card border-0 shadow text-center p-3 h-100">
          <img src="{{ asset('img/timkami/Fajar.jpg') }}" class="rounded-circle mx-auto mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Fajar">
          <div class="card-body">
            <h5 class="card-title">Fajar Nugroho</h5>
            <p class="text-muted mb-0">Front-End Developer</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



  {{-- Kenapa Pilih Kami --}}
  <div class="py-5">
  <div class="container text-center">
    <h4 class="fw-bold mb-5">Kenapa Pilih Kami?</h4>
    <div class="row justify-content-center g-4">
      <!-- Pengiriman Seluruh Dunia -->
      <div class="col-md-3">
        <i class="bi bi-globe2 fs-1"></i>
        <p class="mt-2 fw-semibold">Pengiriman Seluruh Dunia</p>
        <p class="text-muted">
          Kami melayani pengiriman ke berbagai negara, memastikan produk tiba dengan aman dan tepat waktu.
        </p>
      </div>

      <!-- Kualitas Terbaik -->
      <div class="col-md-3">
        <i class="bi bi-person-bounding-box fs-1"></i>
        <p class="mt-2 fw-semibold">Kualitas Terbaik</p>
        <p class="text-muted">
          Setiap produk dibuat dengan bahan pilihan dan standar tinggi, demi kenyamanan dan daya tahan maksimal.
        </p>
      </div>

      <!-- Penawaran Terbaik -->
      <div class="col-md-3">
        <i class="bi bi-tag fs-1"></i>
        <p class="mt-2 fw-semibold">Penawaran Terbaik</p>
        <p class="text-muted">
          Harga Terbaik tanpa Mengorbankan Kualitas. Kenyamanan Anda adalah prioritas kami.
        </p>
      </div>

      <!-- Pembayaran Aman -->
      <div class="col-md-3">
        <i class="bi bi-shield-lock fs-1"></i>
        <p class="mt-2 fw-semibold">Pembayaran Aman</p>
        <p class="text-muted">
          Transaksi Anda terlindungi dengan sistem pembayaran yang terpercaya dan aman.
        </p>
      </div>
    </div>
  </div>
</div>



@include('sidebar.footer')
