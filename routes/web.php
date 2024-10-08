<?php

use App\Http\Controllers\GiftController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('site.index');
Route::get('/register', [RegisterController::class, 'index'])->name('site.register');
Route::post('/login', [UserController::class, 'login']);
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::get('/gifts/list/{user_code?}', [GiftController::class, 'giftsWithoutGuestByCode'])->name('gifts.list');
Route::post('/gifts/choose', [GiftController::class, 'chooseGifts'])->name('gifts.choose');
Route::get('/gifts/remember/{guest_code}', [GiftController::class, 'rememberGifts'])->name('gifts.remember');
Route::resource('users', UserController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/logout', [UserController::class, 'logout'])->name('app.logout');
    Route::get('/guests/confirmed', [GuestController::class, 'confirmedGuests'])->name('guests.confirmed');
    Route::resource('guests', GuestController::class);
    Route::resource('gifts', GiftController::class);
    Route::resource('images', ImageController::class);
});

Route::fallback(function(){
    echo 'The accessed route does not exist! <a href="'.route('site.index').'">Click here</a> to return to the home page';
});