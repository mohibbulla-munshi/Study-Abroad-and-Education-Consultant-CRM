<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Define the fillable attributes
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    // Define the hidden attributes
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define the attributes casting
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Define the relationship with the Role model
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Define a method to check if the user has a specific permission
    public function hasPermission($permissionName)
    {
        return $this->role->permissions()->where('name', $permissionName)->exists();
    }
}
