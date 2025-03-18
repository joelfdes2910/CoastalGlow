<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <img src="{{ asset('lotus.png') }}" alt="SPA Logo" height="50">
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('services.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Services</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('staff.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Staff</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bookings.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>Bookings</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
