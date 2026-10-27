<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session 'user' ada
        if (!session()->has('user')) {
            return redirect()->route('login')->withErrors(['msg' => 'Silakan login terlebih dahulu!']);
        }

        return $next($request);
    }
}