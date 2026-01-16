<?php

namespace App\Mcp\Servers;

use Laravel\Mcp\Server;
use App\Mcp\Prompts\BookingAgentPrompt;
use App\Mcp\Resources\BookingRulesResource;


class booking extends Server
{
    /**
     * The MCP server's name.
     */
    protected string $name = 'booking';

    /**
     * The MCP server's version.
     */
    protected string $version = '0.0.1';

    /**
     * The MCP server's instructions for the LLM.
     */
    protected string $instructions = "You are a booking management system. Use the tools provided to manage and retrieve booking information as requested.";

    /**
     * The tools registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */
    protected array $tools = [
        \App\Mcp\Tools\GetBookings::class,
        \App\Mcp\Tools\Book::class
    ];

    /**
     * The resources registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Resource>>
     */
    protected array $resources = [
        BookingRulesResource::class,
    ];

    /**
     * The prompts registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Prompt>>
     */
    protected array $prompts = [
        BookingAgentPrompt::class,
    ];
}
