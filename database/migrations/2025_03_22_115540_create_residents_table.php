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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('household_id')->nullable();
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
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_relationship');
            $table->string('emergency_contact_number');
            $table->string('emergency_alt_contact_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
