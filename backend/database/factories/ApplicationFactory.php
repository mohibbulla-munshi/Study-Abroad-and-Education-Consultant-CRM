<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(), // This will create a student if none exists
            'course_id' => Course::factory(), // This will create a course if none exists
            'application_status' => $this->faker->randomElement([
                'In Review', 'Documents Submitted', 'Accepted', 'Rejected', 'Withdrawn'
            ]),
            'applied_on' => $this->faker->date(),
            'decision_date' => $this->faker->optional()->date(),
            'comments' => $this->faker->optional()->text(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
