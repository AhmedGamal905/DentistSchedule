<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $appointments = Appointment::query()
            ->where('user_id', $userId)
            ->with(['doctor', 'rating'])
            ->latest()
            ->get();

        $upcomingAppointments = $appointments->where('date', '>=', now()->toDateString());

        $pastAppointments = $appointments->where('date', '<', now()->toDateString());

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
