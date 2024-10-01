<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Table name (optional, only if it's not 'courses' by default)
    protected $table = 'courses';

    // Primary key (if not the default 'id')
    protected $primaryKey = 'course_id';

    // Allow mass assignment for these fields
    protected $fillable = [
        'course_name',
        'university_id',
        'duration',
        'fees',
        'description',
    ];

    // Define the relationship with the University model
    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function universities()
    {
        return $this->belongsToMany(University::class, 'course_university')
                    ->withPivot('is_available_for_international_students')
                    ->withTimestamps();
    }
}
