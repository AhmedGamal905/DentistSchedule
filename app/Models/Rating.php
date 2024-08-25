<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'rating',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
