<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjualan</title>
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    @include('sidebar.admin')

    <div class="main-content"> 
        <header>
            <h2>Hallo, Selamat datang {{ Auth::user()->name }}.</h2>
        </header>

        <!-- Stats Cards -->
        <div class="cards">
            <div class="card">
                <a href="{{ url(Auth::user()->role.'/laporan') }}" class="text-decoration-none">
                <h3>Laporan Produk</h3>
                <p id="total-products">{{$totalProducts}}</p>
                </a>
            </div>

            <div class="card">
                <a href="{{ url(Auth::user()->role.'/pendapatan') }}" class="text-decoration-none">
                <h3>Laporan Pendapatan</h3>
                </a>
            </div> 

            <div class="card">
                <a href="{{ url(Auth::user()->role.'/pendapatan') }}" class="text-decoration-none">
                <h5>Total Pendapatan & Status Pemesanan</h5>
                <p id="total-revenue">{{ $totalRevenue }}</p>
                <small class="text-muted">Hari ini {{ now()->format('d F Y') }}</small>
                </a>
            </div>
            
            <div class="card">
                <a href="#" class="text-decoration-none">
                <h3>Pengguna Terdaftar</h3>
                <p id="registered-users">{{ $registeredUsers }}</p>
                </a>
            </div>
        </div>

        <div class="alert alert-primary" role="alert">
            A simple primary alert
        </div>

        <!-- Sales chart -->
        <div id="chart">
            <h2>Grafik Penambahan Produk</h2>
            {!! $chart->container() !!}
        </div>

        <script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}

        @include('sidebar.footer')