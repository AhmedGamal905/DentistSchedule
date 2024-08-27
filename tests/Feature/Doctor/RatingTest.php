<?php

namespace Tests\Feature\Doctor;

use Tests\TestCase;
use App\Models\Doctor;
use App\Models\Rating;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RatingTest extends TestCase
{
    use RefreshDatabase;
    private $doctor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->doctor = Doctor::factory()->create();

        $this->actingAs($this->doctor, 'doctor');
    }
    public function test_no_ratings_found_message_is_displayed()
    {
        $this->get(route('dashboard.rating.index'))
            ->assertStatus(200)
            ->assertSee('No ratings found.');
    }

    public function test_doctor_can_view_ratings()
    {
        $ratings = Rating::factory()->count(2)->create();

        $this->get(route('dashboard.rating.index'))
            ->assertStatus(200)
            ->assertViewHas('ratings');

        foreach ($ratings as $rating) {
            $this->assertDatabaseHas('ratings', [
                'id' => $rating->id,
                'rating' => $rating->rating,
            ]);
        }

        $this->assertDatabaseCount('ratings', 2);
    }
}
