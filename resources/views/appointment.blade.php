@extends('layouts.home')

@section('content')
<section class="appointment-section">
    <p>My Upcoming Appointment:</p>
    @forelse ($upcomingAppointments as $appointment)
    <div class="box">
        <h2>Appointment Date: {{$appointment->date}}</h2>
        <h2>Appointment Time: {{$appointment->time}}</h2>
        <h2>Doctor: {{$appointment->doctor->name}}</h2>
    </div>
    @empty
    <div class="box">
        <h2>No upcoming appointments found.</h2>
    </div>
    @endforelse
    <p>Past Appointment:</p>
    @forelse ($pastAppointments as $appointment)
    <div class="box">
        <h2>Appointment Date: {{$appointment->date}}</h2>
        <h2>Appointment Time: {{$appointment->time}}</h2>
        <h2>Doctor: {{$appointment->doctor->name}}</h2>
    </div>
    @empty
    <div class="box">
        <h2>No past appointments found.</h2>
    </div>
    @endforelse
</section>
@endsection