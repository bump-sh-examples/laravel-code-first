<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class WidgetResource extends JsonResource
{
    #[OA\Property(
        description: 'Unique auto-incrementing ID of the Widget.',
        readOnly: true,
    )]
    protected int $id;

    #[OA\Property(
        description: 'The name of a widget in English.',
    )]
    protected string $name;

    #[OA\Property(
        description: 'Optional description of what the widget does, and how it works.',
    )]
    protected ?string $description;

    #[OA\Property(
        description: 'Date the widget was created, in ISO 8601 date time.',
        example: '2024-01-20T09:15:28Z'
        readOnly: true,
    )]
    protected string $created_at;

    #[OA\Property(
        description: '',
        readOnly: true,
    )]
    protected string $updated_at;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'links' => [
                'self' => route('widgets.show', ['widget' => $this->id]),
            ],
        ];
    }
}
