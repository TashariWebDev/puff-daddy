<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/offline', function (Request $request) {
    if ($request->referrer === config('app.admin_url')) {
        \Illuminate\Support\Facades\Artisan::call('down');
    }
});

Route::get('/online', function (Request $request) {
    if ($request->referrer === config('app.admin_url')) {
        \Illuminate\Support\Facades\Artisan::call('up');
    }
});

Route::get('/check-maintenance', function () {
    if (app()->isDownForMaintenance()) {
        return response([], '503');
    }

    return response([], '200');
});
