<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect(["ویلایی", "آپارتمان", "تجاری"]);
        $categories->each(function ($category){
            Category::factory()->create([
                "name"=> $category,
            ]);
        });

    }
}
