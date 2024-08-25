@extends('layouts.home')

@section('content')
<section class="landing-section">
    <div class="landing-content">
        <h1>A Dental Practice Designed with You in Mind. Finally.</h1>
        <h2>Dental Schedule provides state-of-the-art care with hands-on service and transparent pricing, all from an award-winning space in the heart of San Francisco.</h2>
        <a class="content-btn" href="{{ route('appointment.create') }}">Book an Appointment</a>
        <h3>Or call us at <a class="contact-tag" href="tel:+4155270263">415-527-0265</a></h3>
    </div>
    <img class="landing-img" src="{{ asset('images/clinic.jpg') }}" alt="clinic landing picture">
</section>
@endsection