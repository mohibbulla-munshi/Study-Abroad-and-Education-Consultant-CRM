<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\University;

class UniversityFactory extends Factory
{
    protected $model = University::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'university_name' => $this->faker->company,
            'university_acronym' => strtoupper($this->faker->lexify('???')),
            'established_year' => $this->faker->year,
            'rank' => $this->faker->numberBetween(1, 1000),
            'university_type' => $this->faker->randomElement(['Public', 'Private', 'Other']),
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'contact_email' => $this->faker->unique()->safeEmail,
            'contact_phone' => $this->faker->numerify(str_repeat('#', 15)), // Generate a random 15-digit number,
            'website' => $this->faker->url,
            'number_of_students' => $this->faker->numberBetween(1000, 50000),
            'number_of_faculties' => $this->faker->numberBetween(5, 100),
            'admission_deadline' => $this->faker->date(),
            'scholarship_information' => $this->faker->sentence,
            'campus_location' => $this->faker->address,
            'international_student_support' => $this->faker->boolean,
            'visa_processing_support' => $this->faker->boolean,
            'affiliated_colleges' => $this->faker->sentence,
            'logo_url' => $this->faker->imageUrl(),
        ];
    }
}
