<?php

namespace App\Http\Controllers\Doctor;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return view('dashboard.users.index', compact('users'));
    }
}
