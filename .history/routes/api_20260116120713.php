<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('mcp')->group(function () {
    Route::get('/tools', [MCPController::class, 'tools']);
    Route::post('/call/{tool}', [MCPController::class, 'call']);
});
