<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
    <link rel="stylesheet" href="{{ asset('css/location.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/appointment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/book.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <header class="home-header">
        <a href="{{ route('home') }}" class="home-link">Dentist Schedule</a>
        <nav class="header-links">
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('pricing') }}">Insurance & Prices</a>
            <a href="{{ route('location') }}">Location</a>
            <a href="{{ route('contact') }}">Contact</a>
            <a href="{{ route('appointment.create') }}">Book Now</a>
            @if (Route::has('login'))
            @auth
            <a href="{{ route('appointment.index') }}">Appointments</a>
            @else
            <a href="{{ route('register') }}">Register</a>
            @endauth
            @endif
        </nav>
    </header>
    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    @if (session()->has('error'))

    @endif
    @yield('content')
    <footer class="footer-main">
        <div class="footer-info">
            <h2>Dental Schedule</h2>
            <h2>33 Taylor St, San Francisco, CA 94102</h2>
            <a href="mailto:Info@dentalSchedule.com">Info@dentalSchedule.com</a>
            <a href="tel:+4155270263">415-527-0265</a>
        </div>
        <div class="footer-btns">
            <button class="footer-btn">Visit our Google</button>
            <button class="footer-btn">Visit our yelp</button>
        </div>
    </footer>
</body>

</html>