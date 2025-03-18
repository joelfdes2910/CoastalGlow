@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Notifications</h2>
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item {{ $notification->read_at ? '' : 'bg-light' }}">
                    <a href="{{ route('notifications.show', $notification->id) }}">
                        <strong>{{ $notification->data['customer_name'] }}</strong> booked an appointment on {{ $notification->data['date'] }} at {{ $notification->data['time'] }}
                        <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="mt-3">
            {{ $notifications->links() }}
        </div>
    </div>
@endsection
