<?php

namespace Database\Seeders;

use App\Models\CourseOfferUniversity;
use Illuminate\Database\Seeder;

class CourseOfferUniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed the course_offer_university table with 50 random records
        CourseOfferUniversity::factory()->count(500)->create();
    }
}
