namespace App\MCP;

abstract class Tool
{
    abstract public function name(): string;
    abstract public function description(): string;
    abstract public function inputSchema(): array;
    abstract public function outputSchema(): array;
    abstract public function handle(array $input): mixed;
}
