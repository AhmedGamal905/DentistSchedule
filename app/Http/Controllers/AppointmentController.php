<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Rating;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $appointments = Appointment::where('user_id', $userId)
            ->with('doctor')
            ->latest()
            ->get();

        $upcomingAppointments = $appointments->where('date', '>=', now()->toDateString());

        $AllPastAppointments = $appointments->where('date', '<', now()->toDateString());

        $pastAppointmentsWithRating = Rating::whereIn('appointment_id', $AllPastAppointments->pluck('id'))->get();

        $pastAppointments = $AllPastAppointments->map(function ($appointment) use ($pastAppointmentsWithRating) {
            $rating = $pastAppointmentsWithRating->firstWhere('appointment_id', $appointment->id);

            return (object) [
                'id' => $appointment->id,
                'doctor' => $appointment->doctor,
                'date' => $appointment->date,
                'time' => $appointment->time,
                'rating' => $rating ? $rating->rating : null,
            ];
        });

        return view('appointment', compact('pastAppointments', 'upcomingAppointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book');
    }

    public function update(Appointment $appointment)
    {
        if ($appointment->date <= now()->toDateString()) {

            session()->flash('error', 'You cannot cancel an appointment scheduled for today or in the past.');

            return back();
        }

        $appointment->update(['user_id' => null]);

        session()->flash('success', 'Appointments cancelled successfully!');

        return to_route('appointment.index');
    }
}
