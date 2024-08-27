<?php

namespace App\Livewire;

use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class AppointmentsCalendar extends Component
{
    public $selectedDate = null;

    public function render()
    {
        if ($this->selectedDate) {
            $appointments = Appointment::where('date', $this->selectedDate)
                ->whereNull('user_id')
                ->get();
        } else {
            $appointments = [];
        }

        return view('livewire.appointments-calendar', compact('appointments'));
    }

    public function bookAppointment(Appointment $appointment)
    {
        if ($appointment->user_id) {
            return session()->flash('error', 'Appointment isn\'t available');
        }

        $appointment->update(['user_id' => auth()->user()->id]);

        Mail::to(auth()->user())->send(
            new AppointmentConfirmation($appointment)
        );

        session()->flash('success', 'Appointment Booked successfully!');

        return redirect()->route('appointment.index');
    }
}
