@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Edit Service</h2>
        <a href="{{ route('services.index') }}" class="btn btn-secondary mb-3">Back</a>

        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Service Name</label>
                <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Duration (mins)</label>
                <input type="number" name="duration" class="form-control" value="{{ $service->duration }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price (£)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ $service->price }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
