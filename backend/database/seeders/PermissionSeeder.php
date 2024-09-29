<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create predefined permissions
        Permission::create(['name' => 'view_posts']);
        Permission::create(['name' => 'create_posts']);
        Permission::create(['name' => 'edit_posts']);
        Permission::create(['name' => 'delete_posts']);

        // Alternatively, you can create multiple permissions using factory
        // Permission::factory()->count(10)->create(); // Uncomment this line to create 10 random permissions
    }
}
