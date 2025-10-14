<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class StatusPesananController extends Controller
{
    public function Status()
    {
        // Ambil semua pesanan dengan status >= diproses
        $pesanans = Pesanan::with('user')
            ->whereIn('status', ['pesanan_diproses', 'pengiriman', 'selesai'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.status_penjualan', compact('pesanans'));
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:pengiriman,selesai',
        ]);

        // Validasi transisi status
        $allowedTransitions = [
            'pesanan_diproses' => 'pengiriman',
            'pengiriman' => 'selesai'
        ];

        if (!isset($allowedTransitions[$pesanan->status]) || $allowedTransitions[$pesanan->status] !== $request->status) {
            return back()->withErrors(['status' => 'Transisi status tidak valid.']);
        }

        $pesanan->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
    
    public function DetailPesanan($id)
    {
        $pesanan = Pesanan::with(['detailPesanan.produk', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.detailstatus_pesanan', compact('pesanan'));
    }
}