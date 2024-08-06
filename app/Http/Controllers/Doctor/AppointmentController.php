<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

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
        $request->validate([
            'shift_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
        ]);

        $doctorId = auth('doctor')->id();

        $existingAppointments = Appointment::query()
            ->where('doctor_id', $doctorId)
            ->where('date', $request->shift_date)
            ->get(['time', 'date'])
            ->groupBy('date')
            ->toArray();

        $periods = CarbonInterval::minutes(30)
            ->toPeriod($request->shift_date.$request->start_time, $request->shift_date.$request->end_time)
            ->toArray();

        $data = collect($periods)
            ->reject(function ($period) use ($existingAppointments) {
                $times = $existingAppointments[$period->format('Y-m-d')] ?? null;

                if (! is_null($times)) {
                    return in_array($period->format('H:i:s'), $times);
                }

                return false;
            })
            ->map(fn ($period) => [
                'date' => $period->format('Y-m-d'),
                'time' => $period->format('H:i'),
                'doctor_id' => $doctorId,
                'created_at' => now(),
                'updated_at' => now(),
            ])
            ->toArray();

        Appointment::insert($data);

        session()->flash('success', 'Appointments created successfully!');

        return to_route('dashboard.appointment.index');
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
