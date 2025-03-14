@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Service</h2>
        <a href="{{ route('services.index') }}" class="btn btn-secondary mb-3">Back</a>

        <form action="{{ route('services.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Service Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Duration (mins)</label>
                <input type="number" name="duration" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price (£)</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
