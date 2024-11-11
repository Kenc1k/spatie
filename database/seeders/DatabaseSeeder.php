<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Routing\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create roles
        $role1 = Role::create([
            'name' => 'admin',
        ]);
        $role2 = Role::create([
            'name' => 'edit',
        ]);

        // $user->assignRole('admin');

        $routes = Route::getRoutes();
    }
}
