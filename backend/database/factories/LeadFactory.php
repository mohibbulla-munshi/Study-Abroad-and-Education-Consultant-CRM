<?php

namespace Database\Factories;

use App\Models\Lead;
use App\Models\Agent; // Include the Agent model if needed
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify(str_repeat('#', 15)), // Generate a random 15-digit number
            'interested_country' => $this->faker->country(),
            'interested_course' => $this->faker->word(),
            'lead_status' => $this->faker->randomElement(['New', 'Contacted', 'Follow-up', 'Converted', 'Lost']),
            'assigned_agent' => Agent::factory(), // Create an agent if needed
            
        ];
    }
}
