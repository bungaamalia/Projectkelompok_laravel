<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
<<<<<<< HEAD
=======

>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
        return view('auth.login');
    }

    public function login(Request $request)
    {
<<<<<<< HEAD
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $mahasiswaGroup = [
            '24100001' => 'Bunga Amalia K.',
            '24100003' => 'Enrio Putra Y.',
            '24100004' => 'Frandica Galih K.',
            '24100005' => 'Frida Putri Eka A. I.',
            '24100006' => 'Ilham Januar Putra',
        ];

        // 1. Cek Login Mahasiswa (Berdasarkan NIM Anggota Kelompok)
        if (array_key_exists($request->username, $mahasiswaGroup) && $request->password === 'password') {
            session(['user' => [
                'id_user'  => $request->username,
                'username' => $request->username,
                'nama'     => $mahasiswaGroup[$request->username],
                'role'     => 'Mahasiswa',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08123456789'
            ]]);

            return redirect()->route('jadwal.index');
        } 
        
        // 2. Cek Login Dosen
        elseif ($request->username === 'dosen' && $request->password === 'password') {
            session(['user' => [
                'id_user'  => 2,
                'username' => '19880101',
                'nama'     => 'Isa Mulia Insan, S.Kom., M.Kom.',
                'role'     => 'Dosen',
                'prodi'    => 'Teknik Informatika',
                'no_hp'    => '08987654321'
            ]]);

            return redirect()->route('sesi.index');
        } 
        
        // 3. Cek Login Admin
        elseif ($request->username === 'admin' && $request->password === 'password') {
            session(['user' => [
                'id_user'  => 3,
                'username' => 'admin',
                'nama'     => 'Admin Akademik UCS',
                'role'     => 'Admin',
                'prodi'    => 'Sistem Informasi',
                'no_hp'    => '08111111111'
            ]]);

            return redirect()->route('mahasiswa.index');
        }

        return back()->withErrors(['msg' => 'Username atau Password salah!']);
    }

    public function logout()
    {
        session()->forget('user');

        return redirect()->route('login');
    }
}
=======
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $users = [
            'admin' => [
                'id_user' => 1,
                'username' => 'admin',
                'nama' => 'Admin Akademik UCS',
                'role' => 'Admin',
                'prodi' => 'Teknik Informatika',
                'no_hp' => '08111111111',
            ],

            'dosen' => [
                'id_user' => 2,
                'username' => '0412089001',
                'nama' => 'Andi Saputra, M.Kom.',
                'role' => 'Dosen',
                'prodi' => 'Teknik Informatika',
                'no_hp' => '08987654321',
            ],

            '0412089001' => [
                'id_user' => 2,
                'username' => '0412089001',
                'nama' => 'Andi Saputra, M.Kom.',
                'role' => 'Dosen',
                'prodi' => 'Teknik Informatika',
                'no_hp' => '08987654321',
            ],

            '24100001' => [
                'id_user' => 3,
                'username' => '24100001',
                'nama' => 'Bunga Amalia Kharismawati',
                'role' => 'Mahasiswa',
                'prodi' => 'Teknik Informatika',
                'no_hp' => '08123456789',
            ],

            '24100002' => [
                'id_user' => 4,
                'username' => '24100002',
                'nama' => 'Aditya Pratama',
                'role' => 'Mahasiswa',
                'prodi' => 'Teknik Informatika',
                'no_hp' => '08123456780',
            ],

            '24100003' => [
                'id_user' => 5,
                'username' => '24100003',
                'nama' => 'Nadia Putri Lestari',
                'role' => 'Mahasiswa',
                'prodi' => 'Teknik Informatika',
                'no_hp' => '08123456781',
            ],

            '25100001' => [
                'id_user' => 6,
                'username' => '25100001',
                'nama' => 'Rizky Ramadhan',
                'role' => 'Mahasiswa',
                'prodi' => 'Teknik Informatika',
                'no_hp' => '08123456782',
            ],

            '25100002' => [
                'id_user' => 7,
                'username' => '25100002',
                'nama' => 'Siti Aulia Rahma',
                'role' => 'Mahasiswa',
                'prodi' => 'Teknik Informatika',
                'no_hp' => '08123456783',
            ],
        ];

        if (
            !isset($users[$data['username']]) ||
            $data['password'] !== 'password'
        ) {
            return back()
                ->withErrors([
                    'login' => 'Username atau password salah.',
                ])
                ->withInput($request->only('username'));
        }

        // Membuat sesi baru setelah login berhasil
        $request->session()->regenerate();

        $request->session()->put('user', $users[$data['username']]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        // Hapus sesi login dan buat token CSRF baru
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil keluar dari sistem.');
    }
}
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
