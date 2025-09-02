<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body>
    @include('sidebar.admin')
    
    <div class="main-content container mt-4">
        <header class="mb-3">
            <h2>Daftar Kategori</h2>
            <p>Masukkan kategori-kategori produk milik kamu. Supaya produk kamu makin terstruktur isinya.</p>
        </header>

        @include('sidebar.pesansukses')

        <a href="{{ url(Auth::user()->role.'/kategori/tambah') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $index => $kategori)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>{{ $kategori->deskripsi }}</td>
                        <td>
                            <a href="{{ url(Auth::user()->role.'/kategori/edit/' . $kategori->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                            <form action="{{ url(Auth::user()->role.'/kategori/delete/' . $kategori->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada kategori</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @include('sidebar.footer')
</body>
</html>