<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Menambahkan produk ke keranjang
    public function TambahKeranjang(Request $request, $kode_produk)
    {
        $produk = Produk::where('kode_produk', $kode_produk)->firstOrFail();
        $jumlah = (int) $request->input('jumlah', 1);
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)
                    ->where('kode_produk', $produk->kode_produk)
                    ->first();

        if ($cart) {
            $cart->jumlah_produk += $jumlah;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'kode_produk' => $produk->kode_produk,
                'jumlah_produk' => $jumlah,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Menampilkan keranjang user
    public function ViewKeranjang()
    {
        $user = Auth::user();

        $carts = Cart::with('produks')
            ->where('user_id', $user->id)
            ->get();

        return view('user.keranjang', compact('carts'));
    }

    // Menghapus 1 item dari keranjang
    public function DeleteKeranjang($kode_produk)
    {
        $user = Auth::user();

        $item = Cart::where('user_id', $user->id)
                    ->where('kode_produk', $kode_produk)
                    ->first();

        if ($item) {
            $item->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }
}
