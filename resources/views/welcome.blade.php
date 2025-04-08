<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coastal Glow</title>

    <!-- Bootstrap 3 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: white;
            color: #333;
        }

        .navbar {
            margin-bottom: 0;
            border-radius: 0;
            border: none;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            padding: 10px 15px;
            height: auto;
        }

        .navbar-brand img {
            /* height: 60px; */
            transition: all 0.3s ease;
            max-width: 90px !important;
            filter: brightness(0.5) !important;
        }

        .hero-section {
    background: url(/homepage.jpeg) no-repeat center center;    
    padding: 100px 0;
    text-align: center;
    position: relative;
    height: 800px;
    color: white;
    background-size: cover;
}

    /* Add an overlay to make text more readable if needed */
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3); /* Adjust opacity as needed */
        z-index: 0;
    }

    .hero-section .container {
        position: relative;
        z-index: 1;
    }

    /* Update text colors for better visibility */
    .hero-title {
        font-size: 42px;
        font-weight: 700;
        margin-bottom: 20px;
        color: white;
    }

    .hero-subtitle {
        font-size: 20px;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 40px;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }


        .btn-primary {
            background-color: #40E0D0;
            border-color: #40E0D0;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            color: white;
        }

        .btn-primary:hover {
            background-color: #36C9BA;
            border-color: #36C9BA;
            color: white;
        }

        .about-section {
            padding: 60px 0;
            background-color: #f5f5f5;
            text-align: center;
        }

        .about-content {
            max-width: 800px;
            margin: 0 auto;
            font-size: 16px;
            line-height: 1.8;
            color: #555;
        }

     

        /* Active nav item styling */
        .navbar-default .navbar-nav > .active > a,
        .navbar-default .navbar-nav > .active > a:hover,
        .navbar-default .navbar-nav > .active > a:focus {
            background-color: transparent;
            color: #40E0D0;
        }

        /* Nav link hover effect */
        .navbar-default .navbar-nav > li > a:hover {
            color: #40E0D0;
        }

        /* Added some spacing for better mobile display */
        @media (max-width: 767px) {
            .navbar-brand img {
                height: 40px;
            }
            .hero-section {
                padding: 60px 0;
            }
            .hero-title {
                font-size: 32px;
            }
            .hero-subtitle {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('bookings.create') }}">
                <img src="{{ asset('lotus.png') }}" alt="SPA Logo">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('bookings.create') }}">Home</a></li>
                <li class="{{ request()->is('services') ? 'active' : '' }}"><a href="{{ route('services.index') }}">Services</a></li>
                @if (Route::has('login'))
                    @auth
                        @php
                            $user = Auth::user();
                        @endphp
                        <li>
                            @if($user->isAdmin())
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            @else
                                <a href="{{ route('bookings.create') }}">Dashboard</a>
                            @endif
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Service Booking and<br>Appointment Management System</h1>
        <p class="hero-subtitle">Streamline your spa and salon appointments with our easy-to-use web application.</p>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-lg">Book Now</a>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <h2>About</h2>
        <div class="about-content">
            <p>Our web application provides a convenient platform for managing spa and salon appointments. Customers can easily book services online, while business owners can manage schedules and appointments efficiently.</p>
        </div>
    </div>
</section>

<!-- Bootstrap 3 JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
