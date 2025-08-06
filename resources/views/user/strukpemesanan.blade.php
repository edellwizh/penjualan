<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Struk Pemesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3 class="text-center mb-4">Struk Pemesanan</h3>

  <p><strong>Nama:</strong> {{ $user->name }}</p>
  <p><strong>Email:</strong> {{ $user->email }}</p>
  <p><strong>Kode Pesanan:</strong> {{ $pesan->kode_pesan }}</p>
  <p><strong>Status:</strong> {{ ucfirst($pesan->status) }}</p>

  <table class="table table-bordered mt-4">
    <thead class="table-secondary">
      <tr>
        <th>Produk</th>
        <th>Harga Satuan</th>
        <th>Jumlah</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($details as $item)
        <tr>
          <td>{{ $item->produk->nama_produk }}</td>
          <td>Rp{{ number_format($item->harga_satuan) }}</td>
          <td>{{ $item->jumlah }}</td>
          <td>Rp{{ number_format($item->total_harga) }}</td>
        </tr>
      @endforeach
      <tr>
        <td colspan="3" class="text-end"><strong>Total Harga:</strong></td>
        <td><strong>Rp{{ number_format($pesan->total_harga) }}</strong></td>
      </tr>
    </tbody>
  </table>

  <div class="text-center mt-4">
    <a href="{{ url('/user/produk') }}" class="btn btn-primary">Belanja Lagi</a>
  </div>
</div>
</body>
</html>
