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

    // Menampilkan form alamat
    public function ViewTambahAlamat()
    {
        return view('crud.tambahalamat');
    }

    // Menyimpan alamat user
   public function TambahAlamat(Request $request){
    $request->validate([
        'provinsi' => 'required|string',
        'kota' => 'required|string',
        'kode_pos' => 'required|string',
        'alamat_lengkap' => 'required|string',
    ]);

    $alamat = $request->alamat_lengkap . ', ' . $request->kota . ', ' . $request->provinsi . ', ' . $request->kode_pos;

    $user = Auth::user();
    $user->alamat = $alamat; // pastikan kolom `alamat` ada di tabel users
    $user->save();

    return redirect('user.profile')->with('success', 'Alamat berhasil disimpan!');
}
    // Tampilkan form edit profil
    public function editProfile()
    {
        $user = Auth::user();
        return view('crud.editprofile', compact('user'));
    }

    // Proses update profil
    public function updateProfile(Request $request){
    $user = auth()->user();

    $gabunganAlamat = $request->provinsi . ', ' .
                      $request->kota . ', ' .
                      $request->kode_pos . ', ' .
                      $request->alamat_lengkap;

    $user->alamat = $gabunganAlamat;

    $user->name = $request->name; // jika ada edit username
    $user->save();

    return redirect('/user/profile')->with('success', 'Profil berhasil diperbarui.');
}


}
