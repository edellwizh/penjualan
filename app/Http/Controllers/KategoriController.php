<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori', compact('kategoris'));
    }

    // Menampilkan tombol 
    public function viewtambahKategori()
    {
        return view('crud.tambahkategori');
    }

    // Proses tambah
    public function tambahKategori(Request $request){
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect(Auth::user()->role . '/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Menampilkan tombol
    public function vieweditKategori($id){
        $editkategori = Kategori::where('id', $id)->first();
        return view('crud.editkategori', compact('editkategori'));
    }

    // Proses update 
    public function updateKategori(Request $request, $id){
        Kategori::where('id', $id)->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect(Auth::user()->role . '/kategori')->with('success', 'Kategori berhasil diubah');
    }

    // Proses hapus 
    public function deleteKategori($id){
        Kategori::where('id', $id)->delete();
        return redirect(Auth::user()->role . '/kategori')->with('success', 'Kategori berhasil dihapus');
    }
    
}
