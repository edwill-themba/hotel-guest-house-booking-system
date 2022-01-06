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
// display update user password
Route::get('/user/edit',[AuthController::class,'edit_user'])->name('user.edit');
// send a link via email for password update
Route::post('/send_link',[AuthController::class,'send_link_to_user'])->name('user.link');
// update user password
Route::patch('/update_user/{id}',[AuthController::class,'update_user_password'])->name('user.update');

// protected routes
Route::middleware(['auth'])->group(function () {
 // user logouts
 Route::post('/logout',[AuthController::class,'logout'])->name('logout.user'); 
 // list all the bookings
 Route::get('/bookings',[BookingController::class,'index'])->name('booking.index');
 // returns the booking view
 Route::get('/booking/create',[BookingController::class,'create'])->name('booking.create');
 // creates a new booking
 Route::post('/booking',[BookingController::class,'store'])->name('booking.store');
 // show the newly created booking
 Route::get('/booking/{id}',[BookingController::class,'show'])->name('booking.show');
 // show the edit booking view
 Route::get('/booking/{id}/edit',[BookingController::class,'edit'])->name('booking.edit');
 // update the user booking
 Route::patch('/booking/{id}/update',[BookingController::class,'update'])->name('booking.update');
 // delete the booking
 Route::delete('/booking/{id}/delete',[BookingController::class,'destroy'])->name('booking.destroy');
 // return the thank you screen
 Route::get('/checkout',[CheckOutController::class,'index'])->name('checkout.index');
 // process the payment
 Route::post('/payment',[CheckOutController::class,'store'])->name('checkout.store');
});



