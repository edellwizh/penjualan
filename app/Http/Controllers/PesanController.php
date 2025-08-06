<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pesan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{
    // Proses pesanan dari keranjang
    public function PesanKeranjang()
    {
        $user = Auth::user();

        // Cek apakah user sudah mengisi alamat
        if (!$user->alamat) {
            return redirect(Auth::user()->role . '/profile')->with('error', 'Silakan lengkapi alamat Anda terlebih dahulu.');
        }

        // Ambil item keranjang dengan relasi produk
        $cartItems = Cart::with('produks')
            ->where('user_id', $user->id)
            ->get();

        // Jika keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja Anda kosong.');
        }

        DB::beginTransaction();
        try {
            $total = 0;

            // Hitung total dan cek stok
            foreach ($cartItems as $item) {
                $produk = $item->produks;

                if ($item->jumlah_produk > $produk->jumlah) {
                    return redirect()->back()->with('error', "Stok tidak cukup untuk produk: {$produk->nama_produk}");
                }

                $total += $produk->harga * $item->jumlah_produk;
            }

            // Simpan data ke tabel pesan
            $kodePesan = 'ORD' . now()->format('Ymd') . strtoupper(Str::random(4));

            $pesan = Pesan::create([
                'user_id' => $user->id,
                'kode_pesan' => $kodePesan,
                'total_harga' => $total,
                'status' => 'pending',
            ]);

            // Simpan ke tabel detail_pesanan dan kurangi stok
            foreach ($cartItems as $item) {
                $produk = $item->produks;

                DetailPesanan::create([
                    'pesan_id' => $pesan->id,
                    'kode_produk' => $produk->kode_produk,
                    'nama_produk' => $produk->nama_produk,
                    'jumlah_produk' => $item->jumlah_produk,
                    'harga_satuan' => $produk->harga,
                    'subtotal' => $produk->harga * $item->jumlah_produk,
                ]);

                // Kurangi stok produk
                $produk->jumlah -= $item->jumlah_produk;
                $produk->save();
            }

            // Hapus semua item dari keranjang user
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('user.strukpemesanan', ['id' => $pesan->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal melakukan pemesanan. Silakan coba lagi.');
        }
    }

    // Menampilkan struk belanja
    public function ViewPesanan($id)
    {
        $pesan = Pesan::findOrFail($id);
        $details = DetailPesanan::where('pesan_id', $id)->get();
        $user = Auth::user();

        return view('user.strukpemesanan', compact('pesan', 'details', 'user'));
    }
}
