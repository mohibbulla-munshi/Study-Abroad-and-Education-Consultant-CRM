<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Handle user registration and role assignment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|string|exists:roles,name', // Ensure the role exists
    ]);

    // Debugging: Log the requested role
    \Log::info('Requested role: ' . $request->role);

    // Find the role by name
    $role = Role::where('name', $request->role)->first();

    // Debugging: Log the retrieved role
    if ($role) {
        \Log::info('Retrieved role: ', $role->toArray());
    } else {
        \Log::info('Role not found for name: ' . $request->role);
    }

    // Create the user with the validated data and assign the role
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role_id' => $role->id, // Assign the role_id from the roles table
    ]);

    // Return a success response
    return response()->json([
        'message' => 'User created successfully',
        'user' => $user
    ], 201);
}

}
