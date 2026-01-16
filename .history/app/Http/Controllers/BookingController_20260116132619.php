<?php

class MCPController extends Controller
{
    protected array $tools = [
        \App\Mcp\Tools\GetBookings::class,
        \App\Mcp\Tools\Book::class,
    ];

    public function tools()
    {
        return response()->json([
            'tools' => collect($this->tools)->map(fn ($tool) => [
                'name' => app($tool)->name(),
                'description' => app($tool)->description(),
                'inputSchema' => app($tool)->inputSchema(),
            ])
        ]);
    }

    public function call(Request $request, string $toolName)
    {
        $tool = collect($this->tools)
            ->map(fn ($t) => app($t))
            ->first(fn ($t) => $t->name() === $toolName);

        abort_if(!$tool, 404);

        return response()->json(
            $tool->handle($request->all())
        );
    }
}
