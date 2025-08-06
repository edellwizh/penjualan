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
        // Pisahkan menjadi dua bagian
        $kategorisAtas = $kategoris->take(2); // ambil 2 pertama
        $kategorisBawah = $kategoris->slice(2);
        $testimonis = Testimoni::with('user')->where('status', true)->get();
        return view('produk', compact('kategorisAtas', 'kategorisBawah', 'produks', 'kategoris', 'testimonis'));

    }

    return view('produk', compact('produks', 'kategoris'));
}


    // Tampilkan form tambah produk
    public function ViewTambahProduk()
    {
        $kategoris = Kategori::all(); // ambil semua kategori
        return view('crud.tambahproduk', compact('kategoris'));
    }

    // Proses tambah produk
    public function TambahProduk(Request $request)
{
    $request->validate([
        'image' => 'nullable|mimes:jpeg,png,jpg|max:2048', // hanya file gambar
        'nama_produk' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'harga' => 'required|numeric',
        'jumlah_produk' => 'required|integer',
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


    // Tampilkan form edit produk
    public function ViewEditProduk($kode_produk)
    {
        $editproduk = Produk::where('kode_produk', $kode_produk)->first();
        $kategoris = Kategori::all(); // ambil kategori untuk dropdown
        return view('crud.editproduk', compact('editproduk', 'kategoris'));
    }

    // Proses update produk
    public function UpdateProduk(Request $request, $kode_produk)
    {
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

    // Proses hapus produk
    public function DeleteProduk($kode_produk)
    {
        Produk::where('kode_produk', $kode_produk)->delete();
        return redirect(Auth::user()->role . '/produk')->with('success', 'Produk berhasil dihapus');
    }

    // Tampilkan halaman laporan
    public function ViewLaporan()
    {
        $kategoris = Kategori::with('produks')->get(); // eager load
        return view('admin.laporan', compact('kategoris'));
    }

    public function print(){
    $kategoris = Kategori::with('produks')->get();
    $pdf = Pdf::loadView('admin.report', compact('kategoris'));
    return $pdf->stream('laporan-produk.pdf');
    }

    public function DetailProduk($kode_produk){
    // Ambil satu produk berdasarkan kode_produk dan relasi kategoris
    $produks = Produk::with('kategoris')->where('kode_produk', $kode_produk)->first();
    $kategoris = Kategori::with('produks')->get();

    // Kirim 1 produk saja, bukan koleksi
    return view('user.detailproduk', compact('produks', 'kategoris'));
}
}