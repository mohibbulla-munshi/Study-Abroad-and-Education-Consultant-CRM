<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads'; // Specify the table name if different from the model name
    protected $primaryKey = 'lead_id'; // Specify the primary key

    // Fillable attributes
    protected $fillable = [
        'name',
        'email',
        'phone',
        'interested_country',
        'interested_course',
        'lead_status',
        'assigned_agent',
    ];

    // Define relationships
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'assigned_agent');
    }
}
