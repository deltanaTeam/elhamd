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
            $table->enum('discount_type',['percentage','fixed']);

            $table->decimal('discount_value',10,2);

            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
  
        Schema::dropIfExists('discounts');
    }
};
