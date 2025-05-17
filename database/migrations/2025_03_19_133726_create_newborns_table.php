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
        Schema::create('newborns', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_delivery');
            $table->time('time_of_delivery');
            $table->string('name_of_mother');
            $table->integer('age');
            $table->enum('sex_of_baby', ['Male', 'Female']);
            $table->string('name_of_child');
            $table->decimal('length', 5, 2); // Length in cm
            $table->decimal('weight', 5, 2); // Weight in kg
            $table->text('date_and_vaccine_given')->nullable(); // Stores multiple vaccines with dates
            $table->string('place_of_delivery');
            $table->enum('type_of_delivery', ['Normal', 'C-Section', 'Others']);
            $table->text('remarks')->nullable();
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newborns');
    }
};
