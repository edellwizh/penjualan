<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('sidebar.admin')

<!-- Main content -->
<div class="main-content">
    <div class="container mt-4">
        <h4>Edit Kategori</h4>

        <form action="{{ url(Auth::user()->role.'/kategori/edit/'.$editkategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" required value="{{ old('nama_kategori', $editkategori->nama_kategori) }}">
            </div>

            <div class="form-group mb-3">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" name="deskripsi" class="form-control" required value="{{ old('deskripsi', $editkategori->deskripsi) }}">
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Edit Kategori</button>
            </div>
        </form>
    </div>
</div>

@include('sidebar.footer')