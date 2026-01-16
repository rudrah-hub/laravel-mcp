<?php

namespace App\MCP\Tools;

use App\MCP\Tool;
use App\Models\User;

class ListUsers extends Tool
{
    public function name(): string
    {
        return 'list_users';
    }

    public function description(): string
    {
        return 'Returns latest 5 users';
    }

    public function inputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => []
        ];
    }

    public function outputSchema(): array
    {
        return [
            'type' => 'array',
            'items' => [
                'type' => 'object',
                'properties' => [
                    'id' => ['type' => 'number'],
                    'name' => ['type' => 'string'],
                    'email' => ['type' => 'string'],
                ]
            ]
        ];
    }

    public function handle(array $input): mixed
    {
        return User::select('id', 'name', 'email')
            ->latest()
            ->limit(5)
            ->get();
    }
}
