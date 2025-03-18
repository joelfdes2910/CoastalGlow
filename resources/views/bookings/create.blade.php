@extends('layouts.app')

@section('content')

    <style>
        .staff-card {
            width: 120px;
            background-color: #f8f9fa;
            transition: 0.3s;
        }
        .staff-card:hover, .staff-card.active {
            background-color: #007bff;
            color: #fff;
        }
        .service-box {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            width: 200px;
            cursor: pointer;
            text-align: center;
        }
        .service-box.active {
            background-color: #28a745;
            color: #fff;
        }
    </style>


    <div class="container">
        <h2 class="mb-3">Book Your Appointment</h2>

        {{--<a href="{{ route('bookings.index') }}" class="btn btn-secondary mb-3">Back</a>--}}

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
            <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">

            <!-- Step 1: Select Staff -->
            <div class="mb-4">
                <label class="form-label fs-5 fw-bold">Choose Your Stylist</label>
                <div class="d-flex flex-wrap gap-3" id="staff-container">
                    @foreach($staff as $staffMember)
                        <div class="staff-card p-3 border rounded text-center" style="cursor: pointer;" data-id="{{ $staffMember->id }}">
                            <i class="fas fa-user-circle fa-2x"></i>
                            <p class="mt-2 fw-bold">{{ $staffMember->name }}</p>
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="staff_id" id="selected-staff">
            </div>

            <!-- Step 2: Display Services -->
            <div class="mb-4 d-none" id="service-section">
                <label class="form-label fs-5 fw-bold">Available Services</label>
                <div class="d-flex flex-wrap gap-3" id="services-container"></div>
            </div>

            <!-- Step 3: Select Date -->
            <div class="mb-4 d-none" id="date-section">
                <label class="form-label fs-5 fw-bold">Select Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <!-- Step 4: Select Time -->
            <div class="mb-4 d-none" id="time-section">
                <label class="form-label fs-5 fw-bold">Select Time</label>
                <input type="time" name="time" class="form-control" required>
            </div>

            <div id="selected-services-container"></div>
            <input type="hidden" name="services[]" id="selected-services">

            <button type="submit" class="btn btn-primary mt-3 d-none" id="submit-button">Confirm Booking</button>
        </form>



{{--        <form action="{{ route('bookings.store') }}"  method="POST">--}}
{{--            @csrf--}}

{{--           --}}{{-- <div class="mb-3">--}}
{{--                <label class="form-label">Customer</label>--}}

{{--                @if(auth()->user()->role === 'admin')--}}
{{--                    <select name="customer_id" class="form-control" required>--}}
{{--                        @foreach($customers as $customer)--}}
{{--                            <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                @else--}}
{{--                    <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">--}}
{{--                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">--}}

{{--            <div class="mb-3">--}}
{{--                <label for="staff" class="form-label">Select Staff</label>--}}
{{--                <select name="staff_id" id="staff" class="form-control">--}}
{{--                    <option value="">-- Select Staff --</option>--}}
{{--                    @foreach($staff as $staffMember)--}}
{{--                        <option value="{{ $staffMember->id }}">{{ $staffMember->name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label class="form-label">Date</label>--}}
{{--                <input type="date" name="date" class="form-control" required>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label class="form-label">Time</label>--}}
{{--                <input type="time" name="time" class="form-control" required>--}}
{{--            </div>--}}

{{--            <div class="mb-3">--}}
{{--                <label for="services" class="form-label">Select Services</label>--}}
{{--                <select name="services[]" id="services" class="form-control" multiple>--}}
{{--                    <option value="">-- Select Service --</option>--}}
{{--                    <!-- Services will be populated dynamically -->--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <button type="submit" class="btn btn-primary">Save Booking</button>--}}
{{--        </form>--}}
    </div>
@endsection

@push('js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Staff selection
            $('.staff-card').click(function () {
                $('.staff-card').removeClass('active');
                $(this).addClass('active');
                let staffId = $(this).data('id');
                $('#selected-staff').val(staffId);

                // Fetch services
                let serviceContainer = $('#services-container');
                serviceContainer.html('<p>Loading services...</p>');

                $.ajax({
                    url: "{{ route('staff.services', ':id') }}".replace(':id', staffId),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        console.log("Received Services:", data); // Debugging
                        serviceContainer.html('');

                        if (data.length > 0) {
                            $.each(data, function (key, service) {
                                console.log(`Service: ${service.name}, Duration: ${service.duration}`); // Debug each service

                                serviceContainer.append(
                                    `<div class="service-box p-2 border" data-id="${service.id}">
                        <strong>${service.name}</strong>
                        <p>${service.duration} mins - $${service.price}</p>
                    </div>`
                                );
                            });
                            $('#service-section').removeClass('d-none');
                        } else {
                            serviceContainer.html('<p>No services available</p>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching services:", error);
                    }
                });


            });

            // Service selection
            $(document).on('click', '.service-box', function () {
                $(this).toggleClass('active');

                let selectedServices = [];
                $('.service-box.active').each(function () {
                    selectedServices.push($(this).data('id'));
                });

                // Clear and append multiple hidden inputs dynamically
                $('#selected-services-container').html('');
                selectedServices.forEach(serviceId => {
                    $('#selected-services-container').append(
                        `<input type="hidden" name="services[]" value="${serviceId}">`
                    );
                });

                if (selectedServices.length > 0) {
                    $('#date-section, #time-section, #submit-button').removeClass('d-none');
                } else {
                    $('#date-section, #time-section, #submit-button').addClass('d-none');
                }
            });

        });
    </script>



{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#staff').change(function () {--}}
{{--                let staffId = $(this).val();--}}
{{--                let serviceDropdown = $('#services');--}}

{{--                // Debugging step: log selected staff ID--}}
{{--                console.log("Selected Staff ID:", staffId);--}}

{{--                serviceDropdown.html('<option value="">Loading...</option>');--}}

{{--                if (staffId) {--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ route('staff.services', ':id') }}".replace(':id', staffId),--}}
{{--                        type: 'GET',--}}
{{--                        dataType: 'json',--}}
{{--                        success: function (data) {--}}
{{--                            console.log("Services received:", data); // Debugging log--}}

{{--                            serviceDropdown.html('');--}}

{{--                            if (data.length > 0) {--}}
{{--                                $.each(data, function (key, service) {--}}
{{--                                    serviceDropdown.append(--}}
{{--                                        `<option value="${service.id}">${service.name} - $${service.price}</option>`--}}
{{--                                    );--}}
{{--                                });--}}
{{--                            } else {--}}
{{--                                serviceDropdown.html('<option value="">No services available</option>');--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function (xhr, status, error) {--}}
{{--                            console.error("Error fetching services:", error);--}}
{{--                            serviceDropdown.html('<option value="">Error loading services</option>');--}}
{{--                        }--}}
{{--                    });--}}
{{--                } else {--}}
{{--                    serviceDropdown.html('<option value="">-- Select Service --</option>');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endpush

