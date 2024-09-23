<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\University>
 */
class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'university_name' => $this->faker->company, // Random university name
            'country' => $this->faker->country, // Random country
            'city' => $this->faker->city, // Random city
            'contact_email' => $this->faker->unique()->safeEmail, // Unique contact email
            'contact_phone' => $this->faker->phoneNumber, // Random phone number
            'website' => $this->faker->url, // Random university website
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
