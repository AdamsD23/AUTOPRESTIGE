<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VehiculeController;
use Illuminate\Support\Facades\Route;

// Pages publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/vehicules', [VehiculeController::class, 'index'])->name('vehicules.index');
Route::get('/vehicules/{vehicule}', [VehiculeController::class, 'show'])->name('vehicules.show');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

// Espace client
Route::middleware('auth')->group(function () {
    Route::get('/mes-reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/dashboard', fn () => redirect()->route('reservations.index'))->name('dashboard');
    Route::get('/vehicules/{vehicule}/reserver', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/vehicules/{vehicule}/reserver', [ReservationController::class, 'store'])->middleware('throttle:10,1')->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::patch('/reservations/{reservation}/annuler', [ReservationController::class, 'annuler'])->name('reservations.annuler');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Espace administrateur
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::patch('/reservations/{reservation}/statut', [AdminController::class, 'statutReservation'])->name('reservations.statut');
    Route::patch('/vehicules/{vehicule}/disponibilite', [AdminController::class, 'disponibilite'])->name('vehicules.disponibilite');
    Route::patch('/messages/{message}/lu', [AdminController::class, 'messageLu'])->name('messages.lu');
});

require __DIR__.'/auth.php';
