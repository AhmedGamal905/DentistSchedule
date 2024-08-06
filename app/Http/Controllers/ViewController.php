<?php

namespace App\Http\Controllers;

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
