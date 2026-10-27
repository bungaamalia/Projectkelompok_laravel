<<<<<<< HEAD
=======

>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>UCS Akademik</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-purple: #6F42C1;
            --hover-purple: #59339D;
            --bg-light-gray: #F7F7FB;
            --bg-white: #FFFFFF;
            --text-dark: #343A40;
        }

        body {
            background-color: var(--bg-light-gray);
            color: var(--text-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 240px;
            min-height: 100vh;
            background-color: var(--primary-purple);
            color: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-brand {
            padding: 20px 24px;
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ffffff;
            text-decoration: none;
        }

        .sidebar-menu {
            list-style: none;
            padding: 10px 0;
            margin: 0;
        }

        .sidebar-menu li a, 
        .sidebar-logout-btn {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 24px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active,
        .sidebar-logout-btn:hover {
            color: #ffffff;
            background-color: var(--hover-purple);
        }

        .sidebar-footer {
            padding: 15px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Main Content Wrapper */
        .main-wrapper {
            margin-left: 240px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar Styling */
        .topbar {
            height: 60px;
            background-color: var(--bg-white);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .topbar-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #333333;
=======

    <title>@yield('title', 'UCS Akademik')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --purple: #6F42C1;
            --purple-hover: #59339D;
            --page-bg: #F7F7FB;
            --text-dark: #343A40;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--page-bg);
            color: var(--text-dark);
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            background: var(--purple);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 24px 20px;
            color: white;
            font-size: 20px;
            font-weight: 700;
            text-decoration: none;
        }

        .sidebar-user {
            padding: 0 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,.2);
        }

        .sidebar-menu {
            list-style: none;
            padding: 12px 0;
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 20px;
            color: rgba(255,255,255,.9);
            text-decoration: none;
            font-size: 14px;
            transition: background .2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: white;
            background: var(--purple-hover);
        }

        .sidebar-menu i {
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 12px 0;
            border-top: 1px solid rgba(255,255,255,.2);
        }

        .sidebar-logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 13px 20px;
            border: 0;
            background: transparent;
            color: white;
            text-align: left;
        }

        .sidebar-logout-btn:hover {
            background: var(--purple-hover);
        }

        .main-wrapper {
            min-height: 100vh;
            margin-left: 250px;
        }

        .topbar {
            min-height: 65px;
            padding: 15px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,.05);
        }

        .topbar-title {
            font-size: 17px;
            font-weight: 600;
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
        }

        .topbar-user {
            display: flex;
            align-items: center;
<<<<<<< HEAD
            gap: 12px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #333333;
        }

        /* Content Body */
        .content-body {
            padding: 30px;
            flex: 1;
        }

        .btn-purple {
            background-color: var(--primary-purple);
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 500;
        }

        .btn-purple:hover {
            background-color: var(--hover-purple);
            color: #ffffff;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div>
            <a href="{{ Route::has('mahasiswa.index') ? route('mahasiswa.index') : '#' }}" class="sidebar-brand">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>UCS Akademik</span>
            </a>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ Route::has('mahasiswa.index') ? route('mahasiswa.index') : '#' }}" 
                       class="{{ request()->is('mahasiswa*') ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i>
                        <span>Mahasiswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route::has('dosen.index') ? route('dosen.index') : '#' }}" 
                       class="{{ request()->is('dosen*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span>Dosen</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route::has('matakuliah.index') ? route('matakuliah.index') : '#' }}" 
                       class="{{ request()->is('matakuliah*') ? 'active' : '' }}">
                        <i class="fa-solid fa-book"></i>
                        <span>Mata Kuliah</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route::has('jadwal.index') ? route('jadwal.index') : '#' }}" 
                       class="{{ request()->is('jadwal*') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Jadwal</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route::has('sesi.index') ? route('sesi.index') : '#' }}" 
                       class="{{ request()->is('sesi-presensi*') ? 'active' : '' }}">
                        <i class="fa-solid fa-qrcode"></i>
                        <span>Sesi Presensi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ Route::has('profile.index') ? route('profile.index') : '#' }}" 
                       class="{{ request()->is('profile*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i>
                        <span>Profil Saya</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tombol Logout di Bawah Sidebar -->
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-logout-btn text-danger-light">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar / Logout</span>
=======
            gap: 10px;
            font-size: 14px;
        }

        .content-body {
            padding: 28px;
        }

        .btn-purple {
            background: var(--purple);
            border: 1px solid var(--purple);
            color: white;
        }

        .btn-purple:hover {
            background: var(--purple-hover);
            border-color: var(--purple-hover);
            color: white;
        }

        .card {
            border: 0;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.05);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 205px;
            }

            .main-wrapper {
                margin-left: 205px;
            }

            .content-body {
                padding: 15px;
            }

            .topbar {
                padding: 15px;
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    
    @php
        $role = session('user.role', 'Mahasiswa');

        if ($role === 'Admin') {
            $menus = [
                [
                    'route' => 'mahasiswa.index',
                    'path' => 'mahasiswa*',
                    'icon' => 'fa-users',
                    'label' => 'Data Mahasiswa'
                ],
                [
                    'route' => 'dosen.index',
                    'path' => 'dosen*',
                    'icon' => 'fa-user-tie',
                    'label' => 'Data Dosen'
                ],
                [
                    'route' => 'mata-kuliah.index',
                    'path' => 'mata-kuliah*',
                    'icon' => 'fa-book',
                    'label' => 'Data Mata Kuliah'
                ],
                [
                    'route' => 'jadwal.index',
                    'path' => 'jadwal*',
                    'icon' => 'fa-calendar-days',
                    'label' => 'Jadwal Kuliah'
                ],
                [
                    'route' => 'presensi08.index',
                    'path' => 'riwayat-presensi*',
                    'icon' => 'fa-clock-rotate-left',
                    'label' => 'Rekap Presensi'
                ],
                [
                    'route' => 'profile.index',
                    'path' => 'profile*',
                    'icon' => 'fa-user',
                    'label' => 'Profil Saya'
                ],
            ];

        } elseif ($role === 'Dosen') {
            $menus = [
                [
                    'route' => 'jadwal.index',
                    'path' => 'jadwal*',
                    'icon' => 'fa-calendar-days',
                    'label' => 'Jadwal Mengajar'
                ],
                [
                    'route' => 'sesi.index',
                    'path' => 'sesi-presensi*',
                    'icon' => 'fa-qrcode',
                    'label' => 'Kelola Sesi Presensi'
                ],
                [
                    'route' => 'presensi.index',
                    'path' => 'presensi*',
                    'icon' => 'fa-clipboard-check',
                    'label' => 'Pencatatan Presensi'
                ],
                [
                    'route' => 'presensi08.index',
                    'path' => 'riwayat-presensi*',
                    'icon' => 'fa-clock-rotate-left',
                    'label' => 'Riwayat Presensi'
                ],
                [
                    'route' => 'profile.index',
                    'path' => 'profile*',
                    'icon' => 'fa-user',
                    'label' => 'Profil Saya'
                ],
            ];

        } else {
            $menus = [
                [
                    'route' => 'jadwal.index',
                    'path' => 'jadwal*',
                    'icon' => 'fa-calendar-days',
                    'label' => 'Jadwal Kuliah'
                ],
                [
                    'route' => 'presensi.index',
                    'path' => 'presensi*',
                    'icon' => 'fa-clipboard-check',
                    'label' => 'Presensi Kuliah'
                ],
                [
                    'route' => 'presensi08.index',
                    'path' => 'riwayat-presensi*',
                    'icon' => 'fa-clock-rotate-left',
                    'label' => 'Riwayat Presensi Saya'
                ],
                [
                    'route' => 'profile.index',
                    'path' => 'profile*',
                    'icon' => 'fa-user',
                    'label' => 'Profil Saya'
                ],
            ];
        }
    @endphp


    <aside class="sidebar">
        <div>
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>UCS Akademik</span>
            </a>

            <div class="sidebar-user">
                <div class="small text-white-50">Login sebagai</div>
                <div class="fw-semibold">
                    {{ session('user.nama', 'Pengguna') }}
                </div>
                <div class="small text-white-50">{{ $role }}</div>
            </div>

            <ul class="sidebar-menu">
                @foreach ($menus as $menu)
                    @if (\Illuminate\Support\Facades\Route::has($menu['route']))
                        <li>
                            <a href="{{ route($menu['route']) }}"
                               class="{{ request()->is($menu['path']) ? 'active' : '' }}">
                                <i class="fa-solid {{ $menu['icon'] }}"></i>
                                <span>{{ $menu['label'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="sidebar-logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar</span>
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
                </button>
            </form>
        </div>
    </aside>

<<<<<<< HEAD
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-title">@yield('page-title', 'Data Mahasiswa')</div>
            <div class="topbar-user">
                <i class="fa-regular fa-user-circle fa-lg"></i>
                <span>{{ session('user.nama', 'Administrator') }}</span>
                
                <!-- Tombol Logout Cepat di Topbar -->
                <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2" title="Logout">
                        <i class="fa-solid fa-power-off"></i>
                    </button>
                </form>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-body">
=======
    <div class="main-wrapper">
        <header class="topbar">
            <div class="topbar-title">
                @yield('topbar-title', 'Dashboard Akademik')
            </div>

            <div class="topbar-user">
                <i class="fa-regular fa-circle-user fa-lg"></i>
                <span>{{ session('user.nama', 'Pengguna') }}</span>
                <span class="badge text-bg-light">{{ $role }}</span>
            </div>
        </header>

        <main class="content-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
            @yield('content')
        </main>
    </div>

<<<<<<< HEAD
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
=======
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
>>>>>>> adf6543c822861eed8508458e30f7487ead6e5d9
