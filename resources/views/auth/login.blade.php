<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Court Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            border: 1px solid #ff6b00;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            color: #fff;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ff6b00;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            font-size: 1rem;
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff8533;
            box-shadow: 0 0 0 2px rgba(255, 107, 0, 0.2);
        }

        .login-button {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #ff6b00 0%, #ff8533 100%);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
        }

        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
        }

        .login-footer a {
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .back-home {
            position: fixed;
            top: 2rem;
            left: 2rem;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: rgba(255, 107, 0, 0.2);
            border-radius: 50px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            border: 1px solid #ff6b00;
        }

        .back-home:hover {
            background: rgba(255, 107, 0, 0.3);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <a href="{{ url('/') }}" class="back-home">
        <i class="fas fa-arrow-left"></i>
        <span>Back to Home</span>
    </a>

    <div class="login-container">
        <div class="login-header">
            <h1>Welcome Back</h1>
            <p style="color: #fff; opacity: 0.8;">Login to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                @error('email')
                    <span style="color: #ff5f6d; font-size: 0.9rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your password">
                @error('password')
                    <span style="color: #ff5f6d; font-size: 0.9rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="display: flex; align-items: center;">
                <input type="checkbox" name="remember" id="remember" style="width: auto; margin-right: 0.5rem;">
                <label for="remember" style="margin: 0;">Remember me</label>
            </div>

            <button type="submit" class="login-button">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <div class="login-footer">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot your password?</a>
            @endif
            <p style="color: #fff; margin-top: 1rem;">
                Don't have an account? 
                <a href="{{ route('register') }}">Register here</a>
            </p>
        </div>
    </div>
</body>
</html>
