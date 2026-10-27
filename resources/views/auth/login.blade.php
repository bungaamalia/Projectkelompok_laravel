<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UCS Campus Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }
        .card-login { 
            background: var(--bg-white); 
            border-radius: 12px; 
            width: 380px; 
            border: none;
        }
        .btn-purple { 
            background-color: var(--primary-purple); 
            color: white; 
        }
        .btn-purple:hover { 
            background-color: var(--hover-purple); 
            color: white; 
        }
    </style>
</head>
<body>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card card-login p-4 shadow-sm">
        <h4 class="text-center mb-1 fw-bold">Selamat Datang!</h4>
        <p class="text-center text-muted small mb-4">UCS Campus Attendance</p>

        @if($errors->any())
            <div class="alert alert-danger p-2 small mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small font-weight-bold">NIM / NIDN / Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Contoh: 24100001">
            </div>
            <div class="mb-3">
                <label class="form-label small font-weight-bold">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn btn-purple w-100 py-2 mt-2">Login</button>
        </form>
    </div>
</div>
</body>
</html>