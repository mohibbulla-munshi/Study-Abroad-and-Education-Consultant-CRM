<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    protected $model = \App\Models\Document::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(), // Creates a new student
            'document_type' => $this->faker->randomElement(['Passport', 'Transcript', 'SOP', 'LOR', 'Visa Documents', 'Other']), // Random document type
            'document_url' => $this->faker->url(), // Random URL
            'uploaded_on' => now(), // Use the current timestamp for upload
        ];
    }
}
