<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = ['name', 'description'];

    // Define the relationship with the Role model
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }
}
