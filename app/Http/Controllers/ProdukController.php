<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Testimoni;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategoris')->get();
        $kategoris = Kategori::with('produks')->get();

        if (Auth::user()->role === 'user') {
            $kategorisAtas = $kategoris->take(2);
            $kategorisBawah = $kategoris->slice(2);
            $testimonis = Testimoni::with('user')->where('status', true)->get();
            return view('produk', compact('kategorisAtas', 'kategorisBawah', 'produks', 'kategoris', 'testimonis'));
        }
        return view('produk', compact('produks', 'kategoris'));
    }

    // Menampilkan tombol
    public function viewtambahProduk()
    {
        $kategoris = Kategori::all();
        return view('crud.tambahproduk', compact('kategoris'));
    }

    // Proses tambah 
    public function tambahProduk(Request $request)
    {
        $request->validate([
            'image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'jumlah_produk' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            Storage::putFileAs('images', $imageFile, $imageName);
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk,
            'kategori_id' => $request->kategori_id,
            'image' => $imageName,
        ]);

        return redirect(Auth::user()->role . '/produk')->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan tombol
    public function vieweditProduk($kode_produk)
    {
        $editproduk = Produk::where('kode_produk', $kode_produk)->first();
        $kategoris = Kategori::all();
        return view('crud.editproduk', compact('editproduk', 'kategoris'));
    }

    // Proses update 
    public function updateProduk(Request $request, $kode_produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'jumlah_produk' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $dataUpdate = [
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk,
            'kategori_id' => $request->kategori_id,
        ];

        Produk::where('kode_produk', $kode_produk)->update($dataUpdate);

        return redirect(Auth::user()->role . '/produk')->with('success', 'Produk berhasil diubah');
    }

    // Proses hapus 
    public function deleteProduk($kode_produk)
    {
        Produk::where('kode_produk', $kode_produk)->delete();
        return redirect(Auth::user()->role . '/produk')->with('success', 'Produk berhasil dihapus');
    }

    // Menampilkan laporan
    public function viewLaporan()
    {
        $kategoris = Kategori::with('produks')->get();
        return view('admin.laporan', compact('kategoris'));
    }

    // Menampilkan print laporan
    public function print()
    {
        $kategoris = Kategori::with('produks')->get();
        $pdf = Pdf::loadView('admin.report', compact('kategoris'));
        return $pdf->stream('laporan-produk.pdf');
    }

    // Menampilkan detail
    public function detailProduk($kode_produk)
    {
        $produks = Produk::with('kategoris')->where('kode_produk', $kode_produk)->first();
        $kategoris = Kategori::with('produks')->get();
        return view('user.detailproduk', compact('produks', 'kategoris'));
    }
}