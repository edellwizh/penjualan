<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    // Tampilkan semua testimoni (user)
    public function index()
    {
        $testimonis = Testimoni::where('status', true)->latest()->get();
        return view('user.testimoni', compact('testimonis'));
    }

    // Simpan testimoni baru
    public function TambahTestimoni(Request $request)
    {
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

    // Admin: Tampilkan semua testimoni
    public function adminIndex()
    {
        $testimonis = Testimoni::with('user')->latest()->get();
        return view('admin.testimoni', compact('testimonis'));
    }

    // Admin: Ubah status testimoni
    public function updateStatus($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->status = !$testimoni->status;
        $testimoni->save();

        return redirect()->back()->with('success', 'Status testimoni diperbarui.');
    }

    // Admin: Hapus testimoni
    public function delete($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();

        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }

}
