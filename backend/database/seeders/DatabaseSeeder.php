<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UniversitySeeder::class,
            CourseSeeder::class,
            ApplicationsSeeder::class,
            AgentSeeder::class,
            StudentAgentSeeder::class,
            //VisaApplicationSeeder::class,
            DocumentSeeder::class,
            CommunicationLogSeeder::class,
            LeadSeeder::class,
            UserSeeder::class,
            RolesSeeder::class,
            PermissionsSeeder::class,
            DepartmentsSeeder::class,
            CourseOfferUniversitySeeder::class,
        ]);
    }
}
