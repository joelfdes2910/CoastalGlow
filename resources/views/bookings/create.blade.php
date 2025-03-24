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
                <input type="date" name="date" id="date-input" class="form-control" required>
            </div>

            <!-- Step 4: Select Time -->
            <div class="mb-4 d-none" id="time-section">
                <label class="form-label fs-5 fw-bold">Select Time</label>
                <input type="time" name="time" id="time-input" class="form-control" required>
            </div>


            <!-- Payment Method Selection -->
            <div class="mb-4 d-none" id="payment-section">
                <label class="form-label fs-5 fw-bold">Payment Method</label>
                <select name="payment_method" class="form-control" required>
                    <option value="cash">Cash</option>
                    <option value="card">Card</option>
                    <option value="online">Online</option>
                </select>
            </div>

            <!-- Transaction ID Field (Only for Card/Online Payments) -->
            <div class="mb-4 d-none" id="transaction-id-field">
                <label class="form-label fs-5 fw-bold">Transaction ID</label>
                <input type="text" name="transaction_id" class="form-control">
            </div>


            <div id="selected-services-container"></div>
            <input type="hidden" name="services[]" id="selected-services">

            <button type="submit" class="btn btn-primary mt-3 d-none" id="submit-button">Confirm Booking</button>
        </form>

    </div>
@endsection

@push('js')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Auto-select current date and time
            function setCurrentDateTime() {
                let now = new Date();

                // Format date as YYYY-MM-DD
                let formattedDate = now.toISOString().split('T')[0];
                $('#date-input').val(formattedDate);

                // Format time as HH:MM (24-hour format)
                let hours = now.getHours().toString().padStart(2, '0');
                let minutes = now.getMinutes().toString().padStart(2, '0');
                let formattedTime = `${hours}:${minutes}`;
                $('#time-input').val(formattedTime);
            }

            // Set current date and time on page load
            setCurrentDateTime();

            // When a service is selected, show date/time fields with auto-selected values
            $(document).on('click', '.service-box', function () {
                $('#date-section, #time-section').removeClass('d-none');
                setCurrentDateTime(); // Ensure date/time is updated when service is selected
            });
        });
    </script>

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
                        <p>${service.duration} mins - £${service.price}</p>
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
            // Handle service selection
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

                // Show date, time, and payment sections if services are selected
                if (selectedServices.length > 0) {
                    $('#date-section, #time-section, #payment-section, #submit-button').removeClass('d-none');
                } else {
                    $('#date-section, #time-section, #payment-section, #transaction-id-field, #submit-button').addClass('d-none');
                }
            });

            // Handle Payment Method Selection
            $('select[name="payment_method"]').change(function () {
                let selectedMethod = $(this).val();
                if (selectedMethod === 'card' || selectedMethod === 'online') {
                    $('#transaction-id-field').removeClass('d-none');
                } else {
                    $('#transaction-id-field').addClass('d-none');
                    $('input[name="transaction_id"]').val(''); // Clear transaction ID input
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

