<div>
    <input class="date-picker-input" type="date" wire:model.live.debounce.500ms="selectedDate">
    @forelse ($appointments as $appointment)
    <div class="app-box">
        <h2>Appointment Date: {{ $appointment->date }}</h2>
        <h2>Appointment Time: {{ $appointment->time }}</h2>
        <h2>Doctor: {{ $appointment->doctor->name }}</h2>
        <button class="book-btn" wire:click="bookAppointment({{ $appointment }})">Book Now</button>
    </div>
    @empty
    <div class="app-box">
        <h2>No appointments found.</h2>
    </div>
    @endforelse
</div>