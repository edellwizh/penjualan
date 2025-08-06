<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body>

<!-- Main content -->
      <div class="main-content">
        <!-- Header -->
         <header>
          <h2>Daftar Produk</h2>
          <p>Temukan Produk terbaik untuk kebutuhan Anda</p>
         </header>

        @include('sidebar.pesansukses')
         
         <a href="{{ url(Auth::user()->role.'/produk/tambah') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>
         <a href="{{ url(Auth::user()->role.'/kategori') }}" class="btn btn-primary mb-3">Lihat Kategori</a>

         <!-- Product card -->
        @foreach ($produks as $item)
          <div class="product-grid">
          <div class="product-card">
            <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->nama_produk }}" width="150">
            <!-- <p>{{ $item->image }}</p> -->
            <h3>{{$item->nama_produk}}</h3>
            <p class="price">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
            
            <a href="{{ url(Auth::user()->role.'/produk/edit/' . $item->kode_produk) }}" class="btn btn-warning">Edit</a>

            <!--  Delete  -->
             <form action="{{ url(Auth::user()->role.'/produk/delete/' .$item->kode_produk) }}" method="post">
              @csrf
              @method('DELETE')
               <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</button>
             </form>
          </div>
          @endforeach
          </div>
      </div>
          
@include('sidebar.footer')