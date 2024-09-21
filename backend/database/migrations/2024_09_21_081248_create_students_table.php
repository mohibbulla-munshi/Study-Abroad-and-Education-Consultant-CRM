<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id'); // Auto-incrementing ID
            $table->string('first_name', 100); // First Name
            $table->string('last_name', 100); // Last Name
            $table->string('email', 100)->unique(); // Email (unique)
            $table->string('phone', 15)->nullable(); // Phone (optional)
            $table->string('nationality', 50)->nullable(); // Nationality (optional)
            $table->date('birthdate')->nullable(); // Birthdate (optional)
            $table->text('address')->nullable(); // Address (optional)
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
