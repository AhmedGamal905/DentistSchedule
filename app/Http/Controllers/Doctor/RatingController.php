<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = auth('doctor')->user()
            ->ratings()
            ->with('user')
            ->paginate();

        return view('dashboard.ratings.index', compact('ratings'));
    }
}
