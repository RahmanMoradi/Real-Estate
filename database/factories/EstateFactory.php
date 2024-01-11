<?php

namespace Database\Factories;

use App\Enums\TypeEnum;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estate>
 */
class EstateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'city_id' => City::factory(),
            'category_id'=> Category::factory(),
            'title'=> fake()->name(),
            'type'=> TypeEnum::RENT->value,
            'floor'=> rand(1, 5),
            'meterage'=> rand(50, 700),
            'price'=> rand(700_000_000, 15_000_000_000),
            'mortgage_price'=> rand(100_000_000, 800_000_000),
            'rent_price'=> rand(2_000_000, 10_000_000),
            'room_count'=> rand(1, 4),
            'toilet_count'=> rand(1, 3),
            'has_parking'=> true,
            'has_elevator'=> false,
            'has_warehouse'=> false,
        ];
    }
}
