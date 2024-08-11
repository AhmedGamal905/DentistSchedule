<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserBookingSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create();

        $appointment = Appointment::whereNull('user_id')->inRandomOrder()->first();

        $appointment->update([
            'user_id' => $user->id,
        ]);
    }
}
