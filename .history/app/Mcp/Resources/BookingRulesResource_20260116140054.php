<?php

namespace App\Mcp\Resources;

use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Resource;

class BookingRulesResource extends Resource
{
    public function name(): string
    {
        return 'booking_context';
    }

    public function description(): string
    {
        return 'Factual booking constraints and business data';
    }

    public function data(): array
    {
        return [
            'working_hours' => [
                'start' => '09:00',
                'end' => '18:00',
            ],
            'slot_duration_minutes' => 30,
            'closed_days' => ['Sunday'],
        ];
    }

}

