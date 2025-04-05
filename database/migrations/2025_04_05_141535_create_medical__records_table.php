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
        Schema::create('medical__records', function (Blueprint $table) {
            $table->id();
            $table->string('household_id');

            // Patient Info
            $table->string('full_name');
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('home_address')->nullable();
            $table->string('purok_zone')->nullable();
            $table->integer('years_of_residency')->nullable();

            // Medical Info
            $table->text('diagnosis')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('prescriptions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical__records');
    }
};
