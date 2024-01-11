<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class EstateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user" => $this->whenLoaded(
                "user",
                fn() => UserResource::make($this->resource->user)
            ),
            "city" => $this->whenLoaded(
                "city",
                fn() => CityResource::make($this->resource->city) //TODO
            ),
            "category" => $this->whenLoaded(
                "category",
                fn() => CategoryResource::make($this->resource->category)
            ),
            "comments" => $this->when(
                Str::contains($request->route()->getName(), 'show'),
                $this->whenLoaded(
                    "comments",
                    fn() => CommentResource::collection($this->resource->comments)
                ),
            ),
            "title"=> $this->resource->title,
            "slug" => $this->resource->slug,
            'type' => $this->resource->type,
            'floor' => $this->resource->floor,
            'meterage' => $this->resource->meterage,
            'price' => $this->resource->price,
            'mortgage_price' => $this->resource->mortgage_price,
            'rent_price' => $this->resource->rent_price,
            'room_count' => $this->resource->room_count,
            'toilet_count' => $this->resource->toilet_count,
            'has_parking' => $this->resource->has_parking,
            'has_elevator' => $this->resource->has_elevator,
            'has_warehouse' => $this->resource->has_warehouse,
        ];
    }
}
