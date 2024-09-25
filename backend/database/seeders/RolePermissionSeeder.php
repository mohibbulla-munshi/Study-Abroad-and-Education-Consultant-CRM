<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create permissions
        $permissions = [
            'create_user',
            'edit_user',
            'delete_user',
            'view_user',
            'create_role',
            'edit_role',
            'delete_role',
            'view_role',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $roles = [
            'Admin' => $permissions, // Admin has all permissions
            'Consultant' => [
                'view_user',
                'edit_user',
            ],
            'Visa Specialist' => [
                'view_user',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);

            // Assign permissions to role
            foreach ($rolePermissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                $role->permissions()->attach($permission);
            }
        }
    }
}
