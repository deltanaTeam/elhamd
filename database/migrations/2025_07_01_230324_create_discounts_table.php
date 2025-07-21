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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type',['auto','personal','buy_get']);
            $table->enum('discount_type',['percentage','fixed']);

            $table->decimal('discount_value',10,2);
            $table->integer('buy_quantity')->nullable();// for type buy get
            $table->integer('get_quantity')->nullable(); // for type buy get

            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
        // Schema::create('discount_product', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('discount_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('product_id')->constrained()->onDelete('cascade');
        //
        // });
        // Schema::create('discount_category', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('discount_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('category_id')->constrained()->onDelete('cascade');
        //
        // });
        //
        // Schema::create('discount_all_order', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('discount_id')->constrained()->onDelete('cascade');
        //
        // });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_all_order');
        Schema::dropIfExists('discount_product');
        Schema::dropIfExists('discount_category');
        Schema::dropIfExists('discounts');
    }
};
