<?php

namespace Database\Factories;

use App\Models\CommunicationLog;
use App\Models\Student;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunicationLogFactory extends Factory
{
    protected $model = CommunicationLog::class;

    public function definition()
    {
        $student = Student::inRandomOrder()->first() ?: Student::factory()->create();
        $agent = Agent::inRandomOrder()->first() ?: Agent::factory()->create();

        return [
            'student_id' => $student->student_id,
            'agent_id' => $agent->agent_id,
            'communication_type' => $this->faker->randomElement(['Email', 'Phone', 'SMS', 'Meeting']),
            'communication_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'notes' => $this->faker->paragraph(),
        ];
    }
}
