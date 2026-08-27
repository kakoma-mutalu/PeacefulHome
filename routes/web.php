<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortalController;

Route::get('/', [PublicController::class,'home'])->name('home');
Route::get('/services', [PublicController::class,'services'])->name('services');
Route::get('/services/{service}', [PublicController::class,'showService'])->name('services.show');
Route::get('/book', [PublicController::class,'booking'])->name('booking');
Route::post('/book', [PublicController::class,'storeBooking'])->name('booking.store');
Route::get('/booking/{booking}/confirmation', [PublicController::class,'confirmation'])->name('booking.confirmation');

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.store');
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth')->name('logout');
Route::get('/register',[AuthController::class,'showRegister'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.store');

Route::middleware(['auth','role:SUPER ADMIN,MANAGER,RECEPTION,CLINICAL,FINANCE,MANAGEMENT'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/patients',[AdminController::class,'patients'])->name('patients');
    Route::get('/patients/create',[AdminController::class,'createPatient'])->name('patients.create');
    Route::post('/patients',[AdminController::class,'storePatient'])->name('patients.store');
    Route::get('/patients/{patient}',[AdminController::class,'patient'])->name('patients.show');

    Route::get('/services',[AdminController::class,'services'])->name('services');
    Route::post('/services',[AdminController::class,'storeService'])->name('services.store');
    Route::patch('/services/{service}/toggle',[AdminController::class,'toggleService'])->name('services.toggle');

    Route::get('/appointments',[AdminController::class,'appointments'])->name('appointments');
    Route::post('/appointments',[AdminController::class,'storeAppointment'])->name('appointments.store');

    Route::get('/bookings',[AdminController::class,'bookings'])->name('bookings');
    Route::patch('/bookings/{booking}',[AdminController::class,'updateBooking'])->name('bookings.update');

    Route::get('/invoices',[AdminController::class,'invoices'])->name('invoices');
    Route::post('/invoices',[AdminController::class,'storeInvoice'])->name('invoices.store');
    Route::post('/invoices/{invoice}/payments',[AdminController::class,'recordPayment'])->name('invoices.payments');
});

Route::middleware(['auth','role:PATIENT'])->prefix('portal')->name('portal.')->group(function(){
    Route::get('/dashboard',[PortalController::class,'dashboard'])->name('dashboard');
});
