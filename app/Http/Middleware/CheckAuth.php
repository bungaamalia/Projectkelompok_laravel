<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
<<<<<<< HEAD

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session 'user' ada
        if (!session()->has('user')) {
            return redirect()->route('login')->withErrors(['msg' => 'Silakan login terlebih dahulu!']);
=======
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (!$request->session()->has('user')) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'login' => 'Silakan login terlebih dahulu.',
                ]);
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
        }

        return $next($request);
    }
}