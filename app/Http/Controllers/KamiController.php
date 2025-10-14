<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class KamiController extends Controller
{
    // Menampilkan halaman tentang kami
    public function TentangKami()
    {
        return view('user.tentangkami');
    }
}