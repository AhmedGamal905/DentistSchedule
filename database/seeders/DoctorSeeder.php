<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::factory()->create([
            'name' => 'Ahmed Gamal',
            'email' => 'doctor@doctor.com',
            'password' => 'doctor@doctor.com',
        ]);
    }
}
