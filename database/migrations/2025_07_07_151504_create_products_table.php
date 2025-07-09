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
            $table->foreignId('product_code_id')->constrained()->onDelete('cascade');
            // $table->morphs('owner'); لبسيوني
            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');

            $table->decimal('price',10,2);
            $table->decimal('tax_rate',5,2);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->integer('min_stock')->default(0);
            $table->integer('quantity')->default(0);

            $table->string('batch_number');
            $table->string('storage_conditions')->nullable();
            $table->boolean('prescription_required')->default(false);

            $table->date('production_date')->nullable();
            $table->date('expiry_date')->nullable();

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
