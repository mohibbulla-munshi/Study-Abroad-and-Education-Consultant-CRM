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
        Schema::disableForeignKeyConstraints();

        Schema::create('courses', function (Blueprint $table) {
            // Primary Key: Unique ID for each course
            $table->id('course_id');

            // Course Name: Descriptive name of the course
            $table->string('course_name')->nullable(false);

            // Unique Course Code: Automatically generated unique identifier for each course
            $table->string('course_code', 20)->unique()->nullable(false);

            // University ID: Foreign key linking to the universities table (many-to-one relationship)
            $table->unsignedBigInteger('university_id');

            // Department ID: Foreign key linking to the departments table (many-to-one relationship)
            $table->unsignedBigInteger('department_id');

            // Duration: Duration of the course (e.g., 4 years, 2 semesters, etc.)
            $table->string('duration', 50)->nullable();

            // Fees: Decimal value to store the cost of the course
            $table->decimal('fees', 10, 2)->nullable();

            // Description: Text field for any additional information about the course
            $table->text('description')->nullable();

            // Course Type: Whether the course is undergraduate, postgraduate, diploma, etc.
            $table->enum('course_type', ['Undergraduate', 'Postgraduate', 'Diploma', 'Certificate'])->nullable(false);

            // Credit Hours: Total credit hours required to complete the course
            $table->integer('credit_hours')->nullable();

            // Credits: General field for course credits (if different from credit_hours)
            $table->integer('credits')->nullable();  // Newly added credits field

            // Mode of Study: Full-time, Part-time, Online
            $table->enum('mode_of_study', ['Full-time', 'Part-time', 'Online'])->default('Full-time');

            // Admission Requirements: Text field to capture specific requirements for enrollment in this course
            $table->text('admission_requirements')->nullable();

            // Application Deadline: Date when the application process ends
            $table->date('application_deadline')->nullable();

            // Start Date: When the course is expected to start
            $table->date('start_date')->nullable();

            // End Date: When the course is expected to end
            $table->date('end_date')->nullable();

            // Status: Whether the course is active or inactive (helps in filtering available courses)
            $table->boolean('is_active')->default(true);

            // Timestamps: Automatically manage created_at and updated_at fields
            $table->timestamps();

            // Foreign key constraints: Ensure referential integrity
            $table->foreign('university_id')
                  ->references('university_id')
                  ->on('universities')
                  ->onDelete('cascade'); // Cascade delete to remove courses if university is deleted

            $table->foreign('department_id')
                  ->references('department_id')
                  ->on('departments')
                  ->onDelete('cascade'); // Cascade delete to remove courses if department is deleted
        });
        
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
