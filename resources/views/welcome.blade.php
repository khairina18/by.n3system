<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - By.N3 Admin System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #a8e063, #56ab2f);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            color: #2f4f2f;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 90%;
        }

        .card h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #2e7d32;
        }

        .card p {
            margin: 10px 0;
            font-size: 1rem;
        }

        .btn-login {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background-color: #2e7d32;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #1b5e20;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Welcome to By.N3 Home Tuition Admin System</h1>
        <p>This is the admin management system for By.N3 Home Tuition</p>
        <a href="{{ route('login') }}" class="btn-login">Login</a>
        <div class="footer">
            <p>&copy; 2025 By.N3 Home Tuition. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
