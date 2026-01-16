<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;

class GetBookings extends Tool
{
    protected string $name = "Get Bookings";

    protected string $title = "Get Bookings Tool";

    protected string $description = "This tool retrieves a list of bookings.";

    public function handle(Request $request): Response
    {

    }

    public function schema(JsonSchema $schema): array
    {

    }
}
