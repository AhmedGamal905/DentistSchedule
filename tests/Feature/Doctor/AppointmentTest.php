<?php

namespace Tests\Feature\Doctor;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    private $doctor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->doctor = Doctor::factory()->create();

        $this->actingAs($this->doctor, 'doctor');
    }

    public function test_no_appointments_found_message_is_displayed(): void
    {
        $this->get(route('dashboard.appointment.index'))
            ->assertStatus(200)
            ->assertViewIs('dashboard.appointments.index')
            ->assertSee('No appointments found.');
    }

    public function test_doctor_can_view_appointments_index(): void
    {
        Appointment::factory()->count(3)->create(['doctor_id' => $this->doctor->id]);

        $this->get(route('dashboard.appointment.index'))
            ->assertStatus(200)
            ->assertViewIs('dashboard.appointments.index')
            ->assertViewHas('appointments');
    }

    public function test_doctor_can_view_the_create_view(): void
    {
        $this->get(route('dashboard.appointment.create'))
            ->assertStatus(200)
            ->assertViewIs('dashboard.schedule');
    }

    public function test_doctor_can_create_appointments(): void
    {
        $shiftDate = now()->addDay()->format('Y-m-d');
        $startTime = '09:00';
        $endTime = '09:30';

        $this->post(route('dashboard.appointment.store'), [
            'shift_date' => $shiftDate,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ])->assertRedirect(route('dashboard.appointment.index'))
            ->assertSessionHas('success', 'Appointments created successfully!');

        $this->assertDatabaseHas('appointments', [
            'doctor_id' => $this->doctor->id,
            'date' => $shiftDate,
            'time' => '09:00',
        ]);

        $this->assertDatabaseHas('appointments', [
            'doctor_id' => $this->doctor->id,
            'date' => $shiftDate,
            'time' => '09:30',
        ]);

        $this->assertDatabaseCount('appointments', 2);
    }

    public function test_doctor_cannot_create_appointments_with_past_date(): void
    {
        $this->post(route('dashboard.appointment.store'), [
            'shift_date' => now()->yesterday()->format('Y-m-d'),
            'start_time' => '09:00',
            'end_time' => '09:30',
        ])->assertSessionHasErrors(['shift_date']);
    }

    public function test_doctor_can_destroy_appointment(): void
    {
        $appointment = Appointment::factory()->create(['doctor_id' => $this->doctor->id]);

        $this->delete(route('dashboard.appointment.destroy', $appointment))
            ->assertRedirect(route('dashboard.appointment.index'))
            ->assertSessionHas('success', 'Appointment deleted successfully!');

        $this->assertDatabaseMissing('appointments', [
            'id' => $appointment->id,
        ]);
    }
}
