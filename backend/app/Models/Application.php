<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // Table associated with the model (optional if it follows Laravel naming conventions)
    protected $table = 'applications';

    // Primary key associated with the table
    protected $primaryKey = 'application_id';

    // Fillable fields
    protected $fillable = [
        'student_id',
        'course_id',
        'application_status',
        'applied_on',
        'decision_date',
        'comments',
    ];

    // Define the relationship with the Student model
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    // Define the relationship with the Course model
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    // Constants for application statuses
    const STATUS_IN_REVIEW = 'In Review';
    const STATUS_DOCUMENTS_SUBMITTED = 'Documents Submitted';
    const STATUS_ACCEPTED = 'Accepted';
    const STATUS_REJECTED = 'Rejected';
    const STATUS_WITHDRAWN = 'Withdrawn';

    // Accessor to get a human-readable status
    public function getApplicationStatusAttribute($value)
    {
        return ucfirst(strtolower(str_replace('_', ' ', $value)));
    }

    // Mutator to set the status in a consistent format
    public function setApplicationStatusAttribute($value)
    {
        $this->attributes['application_status'] = ucfirst(strtolower($value));
    }

    // Accessor to format the 'applied_on' date
    public function getAppliedOnAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    // Accessor to format the 'decision_date' date
    public function getDecisionDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
