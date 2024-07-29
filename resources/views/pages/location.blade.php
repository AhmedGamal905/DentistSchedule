@extends('layouts.home')

@section('content')
<section class="location-section">
    <h1>Location</h1>
    <p>We practice in a beautiful, award-winning clinic in San Francisco's Mid-Market District. We hope you love it as much as we do.</p>
    <div class="grid-container">
        <div class="grid-box">
            <img class="responsive-img" src="{{ asset('images/clinic0.jpg') }}" alt="clinic picture">
        </div>
        <div class="grid-box">
            <img class="responsive-img" src="{{ asset('images/clinic1.jpg') }}" alt="clinic picture">
        </div>
        <div class="grid-box">
            <img class="responsive-img" src="{{ asset('images/clinic2.jpg') }}" alt="clinic picture">
        </div>
        <div class="grid-box">
            <img class="responsive-img" src="{{ asset('images/clinic3.jpg') }}" alt="clinic picture">
        </div>
    </div>
    <h2>Address</h2>
    <h3>33 Taylor St, San Francisco, CA 94102</h3>
    <h2>Hours</h2>
    <h3><span class="day">Monday:</span> 8:00 AM – 4:30 PM</h3>
    <h3><span class="day">Tuesday:</span> 8:00 AM – 4:30 PM</h3>
    <h3><span class="day">Wednesday:</span> 8:00 AM – 4:30 PM</h3>
    <h3><span class="day">Thursday:</span> 8:00 AM – 4:30 PM</h3>
    <h3><span class="day">Friday:</span> 8:00 AM – 3:00 PM</h3>
    <h3><span class="day">Saturday:</span> Closed</h3>
    <h3><span class="day">Sunday:</span> Closed</h3>
    <h2>Phone</h2>
    <h3>Or call us at <a href="tel:+4155270263">415-527-0265</a></h3>
</section>
@endsection