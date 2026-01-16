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

    public function outputSchema(): array
    {
        return [
            'type' => 'array',
            'items' => ['type' => 'object'],
        ];
    }

    public function handle(array $input): mixed
    {
        $validator = Validator::make($input, [
            'name' => 'string|max:255',
            'email' => 'email',
            'booking_date' => 'date|after_or_equal:today',
            'phone_number' => 'string|max:20',
        ]);

        if ($validator->fails()) {
            abort(422, $validator->errors()->first());
        }

        $exists = Booking::where('booking_date', $input['booking_date'])
            ->where('booking_time', $input['booking_time'])
            ->exists();

        if ($exists) {
            abort(409, 'Time slot already booked');
        }

        $dailyCount = Booking::whereDate('booking_date', $input['booking_date'])->count();

        if ($dailyCount >= 20) {
            abort(429, 'Daily booking limit reached');
        }

        $booking = Booking::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'booking_date' => $input['booking_date'],
            'booking_time' => $input['booking_time'],
            'phone_number' => $input['phone_number'],
            'status' => 'pending',
        ]);

        return [
            'id' => $booking->id,
            'status' => $booking->status,
        ];
    }

}
