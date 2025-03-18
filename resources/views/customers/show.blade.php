@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Customer Details</h2>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary mb-3">Back</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $customer->name }} {{ $customer->last_name }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $customer->email }}</p>
                <p class="card-text"><strong>Phone:</strong> {{ $customer->phone }}</p>
                <p class="card-text"><strong>Gender:</strong> {{ ucfirst($customer->gender) }}</p>
            </div>
        </div>
    </div>
@endsection
