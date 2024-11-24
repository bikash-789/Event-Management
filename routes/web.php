<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;


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
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
Route::post('/event/create', [EventController::class, 'store'])->name('event.post');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');