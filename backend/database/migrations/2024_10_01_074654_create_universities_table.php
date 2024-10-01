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
        Schema::create('universities', function (Blueprint $table) {
            $table->bigIncrements('university_id');
            $table->string('university_name');
            $table->string('university_acronym', 50)->nullable();          // Acronym of the university
            $table->year('established_year')->nullable();                   // Year the university was founded
            $table->integer('rank')->nullable();                            // University ranking (global/national)
            $table->enum('university_type', ['Public', 'Private', 'Other']); // Type of the university
            $table->string('country', 100)->nullable();                      // Country
            $table->string('city', 100)->nullable();                         // City
            $table->text('address')->nullable();                             // Full address of the university
            $table->string('contact_email', 100)->nullable();                // Contact email
            $table->string('contact_phone', 15)->nullable();                 // Contact phone number
            $table->string('website', 255)->nullable();                      // Website URL
            $table->integer('number_of_students')->nullable();               // Total number of students
            $table->integer('number_of_faculties')->nullable();              // Number of faculties or departments
            $table->date('admission_deadline')->nullable();                  // General admission deadline
            $table->text('scholarship_information')->nullable();             // Details on scholarships
            $table->text('campus_location')->nullable();                     // Campus location details
            $table->boolean('international_student_support')->default(false); // Support for international students
            $table->boolean('visa_processing_support')->default(false);      // Support with visa processing
            $table->text('affiliated_colleges')->nullable();                 // List of affiliated colleges
            $table->string('logo_url', 255)->nullable();                     // URL of the university logo
            $table->timestamps();                                            // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
