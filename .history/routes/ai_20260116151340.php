<?php

use Laravel\Mcp\Facades\Mcp;
use App\Mcp\Servers\BookingServer;

Mcp::local('booking', booking::class);
