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
        Schema::create('visa_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('visa_application_id')->autoIncrement(); // Primary Key
            $table->unsignedBigInteger('student_id'); // Foreign key referencing students
            $table->string('visa_type', 50)->nullable(); // Type of visa
            $table->enum('visa_status', ['Not Applied', 'Applied', 'Interview Scheduled', 'Approved', 'Rejected'])
                ->default('Not Applied'); // Status of visa application
            $table->date('application_date')->nullable(); // Date of application
            $table->date('interview_date')->nullable(); // Interview date
            $table->date('decision_date')->nullable(); // Decision date
            $table->text('comments')->nullable(); // Additional comments

            // Foreign key constraints
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');

            // Add timestamps
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_applications');
    }
};
