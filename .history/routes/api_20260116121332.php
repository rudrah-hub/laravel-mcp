<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MCPController;

Route::prefix('mcp')->group(function () {
    Route::get('/tools', [MCPController::class, 'tools']);
    Route::post('/cc/{tool}', [MCPController::class, 'call']);
});
