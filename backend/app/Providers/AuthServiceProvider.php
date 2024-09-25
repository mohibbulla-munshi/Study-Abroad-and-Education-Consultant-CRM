<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; // Import the Gate facade
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Your policies
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('create_user', function ($user) {
            return $user->role->permissions()->where('name', 'create_user')->exists();
        });

        // Define other permissions similarly
    }
}
