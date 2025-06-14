<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0fdf4;
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background-color: #e0f2f1;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2e7d32;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #a5d6a7;
            border-radius: 6px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #388e3c;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #2e7d32;
        }

        .text-center {
            text-align: center;
            margin-top: 15px;
        }

        a {
            color: #2e7d32;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Admin Login</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label><input type="checkbox" name="remember"> Remember Me</label>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
