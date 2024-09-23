<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentAgentFactory extends Factory
{
    protected $model = \App\Models\StudentAgent::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(), // Creates a new student
            'agent_id' => Agent::factory(),     // Creates a new agent
            'assigned_on' => $this->faker->date(), // Random date
        ];
    }
}
