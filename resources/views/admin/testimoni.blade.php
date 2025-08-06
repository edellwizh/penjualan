<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Testimoni</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body>

@include('sidebar.admin')

<div class="main-content container mt-4">
    <!-- Header -->
    <header class="mb-3">
        <h2>Daftar Testimoni</h2>
    </header>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Rating</th>
                <th>Pesan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonis as $no => $t)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $t->user->name }}</td>
                <td>{{ $t->rating }}</td>
                <td>{{ $t->pesan }}</td>
                <td>
                    @if($t->status)
                        <span class="badge bg-success">Disetujui</span>
                    @else
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    @endif
                </td>
                <td>
                    <a href="{{ url('admin/testimoni/status/'.$t->id) }}" class="btn btn-sm btn-info">
                        @if($t->status) Tolak @else Setujui @endif
                    </a>
                    <a href="{{ url('admin/testimoni/delete/'.$t->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('sidebar.footer')