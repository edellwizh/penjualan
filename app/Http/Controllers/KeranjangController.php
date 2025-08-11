<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /**
     * Tampilkan halaman keranjang belanja pengguna.
     */
    public function ViewKeranjang()
    {
        // Ambil data keranjang untuk user yang sedang login
        $keranjang = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        // Hitung total harga dari semua item di keranjang
        $totalHarga = $keranjang->sum(function ($item) {
            return $item->quantity * $item->produk->harga;
        });

        return view('user.keranjang', compact('keranjang', 'totalHarga'));
    }

    /**
     * Tambahkan produk ke keranjang.
     * Menggunakan method POST
     */
    public function TambahKeranjang(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|exists:produks,kode_produk',
            'quantity' => 'required|integer|min:1'
        ]);

        $kode_produk = $request->input('kode_produk');
        $quantity = $request->input('quantity');

        // Cari apakah produk sudah ada di keranjang user
        $itemKeranjang = Keranjang::where('user_id', Auth::id())
            ->where('kode_produk', $kode_produk)
            ->first();

        // Jika produk sudah ada, update quantity-nya
        if ($itemKeranjang) {
            $itemKeranjang->quantity += $quantity;
            $itemKeranjang->save();
        } else {
            // Jika produk belum ada, buat item baru di keranjang
            Keranjang::create([
                'user_id' => Auth::id(),
                'kode_produk' => $kode_produk,
                'quantity' => $quantity
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update jumlah produk di keranjang.
     */
    public function UpdateKeranjang(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $itemKeranjang = Keranjang::where('user_id', Auth::id())->findOrFail($id);
        $itemKeranjang->quantity = $request->input('quantity');
        $itemKeranjang->save();

        return redirect()->back()->with('success', 'Jumlah produk berhasil diubah!');
    }

    /**
     * Hapus satu item dari keranjang.
     */
    public function HapusKeranjang($id)
    {
        $itemKeranjang = Keranjang::where('user_id', Auth::id())->findOrFail($id);
        $itemKeranjang->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
