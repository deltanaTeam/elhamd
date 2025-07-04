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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->decimal('earning_rate',10,2);// تحويل الفلوس الى نقاط عند شراء منتج  (earn >=1)
            $table->decimal('redeem_rate',10,2);//تحويل النقاط لفلوس تضع في المحفظة (redeem <1)
            $table->integer('min_points')->default(0);//

            $table->boolean('is_active')->default(true);
            $table->foreignId('pharmacy_id')->unique()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points');
    }
};
