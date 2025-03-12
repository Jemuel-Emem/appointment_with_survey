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
        Schema::create('pregnants', function (Blueprint $table) {
            $table->id();
            $table->date('date_tracked');
            $table->string('name');
            $table->date('dob');
            $table->integer('age');
            $table->string('gp');
            $table->float('height');
            $table->float('weight');
            $table->float('bmi');
            $table->integer('pregnant_months');
            $table->string('purok');
            $table->string('husband_partner')->nullable();
            $table->string('muac')->nullable();
            $table->string('tt_status')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pregnants');
    }
};
