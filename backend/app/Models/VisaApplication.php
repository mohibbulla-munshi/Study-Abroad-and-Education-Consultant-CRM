<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaApplication extends Model
{
    use HasFactory;

    protected $table = 'visa_applications'; // Specify the table name if different from the model name

    // Primary key
    protected $primaryKey = 'visa_application_id'; // Specify the primary key field

    // Indicate that the primary key is not auto-incrementing if necessary
    public $incrementing = true; // Set to false if your primary key is not an auto-incrementing integer

    // Fillable attributes
    protected $fillable = [
        'student_id',
        'visa_type',
        'visa_status',
        'application_date',
        'interview_date',
        'decision_date',
        'comments',
    ];

    // Define relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
