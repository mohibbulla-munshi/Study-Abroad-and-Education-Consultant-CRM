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
            $table->unsignedBigInteger('log_id')->autoIncrement(); // Primary Key
            $table->unsignedBigInteger('student_id'); // Foreign key for students
            $table->unsignedBigInteger('agent_id'); // Foreign key for agents
            $table->enum('communication_type', ['Email', 'Phone', 'SMS', 'Meeting']); // Type of communication
            $table->timestamp('communication_date')->default(DB::raw('CURRENT_TIMESTAMP')); // Date of communication
            $table->text('notes')->nullable(); // Notes regarding the communication
            
            // Foreign key constraints
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('agent_id')->references('agent_id')->on('agents')->onDelete('cascade');
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
