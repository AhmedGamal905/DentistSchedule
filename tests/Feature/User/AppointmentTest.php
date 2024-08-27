<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use App\Models\Rating;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }
    public function test_user_can_view_booked_appointments(): void
    {

        $pastAppointment = Appointment::factory()->create([
            'user_id' => $this->user->id,
            'date' => now()->subDay()->toDateString(),
        ]);

        $upcomingAppointment = Appointment::factory()->create([
            'user_id' => $this->user->id,
            'date' => now()->addDay()->toDateString(),
        ]);

        $rating = Rating::factory()->create([
            'appointment_id' => $pastAppointment->id,
        ]);

        $this->get(route('appointment.index'))
            ->assertStatus(200)
            ->assertViewIs('appointment')
            ->assertViewHas(['pastAppointments', 'upcomingAppointments'])
            ->assertViewHas('upcomingAppointments', function ($upcomingAppointments) use ($upcomingAppointment) {
                return $upcomingAppointments->contains($upcomingAppointment);
            })
            ->assertViewHas('pastAppointments', function ($pastAppointments) use ($pastAppointment, $rating) {
                $pastAppointmentWithRating = $pastAppointments->firstWhere('id', $pastAppointment->id);
                return $pastAppointmentWithRating && $pastAppointmentWithRating->rating === $rating->rating;
            });
    }
    public function test_no_appointments_message_is_displayed(): void
    {
        $this->get(route('appointment.index'))
            ->assertStatus(200)
            ->assertViewIs('appointment')
            ->assertSee(['No upcoming appointments found.', 'No past appointments found.']);
    }

    public function test_user_can_view_the_book_page(): void
    {
        $this->get(route('appointment.create'))
            ->assertStatus(200)
            ->assertViewIs('book');
    }

    public function test_user_can_cancel_upcoming_appointments(): void
    {
        $upcomingAppointment = Appointment::factory()->create([
            'user_id' => $this->user->id,
            'date' => now()->addWeek()->toDateString(),
        ]);

        $this->put(route('appointment.update', $upcomingAppointment))
            ->assertStatus(302)
            ->assertRedirectToRoute('appointment.index')
            ->assertSessionHas('success', 'Appointments cancelled successfully!');
    }

    public function test_user_can_not_cancel_past_appointments(): void
    {
        $pastAppointment = Appointment::factory()->create([
            'user_id' => $this->user->id,
            'date' => now()->subDay()->toDateString(),
        ]);

        $this->put(route('appointment.update', $pastAppointment))
            ->assertStatus(302)
            ->assertSessionHas('error', 'You cannot cancel an appointment scheduled for today or in the past.');
    }
}
