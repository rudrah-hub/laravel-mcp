<?php

use Laravel\Mcp\Facades\Mcp;
use App\Mcp\Servers\WeatherServer;

Mcp::web('/mcp/weather', WeatherServer::class);

Route::prefix('mcp')->group(function () {
    Route::get('/tools', [MCPController::class, 'tools']);
    Route::post('/call/{tool}', [MCPController::class, 'call']);
});
