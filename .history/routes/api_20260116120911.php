<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MCPController;
use App\MCP\ToolRegistry;
use Laravel\Mcp\Facades\Mcp;
use App\Mcp\Servers\WeatherServer;

Route::prefix('mcp')->group(function () {
    Route::get('/tools', [MCPController::class, 'tools']);
    Route::post('/call/{tool}', [MCPController::class, 'call']);
});
