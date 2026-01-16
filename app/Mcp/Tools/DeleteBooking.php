<?php

namespace App\Mcp\Tools;

use App\Mcp\Tool;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;

class DeleteBooking extends Tool
{
    public function name(): string
    {
        return 'delete_booking';
    }

    public function description(): string
    {
        return 'Delete an existing booking';
    }

    public function inputSchema(): array
    {
        return [
            'type' => 'object',
            'required' => [
                'booking_id',
            ],
            'properties' => [
                'booking_id' => ['type' => 'number'],
            ],
        ];
    }

    public function outputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'success' => ['type' => 'boolean'],
            ],
        ];
    }

    /**
     * WRITE handle (controlled)
     */
    public function handle(array $input): mixed
    {
        $validator = Validator::make($input, [
            'booking_id' => 'required|integer|exists:bookings,id',
        ]);

        if ($validator->fails()) {
            abort(422, $validator->errors()->first());
        }

        $booking = Booking::find($input['booking_id']);
        $booking->delete();

        return [
            'success' => true,
        ];
    }
}
