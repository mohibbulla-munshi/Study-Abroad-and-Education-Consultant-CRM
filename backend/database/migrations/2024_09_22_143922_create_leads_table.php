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
        Schema::create('leads', function (Blueprint $table) {
            $table->unsignedBigInteger('lead_id')->autoIncrement(); // Primary Key
            $table->string('name', 100)->nullable(); // Lead name
            $table->string('email', 100)->nullable(); // Lead email
            $table->string('phone', 15)->nullable(); // Lead phone number
            $table->string('interested_country', 100)->nullable(); // Interested country
            $table->string('interested_course', 100)->nullable(); // Interested course
            $table->enum('lead_status', ['New', 'Contacted', 'Follow-up', 'Converted', 'Lost'])->default('New'); // Lead status
            $table->unsignedBigInteger('assigned_agent')->nullable(); // Foreign key referencing agents
            $table->timestamps(); // Adds created_at and updated_at columns
    
            // Foreign key constraint
            $table->foreign('assigned_agent')->references('agent_id')->on('agents')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
