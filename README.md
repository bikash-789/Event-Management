# Event Management Application 

**Event Management Application** is a Laravel-based system that allows users to create, update, and manage events. 

## Features

- **Event Creation**: Easily create events with details like title, description, location, and date.
- **Event Management**:
  - Update event details.
  - Manage event capacities and track attendees.
- **User Management**: Admin can manage the authorization for users.
- **Booking**: User can login and book the events and see their previous bookings. Admin can update the status of bookings.

## Tech Stack
- **Backend**: Laravel (PHP framework).
- **Database**: MySQL.
- **Frontend**: Blade templates with support for Tailwind CSS.
- **Analytics**: Event analytics tracking via a RabbitMQ-backed service.

## Getting Started

### Prerequisites

- **PHP 8.1+**
- **Composer**
- **MySQL 8.0+** (or any compatible database)
- **RabbitMQ** (optional for analytics and queueing)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/bikash-789/Event-Management.git
   cd Event-Management
   
2. Install PHP dependencies
    `composer install`
3. Set up your .env file:
   `cp .env.example .env`
   Update the .env file with your database credentials and RabbitMQ details:
   ```bash
    `DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=event_management
    DB_USERNAME=root
    DB_PASSWORD=

    QUEUE_CONNECTION=rabbitmq
    RABBITMQ_HOST=127.0.0.1
    RABBITMQ_PORT=5672
    RABBITMQ_USER=guest
    RABBITMQ_PASSWORD=guest

4. Generate the application key:
    `php artisan key:generate`
   
6. Run database migrations:
    `php artisan migrate`

7. Start the server:
    `php artisan serve`

8. Start the frontend application:
   `npm run install && npm run dev`

9. Start the queue worker for RabbitMQ:
    `php artisan queue:work`

10. Application will be running at `localhost:8000/v1`

