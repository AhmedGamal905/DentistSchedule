<?php

namespace App\Livewire;

use App\Models\Rating;
use Livewire\Component;

class RatingForm extends Component
{
    public $appointment;

    public $rating;

    public function updated()
    {
        $this->validate([
            'rating' => ['required', 'numeric', 'between:1,5'],
        ]);
        Rating::updateOrCreate(
            [
                'appointment_id' => $this->appointment->id,
                'rating' => $this->rating,
            ]
        );
    }

    public function render()
    {
        return view('livewire.rating-form');
    }
}
