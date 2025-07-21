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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('position')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('show_home')->default(1);
            $table->softDeletes();
            $table->enum('status',['pending','approved','rejected','admin_insert'])->default("pending");
            $table->text('reason')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
