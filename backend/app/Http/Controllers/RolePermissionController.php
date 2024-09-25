<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    /**
     * Assign permissions to a role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignPermissions(Request $request)
    {
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($validatedData['role_id']);

        // Attach the permissions to the role
        $role->permissions()->sync($validatedData['permission_ids']); // Syncing the permissions to avoid duplicates

        return response()->json([
            'message' => 'Permissions assigned successfully to the role',
            'role' => $role->load('permissions') // Eager load permissions to show them in response
        ], 200);
    }
}
