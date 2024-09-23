<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_name' => $this->faker->words(3, true),
            'university_id' => University::factory(),  // Generates a university if not already created
            'duration' => $this->faker->numberBetween(1, 4) . ' years',
            'fees' => $this->faker->randomFloat(2, 1000, 50000),
            'description' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
