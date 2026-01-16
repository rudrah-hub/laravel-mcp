<?php

use Laravel\Mcp\Facades\Mcp;
use App\Mcp\Servers\booking;

Mcp::local('/mcp/booking', booking::class);
