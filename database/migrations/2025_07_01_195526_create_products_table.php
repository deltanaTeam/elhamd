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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete('cascade');

            $table->string('name');

            $table->string('scientific_name')->nullable();

            $table->string('type');// دواء او مكمل
            $table->string('form');  // اقراص - شراب
            $table->string('dose')->nullable();

            $table->text('description')->nullable();
            $table->text('instructions')->nullable();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
