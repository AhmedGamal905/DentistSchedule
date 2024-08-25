@extends('layouts.home')

@section('content')
<section class="contact-section">
    <div class="contact-elements">
        <h1>Contact</h1>
        <h3>We'd love to hear from you.</h3>
        <h2>Phone</h2>
        <p>Get us on the horn at <a href="tel:+14155270265">415-527-0265</a>, and leave a voicemail if it's urgent.</p>
        <h2>Email</h2>
        <p>Reach us at <a href="mailto:Info@dentalSchedule.com">Info@dentalSchedule.com</a>, where we’ll respond as soon as we can.</p>
        <h2>Online</h2>
        <p>Book an appointment online, simply by clicking <a href="{{ route('appointment.create') }}">here</a>.</p>
    </div>
</section>
@endsection