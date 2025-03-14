@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Services</h2>
        <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Add Service</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Duration (mins)</th>
                <th>Price (£)</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->duration }}</td>
                    <td>£{{ number_format($service->price, 2) }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $services->links('vendor.pagination.bootstrap-4') }}

    </div>
@endsection
