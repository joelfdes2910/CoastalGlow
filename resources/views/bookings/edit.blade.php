@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Edit Booking</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Customer Selection -->
            <div class="mb-3">
                <label class="form-label">Customer</label>
                <select name="customer_id" class="form-control" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $booking->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Staff Selection -->
            <div class="mb-3">
                <label for="staff" class="form-label">Select Staff</label>
                <select name="staff_id" id="staff" class="form-control">
                    <option value="">-- Select Staff --</option>
                    @foreach($staff as $staffMember)
                        <option value="{{ $staffMember->id }}" {{ $booking->staff_id == $staffMember->id ? 'selected' : '' }}>
                            {{ $staffMember->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date Selection -->
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" value="{{ $booking->date }}" required>
            </div>

            <!-- Time Selection -->
            <div class="mb-3">
                <label class="form-label">Time</label>
                <input type="time" name="time" class="form-control" value="{{ $booking->time }}" required>
            </div>

            <!-- Service Selection -->
            <div class="mb-3">
                <label for="services" class="form-label">Select Services</label>
                <select name="services[]" id="services" class="form-control" multiple>
                    @foreach($booking->staff->services as $service)
                        <option value="{{ $service->id }}"
                            {{ in_array($service->id, $selectedServiceIds) ? 'selected' : '' }}>
                            {{ $service->name }} - ${{ $service->price }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Booking</button>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function loadServices(staffId, selectedServices = []) {
                let serviceDropdown = $('#services');
                serviceDropdown.html('<option value="">Loading...</option>');

                if (staffId) {
                    $.ajax({
                        url: "{{ route('staff.services', ':id') }}".replace(':id', staffId),
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            serviceDropdown.html('');

                            if (data.length > 0) {
                                $.each(data, function (key, service) {
                                    let isSelected = selectedServices.includes(service.id.toString()) ? 'selected' : '';
                                    serviceDropdown.append(
                                        `<option value="${service.id}" ${isSelected}>${service.name} - $${service.price}</option>`
                                    );
                                });
                            } else {
                                serviceDropdown.html('<option value="">No services available</option>');
                            }
                        },
                        error: function () {
                            serviceDropdown.html('<option value="">Error loading services</option>');
                        }
                    });
                } else {
                    serviceDropdown.html('<option value="">-- Select Service --</option>');
                }
            }

            // Load services when staff is changed
            $('#staff').change(function () {
                let staffId = $(this).val();
                loadServices(staffId);
            });

            // Load services when the page loads (for editing existing data)
            let initialStaffId = $('#staff').val();
            let selectedServices = @json($selectedServiceIds);
            if (initialStaffId) {
                loadServices(initialStaffId, selectedServices);
            }
        });
    </script>
@endpush
