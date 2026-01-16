<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MCPController;

Route::prefix('mcp')->middleware('throttle:60,1')->group(function () {
    Route::get('/tools', [MCPController::class, 'tools']);
    Route::post('/call/{tool}', [MCPController::class, 'call']);
});
