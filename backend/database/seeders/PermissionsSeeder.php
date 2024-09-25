<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['name' => 'create-post'],
            ['name' => 'edit-post'],
            ['name' => 'delete-post'],
            ['name' => 'view-post'],
        ];

        Permission::insert($permissions);
    }
}
