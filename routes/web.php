<?php

use App\Livewire\Pages\Brand\Preview;
use Illuminate\Support\Facades\Route;

//Public Pages
Route::view('/', 'welcome')->name('welcome');
Route::view('/detail/{product}', 'detail')->name('detail');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/terms', 'terms')->name('terms');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/returns', 'returns')->name('returns');
Route::view('/payments', 'payment-policy')->name('payments');
Route::get('/brand/{page}', Preview::class)->name('preview');

//Purchasing Pages ** Requires Authentication **
Route::view('/cart', 'cart')->name('cart')->middleware('auth');
Route::view('/checkout', 'checkout')->name('checkout')->middleware('auth');
Route::view('/payment', 'payment')->name('payment')->middleware('auth');
Route::view('/payment-confirmation',
    'payment-confirmation')->name('payment-confirmation')->middleware('auth');
Route::view('/order-confirmation',
    'order-confirmation')->name('order-confirmation')->middleware('auth');

//Account Pages ** Requires Authentication **
Route::middleware(['web', 'auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('account', 'account')->name('account');
    Route::view('orders', 'orders')->name('orders');
    Route::view('profile', 'profile')->name('profile');
    Route::view('update-password', 'password')->name('update-password');
    Route::view('delivery-address', 'addresses')->name('delivery-address');
    Route::view('wholesale-application', 'wholesale-application')->name('wholesale-application');
    Route::view('wholesale-application/form',
        'wholesale-application-form')->name('wholesale-application-form');
});

require __DIR__.'/auth.php';
