<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseOfferUniversity extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'course_id',
        'is_available_for_international_students',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
