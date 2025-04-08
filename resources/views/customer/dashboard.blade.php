@extends('layouts.app')

@section('content')



<style>
.hero-section {
    background: url('{{ asset('customerpage.jpeg') }}') no-repeat center center;
    background-size: cover;
    position: relative;
    padding: 100px 0;
    text-align: center;
    color: #333;
    opacity: 0.7;
}

/* Optional overlay for readability */
.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.7);
    z-index: 0;
}

.hero-content {
    position: relative;
    z-index: 1;
}
</style>
<section class="hero-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="hero-content">
          <h1 class="hero-title">Salon & Spa Booking and Business <br>Management Web Application </h1>
          <p class="hero-subtitle">Streamline your beauty appointments with our easy-to-use platform</p>
          <a href="{{ route('bookings.create') }}" class="btn btn-primary">Book Now</a>
        </div>
      </div>
    </div>
  </div>
</section>   
@endsection
