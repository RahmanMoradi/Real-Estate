<?php

namespace App\Http\Resources;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'mobile' => $this->resource->mobile,
            'mobile_verify_at' => $this->when(
                !is_null($request->user()) && $request->user()->hasRole(RoleEnum::ADMIN->value),
                $this->resource->mobile_verify_at,
            ),
            'join_datetime' => $this->when(
                !is_null($request->user()) && $request->user()->hasRole(RoleEnum::ADMIN->value),
                $this->resource->created_at,
            ),
            'estates' => $this->whenLoaded(
                "estates",
                fn() => EstateResource::collection($this->resource->estates)
            ),
        ];
    }
}
