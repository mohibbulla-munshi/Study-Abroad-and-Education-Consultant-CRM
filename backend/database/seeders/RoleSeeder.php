<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create predefined roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);
        Role::create(['name' => 'Editor']);
        
        // Alternatively, you can create multiple roles using factory
        // Role::factory()->count(5)->create(); // Uncomment this line to create 5 random roles
    }
}
