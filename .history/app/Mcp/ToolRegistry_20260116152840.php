<?php

namespace App\MCP;

class ToolRegistry
{
    public static function all(): array
    {
        return collect(glob(app_path('Mcp/Tools/*.php')))
            ->map(function ($file) {
                $class = 'App\\MCP\\Tools\\' . basename($file, '.php');
                return app($class);
            })
            ->toArray();
    }
}
