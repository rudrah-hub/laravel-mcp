<?php

namespace App\Mcp\Servers;

use Laravel\Mcp\Server;
use App\Mcp\Tools\Book;
use App\Mcp\Tools\DeleteBooking;
use App\Mcp\Tools\EditBooking;
use App\Mcp\Tools\GetBookings;

class Booking extends Server
{
    /**
     * The MCP server's name.
     */
    protected string $name = 'Booking';

    /**
     * The MCP server's version.
     */
    protected string $version = '0.0.1';

    /**
     * The MCP server's instructions for the LLM.
     */
    protected string $instructions = <<<'MARKDOWN'
        Instructions describing how to use the server and its features.
    MARKDOWN;

    /**
     * The tools registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Tool>>
     */
    protected array $tools = [
        Book::class,
        \App\Mcp\Tools\GetBookings::class,
        \App\Mcp\Tools\UpdateBooking::class,
        \App\Mcp\Tools\DeleteBooking::class,
    ];

    /**
     * The resources registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Resource>>
     */
    protected array $resources = [
        //
    ];

    /**
     * The prompts registered with this MCP server.
     *
     * @var array<int, class-string<\Laravel\Mcp\Server\Prompt>>
     */
    protected array $prompts = [
        //
    ];
}
