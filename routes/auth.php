<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisteredController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredController::class, 'showRegisterForm'])->name('register.form');

    Route::post('register', [RegisteredController::class, 'register'])->name('register');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::resource('hospitals', HospitalController::class);

    Route::resource('patients', PatientController::class);

    // Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy.ajax');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
