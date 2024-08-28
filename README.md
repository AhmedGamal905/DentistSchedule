# DentistSchedule

DentistSchedule is a web application designed for a dental clinic, allowing users to view services, book appointments, and manage their dental care seamlessly. The application features a responsive design, ensuring accessibility across various devices.

## Features

### User Interface
- **Responsive Design**: Built with HTML and CSS, enhanced with media queries to ensure a flexible design across various devices.
- **User Authentication**: Users can sign in or create an account to access personalized features.
- **Service Overview**: Users can view the services provided by the clinic.

### User Functionality
- **Doctor and Appointment Management**: Users can check available doctors and appointments.
- **Booking System**: Facilitated through Livewire components, users can book appointments.
- **Email Notifications**: Confirmation emails are sent upon booking, and reminder emails are sent 24 hours before the appointment using Jobs and queues.
- **Appointment History**: Users can view upcoming and past appointments and rate their previous appointments.

### Doctor Dashboard
- **Shift Management**: Doctors can choose their shifts, set the start and end times, and the system creates 30-minute intervals.
- **Appointment Overview**: Doctors can view all booked and available appointments and have the option to cancel them.
- **Ratings and Feedback**: Doctors can view ratings from users.

## Usage

After accessing the application, users can create an account, log in, and begin managing their appointments. Doctors can log into their separate dashboard to manage shifts and appointments.

## Tech Stack

- **Frontend**: HTML, CSS, Livewire
- **Backend**: PHP, Laravel
- **Database**: MySQL

## Installation

### Steps

1. **Clone the repository:**

   ```bash
   git clone https://github.com/AhmedGamal905/DentistSchedule
   cd DentistSchedule
   ```

2. **Install backend dependencies:**

   ```bash
   composer install
   ```

3. **Set up environment variables:**

   Create a `.env` file in the root directory and add the necessary configuration values:

   ```plaintext
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=clinic
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Run database migrations:**

   ```bash
   php artisan migrate
   ```

5. **Start the development server:**

   ```bash
   php artisan serve
   npm start
   ```

6. **Access the application:**

   Open your browser and navigate to `http://localhost:8000` (or the specified port).