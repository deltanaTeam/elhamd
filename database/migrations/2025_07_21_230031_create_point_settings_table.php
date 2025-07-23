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
        Schema::create('point_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');

            // نسبة الكسب (مثلاً: 0.1 تعني كل 10 جنيه = 1 نقطة)
            $table->decimal('earning_rate', 10, 4)->default(0.00);

            // نسبة التحويل (مثلاً: 0.01 تعني كل 100 نقطة = 1 جنيه)
            $table->decimal('redeem_rate', 10, 4)->default(0.00);

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_settings');
    }
};
