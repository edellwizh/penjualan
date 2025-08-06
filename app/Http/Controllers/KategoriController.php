<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ViewTambahKategori()
    {
        return view('crud.tambahkategori');
    }
    // Proses tambah kategori
    public function TambahKategori(Request $request){
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect(Auth::user()->role . '/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }
    // Tampilkan form edit kategori
    public function ViewEditKategori($id){
        $editkategori = Kategori::where('id', $id)->first();
        return view('crud.editkategori', compact('editkategori'));
    }
    // Proses update produk
    public function UpdateKategori(Request $request, $id){
        Kategori::where('id', $id)->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect(Auth::user()->role . '/kategori')->with('success', 'Kategori berhasil diubah');
    }
    // Proses hapus kategori
    public function DeleteKategori($id){
        Kategori::where('id', $id)->delete();
        return redirect(Auth::user()->role . '/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
