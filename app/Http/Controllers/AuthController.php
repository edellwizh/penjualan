<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pesanan; 

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    // Fungsi untuk proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // cek kredensial pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect('/admin/home');
            } else {
                return redirect('/user/produk');
            }
        }

        // jika gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau Password salah',
        ]);
    }

    // Fungsi untuk menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('login.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat pengguna baru
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        // Kembali ke halaman register dengan pesan sukses
        // dd($user);
        return back()->with('success', 'Registrasi berhasil. Silakan login.');
    }


    // Fungsi logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // Menampilkan halaman profil user
    public function Profile()
     {
        // Ambil 3 riwayat pesanan terakhir
        $recentOrders = Pesanan::where('user_id', Auth::id())
                         ->orderBy('created_at', 'desc')
                         ->limit(3)
                         ->get();

        return view('user.profile', compact('recentOrders'));
    }

    public function FormTambahProfile()
    {

        return view('crud.editprofile');
    }
    // Method untuk memproses update profil
    public function UpdateProfile(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'provinsi' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'alamat_lengkap' => 'required|string',
            'telepon' => 'required|string|max:15',
        ]);

        // Menggabungkan data alamat menjadi satu string
        $fullAddress = $request->provinsi . ', ' .
                       $request->kecamatan . ', ' .
                       $request->kelurahan . ', ' .
                       $request->alamat_lengkap . ' ' .
                       '(' . $request->kode_pos . ')';

        // Mengambil user yang sedang login
        $users = Auth::user();
        
        // Memperbarui data user
        $users->alamat = $fullAddress;
        $users->telepon = $request->telepon;
        $users->save(); 

        // Redirect kembali ke halaman tertentu dengan pesan sukses
        return redirect(Auth::user()->role . '/profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
