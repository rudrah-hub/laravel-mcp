<?php

namespace App\Mcp\Prompts;

use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Prompt;
use Laravel\Mcp\Server\Prompts\Argument;

class BookingAgentPrompt
{
    public static function system(): string
    {
        return <<<PROMPT
You are a booking assistant.

Rules:
- Check availability before booking
- Use tools instead of guessing
- Suggest alternatives if unavailable
- Confirm before creating booking
PROMPT;
    }
}
