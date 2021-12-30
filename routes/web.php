<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckOutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// display the register screen
Route::get('/register_view',[AuthController::class,'register_view'])->name('register.view');
// display the login screen
Route::get('/login_view',[AuthController::class,'login_view'])->name('login.view');
// register new user
Route::post('/register',[AuthController::class,'register'])->name('register.user');
// logs the user in
Route::post('/login',[AuthController::class,'login'])->name('login.user');

// protected routes
Route::middleware(['auth'])->group(function () {
 // user logouts
 Route::post('/logout',[AuthController::class,'logout'])->name('logout.user'); 
 // returns the booking view
 Route::get('/booking/create',[BookingController::class,'create'])->name('booking.create');
 // creates a new booking
 Route::post('/booking',[BookingController::class,'store'])->name('booking.store');
 // show the newly created booking
 Route::get('/booking/{id}',[BookingController::class,'show'])->name('booking.show');
 // delete the booking
 Route::delete('/booking/{id}/delete',[BookingController::class,'destroy'])->name('booking.destroy');
 // return the thank you screen
 Route::get('/checkout',[CheckOutController::class,'index'])->name('checkout.index');
 // process the payment
 Route::post('/payment',[CheckOutController::class,'store'])->name('checkout.store');
});



