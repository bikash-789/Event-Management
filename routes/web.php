<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProviderController;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

// auth controller
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/forgotpassword', function () {
    return view('pages.forgotpassword');
})->name('forgotpassword');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// google auth controller
Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);


// event controller
Route::get('/events', [EventController::class, 'index'])->name('pages.events.index');
Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/event/create', [EventController::class, 'create'])->name('pages.event.create');
    Route::put('/event/{event}/edit', [EventController::class, 'update'])->name('pages.event.edit');
    Route::get('/event/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::post('/event/create', [EventController::class, 'store'])->name('event.post');
    Route::delete('/event/{event}/delete', [EventController::class, 'destroy'])->name('event.destroy');
});
Route::get('/event/{event}', [EventController::class, 'show'])->name('events.show');

// bookings controller
Route::post('/booking/create/{id}', [BookingController::class, 'store'])->name('booking.post');
Route::middleware(IsAdmin::class)->group(function(){
    Route::get('/bookings', [BookingController::class, 'index'])->name('pages.bookings.index');
    Route::patch('/bookings/{id}', [BookingController::class, 'update'])->name('booking.update');
});
Route::get('/booking/verify/{bookingId}', [BookingController::class, 'verify'])->name('booking.verify');
// admin test route
Route::get('/admin', function () {
    return 'Welcome Admin!';
})->middleware(IsAdmin::class);