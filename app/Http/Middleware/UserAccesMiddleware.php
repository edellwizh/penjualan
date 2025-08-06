<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // 

class UserAccesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        // cek apakah user sudah login
        if(Auth::user()->role == $userType){
            return $next($request);
        }

        // jika user tidak memiliki akses kirim pesan error
        return response()->json([
            'error' => 'kamu tidak memiliki akses halaman ini.',
            'userType' => $userType
        ]);
    }
}
