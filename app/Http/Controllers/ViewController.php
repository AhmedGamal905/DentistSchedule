<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function showServices()
    {
        return view('pages.services');
    }
    public function showPricing()
    {
        return view('pages.pricing');
    }
    public function showLocation()
    {
        return view('pages.location');
    }
    public function showContact()
    {
        return view('pages.contact');
    }
}
