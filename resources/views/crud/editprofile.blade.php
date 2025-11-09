<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/user1.css') }}">
</head>
<body>

@include('sidebar.user')

<!-- Header untuk Form Profil -->
<div class="hero text-center py-5">
  <h1 class="fw-bold">Update Profile</h1>
  <p class="mb-0">Perbarui data diri Anda jika ada perubahan.</p>
</div>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card p-4 shadow-sm">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ url(Auth::user()->role.'/profile/edit') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <input type="text" name="provinsi" id="provinsi" class="form-control"
              value="{{ old('provinsi', $user->provinsi ?? '') }}" required>
          </div>

          <div class="mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" name="kecamatan" id="kecamatan" class="form-control"
              value="{{ old('kecamatan', $user->kecamatan ?? '') }}" required>
          </div>

          <div class="mb-3">
            <label for="kelurahan" class="form-label">Kelurahan</label>
            <input type="text" name="kelurahan" id="kelurahan" class="form-control"
              value="{{ old('kelurahan', $user->kelurahan ?? '') }}" required>
          </div>

          <div class="mb-3">
            <label for="kode_pos" class="form-label">Kode Pos</label>
            <input type="text" name="kode_pos" id="kode_pos" class="form-control"
              value="{{ old('kode_pos', $user->kode_pos ?? '') }}" required>
          </div>

          <div class="mb-3">
            <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
            <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="3" required>{{ old('alamat_lengkap', $user->alamat_lengkap ?? '') }}</textarea>
          </div>

          <div class="mb-3">
            <label for="telepon" class="form-label">Nomor Telepon</label>
            <input type="text" name="telepon" id="telepon" class="form-control"
              value="{{ old('telepon', $user->telepon ?? '') }}" required>
          </div>

          <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
        </form>
      </div>
    </div>
  </div>
</div>

@include('sidebar.footer')