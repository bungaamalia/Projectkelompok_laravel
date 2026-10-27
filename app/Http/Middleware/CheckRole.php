<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        // Pastikan pengguna sudah login.
        $user = session('user');

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Baca role pengguna dari session.
        $role = strtolower(
            is_array($user)
                ? ($user['role'] ?? '')
                : ($user->role ?? '')
        );

        // Tolak akses jika role tidak sesuai.
        if (!in_array($role, $roles, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
