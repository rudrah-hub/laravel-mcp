<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::prefix('mcp')->middleware('throttle:60,1')->group(function () {
    Route::get('/tools', [BookingController::class, 'tools']);
    Route::post('/call/{tool}', [BookingController::class, 'call']);
});
