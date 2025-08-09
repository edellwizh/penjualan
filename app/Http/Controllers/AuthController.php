<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        return view('user.profile');
    }

}
