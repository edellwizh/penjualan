<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body>

<div class="main-content">
    <header>
        <h2>Daftar Produk</h2>
        <p>Temukan Produk terbaik untuk kebutuhan Anda</p>
    </header>

    @include('sidebar.pesansukses')
    
    <a href="{{ url(Auth::user()->role.'/produk/tambah') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>
    <a href="{{ url(Auth::user()->role.'/kategori') }}" class="btn btn-primary mb-3">Lihat Kategori</a>

    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                @foreach ($kategoris as $kategori)
                    <h4 class="mb-4">{{ $kategori->nama_kategori }}</h4>
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4 mb-5">
                        @foreach ($produks->where('kategori_id', $kategori->id) as $item)
                            <div class="col">
                                <div class="product-card bg-light p-3 rounded-xl text-center h-100 d-flex flex-column justify-content-between shadow-sm">
                                    <div class="product-image mb-3 rounded-lg overflow-hidden d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->nama_produk }}" class="card-img-top">
                                    </div>

                                    <h6 class="mt-2 text-dark fw-semibold">{{ $item->nama_produk }}</h6>
                                    <p class="fw-bold text-danger">Stok: {{ $item->jumlah_produk }}</p>
                                    <p class="fw-bold text-primary">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                    
                                    <div class="d-flex gap-2">
                                        <a href="{{ url(Auth::user()->role.'/produk/edit/' . $item->kode_produk) }}" class="btn btn-warning flex-grow-1">Edit</a>
                                        <form action="{{ url(Auth::user()->role.'/produk/delete/' .$item->kode_produk) }}" method="post" class="flex-grow-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('sidebar.footer')