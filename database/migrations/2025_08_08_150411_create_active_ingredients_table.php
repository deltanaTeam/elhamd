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
        Schema::create('active_ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        // Schema::create('ingredient_master_product', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('master_product_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('active_ingredient_id')->constrained()->onDelete('cascade');
        //     $table->string('amount')->nullable();// ;كمية المادة الفعالة 500 mg
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_master_product');

        Schema::dropIfExists('active_ingredients');
    }
};
