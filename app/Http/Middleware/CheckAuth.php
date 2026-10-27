<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah session 'user' ada
        if (!$request->session()->has('user')) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Silakan login terlebih dahulu.',
                ]);
        }

        return $next($request);
    }
}