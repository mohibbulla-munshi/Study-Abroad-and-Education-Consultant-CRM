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
        Schema::create('student_agents', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id'); // Foreign key referencing students
            $table->unsignedBigInteger('agent_id');   // Foreign key referencing agents
            $table->date('assigned_on');               // Date when the agent was assigned to the student

            $table->timestamps(); // Adds created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('agent_id')->references('agent_id')->on('agents')->onDelete('cascade');

            // Composite primary key
            $table->primary(['student_id', 'agent_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_agents');
    }
};
