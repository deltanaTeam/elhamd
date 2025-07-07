<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ✅ دي اللي ناقصه
use Carbon\Carbon; // (اختياري) لو بتستخدم تواريخ

class cater extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'إلكترونيات', 'parent_id' => 0, 'description' => 'كل ما يخص الإلكترونيات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ملابس', 'parent_id' => 0, 'description' => 'أحدث صيحات الملابس', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
