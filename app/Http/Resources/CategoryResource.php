<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'        => $this->id,
            'name'     => $this->name,
            'children'  => $this->whenLoaded('children', function () {
                return $this->children;
            }),
            'parent'    => $this->whenLoaded('parent', function () {
                return CategoryResource::make($this->parent);
            }),
        ];
    }
}
