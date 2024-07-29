<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <header class="home-header">
        <h1>Dentist Schedule</h1>
        <nav class="header-links">
            <a href="illustrations.html">Services</a>
            <a href="Murals.html">Insurance & Prices</a>
            <a href="Picture.html">Team</a>
            <a href="About.html">Location</a>
            <a href="Shop.html">Contact</a>
            <a href="Shop.html">Book Now</a>
        </nav>
    </header>
    @yield('content')
    <footer class="footer-main">
        <div class="footer-info">
            <h2>Dental Schedule</h2>
            <h2>27 Taylor St, San Francisco, CA 94102</h2>
            <a href="info@dentalSchedule.com">Info@dentalSchedule.com</a>
            <a href="tel:+4155270265">415-527-0263</a>
        </div>
        <div class="footer-btns">
            <button class="footer-btn">Visit our Google</button>
            <button class="footer-btn">Visit our yelp</button>
        </div>
    </footer>
</body>

</html>