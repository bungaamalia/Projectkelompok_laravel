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