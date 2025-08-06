<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>

@include('sidebar.admin')

     <!-- Main content -->
      <div class="main-content">
         
         <div class="container">
            <h4>Tambah Kategori</h4>
         <form action="{{ url(Auth::user()->role.'/kategori/tambah') }}" method="POST" enctype="multipart/form-data">
            @csrf

        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" required>
        </div>


        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Tambah Kategori</button>
        </div>
        </div>
    </form>

    @include('sidebar.footer')