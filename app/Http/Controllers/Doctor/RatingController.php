<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Doctor::find(auth('doctor')->id())
            ->ratings()
            ->paginate();

        return view('dashboard.ratings.index', compact('ratings'));
    }
}
