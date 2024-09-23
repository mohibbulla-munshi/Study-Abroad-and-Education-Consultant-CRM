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
        Schema::create('communication_logs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('student_id'); // Foreign key to students table
            $table->unsignedBigInteger('agent_id');   // Foreign key to agents table
            $table->string('communication_type');
            $table->dateTime('communication_date');
            $table->text('notes')->nullable();
            $table->timestamps(); // created_at and updated_at
        
            // Correct foreign key constraints
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade'); // Reference student_id
            $table->foreign('agent_id')->references('agent_id')->on('agents')->onDelete('cascade'); // Reference agent_id
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communication_logs');
    }
};
