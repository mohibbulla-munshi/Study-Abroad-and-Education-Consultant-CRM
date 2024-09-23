<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    // Define the table if necessary (Laravel will use the plural of the model name otherwise)
    protected $table = 'universities';

    // Define the primary key
    protected $primaryKey = 'university_id';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'university_name',
        'country',
        'city',
        'contact_email',
        'contact_phone',
        'website',
    ];

    // Relationships
    public function courses()
    {
        // A university has many courses
        return $this->hasMany(Course::class, 'university_id', 'university_id');
    }

    // Optional: Add validation rules if needed
    public static function rules()
    {
        return [
            'university_name' => 'required|string|max:255|unique:universities',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'contact_email' => 'nullable|string|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
        ];
    }

    // Custom error messages
    public static function messages()
    {
        return [
            'university_name.required' => 'University name is required',
            'university_name.unique' => 'This university name already exists',
            'contact_email.email' => 'The contact email must be a valid email address',
            'website.url' => 'The website must be a valid URL',
        ];
    }
}
