<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMONTI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #0a0e27;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; position: relative;
        }

        /* Animated background */
        .bg-shapes {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            z-index: 0; overflow: hidden;
        }
        .bg-shapes .shape {
            position: absolute; border-radius: 50%;
            filter: blur(80px); opacity: 0.15;
            animation: float 20s ease-in-out infinite;
        }
        .shape-1 { width: 500px; height: 500px; background: #6366f1; top: -10%; left: -10%; animation-delay: 0s; }
        .shape-2 { width: 400px; height: 400px; background: #a855f7; bottom: -15%; right: -10%; animation-delay: -7s; }
        .shape-3 { width: 300px; height: 300px; background: #ec4899; top: 50%; left: 60%; animation-delay: -14s; }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -30px) scale(1.05); }
            66% { transform: translate(-20px, 20px) scale(0.95); }
        }

        .login-container {
            position: relative; z-index: 1;
            width: 100%; max-width: 440px;
            padding: 20px;
        }

        .login-card {
            background: rgba(19, 23, 56, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(99, 115, 255, 0.15);
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            animation: cardAppear 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes cardAppear {
            from { opacity: 0; transform: translateY(30px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .login-header { text-align: center; margin-bottom: 36px; }

        .login-logo {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            border-radius: 18px; margin: 0 auto 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; font-weight: 800; color: white;
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.35);
            animation: logoPulse 3s ease-in-out infinite;
        }

        @keyframes logoPulse {
            0%, 100% { box-shadow: 0 8px 30px rgba(99, 102, 241, 0.35); }
            50% { box-shadow: 0 8px 40px rgba(99, 102, 241, 0.5); }
        }

        .login-header h1 {
            font-size: 26px; font-weight: 800;
            color: #e8eaff; letter-spacing: -0.8px;
        }

        .login-header p {
            font-size: 13px; color: #8b92c5;
            margin-top: 6px;
        }

        .form-group { margin-bottom: 22px; position: relative; }

        .form-label {
            display: block; font-size: 13px; font-weight: 600;
            color: #8b92c5; margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative; display: flex; align-items: center;
        }

        .input-wrapper i {
            position: absolute; left: 14px;
            color: #5c6399; font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-input {
            width: 100%; padding: 13px 14px 13px 42px;
            background: rgba(10, 14, 39, 0.7);
            border: 1px solid rgba(99, 115, 255, 0.15);
            border-radius: 12px;
            color: #e8eaff; font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .form-input:focus + i, .form-input:focus ~ i { color: #6366f1; }
        .form-input::placeholder { color: #5c6399; }

        .password-toggle {
            position: absolute; right: 14px;
            cursor: pointer; color: #5c6399;
            transition: all 0.3s ease; background: none;
            border: none; font-size: 14px;
        }
        .password-toggle:hover { color: #818cf8; }

        .remember-row {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 28px;
        }

        .remember-label {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: #8b92c5; cursor: pointer;
        }

        .remember-label input[type="checkbox"] {
            accent-color: #6366f1;
            width: 16px; height: 16px;
        }

        .btn-login {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: white; border: none; border-radius: 12px;
            font-size: 15px; font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer; transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.35);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(99, 102, 241, 0.45);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            padding: 12px 16px; border-radius: 10px;
            font-size: 13px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 8px;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .login-footer {
            text-align: center; margin-top: 24px;
            font-size: 12px; color: #5c6399;
        }
    </style>
</head>
<body>
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">SM</div>
                <h1>SIMONTI</h1>
                <p>Sistem Monitoring Internship</p>
            </div>

            @if($errors->any())
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" class="form-input"
                               placeholder="Masukkan email anda"
                               value="{{ old('email') }}" required autofocus>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password"
                               class="form-input" placeholder="Masukkan password" required>
                        <i class="fas fa-lock"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="remember-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>

            <div class="login-footer">
                &copy; {{ date('Y') }} PT Industri Telekomunikasi Indonesia
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
