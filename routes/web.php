<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;

// v1 routes
Route::prefix('v1')->group(function () {
    //homepage
    Route::get('/', function(){
        return view('welcome');
    });
    // auth controller
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('v1.login');
    Route::post('/login', [AuthController::class, 'login'])->name('v1.login.post');
    Route::get('/forgotpassword', function () {
        return view('pages.forgotpassword');
    })->name('v1.forgotpassword');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('v1.register');
    Route::post('/register', [AuthController::class, 'register'])->name('v1.register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('v1.logout');

    // google auth controller
    Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
    Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

    // event controller
    Route::get('/events', [EventController::class, 'index'])->name('v1.pages.events.index');
    Route::middleware(IsAdmin::class)->group(function () {
        Route::get('/event/create', [EventController::class, 'create'])->name('v1.pages.event.create');
        Route::put('/event/{event}/edit', [EventController::class, 'update'])->name('v1.pages.event.edit');
        Route::get('/event/{event}/edit', [EventController::class, 'edit'])->name('v1.events.edit');
        Route::post('/event/create', [EventController::class, 'store'])->name('v1.event.post');
        Route::delete('/event/{event}/delete', [EventController::class, 'destroy'])->name('v1.event.destroy');
    });
    Route::get('/event/{event}', [EventController::class, 'show'])->name('v1.events.show');

    // bookings controller
    Route::post('/booking/create/{id}', [BookingController::class, 'store'])->name('v1.booking.post');
    Route::middleware(IsAdmin::class)->group(function(){
        Route::get('/bookings', [BookingController::class, 'index'])->name('v1.pages.bookings.index');
        Route::patch('/bookings/{id}', [BookingController::class, 'update'])->name('v1.booking.update');
        Route::get('/users', [UserController::class, 'index'])->name('v1.users');
        Route::post('/users/{user}/blacklist', [UserController::class, 'blacklist'])->name('v1.users.blacklist');
        Route::post('/users/{user}/whitelist', [UserController::class, 'whitelist'])->name('v1.users.whitelist');
        Route::post('/users/{user}/reactivate', [UserController::class, 'reactivate'])->name('v1.users.reactivate');
    });
    Route::get('/booking/verify/{id}/{token}', [BookingController::class, 'verify'])->name('v1.bookings.verify');

    Route::middleware(IsUser::class)->group(function(){
        Route::get('/bookings/user', [BookingController::class, 'userbookings'])->name('v1.pages.bookings.userbookings');
    });

    // admin test route
    Route::get('/admin', function () {
        return 'Welcome Admin!';
    })->middleware(IsAdmin::class);
});
