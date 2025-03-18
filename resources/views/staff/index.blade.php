@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-4">Staff Management</h2>
        <a href="{{ route('staff.create') }}" class="btn btn-primary mb-3">Add Staff</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Services</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($staff as $member)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>
                        @foreach($member->services as $service)
                            <span class="badge bg-primary">{{ $service->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('staff.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('staff.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $staff->links('vendor.pagination.bootstrap-4') }}



    </div>
@endsection
