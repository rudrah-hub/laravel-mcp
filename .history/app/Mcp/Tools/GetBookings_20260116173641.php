<?php

namespace App\Mcp\Tools;

use App\Mcp\Tool;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;

class GetBookings extends Tool
{
    public function name(): string
    {
        return 'get_bookings';
    }

    public function description(): string
    {
        return 'Get recent bookings with optional filters';
    }

    public function inputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'status' => ['type' => 'string'],
                'date' => ['type' => 'string'], // YYYY-MM-DD
                'limit' => ['type' => 'number'],
            ],
        ];
    }

    public function handle(array $input): mixed
    {
        $query = Booking::query();

        if (!empty($input['status'])) {
            $query->where('status', $input['status']);
        }

        if (!empty($input['date'])) {
            $query->whereDate('booking_date', $input['date']);
        }

        $limit = $input['limit'] ?? 10;

        return $query
            ->latest('booking_date')
            ->limit(min($limit, 50)) // hard safety cap
            ->get([
                'id',
                'name',
                'email',
                'booking_date',
                'booking_time',
                'phone_number',
                'status',
            ]);
    }

}
