<?php

use Laravel\Mcp\Facades\Mcp;
use App\Mcp\Servers\booking;

Mcp::local('booking', booking::class);
