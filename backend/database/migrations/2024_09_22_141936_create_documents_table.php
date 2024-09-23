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
        Schema::create('documents', function (Blueprint $table) {
            $table->unsignedBigInteger('document_id')->autoIncrement(); // Primary Key
            $table->unsignedBigInteger('student_id'); // Foreign key referencing students
            $table->enum('document_type', ['Passport', 'Transcript', 'SOP', 'LOR', 'Visa Documents', 'Other']); // Type of document
            $table->string('document_url', 255)->nullable(); // URL to the document
            $table->timestamp('uploaded_on')->default(DB::raw('CURRENT_TIMESTAMP')); // Upload timestamp
            
            // Add timestamps
            $table->timestamps(); // Adds created_at and updated_at columns
            
            // Foreign key constraints
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
