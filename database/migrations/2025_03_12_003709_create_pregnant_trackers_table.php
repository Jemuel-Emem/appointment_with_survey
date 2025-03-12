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
        Schema::create('pregnant_trackers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pregnant_id')->constrained('pregnants')->onDelete('cascade');
            $table->date('date_of_visit');
            $table->string('family_number');
            $table->integer('months_upon_visit');
            $table->string('purok');
            $table->string('vaccine_received')->nullable();
            $table->decimal('weight', 5, 2)->nullable(); // Weight in kg (e.g., 55.50)
            $table->decimal('height', 5, 2)->nullable(); // Height in cm (e.g., 160.50)
            $table->string('bp')->nullable(); // Blood Pressure (e.g., 120/80)
            $table->text('remarks')->nullable();
            $table->date('next_schedule_visit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pregnant_trackers');
    }
};
