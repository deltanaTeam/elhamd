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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('master_order_id')->constrained()->onDelete('cascade');
            $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');
            $table->enum('status',['pending','confirmed','returned','shipped','delivered','cancelled'])->default('pending');
            $table->decimal('subtotal',10,2);
            $table->decimal('order_discount',10,2);
            $table->decimal('total',10,2);
            $table->decimal('paid_from_wallet', 10, 2)->default(0);
            $table->decimal('paid_by_card', 10, 2)->default(0);
            $table->boolean('is_paid')->default(false);
            $table->foreignId('coupon_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('coupon_discount', 10, 2)->default(0);
            $table->unsignedInteger('earned_points')->default(0);

            $table->foreignId('shipping_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->text('shipping_address')->nullable();
            $table->enum('payment_type',['wallet','cash','card','zain','deferred']);
            $table->date('due_date');
            $table->decimal('paid_amount',10,2)->default(0);
            $table->decimal('remaining_amount',10,2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
