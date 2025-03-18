@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Add Staff Member</h2>
        <a href="{{ route('staff.index') }}" class="btn btn-secondary mb-3">Back</a>

        <form action="{{ route('staff.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="services" class="form-label">Select Services</label>
                <select name="services[]" id="services" class="form-control" multiple>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}"
                            {{ isset($staff) && $staff->services->contains($service->id) ? 'selected' : '' }}>
                            {{ $service->name }} - ${{ $service->price }}
                        </option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
