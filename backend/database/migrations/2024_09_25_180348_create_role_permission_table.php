<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')
                ->constrained('roles') // Reference to the roles table
                ->onDelete('cascade'); // If a role is deleted, remove related permissions

            $table->foreignId('permission_id')
                ->constrained('permissions') // Reference to the permissions table
                ->onDelete('cascade'); // If a permission is deleted, remove related roles

            $table->timestamps();

            // Add unique constraint to prevent duplicate role-permission pairs
            $table->unique(['role_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
}
