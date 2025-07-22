<?php
// database/migrations/YYYY_MM_DD_add_rating_fields_to_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('ratings_count')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);
            $table->json('rating_breakdown')->nullable();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['ratings_count', 'average_rating', 'rating_breakdown']);
        });
    }
};