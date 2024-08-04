<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;

class AppointmentsCalendar extends Component
{
    public $selectedDate;
    public $appointments = [];

    public function render()
    {
        return view('livewire.appointments-calendar');
    }

    public function fetchAppointments($date)
    {
        if (Carbon::parse($date)->isPast()) {
            $this->selectedDate = null;
        }
        $this->appointments = Appointment::where('appointment_date', $date)
            ->whereNull('user_id')
            ->get();
    }
}
