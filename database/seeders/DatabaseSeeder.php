<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
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
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password'=> Hash::make('12345678'),    
        ]);

        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'edit']);

        $user->assignRole($role1);

        $routes = app('router')->getRoutes();
        
        foreach ($routes as $route) {
            $routeName = $route->getName();

            if ($routeName && !str_starts_with($routeName, 'generated::') && $routeName !== 'storage.local') {
                $permission = Permission::firstOrCreate(['name' => $routeName]);

                $role1->givePermissionTo($permission);
                $role2->givePermissionTo($permission);

                $this->command->info("Created permission for route: $routeName");
            }
        }
    }
}
