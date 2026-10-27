<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        // Mengambil data user yang sedang login dari Session
        $user = session('user', [
            'username' => '24100001',
            'nama'     => 'Bunga Amalia K.',
            'role'     => 'Mahasiswa',
            'prodi'    => 'Teknik Informatika',
            'no_hp'    => '08123456789'
        ]);

        return view('profile.index', compact('user'));
=======
        return view('profile.index', [
            'user' => session('user'),
        ]);
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
    }

    public function update(Request $request)
    {
<<<<<<< HEAD
        $request->validate([
            'nama'  => 'required',
            'no_hp' => 'required'
        ]);

        $user = session('user');
        $user['nama'] = $request->nama;
        $user['no_hp'] = $request->no_hp;
        
        session(['user' => $user]);

        return back()->with('success', 'Profil berhasil diperbarui!');
=======
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:25',
        ]);

        $user = session('user');
        $user['nama'] = $data['nama'];
        $user['no_hp'] = $data['no_hp'] ?? '';

        session(['user' => $user]);

        return back()->with('success', 'Profil berhasil diperbarui.');
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
    }

    public function changePassword(Request $request)
    {
        $request->validate([
<<<<<<< HEAD
            'password_lama' => 'required',
            'password_baru' => 'required|min:6'
        ]);

        if ($request->password_lama !== 'password') {
            return back()->withErrors(['msg' => 'Password lama kamu salah!']);
        }

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    public function storeUser(Request $request)
    {
        if (session('user.role') !== 'Admin') {
            return back()->withErrors(['msg' => 'Akses ditolak! Hanya Admin yang dapat menambah pengguna.']);
        }

        $request->validate([
            'username' => 'required',
            'nama'     => 'required',
            'role'     => 'required',
            'prodi'    => 'required'
        ]);

        $dbMhs = session('db_mahasiswa', []);
        $dbMhs[$request->username] = [
            'nim'      => $request->username,
            'nama'     => $request->nama,
            'prodi'    => $request->prodi,
            'angkatan' => '2024'
        ];

        session(['db_mahasiswa' => $dbMhs]);

        return back()->with('success', 'Akun ' . $request->role . ' baru berhasil dibuat!');
=======
            'password' => 'required|string|min:8|confirmed',
        ]);

        return back()->with(
            'success',
            'Simulasi perubahan password berhasil. Akun demo akan kembali ke password awal saat login berikutnya.'
        );
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
    }
}