<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Master Data User (Anggota Kelompok, Dosen, dan Admin)
        $users = [
            'admin' => [
                'id_user'  => 1,
                'username' => 'admin',
                'nama'     => 'Admin Akademik UCS',
                'role'     => 'Admin',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08111111111',
            ],
            'dosen' => [
                'id_user'  => 2,
                'username' => '19880101',
                'nama'     => 'Isa Mulia Insan, S.Kom., M.Kom.',
                'role'     => 'Dosen',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08987654321',
            ],
            '0412089001' => [
                'id_user'  => 2,
                'username' => '0412089001',
                'nama'     => 'Andi Saputra, M.Kom.',
                'role'     => 'Dosen',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08987654321',
            ],
            // Data Mahasiswa Anggota Kelompok
            '24100001' => [
                'id_user'  => 3,
                'username' => '24100001',
                'nama'     => 'Bunga Amalia K.',
                'role'     => 'Mahasiswa',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08123456789',
            ],
            '24100002' => [
                'id_user'  => 4,
                'username' => '24100002',
                'nama'     => 'Aditya Pratama',
                'role'     => 'Mahasiswa',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08123456780',
            ],
            '24100003' => [
                'id_user'  => 5,
                'username' => '24100003',
                'nama'     => 'Enrio Putra Y.',
                'role'     => 'Mahasiswa',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08123456781',
            ],
            '24100004' => [
                'id_user'  => 6,
                'username' => '24100004',
                'nama'     => 'Frandica Galih K.',
                'role'     => 'Mahasiswa',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08123456782',
            ],
            '24100005' => [
                'id_user'  => 7,
                'username' => '24100005',
                'nama'     => 'Frida Putri Eka A. I.',
                'role'     => 'Mahasiswa',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08123456783',
            ],
            '24100006' => [
                'id_user'  => 8,
                'username' => '24100006',
                'nama'     => 'Ilham Januar Putra',
                'role'     => 'Mahasiswa',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08123456784',
            ],
        ];

        // Verifikasi Username dan Password
        if (!isset($users[$data['username']]) || $data['password'] !== 'password') {
            return back()
                ->withErrors(['login' => 'Username atau password salah.'])
                ->withInput($request->only('username'));
        }

        // Regenerasi Sesi & Simpan Data User
        $request->session()->regenerate();
        $user = $users[$data['username']];
        $request->session()->put('user', $user);

        // Redirect Berdasarkan Role User
        if ($user['role'] === 'Mahasiswa') {
            return redirect()->route('jadwal.index');
        } elseif ($user['role'] === 'Dosen') {
            return redirect()->route('sesi.index');
        } elseif ($user['role'] === 'Admin') {
            return redirect()->route('mahasiswa.index');
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil keluar dari sistem.');
    }
}