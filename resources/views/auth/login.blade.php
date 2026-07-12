<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | Masjid AL-Azhar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Rubik:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Rubik', sans-serif;
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(58, 123, 213, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
        }

        .login-header {
            background: linear-gradient(to right, #3a7bd5, #00d2ff);
            padding: 35px 30px 25px;
            text-align: center;
            color: #fff;
        }

        .login-header .mosque-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .login-header h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin: 0;
        }

        .login-header p {
            font-size: 13px;
            opacity: 0.85;
            margin: 5px 0 0;
        }

        .login-body {
            padding: 30px;
        }

        .form-label {
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #2d5895;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
            border: 1.5px solid #dee2e6;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #3a7bd5;
            box-shadow: 0 0 0 3px rgba(58, 123, 213, 0.15);
        }

        .btn-login {
            background: linear-gradient(to right, #3a7bd5, #00d2ff);
            border: none;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            font-size: 15px;
            letter-spacing: 0.5px;
            transition: opacity 0.2s, transform 0.2s;
            width: 100%;
        }

        .btn-login:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            color: #fff;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: #7c7c7c;
        }

        .back-link a {
            color: #3a7bd5;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="mosque-icon">🕌</div>
            <h4>Masjid AL-Azhar</h4>
            <p>Panel Administrasi — Login Admin</p>
        </div>
        <div class="login-body">
            @if($errors->any())
            <div class="alert alert-danger" style="border-radius:10px; font-size:14px;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           placeholder="admin@alazhar.com" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="font-size:13px; color:#7c7c7c;">Ingat saya</label>
                </div>
                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Masuk
                </button>
            </form>

            <div class="back-link">
                <a href="{{ route('home') }}"><i class="bi bi-arrow-left me-1"></i> Kembali ke Website</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
