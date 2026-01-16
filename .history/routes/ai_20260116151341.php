<?php

use Laravel\Mcp\Facades\Mcp;
use App\Mcp\Servers\BookingServer;

Mcp::local('booking', BookingServer::class);
