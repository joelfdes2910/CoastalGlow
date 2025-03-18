@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Customer Management</h2>
{{--        <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Add Customer</a>--}}

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
                <th>Gender</th>
{{--                <th>Actions</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ ucfirst($customer->gender) }}</td>
{{--                    <td>--}}
{{--                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>--}}
{{--                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>--}}
{{--                        </form>--}}
{{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>

    {{ $customers->links('vendor.pagination.bootstrap-4') }} <!-- Pagination -->
    </div>
@endsection
