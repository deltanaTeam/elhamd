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
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('manufacturer_id')->nullable()->constrained()->onDelete('set null');

            $table->string('name');
            $table->string('generic_name')->nullable();
            $table->string('type');// دواء او مكمل
            $table->string('form');  // اقراص - شراب
            $table->string('strength');// التركيز

            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');
            $table->boolean('active')->default(1);
            $table->boolean('show_home')->default(1);
            $table->decimal('price',10,2);
            $table->decimal('tax_rate',5,2);
            $table->boolean('is_featured')->default(false);

            $table->integer('min_stock')->default(0);
            $table->integer('quantity')->default(0);

            $table->string('batch_number');
            $table->string('storage_conditions')->nullable();
            $table->boolean('prescription_required')->default(false);

            $table->date('production_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('barcode')->nullable();

            $table->string('pack_size')->nullable();

            $table->string('description')->nullable();
            $table->integer('position')->nullable();



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
