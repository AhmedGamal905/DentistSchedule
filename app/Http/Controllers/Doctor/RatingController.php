<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
