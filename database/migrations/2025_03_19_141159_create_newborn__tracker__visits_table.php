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
        Schema::create('newborn__tracker__visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('newborn_id')->constrained()->onDelete('cascade');
            $table->date('visit_date');
            $table->integer('age_today');
            $table->decimal('height', 5, 2)->nullable();
            $table->string('reason_of_visit');
            $table->string('vaccine_or_service_provided')->nullable();
            $table->string('dose')->nullable();
            $table->date('schedule_next_visit')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newborn__tracker__visits');
    }
};
