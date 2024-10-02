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
        Schema::create('applications', function (Blueprint $table) {
            $table->id('application_id'); // Auto-incrementing ID
            $table->unsignedBigInteger('student_id'); // Foreign key referencing student_id
            $table->unsignedBigInteger('course_id');  // Foreign key referencing course_id
            $table->enum('application_status', ['In Review', 'Documents Submitted', 'Accepted', 'Rejected', 'Withdrawn'])
                  ->default('In Review'); // Application status
            $table->date('applied_on')->nullable(); // Date of application
            $table->date('decision_date')->nullable(); // Date of decision
            $table->text('comments')->nullable(); // Comments related to the application
            $table->timestamps(); // Created at and Updated at


            // Foreign key constraints
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade'); // Correct student_id reference
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
