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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_seeker_id');
            $table->foreign('job_seeker_id')->references('id')->on('job_seekers')->onDelete('cascade');
            $table->string('resume_file'); 
            $table->text('career_objective')->nullable();
            $table->text('career_summary')->nullable();
            $table->enum('experience', ['Fresher', '1 Year', '2 Years', '3 Years', '4 Years','More Than 5 Years']);
            $table->decimal('expected_salary', 11, 2)->nullable();
            $table->text('academic_qualification')->nullable();
            $table->text('training_summary')->nullable();
            $table->text('specialization')->nullable();
            $table->text('extra_curricular_activities')->nullable();
            $table->text('languages')->nullable();
            $table->text('references')->nullable();
            $table->string('current_job_title')->nullable();
            $table->string('current_company')->nullable();
            $table->text('skills')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
