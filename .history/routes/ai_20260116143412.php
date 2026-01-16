<?php

use Laravel\Mcp\Facades\Mcp;
use App\Mcp\Servers\booking;

Mcp::web('/mcp/weather', WeatherServer::class);


