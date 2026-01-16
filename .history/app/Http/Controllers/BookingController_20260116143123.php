<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mcp\ToolRegistry;

class BookingController extends Controller
{
    public function tools()
    {
        return response()->json([
            'tools' => collect(ToolRegistry::all())->map(fn ($tool) => [
                'name' => $tool->name(),
                'description' => $tool->description(),
                'inputSchema' => $tool->inputSchema(),
                'outputSchema' => $tool->outputSchema(),
            ])
        ]);
    }

    public function call(Request $request, string $tool)
    {
        $instance = collect(ToolRegistry::all())
            ->first(fn ($t) => $t->name() === $tool);

        abort_if(!$instance, 404);

        if ($instance instanceof AuthorizableTool) {
            abort_if(!$instance->authorize(), 403);
        }

        \Log::info('MCP tool called', [
            'tool' => $tool,
            'input' => $request->all()
        ]);

        return response()->json(
            $instance->handle($request->all())
        );
    }
}

