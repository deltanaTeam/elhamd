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
            ['name' => 'إلكترونيات',  'reason' => 'كل ما يخص الإلكترونيات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ملابس', 'reason' => 'أحدث صيحات الملابس', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('brands')->insert([
            ['name' => 'hp',  'reason' => 'كل ما يخص الإلكترونيات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'gucci', 'reason' => 'أحدث صيحات الملابس', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
