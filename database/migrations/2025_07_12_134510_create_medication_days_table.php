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
        Schema::create('medication_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medication_id')->constrained()->onDelete('cascade')->index()->name('medications_id_foreign');
            $table->string('day_of_week')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_days');
    }
};
