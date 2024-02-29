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
        Schema::create('recruiters', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('google_id')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->string('microsoft_id')->nullable();
            $table->string('mobile')->nullable();
            $table->string('industry_type')->nullable();
            $table->enum('employee_count', ['1-10', '11-25', '26-50', '51-100'])->nullable();
            $table->string('location')->nullable();
            $table->string('logo')->nullable();
            $table->string('trading_license')->nullable();
            $table->string('business_tin')->nullable();
            $table->tinyInteger('status')->default(1); 
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recruiters');
    }
};
