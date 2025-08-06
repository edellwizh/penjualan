<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $data = [
            'totalProducts' => 310,
            'salesTOday' => 100,
            'totalRevenue' => 'Rp 50,000,000',
            'registeredUsers' => User::where('role', 'user')->count(),
        ];
        return view('admin.home', $data);
        }

    public function ViewHome(){
        // apakah user adalah admin
        $isAdmin = Auth::user()->role === 'admin';

        // ambil produk dari db dan kelompokkan berdasarkan tanggal
        $produkPerHariQuery = Produk::selectRaw('DATE(created_at) as date, COUNT(*) as total')
        ->groupBy('date')
        ->orderBy('date', 'asc');

        // filter by user_id jika user bukan admin
        if(!$isAdmin){
            $produkPerHariQuery->where('user_id', Auth::id());
        }

        $produkPerHari = $produkPerHariQuery->get();

        // memisahkan data untuk grafik
        $dates = [];
        $totals =[];

        foreach ($produkPerHari as $item){
            $dates[] = Carbon::parse($item->date)->format('Y-m-d');
            $totals[] = $item->total;       
        }

        // membuat grafik menggunakan data yang diambil
        $chart = LarapexChart::barChart()
        ->setTitle('Produk Ditambahkan Per Hari')
        ->setSubtitle('Data Penambahan Produk Harian')
        ->addData('Jumlah Produk', $totals)
        ->setXAxis($dates);

        $totalProductsQuery = Produk::query();

        //  Filter by user_id jika user bukan admin
        if(!$isAdmin){
            $totalProductsQuery->where('user_id', Auth::id());
        }
        // data tambahan untuk view
        $data = [
            'totalProducts' => $totalProductsQuery->count(), // total produk
            'salesToday' => 130, // contoh data
            'totalRevenue' => 'Rp 75,000,000',
            'registeredUsers' => User::where('role', 'user')->count(),
            'chart' => $chart // Pass chart ke view
        ];
        return view('admin.home', $data);
    }
}
