<?php

namespace App\Mcp\Resources;

use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Resource;

class BookingRBookingRulesResourceules extends Resource
{
    public static function get(): array
    {
        return [
            'working_hours' => '09:00 - 18:00',
            'slot_duration' => '30 minutes',
            'max_daily_bookings' => 20,
            'closed_days' => ['Sunday'],
        ];
    }
}

