<?php

namespace App\Mcp\Tools;

use App\Mcp\Tool;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;

class EditBooking extends Tool
{
    public function name(): string
    {
        return 'edit_booking';
    }

    public function description(): string
    {
        return 'Edit an existing booking';
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

    public function outputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'id' => ['type' => 'number'],
                'status' => ['type' => 'string'],
            ],
        ];
    }

    /**
     * WRITE handle (controlled)
     */
    public function handle(array $input): mixed
    {
        $validator = Validator::make($input, [
            'name' => 'string|max:255',
            'email' => 'email',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'phone_number' => 'required|string|max:20',
        ]);


        if ($validator->fails()) {
            abort(422, $validator->errors()->first());
        }

        $booking = Booking::find($input['id']);
        if (!$booking) {
            abort(404, 'Booking not found');
        }
        $booking->name = $input['name'];
        $booking->email = $input['email'];
        $booking->booking_date = $input['booking_date'];
        $booking->booking_time = $input['booking_time'];
        $booking->phone_number = $input['phone_number'];
        $booking->save();
        return [
            'id' => $booking->id,
            'status' => $booking->status,
        ];
    }
}
