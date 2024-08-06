<?php

namespace App\Livewire;

use App\Models\Appointment;
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

        session()->flash('success', 'Appointment Booked successfully!');

        return redirect()->route('appointment.index');
    }
}
