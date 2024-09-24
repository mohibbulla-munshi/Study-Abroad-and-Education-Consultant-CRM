<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'agents';

    // Define the primary key for the table
    protected $primaryKey = 'agent_id';

    // Disable auto-incrementing if you're using a non-numeric or non-sequential primary key
    public $incrementing = true;

    // Define the data type of the primary key
    protected $keyType = 'int';

    // Allow mass assignment for these fields
    protected $fillable = [
        'agent_name',
        'email',
        'phone',
    ];

    // Optionally, define any default values for model attributes
    protected $attributes = [
        'email' => null,
        'phone' => null,
    ];

    // If you don't want Laravel to handle the timestamps (created_at, updated_at), you can disable them:
    // public $timestamps = false;
}
