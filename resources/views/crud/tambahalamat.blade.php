<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Alamat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/user.css') }}">
</head>
<body>

@include('sidebar.user')

<div class="container py-5">
  <h4 class="mb-4">Tambah Alamat</h4>

  <form action="{{ url(Auth::user()->role.'/profile/alamat') }}" method="POST">
    @csrf

    <div class="row g-3">
      <div class="col-md-6">
        <label for="provinsi" class="form-label">Provinsi</label>
        <input type="text" name="provinsi" id="provinsi" class="form-control" required>
      </div>

      <div class="col-md-6">
        <label for="kota" class="form-label">Kota / Kabupaten</label>
        <input type="text" name="kota" id="kota" class="form-control" required>
      </div>

      <div class="col-md-6">
        <label for="kode_pos" class="form-label">Kode Pos</label>
        <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
      </div>

      <div class="col-md-12">
        <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
        <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="3" required></textarea>
      </div>
    </div>

    <div class="mt-4">
      <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> Simpan Alamat
      </button>
    </div>
  </form>

</div>

@include('sidebar.footer')