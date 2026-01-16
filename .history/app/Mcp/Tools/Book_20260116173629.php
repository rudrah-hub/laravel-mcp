<?php

namespace App\Mcp\Tools;

use Laravel\Mcp\Server\Tool;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;


class Book extends Tool
{
    public function name(): string
    {
        return 'create_booking';
    }

    public function description(): string
    {
        return 'Create a new booking';
    }

    public function inputSchema(): array
    {
        return [
            'type' => 'object',
            'required' => [
                'name',
                'email',
                'booking_date',
                'booking_time',
                'phone_number',
            ],
            'properties' => [
                'name' => ['type' => 'string'],
                'email' => ['type' => 'string'],
                'booking_date' => ['type' => 'string'],
                'booking_time' => ['type' => 'string'],
                'phone_number' => ['type' => 'string'],
            ],
        ];
    }

    public function handle(array $input): mixed
    {
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'phone_number' => 'required|string|max:20',
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
