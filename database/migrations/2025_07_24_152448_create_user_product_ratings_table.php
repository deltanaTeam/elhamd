<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::create('user_product_ratings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
        $table->integer('rate');
        $table->text('rate_text')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
public function down()
{
    Schema::dropIfExists('user_product_ratings');
}
};
