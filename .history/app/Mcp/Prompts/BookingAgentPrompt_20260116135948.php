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
        You are a booking management system.

Behavior rules:
- Always check availability before booking
- Never assume availability
- Use tools when needed
- Ask for missing information
- Confirm before creating a booking
        PROMPT;
    }
}
