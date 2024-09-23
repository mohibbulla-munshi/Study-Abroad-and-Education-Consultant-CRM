<?php

namespace Database\Factories;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{
    protected $model = Agent::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'agent_name' => $this->faker->name(),  // Generate a random name
            'email' => $this->faker->unique()->safeEmail(),  // Generate a unique email
            'phone' => $this->faker->numerify(str_repeat('#', 15)),  // Generate a phone number
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
