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
        Schema::create('midwife__follow_appointements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('med_id')->constrained('midwife__appointments')->onDelete('cascade');
            $table->date('followup_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midwife__follow_appointements');
    }
};
