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
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('pharmacist_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('logo_path')->nullable();
            $table->decimal('location_lat',10,6)->nullable();
            $table->decimal('location_lng',10,6)->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
