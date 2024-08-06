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

        $appointments = Appointment::where('user_id', $userId)
            ->latest()
            ->get();

        $upcomingAppointments = $appointments->where('date', '>=', now()->toDateString());

        $pastAppointments = $appointments->where('date', '<=', now()->toDateString());

        return view('appointment', compact('pastAppointments', 'upcomingAppointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book');
    }
}
