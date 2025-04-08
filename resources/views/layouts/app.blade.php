<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Coastal Glow') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('front_style.css') }}" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('bookings.create') }}">
                    <img src="{{ asset('lotus.png') }}" alt="Coastal Glow Logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <ul class="navbar-nav">


                                @if(auth()->user()->role === 'admin')


                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>


                                    <li class="nav-item"><a class="nav-link" href="{{ route('services.index') }}">Services</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('staff.index') }}">Staff</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('customers.index') }}">Customers</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('bookings.index') }}">Bookings</a></li>
                                @endif

                                @if(auth()->user()->role === 'customer')

                                        <li class="nav-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}" >
                                            <a class="nav-link" href="{{ route('customer.dashboard') }}">Home</a>
                                        </li>

                                        <!-- Bookings Dropdown -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="bookingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Bookings
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="bookingsDropdown">
                                                <li><a class="dropdown-item" href="{{ route('customer.bookings') }}">My Bookings</a></li>
                                                <li><a class="dropdown-item" href="{{ route('bookings.create') }}">Book An Appointment</a></li>
                                            </ul>
                                        </li>



                                        <li class="nav-item"><a class="nav-link" href="{{ route('customer.profile') }}">Profile</a></li>

                                @endif
                            </ul>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>

        <main class="py-4" style="min-height: calc(100vh - 180px);">
            @yield('content')
        </main>
    </div>

    @stack('js')
</body>
</html>
