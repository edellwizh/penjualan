<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>

@include('sidebar.admin')

     <!-- Main content -->
      <div class="main-content">
         
         <div class="container">
            <h4>Tambah Produk</h4>

            @if ($errors->any())
            <div class="alert alert-danger mt-2">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            </div>
        @endif

         <form action="{{ url(Auth::user()->role.'/produk/tambah') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
            <label for="image">Gambar Produk</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori}}</option>
            @endforeach
        </select>
    </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="jumlah_produk">Jumlah Produk</label>
            <input type="number" name="jumlah_produk" class="form-control" required>
        </div>

         <div class="form-group">
            <label for="deskripsi">Deskripsi (buat semenarik mungkin)</label>
            <textarea name="deskripsi" class="form-control" required rows="8" style="resize: vertical;"></textarea>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
        </div>
        </div>
    </form>

    @include('sidebar.footer')