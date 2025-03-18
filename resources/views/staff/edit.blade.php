@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Edit Staff Member</h2>
        <a href="{{ route('staff.index') }}" class="btn btn-secondary mb-3">Back</a>

        <form action="{{ route('staff.update', $staff->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ $staff->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $staff->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $staff->phone }}" required>
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


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
