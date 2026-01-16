<?php

use Laravel\Mcp\Facades\Mcp;
use App\Mcp\Servers\Booking;

Mcp::web('/mcp/booking', Booking::class);
