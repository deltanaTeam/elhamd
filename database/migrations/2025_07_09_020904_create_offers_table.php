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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

              // المنتج المرتبط بالعرض
              $table->foreignId('product_id')->constrained()->onDelete('cascade');

              // عنوان ووصف العرض
              $table->string('title')->nullable();
              $table->text('description')->nullable();

              // نوع العرض: خصم أو عرض إضافي
              $table->enum('type', ['discount', 'extra'])->default('discount');

              // نوع الخصم: نسبة أو مبلغ ثابت
              $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');

              // قيمة الخصم أو العرض
              $table->decimal('value', 10, 2);

              // للعرض الإضافي (مثلاً: اشتري 2 واحصل على 1 مجانًا)
              $table->integer('min_quantity')->default(1);

              // المدة الزمنية
              $table->date('start_date')->nullable();
              $table->date('end_date')->nullable();

              // تفعيل/تعطيل العرض
              $table->boolean('is_active')->default(true);

              // الصيدلية المالكة للعرض
              $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
