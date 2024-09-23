<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisaApplicationFactory extends Factory
{
    protected $model = \App\Models\VisaApplication::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(), // Creates a new student
            'visa_type' => $this->faker->randomElement(['Student Visa', 'Work Visa', 'Tourist Visa']), // Random visa type
            'visa_status' => $this->faker->randomElement(['Not Applied', 'Applied', 'Interview Scheduled', 'Approved', 'Rejected']), // Random status
            'application_date' => $this->faker->date(),
            'interview_date' => $this->faker->optional()->date(), // Optional interview date
            'decision_date' => $this->faker->optional()->date(), // Optional decision date
            'comments' => $this->faker->optional()->text(), // Optional comments
        ];
    }
}
