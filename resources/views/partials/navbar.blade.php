<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ml-auto">


        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="notification-count">
            {{ Auth::user()->unreadNotifications->count() }}
        </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">{{ Auth::user()->unreadNotifications->count() }} New Notifications</span>
                <div class="dropdown-divider"></div>
                @foreach(Auth::user()->unreadNotifications->take(5) as $notification)
                    <a href="{{ route('notifications.show', $notification->id) }}" class="dropdown-item">
                        <i class="fas fa-calendar-check mr-2"></i> New Booking from {{ $notification->data['customer_name'] }}
                        <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach
                <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>


        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-user"></i> {{ Auth::user()->name }}
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
