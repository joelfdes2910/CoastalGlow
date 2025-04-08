<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- AdminLTE Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <style>

        :root {
            --primary-color: #40E0D0;
            --secondary-color: white;
        }

        /* General Styles */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--primary-color) !important;
            color: #333;
        }

        /* Navigation Bar */
        .navbar {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }


        .login-logo a img {
            transition: all 0.3s ease;            
            filter: brightness(0.5) !important;
        }

    </style>

</head>

<!-- REMOVE sidebar-mini CLASS from the body tag -->
<body class="hold-transition login-page">
<div class="login-box">



    <div class="login-logo">
        <a href="#">
            <img src="{{ asset('lotus.png') }}" alt="Coastal Glow Logo" width="150">
        </a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autofocus
                           placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input id="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password" required placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            @if (Route::has('password.request'))
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                </p>
            @endif

            <p class="mb-0">
                Don't have an account? <a href="{{ route('register') }}" class="text-center">Register</a>
            </p>

            <p class="mb-0">
                        <a href="{{ url('/') }}" class="text-center">Return to Coastal Glow</a>
                    </p>

        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

</body>
</html>
