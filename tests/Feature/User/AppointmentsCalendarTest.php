<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;
use App\Livewire\AppointmentsCalendar;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentsCalendarTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }
    public function test_it_renders_successfully(): void
    {
        Livewire::test(AppointmentsCalendar::class)
            ->assertStatus(200)
            ->assertViewIs('livewire.appointments-calendar')
            ->assertViewHas('appointments');
    }
    public function test_user_can_see_appointments_for_selected_date(): void
    {
        $appointment = Appointment::factory()->create(['date' => now()->addWeek()->format('yyyy-mm-dd')]);

        Livewire::test(AppointmentsCalendar::class)
            ->set('selectedDate', now()->addWeek()->format('yyyy-mm-dd'))
            ->assertSee($appointment->id);
    }

    public function test_user_can_book_an_appointment()
    {
        $appointment = Appointment::factory()->create(['user_id' => null]);

        Livewire::test(appointmentsCalendar::class)
            ->call('bookAppointment', $appointment)
            ->assertRedirect(route('appointment.index'))
            ->assertSessionHas('success', 'Appointment Booked successfully!');

        $this->assertNotNull($appointment->user_id);
    }
}
