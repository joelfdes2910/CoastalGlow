@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Customer</h2>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary mb-3">Back</a>

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ $customer->first_name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ $customer->last_name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $customer->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-control">
                    <option value="male" {{ $customer->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $customer->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $customer->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
