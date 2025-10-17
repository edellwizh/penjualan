<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller{
    
    public function index()
    {
        $testimonis = Testimoni::where('status', true)->latest()->get();
        return view('user.testimoni', compact('testimonis'));
    }

    // Proses tambah
    public function tambahTestimoni(Request $request){
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'pesan' => 'required|string|max:1000',
        ]);

        Testimoni::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'pesan' => $request->pesan,
            'status' => false
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Testimoni kamu akan ditinjau terlebih dahulu.');
    }

    // Menampilkan
    public function adminIndex(){
        $testimonis = Testimoni::with('user')->latest()->get();
        return view('admin.testimoni', compact('testimonis'));
    }

    // Ubah status
    public function updateStatus($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->status = !$testimoni->status;
        $testimoni->save();

        return redirect()->back()->with('success', 'Status testimoni diperbarui.');
    }

    // Hapus
    public function delete($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();

        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }

}
