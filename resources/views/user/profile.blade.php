<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user1.css') }}">
</head>
<body>

@include('sidebar.user')

<div class="hero d-flex justify-content-center align-items-center text-center">
    <div>
        <div class="img-circle mx-auto mb-3"></div>
        <h5 class="mb-0 fw-bold">{{ auth()->user()->name }}</h5>

        @if(empty(auth()->user()->alamat) && empty(auth()->user()->telepon))
            <p class="mb-2">Profile belum diisi</p>
            <div class="d-flex justify-content-center gap-2 mt-3">
                <a href="{{ url(Auth::user()->role.'/profile/edit') }}" class="btn btn-primary mb-3">Isi Profile</a>
                <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        @else
            <p class="text-muted mb-1">{{ auth()->user()->alamat }}</p>
            <p class="text-muted mb-2">{{ auth()->user()->telepon }}</p>
            <div class="d-flex justify-content-center gap-2 mt-3">
                <a href="{{ url(Auth::user()->role.'/profile/edit') }}" class="btn btn-primary mb-3">Edit Profile</a>
                <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        @endif
        
        @include('sidebar.pesansukses')
    </div>
</div>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">
            <i class="bi bi-journal-text me-2"></i> Riwayat Pesanan Saya
        </h5>
        <a href="{{ url('user/riwayat-pemesanan') }}" class="btn btn-primary btn-sm">Lihat Semua <i class="bi bi-chevron-right"></i></a>
    </div>

    @php
        $recentOrders = App\Models\Pesanan::where('user_id', Auth::id())
                          ->orderBy('created_at', 'desc')
                          ->limit(3)
                          ->get();
    @endphp

    @if($recentOrders->count() > 0)
        @foreach($recentOrders as $order)
            <div class="order-summary">
                <div>
                    <p class="mb-0 fw-bold">Pesanan {{ $order->created_at->format('d/m/Y') }}</p>
                </div>
                <div>
                    <span class="badge 
                        @if($order->status == 'Pesanan Diproses') status-shipping
                        @elseif($order->status == 'Selesai') status-complete
                        @else status-pending
                        @endif">
                        {{ $order->status }}
                    </span>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> Belum ada riwayat pesanan
        </div>
    @endif
</div>

@include('sidebar.footer')