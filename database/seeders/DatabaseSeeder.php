<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $seeders = [
            RolePermissionSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            SmsConfigSeeder::class,
            EstateSeeder::class,
        ];

        foreach ($seeders as $seeder){
            $this->call($seeder);
        }
    }


}
