<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body>

@include('sidebar.admin')

     <!-- Main content -->
      <div class="main-content">
         
         <div class="container">
            <h4>Edit Produk</h4>
         <form action="{{ url(Auth::user()->role.'/produk/edit/'.$editproduk->kode_produk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="form-group">
            <label for="image">Gambar Produk</label>
            <input type="file" name="image" class="form-control" value='{{$editproduk->image}}'>
        </div>

        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required value='{{$editproduk->nama_produk}}'>
        </div>

            <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $editproduk->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" class="form-control" rows="8" required value='{{$editproduk->harga}}'>
        </div>

        <div class="form-group">
            <label for="jumlah_produk">Jumlah Produk</label>
            <input type="number" name="jumlah_produk" class="form-control" required value='{{$editproduk->jumlah_produk}}'>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi (buat semenarik mungkin)</label>
            <textarea name="deskripsi" class="form-control" required rows="8" style="resize: vertical;">{{ $editproduk->deskripsi }}</textarea>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Edit Produk</button>
        </div>
        </div>
    </form>

    @include('sidebar.footer')