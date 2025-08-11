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

        @include('sidebar.pesansukses')

        <div class="keranjang-card">
            <div class="card-header-keranjang d-flex justify-content-between align-items-center">
                <span>Keranjang Kamu</span>
                <span class="badge rounded-pill bg-light text-dark">{{ $keranjang->count() }} item</span>
            </div>
            <div class="card-body-keranjang">
                @forelse ($keranjang as $item)
                    <div class="item-keranjang d-flex align-items-center mb-3">
                        {{-- Tampilan gambar produk --}}
                        <div class="img-produk-keranjang">
                            @if($item->produk->image)
                                <img src="{{ asset('storage/images/' . $item->produk->image) }}" alt="{{ $item->produk->nama_produk }}" class="img-fluid rounded">
                            @else
                                <div class="img-placeholder bg-light d-flex align-items-center justify-content-center text-secondary">
                                    <i class="bi bi-image" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Informasi produk --}}
                        <div class="info-produk-keranjang flex-grow-1 ms-3">
                            <div class="nama-produk">{{ $item->produk->nama_produk }}</div>
                            <div class="harga-produk">Rp. {{ number_format($item->produk->harga, 0, ',', '.') }}</div>
                            
                            {{-- Form untuk hapus produk --}}
                            <form action="{{ url(Auth::user()->role.'/keranjang/hapus/' . $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger mt-2" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                        
                        {{-- Form untuk update quantity --}}
                        <div class="qty-control">
                            <form action="{{ url(Auth::user()->role.'/keranjang/edit/' . $item->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="number" class="form-control" name="quantity" value="{{ $item->quantity }}" min="1" onchange="this.form.submit()">
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-bag-x-fill" style="font-size: 4rem;"></i>
                        <p class="mt-3">Keranjang Anda kosong. Yuk, belanja sekarang!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="total-keranjang d-flex justify-content-between align-items-center mt-4">
            <h4 class="m-0">Total:</h4>
            <h4 class="m-0 harga-total">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h4>
        </div>

        <div class="d-grid mt-4">
            {{-- Tombol checkout hanya aktif jika keranjang tidak kosong --}}
            @if ($keranjang->count() > 0)
                <a href="" class="btn-pesan text-center text-decoration-none">Pesan</a>
            @else
                <button class="btn-pesan" disabled>Pesan</button>
            @endif
        </div>
    </div>
</section>

@include('sidebar.footer')