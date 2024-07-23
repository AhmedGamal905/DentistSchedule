<?php

namespace App\Http\Controllers\Doctor;

use DateTime;
use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::query()
            ->latest()
            ->paginate();

        return view('dashboard.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.schedule');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'shiftDate' => ['required', 'date', 'after_or_equal:today'],
            'startTime' => ['required', 'date_format:H:i'],
            'endTime' => ['required', 'date_format:H:i', 'after:startTime'],
        ]);

        $doctorId = Auth::guard('doctor')->id();
        $appointmentDate = Carbon::parse($data['shiftDate'])->format('Y-m-d');
        $startTime = Carbon::parse($data['startTime']);
        $endTime = Carbon::parse($data['endTime'])->subMinutes(30);
        $currentTime = Carbon::now();

        if ($endTime->diffInMinutes($startTime) % 30 !== 0) {
            return back()->withErrors(['endTime' => 'Each appointment must have a duration of exactly 30 minutes']);
        }

        if ($appointmentDate === $currentTime->format('Y-m-d') && $startTime->lessThan($currentTime)) {
            return back()->withErrors(['startTime' => 'The start time cannot be in the past if the date is today.']);
        }

        for ($appointmentTime = $startTime; $appointmentTime->lessThanOrEqualTo($endTime); $appointmentTime->addMinutes(30)) {

            $appointmentData = [
                'appointment_date' => $appointmentDate,
                'appointment_time' => $appointmentTime->format('H:i'),
                'doctor_id' => $doctorId,
            ];

            if (Appointment::where($appointmentData)->exists()) {
                continue;
            }

            Appointment::create($appointmentData);
        }

        session()->flash('success', 'Appointments created successfully!');

        return to_route('dashboard.appointment.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        session()->flash('success', 'Appointment deleted successfully!');

        return to_route('dashboard.appointment.index');
    }
}
