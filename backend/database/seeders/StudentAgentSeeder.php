<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentAgent;

class StudentAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use the factory to create 10 student-agent relationships
        StudentAgent::factory()->count(50)->create();
    }
}
