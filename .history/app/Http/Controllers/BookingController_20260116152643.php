<?php

namespace App\Http\Controllers;
use App\Mcp\ToolRegistry;
use Illuminate\Http\Request;

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
        $toolInstance = collect(ToolRegistry::all())
            ->first(fn ($t) => $t->name() === $tool);

        abort_if(!$toolInstance, 404);

        return response()->json(
            $toolInstance->handle($request->all())
        );
    }
}
