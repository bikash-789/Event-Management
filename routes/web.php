<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
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
Route::get('/signin', function () {
    return response('<h1>Signin with Google</h1>');
})->name('google.signin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// event controller
Route::get('/events', [EventController::class, 'index'])->name('pages.events.index');
Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/event/create', [EventController::class, 'create'])->name('pages.event.create');
    Route::put('/event/{event}/edit', [EventController::class, 'update'])->name('pages.event.edit');
    Route::get('/event/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::post('/event/create', [EventController::class, 'store'])->name('event.post');
    Route::delete('/event/{event}/delete', [EventController::class, 'destroy'])->name('event.destroy');
});
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// admin test route
Route::get('/admin', function () {
    return 'Welcome Admin!';
})->middleware(IsAdmin::class);