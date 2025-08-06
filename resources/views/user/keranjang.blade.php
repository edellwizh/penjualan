<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/user.css') }}">
</head>
<body>

@include('sidebar.user')

<section class="text-center py-5 bg-blue">
  <h2 class="fw-bold">Keranjang Belanja</h2>
  <p>by Sandang Sehat Indonesia</p>
</section>
  
<div class="container my-5">
  <div class="bg-light p-4 rounded-4" style="max-width: 800px; margin: auto;">

    @php
      $total = $carts->sum(function ($item) {
        return $item->jumlah_produk * $item->produks->harga;
      });
    @endphp

    <h5 class="fw-semibold mb-4 border-bottom pb-2">
      Keranjang Kamu 
      <span class="float-end">{{ $carts->count() }} item</span>
    </h5>

    @if($carts->count() > 0)
      @foreach($carts as $item)
        @php 
          $produk = $item->produks;
          $subtotal = $item->jumlah_produk * $produk->harga;
        @endphp

        <!-- Produk -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="d-flex align-items-center">
            <div class="product-image me-3" style="width: 80px; height: 80px;">
              <img src="{{ asset('storage/images/' . ($produk->gambar ?? 'default.png')) }}" class="img-fluid rounded" alt="{{ $produk->nama_produk }}">
            </div>
            <div>
              <strong>{{ $produk->nama_produk }}</strong><br>
              <span class="fw-bold">Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</span><br>
              <small>Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</small>
            </div>
          </div>
          <div class="text-end">
            <form action="{{ url('/user/keranjang/delete/' . $item->id) }}" method="POST" class="mb-2">
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                <i class="bi bi-trash"></i> Hapus
              </button>
            </form>
            <span class="badge bg-secondary">Jumlah: {{ $item->jumlah_produk }}</span>
          </div>
        </div>
      @endforeach

      <!-- Total & Tombol -->
      <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
        <h5>Total:</h5>
        <h5 class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</h5>
      </div>

      @include('sidebar.pesansukses')

      <form action="{{ url('user/keranjang/pesan') }}" method="POST">
        @csrf
        <div class="text-end mt-3">
          <button type="submit" class="btn btn-primary btn-lg px-5 rounded-3" style="background-color: #b3e5fc; border: none;">
            Pesan
          </button>
        </div>
      </form>
      
    @else
      <div class="alert alert-info text-center">
        Keranjang kamu masih kosong.
      </div>
    @endif

  </div>
</div>

@include('sidebar.footer')