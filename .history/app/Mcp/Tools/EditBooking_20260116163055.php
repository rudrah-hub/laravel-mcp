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
curl -X POST http://127.0.0.1:8000/mcp/booking \
  -H "Content-Type: application/json" \
  --data-binary '{"jsonrpc":"2.0","id":1,"method":"tools/list","params":{}}'

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

    public function handle(array $input): mixed
    {
        $validator = Validator::make($input, [
            'name' => 'string|max:255',
            'email' => 'email',
            'booking_date' => 'date',
            'phone_number' => 'string|max:20',
        ]);

        if ($validator->fails()) {
            abort(422, $validator->errors()->first());
        }

        $booking = Booking::find($input['id']);
        if (!$booking) {
            abort(404, 'Booking not found');
        }
        if(isset($input['status'])) {
            $booking->status = $input['status'];
        }
        if(isset($input['name'])) {
            $booking->name = $input['name'];
        }
        if(isset($input['email'])) {
            $booking->email = $input['email'];
        }
        if(isset($input['booking_date'])) {
            $booking->booking_date = $input['booking_date'];
        }
        if(isset($input['booking_time'])) {
            $booking->booking_time = $input['booking_time'];
        }
        if(isset($input['phone_number'])) {
            $booking->phone_number = $input['phone_number'];
        }

        $booking->save();
        return [
            'id' => $booking->id,
            'status' => $booking->status,
        ];
    }
}
