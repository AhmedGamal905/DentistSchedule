<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Appointment;
use App\Livewire\RatingForm;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RatingFormTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $appointment;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);

        $this->appointment = Appointment::factory()->create([
            'user_id' => $this->user->id,
            'date' => now()->subDay()->toDateString(),
        ]);
    }
    public function test_it_renders_successfully(): void
    {
        Livewire::test(RatingForm::class, ['appointment' => $this->appointment])
            ->assertStatus(200)
            ->assertViewIs('livewire.rating-form');
    }

    public function test_user_able_to_rate(): void
    {
        Livewire::test(RatingForm::class, ['appointment' => $this->appointment])
            ->set('rating', 4)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('ratings', [
            'appointment_id' => $this->appointment->id,
            'rating' => 4,
        ]);
    }
}
