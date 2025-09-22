<?php

namespace App\Mcp\Tools;

use App\Models\Category;
use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;

class CreateCategoryTool extends Tool
{
    /**
     * The tool's name.
     */
    protected string $name = 'create-category';

    /**
     * The tool's description.
     */
    protected string $description = 'Create a new category';

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $valdiated = $request->validate([
            'name' => 'required|string|max:50',
        ], [
            'name.required' => 'The name of the category is required',
            'name.string' => 'The name of the category must be a string',
            'name.max' => 'The name of the category must be less than 50 characters',
        ]);

        $category = Category::create($valdiated);

        return Response::text('Category ' . $category->name . ' created successfully');
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, \Illuminate\JsonSchema\JsonSchema>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'name' => $schema->string()
                ->description('The name of the category')
                ->required(),
        ];
    }
}
