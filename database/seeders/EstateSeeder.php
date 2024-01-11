<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Estate;
use App\Models\User;
use Illuminate\Database\Seeder;

class EstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i < 15; $i++){
            $estate = Estate::factory()->create([
                "user_id" => rand(2, 3),
                "city_id" => City::all()->random()->id,
                "category_id" => Category::all()->random()->id,
            ]);
            $estate->attachTag(collect(["لاکچری", "بالا شهر", "پایین شهر"])->random());
            $estate->comments()->create([
                "user_id" => User::factory()->create()->id,
                "parent_id" => null,
                "text"=> fake()->text,
                "published" => 0,
            ]);
        }

    }
}
