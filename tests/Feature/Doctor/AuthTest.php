<?php

namespace Tests\Feature\Doctor;

use Tests\TestCase;
use App\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_login_form(): void
    {
        $this->get(route('dashboard.login.index'))
            ->assertStatus(200)
            ->assertViewIs('doctor.login');
    }

    public function test_doctor_can_login(): void
    {
        $doctor = Doctor::factory()->create([
            'password' => bcrypt($password = 'password123'),
        ]);

        $this->post(route('dashboard.login.post'), [
            'email' => $doctor->email,
            'password' => $password,
        ])
            ->assertRedirect(route('dashboard.welcome'));

        $this->assertAuthenticatedAs($doctor, 'doctor');
    }

    public function test_doctor_cannot_login_with_invalid_credentials(): void
    {
        $doctor = Doctor::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $this->post(route('dashboard.login.post'), [
            'email' => $doctor->email,
            'password' => 'wrongPassword',
        ])
            ->assertSessionHasErrors(['email']);

        $this->assertGuest('doctor');
    }

    public function test_doctor_can_logout(): void
    {
        $doctor = Doctor::factory()->create();

        $this->actingAs($doctor, 'doctor');

        $this->post(route('dashboard.logout'))
            ->assertStatus(200)
            ->assertViewIs('doctor.login');

        $this->assertGuest('doctor');
    }
}
