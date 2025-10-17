<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PesanController extends Controller
{
    // Menampilkan
    public function viewPesan(){
        // Ambil data keranjang untuk user yang sedang login
        $keranjang = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        $user = Auth::user();

        if ($keranjang->isEmpty()) {
            return redirect(Auth::user()->role . '/keranjang')->with('error', 'Keranjang Anda kosong, tidak dapat melakukan checkout.');
        }

        if (empty($user->alamat)) {
            return redirect(Auth::user()->role . '/profile')->with('error', 'Silakan lengkapi alamat pengiriman Anda terlebih dahulu sebelum melanjutkan checkout.');
        }

        // Hitung total harga dari semua item di keranjang
        $totalHarga = $keranjang->sum(function ($item) {
            return $item->quantity * $item->produk->harga;
        });

        // GENERATE NOMOR FAKTUR DI SINI dan kirim ke view
        $invoiceNumber = 'INV-' . strtoupper(Str::random(8));

        return view('user.pemesanan', compact('keranjang', 'totalHarga', 'invoiceNumber'));
    }

    // Proses
    public function prosesPesan(Request $request)
    {
        if (!Auth::check()) {
            return redirect(Auth::user()->role . '/login')->with('error', 'Anda harus login untuk melakukan checkout.');
        }

        $userId = Auth::id();
        $user = Auth::user();

        if (empty($user->alamat)) {
             return redirect(Auth::user()->role . '/profile')->with('error', 'Silakan lengkapi alamat pengiriman Anda terlebih dahulu sebelum melanjutkan checkout.');
        }

        DB::beginTransaction();

        try {
            // Ambil semua item dari keranjang user
            $keranjang = Keranjang::with('produk')->where('user_id', $userId)->get();

            if ($keranjang->isEmpty()) {
                throw new \Exception('Keranjang Anda kosong, tidak dapat membuat pesanan.');
            }

            // Validasi stok produk sebelum membuat pesanan
            foreach ($keranjang as $item) {
                $produk = $item->produk; 

                if (!$produk || $produk->jumlah_produk < $item->quantity) {
                    throw new \Exception("Stok produk '{$item->produk->nama_produk}' tidak mencukupi.");
                }
            }

            // Hitung total harga
            $totalHarga = $keranjang->sum(function ($item) {
                return $item->quantity * $item->produk->harga;
            });
            
            // Gunakan nomor faktur dari request
            $invoiceNumber = $request->input('invoice_number');

            // Buat pesanan baru, ambil alamat dari profil user
            $pesanan = Pesanan::create([
                'user_id' => $userId,
                'invoice_number' => $invoiceNumber,
                'total_harga' => $totalHarga,
                'alamat_pengiriman' => $user->alamat,
                'status' => 'menunggu_pembayaran',
            ]);

            // Pindahkan item dari keranjang ke detail pesanan dan kurangi stok
            foreach ($keranjang as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'kode_produk' => $item->kode_produk,
                    'quantity' => $item->quantity,
                    'harga' => $item->produk->harga,
                ]);

                // Kurangi stok produk
                $produk = Produk::where('kode_produk', $item->kode_produk)->first();
                if ($produk) {
                    $produk->jumlah_produk -= $item->quantity;
                    $produk->save();
                }
            }

            // Hapus semua item dari keranjang setelah pesanan berhasil
            Keranjang::where('user_id', $userId)->delete();

            // Commit transaksi jika semua berhasil
            DB::commit();

            // Redirect ke halaman pembayaran dengan parameter invoice_number
            return redirect(Auth::user()->role . '/pembayaran?invoice_number=' . $invoiceNumber)
                        ->with('success', "Pesanan Anda dengan nomor faktur {$invoiceNumber} berhasil dibuat! Silakan selesaikan pembayaran.");

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            return redirect(Auth::user()->role . '/keranjang')->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    // Menampilkan
    public function halamanPembayaran(Request $request)
    {
        // Cek apakah ada parameter invoice_number dari URL
        $invoiceNumber = $request->query('invoice_number');
        
        // Jika tidak ada di query, cek dari session
        if (!$invoiceNumber) {
            $invoiceNumber = session('invoiceNumber');
        }

        // Jika masih tidak ada, redirect ke riwayat pesanan
        if (!$invoiceNumber) {
            return redirect(Auth::user()->role . '/riwayat-pemesanan')
                   ->with('error', 'Nomor faktur tidak ditemukan.');
        }

        // Cari pesanan dengan status menunggu_pembayaran
        $pesanan = Pesanan::where('invoice_number', $invoiceNumber)
                         ->where('user_id', Auth::id())
                         ->where('status', 'menunggu_pembayaran')
                         ->first();

        if (!$pesanan) {
            return redirect(Auth::user()->role . '/riwayat-pemesanan')
                   ->with('error', 'Pesanan tidak ditemukan atau tidak dalam status menunggu pembayaran.');
        }
        
        return view('user.pembayaran', compact('pesanan'));
    }

    // Proses bayar sekarang
    public function redirectToPembayaran($id)
    {
        // Cari pesanan berdasarkan ID dan pastikan statusnya menunggu_pembayaran
        $pesanan = Pesanan::where('id', $id)
                         ->where('user_id', Auth::id())
                         ->where('status', 'menunggu_pembayaran')
                         ->first();
        
        if (!$pesanan) {
            return redirect(Auth::user()->role . '/riwayat-pemesanan')
                   ->with('error', 'Pesanan tidak ditemukan atau tidak dalam status menunggu pembayaran.');
        }
        
        // Redirect ke halaman pembayaran dengan parameter invoice_number
        return redirect(Auth::user()->role . '/pembayaran?invoice_number=' . $pesanan->invoice_number);
    }

    // Proses ubah status pesanan diproses
    public function prosesPesanan($id)
    {
        // Cari pesanan berdasarkan ID dan pastikan milik user yang sedang login
        $pesanan = Pesanan::where('id', $id)
                         ->where('user_id', Auth::id())
                         ->first();
        
        if (!$pesanan) {
            return redirect(Auth::user()->role . '/riwayat-pemesanan')
                   ->with('error', 'Pesanan tidak ditemukan atau akses ditolak.');
        }
        
        // Update status pesanan hanya jika status saat ini menunggu_pembayaran
        if ($pesanan->status === 'menunggu_pembayaran') {
            $pesanan->update([
                'status' => 'pesanan_diproses'
            ]);
        }
        
        // REDIRECT KE RIWAYAT TANPA FILTER INVOICE (menampilkan semua riwayat)
        return redirect(Auth::user()->role . '/riwayat-pemesanan')
                    ->with('success', 'Pesanan Anda sedang diproses!');
    }

    // Menampilkan
    public function riwayatPemesanan(Request $request)
    {
        $invoiceNumber = $request->query('invoice');
        
        if ($invoiceNumber) {
            // Tampilkan detail pesanan spesifik
            $pesanan = Pesanan::with(['detailPesanan.produk'])
                             ->where('invoice_number', $invoiceNumber)
                             ->where('user_id', Auth::id())
                             ->firstOrFail();
            
            $pesanans = collect([$pesanan]);
        } else {
            // Tampilkan semua pesanan user
            $pesanans = Pesanan::with(['detailPesanan.produk'])
                              ->where('user_id', Auth::id())
                              ->orderBy('created_at', 'desc')
                              ->get();
        }

        return view('user.riwayat_pesanan', compact('pesanans', 'invoiceNumber'));
    }
}