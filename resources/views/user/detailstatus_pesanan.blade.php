<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Status Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user1.css') }}">
</head>
<body>

@include('sidebar.user')

<!-- Main Content -->
<main class="container my-5">
    @if(isset($pesanan))
    <div class="detail-card">
        <div class="row">
            <div class="col-md-6">
                <!-- Ringkasan Pesanan -->
                <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                <p><strong>Nomor Faktur:</strong> {{ $pesanan->invoice_number }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge 
                        @if($pesanan->status == 'pesanan_diproses') status-pengiriman
                        @elseif($pesanan->status == 'selesai') status-selesai
                        @elseif($pesanan->status == 'pengiriman') status-pengiriman
                        @else status-menunggu
                        @endif rounded-pill px-3 py-2 fw-bold">
                        {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}
                    </span>
                </p>
                <p><strong>Tanggal Pesanan:</strong> {{ $pesanan->created_at->format('d F Y') }}</p>
                <p><strong>Alamat Pengiriman:</strong> {{ $pesanan->alamat_pengiriman ?? 'Alamat tidak tersedia' }}</p>
                <hr>
                <p class="h6 fw-bold">Total Pembayaran: Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
            </div>
            <div class="col-md-6">
                <!-- Detail Pengiriman -->
                <h5 class="fw-bold mb-3">Detail Pengiriman</h5>
                <div class="d-flex align-items-center mb-3">
                    <img src="https://placehold.co/70x70/E0F7FA/333?text=Kurir" alt="Gambar Kurir" class="rounded-circle me-3">
                    <div>
                        <p class="mb-0 fw-bold">Kurir: {{ $pesanan->kurir ?? 'JNE' }}</p>
                        <p class="mb-0 text-muted">Nomor Resi: {{ $pesanan->nomor_resi ?? '--' }}</p>
                    </div>
                </div>
                @if($pesanan->nomor_resi)
                <div class="d-grid">
                    <button class="btn btn-dark btn-view-order rounded-pill" onclick="lacakPengiriman('{{ $pesanan->nomor_resi }}')">Lacak Pengiriman</button>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Timeline Status Pesanan -->
    <div class="detail-card">
        <h5 class="fw-bold mb-4">Perjalanan Pesanan</h5>
        <div class="timeline-container">
            
            <!-- Menunggu Pembayaran -->
            <div class="timeline-item">
                <div class="timeline-dot {{ in_array($pesanan->status, ['pesanan_diproses', 'pengiriman', 'selesai']) ? 'active' : '' }}"></div>
                <p class="mb-0"><strong>Menunggu Pembayaran</strong></p>
                <small class="text-muted">
                    @if(in_array($pesanan->status, ['pesanan_diproses', 'pengiriman', 'selesai']))
                        {{ $pesanan->created_at->addDay()->format('d F Y') }}
                    @else
                        --
                    @endif
                </small>
            </div>
            
            <!-- Pesanan Diproses -->
            <div class="timeline-item">
                <div class="timeline-dot {{ in_array($pesanan->status, ['pesanan_diproses', 'pengiriman', 'selesai']) ? 'active' : '' }}"></div>
                <p class="mb-0"><strong>Pesanan Diproses</strong></p>
                <small class="text-muted">
                    @if(in_array($pesanan->status, ['pesanan_diproses', 'pengiriman', 'selesai']))
                        {{ $pesanan->updated_at->format('d F Y') }}
                    @else
                        --
                    @endif
                </small>
            </div>
            
            <!-- Sedang Dalam Pengiriman -->
            <div class="timeline-item">
                <div class="timeline-dot {{ in_array($pesanan->status, ['pengiriman', 'selesai']) ? 'active' : '' }}"></div>
                <p class="mb-0"><strong>Sedang Dalam Pengiriman</strong></p>
                <small class="text-muted">
                    @if(in_array($pesanan->status, ['pengiriman', 'selesai']))
                        {{ $pesanan->updated_at->format('d F Y') }}
                    @else
                        --
                    @endif
                </small>
            </div>
            
            <!-- Pesanan Tiba di Tujuan -->
            <div class="timeline-item">
                <div class="timeline-dot {{ $pesanan->status == 'selesai' ? 'active' : '' }}"></div>
                <p class="mb-0"><strong>Pesanan Tiba di Tujuan</strong></p>
                <small class="text-muted">
                    @if($pesanan->status == 'selesai')
                        {{ $pesanan->updated_at->format('d F Y') }}
                    @else
                        --
                    @endif
                </small>
            </div>
            
            <!-- Selesai -->
            <div class="timeline-item">
                <div class="timeline-dot {{ $pesanan->status == 'selesai' ? 'active' : '' }}"></div>
                <p class="mb-0"><strong>Selesai</strong></p>
                <small class="text-muted">
                    @if($pesanan->status == 'selesai')
                        {{ $pesanan->updated_at->format('d F Y') }}
                    @else
                        --
                    @endif
                </small>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-danger">
        Pesanan tidak ditemukan.
    </div>
    @endif
</main>


@include('sidebar.footer')