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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('extension_name')->nullable();
            $table->enum('sex', ['Male', 'Female']);
            $table->date('birthdate');
            $table->string('birthplace')->nullable();
            $table->string('grade_level');
            $table->string('lrn')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('ip')->nullable();
            $table->string('religion')->nullable();
            $table->string('is_4ps')->nullable();
            $table->string('street')->nullable();
            $table->string('barangay');
            $table->string('municipality')->nullable();
            $table->string('province')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('live_birth')->nullable(); // file path
            $table->string('profile_image')->nullable(); // file path
            $table->string('enrollment_year')->nullable(); // file path
            $table->string('enrollment_status')->nullable(); // file path
            $table->string('live_birth_one')->nullable(); // file path
            $table->string('live_birth_two')->nullable(); // file path
            $table->string('form_one_three')->nullable(); // file path
            $table->string('pwd')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('father_education')->nullable();
            $table->string('mother_education')->nullable();
            $table->string('guardian_education')->nullable();
            $table->decimal('father_income', 10, 2)->nullable();
            $table->decimal('mother_income', 10, 2)->nullable();
            $table->decimal('guardian_income', 10, 2)->nullable();
            $table->string('father_disability')->nullable();
            $table->string('mother_disability')->nullable();
            $table->string('guardian_disability')->nullable();
            $table->string('age')->nullable(); 
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
