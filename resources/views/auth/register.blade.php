<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>

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
    </style>


</head>

<body class="hold-transition register-page">
<div class="register-box">


    <div class="login-logo">
        <a href="#">
            <img src="{{ asset('lotus.png') }}" alt="SPA Logo" width="150">
        </a>
    </div>


    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new customer account</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <input type="hidden" name="role" value="customer"> <!-- Default role -->

                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" required placeholder="First Name">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                    @error('name')
                    <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           required placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" required
                           placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Gender:</label>
                    <div class="d-flex align-items-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">Male</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">Female</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="unisex" value="unisex" {{ old('gender') == 'unisex' ? 'checked' : '' }}>
                            <label class="form-check-label" for="unisex">Unisex</label>
                        </div>

                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-venus-mars"></span></div>
                        </div>
                    </div>

                    @error('gender')
                    <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>


                <div class="row">
                    <div class="col-8">
                        <a href="{{ route('login') }}" class="text-center">Already have an account? Login</a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

</body>
</html>
