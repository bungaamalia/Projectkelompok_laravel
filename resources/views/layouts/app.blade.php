<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }

        .topbar-user {
            display: flex;
            align-items: center;
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
                </button>
            </form>
        </div>
    </aside>

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
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>