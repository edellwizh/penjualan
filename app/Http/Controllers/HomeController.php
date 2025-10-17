<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $this->homeAdmin();
        }
        return view('user.home');
    }

    public function homeAdmin()
    {
        $isAdmin = Auth::user()->role === 'admin';

        // === Grafik Produk Per Hari ===
        $produkPerHariQuery = Produk::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc');

        if (!$isAdmin) {
            $produkPerHariQuery->where('user_id', Auth::id());
        }

        $produkPerHari = $produkPerHariQuery->get();

        $dates = [];
        $totals = [];
        foreach ($produkPerHari as $item) {
            $dates[] = Carbon::parse($item->date)->format('Y-m-d');
            $totals[] = $item->total;
        }

        $chart = LarapexChart::barChart()
            ->setTitle('Produk Ditambahkan Per Hari')
            ->setSubtitle('Data Penambahan Produk Harian')
            ->addData('Jumlah Produk', $totals)
            ->setXAxis($dates);

        // === Total Produk ===
        $totalProductsQuery = Produk::query();
        if (!$isAdmin) {
            $totalProductsQuery->where('user_id', Auth::id());
        }
        $totalProducts = $totalProductsQuery->count();

        // === Total Pendapatan HARI INI (hanya status 'selesai') ===
        $totalRevenueAmount = Pesanan::where('status', 'selesai')
            ->whereDate('created_at', Carbon::today())
            ->sum('total_harga');

        $totalRevenue = 'Rp ' . number_format($totalRevenueAmount, 0, ',', '.');

        // === Pengguna Terdaftar ===
        $registeredUsers = User::where('role', 'user')->count();

        return view('admin.home', compact(
            'totalProducts',
            'totalRevenue',
            'registeredUsers',
            'chart'
        ));
    }

    // Menampilkan daftar tanggal pendapatan (hanya transaksi SELESAI)
    public function Pendapatan()
{
    // Ambil semua pesanan per tanggal (semua status)
    $pendapatanPerTanggal = Pesanan::selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah_transaksi')
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'desc')
        ->get();

        // === Buat Grafik Transaksi Harian ===
    $dates = [];
    $totals = [];

    foreach ($pendapatanPerTanggal as $item) {
        $dates[] = \Carbon\Carbon::parse($item->tanggal)->format('d M Y'); // Format: 17 Oct 2025
        $totals[] = $item->jumlah_transaksi;
    }

    $chart = \ArielMejiaDev\LarapexCharts\Facades\LarapexChart::barChart()
        ->setTitle('Transaksi Harian')
        ->setSubtitle('Jumlah Transaksi Per Hari')
        ->addData('Jumlah Transaksi', $totals)
        ->setXAxis($dates);

    return view('admin.pendapatan', compact('pendapatanPerTanggal', 'chart'));
}

    // Menampilkan SEMUA pesanan pada tanggal tertentu (disesuaikan dengan status di database)
    public function detailPendapatan($tanggal)
    {
        // ⚠️ SESUAIKAN DENGAN STATUS YANG ADA DI DATABASE
        // Berdasarkan screenshot: ada typo 'menunggu_pembayaran'
        $transaksiHariItu = Pesanan::with('user')
            ->whereDate('created_at', $tanggal)
            ->whereIn('status', [
                'menunggu_pembayaran',   // ← typo sesuai database
                'pesanan_diproses',
                'pengiriman',
                'selesai'
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.detailpendapatan', compact('transaksiHariItu', 'tanggal'));
    }

    // Detail pesanan (produk dalam pesanan)
    public function detailPesananadmin($id)
    {
        $pesanan = Pesanan::with('detailPesanan.produk')->findOrFail($id);
        return view('admin.detailpesanan', compact('pesanan'));
    }

    // Menampilkan Detail Status Pesanan (user)
    public function detailStatususer($id)
    {
        $pesanan = Pesanan::with(['detailPesanan.produk', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.detailstatus_pesanan', compact('pesanan'));
    }

    // Export PDF (hanya transaksi 'selesai')
    public function exportPendapatanPdf($tanggal)
    {
        $transaksiHariItu = Pesanan::with('user')
            ->where('status', 'selesai')
            ->whereDate('created_at', $tanggal)
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.report_pendapatan', compact('transaksiHariItu', 'tanggal'));
        return $pdf->stream('laporan-pendapatan-' . $tanggal . '.pdf');
    }
}