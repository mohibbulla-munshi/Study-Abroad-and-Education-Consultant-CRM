<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // Correctly import the Role model

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles to seed
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Consultant'],
            ['name' => 'Visa Specialist'],
        ];

        // Insert roles into the database
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
