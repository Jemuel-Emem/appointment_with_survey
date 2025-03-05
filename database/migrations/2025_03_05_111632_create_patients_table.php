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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('household_id')->nullable();

            // Personal Information
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->integer('age');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('civil_status');
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->text('home_address')->nullable();
            $table->string('purok_zone')->nullable();
            $table->integer('years_of_residency')->nullable();

            // Emergency Contact
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_relationship');
            $table->string('emergency_contact_number');
            $table->string('emergency_alt_contact_number')->nullable();

            // Health Information
            $table->boolean('philhealth_member');
            $table->string('philhealth_number')->nullable();
            $table->text('existing_medical_conditions')->nullable();
            $table->text('allergies')->nullable();
            $table->text('current_medications')->nullable();
            $table->text('past_surgeries_hospitalizations')->nullable();
            $table->text('family_medical_history')->nullable();
            $table->boolean('covid_vaccinated');
            $table->text('other_vaccinations_received')->nullable();

            // Category

            $table->string('category')->nullable();
            $table->integer('months_pregnant_newborn')->nullable();

            // Medical Treatment
            $table->boolean('under_medical_treatment')->default(false);
            $table->text('treatment_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
