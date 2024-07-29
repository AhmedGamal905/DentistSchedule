@extends('layouts.home')

@section('content')
<section class="landing-section">
    <div class="landing-content">
        <h1>A Dental Practice Designed with You in Mind. Finally.</h1>
        <h2>Dental Schedule provides state-of-the-art care with hands-on service and transparent pricing, all from an award-winning space in the heart of San Francisco.</h2>
        <button class="content-btn">Book an Appointment</button>
        <h3>Or call us at <a href="+4155270265">415-527-0263</a></h3>
    </div>
    <img class="landing-img" src="{{ asset('images/clinic.jpg') }}" alt="clinic landing picture">
</section>
@endsection