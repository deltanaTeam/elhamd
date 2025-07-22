<?php 
// database/migrations/YYYY_MM_DD_create_product_ratings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_ratings', function (Blueprint $table) {
            $table->id();
            
            // العلاقات
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            // بيانات التقييم
            $table->tinyInteger('rating')->unsigned()->between(1, 5);
            $table->text('comment')->nullable();
            
            // الموافقة
            $table->boolean('is_approved')->default(false);
            
            // التواريخ
            $table->timestamps();
            
            // الفهارس
            $table->unique(['user_id', 'product_id']);
            $table->index(['product_id', 'is_approved']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_ratings');
    }
};