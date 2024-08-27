<?php

namespace App\Jobs;

use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class CheckAppointmentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $appointments = Appointment::query()
            ->whereBetween('date', [now()->format('Y-m-d'), now()->addDay()->format('Y-m-d')])
            ->whereNotNull('user_id')
            ->get();

        foreach ($appointments as $appointment) {
            //checking if a confirmation email was sent with in 24hrs
            $cacheKey = 'appointment_eml_sent_' . $appointment->id;

            if (! Cache::has($cacheKey)) {

                Mail::to($appointment->user->email)->send(
                    new AppointmentConfirmation($appointment)
                );

                Cache::put($cacheKey, true, now()->addDay());
            }
        }
    }
}
