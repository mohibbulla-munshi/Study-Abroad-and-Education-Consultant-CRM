<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'nationality',
        'birthdate',
        'address',
    ];

    // Specify the primary key name
    protected $primaryKey = 'student_id';

    // Optional: Disable auto-incrementing if your primary key isn't auto-incrementing (though in this case it is)
    public $incrementing = true;

    // Optional: Specify the primary key type if it's not an integer (e.g., if you use UUIDs)
    protected $keyType = 'int';
}
