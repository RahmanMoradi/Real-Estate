<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
//        Permission::create(['name' => 'view drivers']);

        $adminRole = Role::create(['name' => RoleEnum::ADMIN]);
        $agencyRole = Role::create(['name' => RoleEnum::AGENCY]);
        $userRole = Role::create(['name' => RoleEnum::USER]);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $admin = User::factory()->create([
            'name' => 'Rahman ADMIN',
            'mobile' => '09332246347',
            "password" => "password",
        ]);
        $agency = User::factory()->create([
            'name' => 'Babak AGENCY',
            'mobile' => '09332246345',
            "password" => "password",
        ]);

        $user = User::factory()->create([
            'name' => 'Majid User',
            'mobile' => '09332246346',
            "password" => "password",
        ]);

        $admin->assignRole($adminRole);
        $agency->assignRole($agencyRole);
        $user->assignRole($userRole);
    }
}
