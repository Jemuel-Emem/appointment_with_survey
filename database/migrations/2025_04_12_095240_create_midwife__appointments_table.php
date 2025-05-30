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
        Schema::create('midwife__appointments', function (Blueprint $table) {
            $table->id();
            // $table->string('patient_name');
            // $table->date('appointment_date');
            // $table->time('appointment_time');

            $table->string('patient_name');
            $table->string('phone_number');
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->string('category_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midwife__appointments');
    }
};
