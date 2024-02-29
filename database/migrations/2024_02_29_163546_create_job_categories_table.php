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
        Schema::create('job_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique(); // Example: A unique slug for SEO-friendly URLs
            $table->tinyInteger('is_featured')->default(0); // Example: Flag to mark a category as featured
            $table->integer('parent_id')->nullable(); // Example: For hierarchical categories, if applicable
            $table->tinyInteger('status')->default(1);
            
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_categories');
    }
};
