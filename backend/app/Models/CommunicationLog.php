<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationLog extends Model
{
    use HasFactory;

    // Specify the primary key
    protected $primaryKey = 'id';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'student_id',
        'agent_id',
        'communication_type',
        'communication_date',
        'notes',
    ];

    // Define relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
