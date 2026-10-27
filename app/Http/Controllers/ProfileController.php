<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'user' => session('user'),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:25',
        ]);

        $user = session('user');
        $user['nama'] = $data['nama'];
        $user['no_hp'] = $data['no_hp'] ?? '';

        session(['user' => $user]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        return back()->with(
            'success',
            'Simulasi perubahan password berhasil. Akun demo akan kembali ke password awal saat login berikutnya.'
        );
    }
}