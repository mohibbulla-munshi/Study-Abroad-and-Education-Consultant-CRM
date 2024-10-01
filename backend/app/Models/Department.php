<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // Table name if different from default
    protected $table = 'departments';

    // Primary key
    protected $primaryKey = 'department_id';

    // Fillable fields for mass assignment
    protected $fillable = ['department_name', 'department_code'];

    // Relationships (if needed, like relationship with Courses)
    public function courses()
    {
        return $this->hasMany(Course::class, 'department_id', 'department_id');
    }
}
