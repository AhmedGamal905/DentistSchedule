<?php

namespace Tests\Feature\Doctor;

use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserTest extends TestCase
{
    use RefreshDatabase;
    private $doctor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->doctor = Doctor::factory()->create();

        $this->actingAs($this->doctor, 'doctor');
    }

    public function test_doctor_can_view_users_index(): void
    {
        $user =  User::factory()->create();

        $this->get(route('dashboard.user.index'))
            ->assertStatus(200)
            ->assertViewIs('dashboard.users.index')
            ->assertViewHas('users')
            ->assertSee($user->id);
    }
    public function test_no_users_found_message_is_displayed(): void
    {
        $this->get(route('dashboard.user.index'))
            ->assertStatus(200)
            ->assertViewIs('dashboard.users.index')
            ->assertSee('No users found.');
    }
}
