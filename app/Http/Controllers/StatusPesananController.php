<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class StatusPesananController extends Controller
{
//     // Menampilkan status admin
//     public function Status(){
//         $pesanans = Pesanan::with('user')
//             ->whereIn('status', ['pesanan_diproses', 'pengiriman', 'selesai'])
//             ->orderBy('created_at', 'desc')
//             ->get();

//         return view('admin.detailpendapatan', compact('pesanans'));
//     }

    // Proses update
    public function updateStatus(Request $request, Pesanan $pesanan){
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
}