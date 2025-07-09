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
        Schema::create('pharmacists', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('email')->unique();
          $table->string('password');
          $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');
          $table->softDeletes();
          $table->timestamp('email_verified_at')->nullable();
          $table->string('firebase_uid')->nullable()->unique();
          $table->foreignId('pharmacy_id')->nullable();
          $table->timestamp('last_login_at')->nullable();
          $table->text('address')->nullable();
          $table->string('phone')->nullable()->unique();
          $table->boolean('is_verified')->default(true);
          $table->rememberToken();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacists');
    }
};
