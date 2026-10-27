
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UCS Akademik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #f7f7fb;
            font-family: Arial, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .08);
        }

        .logo {
            width: 65px;
            height: 65px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            background: #6f42c1;
            color: white;
            font-size: 30px;
            font-weight: bold;
        }

        h3 {
            color: #343a40;
            font-weight: 700;
        }

        .form-control {
            padding: 12px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 8px;
            background: #6f42c1;
            color: white;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #59339d;
            color: white;
        }

        .hint {
            padding: 12px;
            border-radius: 8px;
            background: #f7f4ff;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <div class="logo">U</div>
            <h3>UCS Akademik</h3>
            <p class="text-secondary mb-0">Silakan masuk ke akun Anda</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username / NIM / NIDN</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <button type="submit" class="btn btn-login">
                Masuk
            </button>
        </form>

        <div class="hint mt-4">
            <strong>Akun demo</strong><br>
            Admin: admin / password<br>
            Dosen: 0412089001 / password<br>
            Mahasiswa: 24100001 / password
        </div>
    </div>
</body>
</html>
