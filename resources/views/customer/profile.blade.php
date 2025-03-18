@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>My Profile</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('customer.profile.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $customer->last_name) }}" required>
                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <div>
                    <input type="radio" name="gender" value="male" {{ old('gender', $customer->gender) == 'male' ? 'checked' : '' }}> Male
                    <input type="radio" name="gender" value="female" {{ old('gender', $customer->gender) == 'female' ? 'checked' : '' }}> Female
                    <input type="radio" name="gender" value="unisex" {{ old('gender', $customer->gender) == 'unisex' ? 'checked' : '' }}> Unisex
                </div>
                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
