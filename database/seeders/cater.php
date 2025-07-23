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
  [
      'name'   => json_encode(['ar' => 'اي كلام', 'en' => 'jhjdhdje']),
      'reason' => json_encode(['ar' => 'كل ما يخص الإلكترونيات', 'en' => 'ekldnehb']),
      'created_at' => now(),
      'updated_at' => now(),
  ],
  [
      'name'   => json_encode(['ar' => 'اي كلامjkj', 'en' => 'jkjplg']),
      'reason' => json_encode(['ar' => 'أحدث صيحات الملابس', 'en' => 'hjbehnbdnj']),
      'created_at' => now(),
      'updated_at' => now(),
  ]
]);

DB::table('brands')->insert([
[
'name'   => json_encode(['ar' => 'اي كلام', 'en' => 'jhjdhdje']),
'reason' => json_encode(['ar' => 'كل ما يخص الإلكترونيات', 'en' => 'ekldnehb']),
'created_at' => now(),
'updated_at' => now(),
],
[
'name'   => json_encode(['ar' => 'اي كلامjkj', 'en' => 'jkjplg']),
'reason' => json_encode(['ar' => 'أحدث صيحات الملابس', 'en' => 'hjbehnbdnj']),
'created_at' => now(),
'updated_at' => now(),
]
]);
    }
}
