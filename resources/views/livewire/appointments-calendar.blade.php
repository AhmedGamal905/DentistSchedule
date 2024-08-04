<div>
    <input class="date-picker-input" type="date" wire:model="selectedDate" wire:change="fetchAppointments($event.target.value)">
    @forelse ($appointments as $appointment)
    <form method="POST" action="{{ route('appointment.update', $appointment) }}">
        @method('PUT')
        @csrf
        <div class="app-box">
            <h2>Appointment Date: {{$appointment->appointment_date}}</h2>
            <h2>Appointment Time: {{$appointment->appointment_time}}</h2>
            <h2>Doctor: {{$appointment->doctor->name}}</h2>
            <button class="book-btn">Book Now</button>
        </div>
    </form>
    @empty
    <tr>
        <div class="app-box">
            <h2>No appointments found.</h2>
        </div>
    </tr>
    @endforelse
</div>