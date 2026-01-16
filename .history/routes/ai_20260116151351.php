<?php

use Laravel\Mcp\Facades\Mcp;
use App\Mcp\Servers\BookingServer;

Mcp::web('booking', BookingServer::class);
