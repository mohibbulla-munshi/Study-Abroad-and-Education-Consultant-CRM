<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\University;
use App\Models\Department;
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
            'course_code' => strtoupper($this->faker->unique()->lexify('???') . $this->faker->randomNumber(3)),
            'university_id' => University::factory(),  // Generates a university if not already created
            'department_id' => Department::factory(),  // Generates a department if not already created
            'duration' => $this->faker->randomElement(['1 year', '2 years', '3 years', '4 years']),
            'fees' => $this->faker->randomFloat(2, 1000, 50000),
            'description' => $this->faker->paragraph,
            'course_type' => $this->faker->randomElement(['Undergraduate', 'Postgraduate', 'Diploma', 'Certificate']),
            'credit_hours' => $this->faker->numberBetween(1, 40),
            'credits' => $this->faker->numberBetween(1, 20),  // Generates a random number of credits
            'mode_of_study' => $this->faker->randomElement(['Full-time', 'Part-time', 'Online']),
            'admission_requirements' => $this->faker->paragraph,
            'application_deadline' => $this->faker->date(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'is_active' => $this->faker->boolean(90),  // 90% chance the course is active
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
