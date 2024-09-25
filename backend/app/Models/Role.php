<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = ['name', 'description'];

    // Define the relationship with the Permission model
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    // Define the relationship with the User model
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
