@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Booking</h2>
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary mb-3">Back</a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Customer</label>
                <select name="customer_id" class="form-control" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="staff" class="form-label">Select Staff</label>
                <select name="staff_id" id="staff" class="form-control">
                    <option value="">-- Select Staff --</option>
                    @foreach($staff as $staffMember)
                        <option value="{{ $staffMember->id }}">{{ $staffMember->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Time</label>
                <input type="time" name="time" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="services" class="form-label">Select Services</label>
                <select name="services[]" id="services" class="form-control" multiple>
                    <option value="">-- Select Service --</option>
                    <!-- Services will be populated dynamically -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Booking</button>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#staff').change(function () {
                let staffId = $(this).val();
                let serviceDropdown = $('#services');

                // Debugging step: log selected staff ID
                console.log("Selected Staff ID:", staffId);

                serviceDropdown.html('<option value="">Loading...</option>');

                if (staffId) {
                    $.ajax({
                        url: "{{ route('staff.services', ':id') }}".replace(':id', staffId),
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            console.log("Services received:", data); // Debugging log

                            serviceDropdown.html('');

                            if (data.length > 0) {
                                $.each(data, function (key, service) {
                                    serviceDropdown.append(
                                        `<option value="${service.id}">${service.name} - $${service.price}</option>`
                                    );
                                });
                            } else {
                                serviceDropdown.html('<option value="">No services available</option>');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Error fetching services:", error);
                            serviceDropdown.html('<option value="">Error loading services</option>');
                        }
                    });
                } else {
                    serviceDropdown.html('<option value="">-- Select Service --</option>');
                }
            });
        });
    </script>
@endpush

