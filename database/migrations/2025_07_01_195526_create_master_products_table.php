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
        Schema::create('master_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete('cascade');
            $table->foreignId('manufacturer_id')->nullable()->constrained()->nullOnDelete('cascade');

            $table->string('name');

            $table->string('generic_name')->nullable();

            $table->string('type');// دواء او مكمل
            $table->string('form');  // اقراص - شراب
            $table->string('strength');// التركيز


            $table->timestamps();
        });
        Schema::create('category_master_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('master_product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_master_product');

        Schema::dropIfExists('master_products');
    }
};
