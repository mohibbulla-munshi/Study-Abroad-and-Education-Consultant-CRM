<?php

namespace Database\Factories;

use App\Models\University;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseOfferUniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'university_id' => University::factory(),
            'course_id' => Course::factory(),
            'is_available_for_international_students' => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
