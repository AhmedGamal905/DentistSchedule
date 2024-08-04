@extends('layouts.home')

@section('content')
<section class="appointment-section">
    <p>My Upcoming Appointment:</p>
    @forelse ($appointments as $appointment)
    <div class="box">
        <h2>Appointment Date: {{$appointment->appointment_date}}</h2>
        <h2>Appointment Time: {{$appointment->appointment_time}}</h2>
        <h2>Doctor: {{$appointment->doctor->name}}</h2>
        <p>Covering the foundations of your dental health.</p>
    </div>
    @empty
    <tr>
        <div class="box">
            <h2>No appointments found.</h2>
        </div>
    </tr>
    @endforelse
    <p>Past Appointment:</p>
    <div class="box">
        <h2>Exams & Cleanings</h2>
        <p>Covering the foundations of your dental health.</p>
    </div>
</section>
@endsection