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
        Schema::create('medication_doses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medication_reminder_id')->constrained('medication_reminders')->onDelete('cascade');
            $table->time('dose_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_doses');
    }
};
