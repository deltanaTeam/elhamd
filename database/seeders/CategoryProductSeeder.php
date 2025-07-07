<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('category_product')->insert([
            ['category_id' => 3, 'product_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 4, 'product_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
