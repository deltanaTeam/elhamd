<?php

namespace Database\Seeders;

use App\Models\Pharmacist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PharmacistWithTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // استخدام firstOrCreate لضمان أن قيمة firebase_uid تكون فريدة
        $pharmacist = Pharmacist::firstOrCreate([
            'firebase_uid' => 'pharmacist-12345', // تأكد أن هذه القيمة فريدة
        ], [
            'name' => 'Ahmed Khaled',
            'email' => 'ahmed.khaled@example.com',
            'password' => Hash::make('password123'), // تعيين كلمة مرور
            'is_verified' => true,
            'pharmacy_id' => 1, // تعيين pharmacy_id صالح
            'address' => '123 Pharmacy Street',
            'phone' => '01012345678',
        ]);

        // حذف أي توكنات سابقة
        $pharmacist->tokens()->delete();

        // إنشاء توكن جديد
        $token = $pharmacist->createToken('pharmacist-token')->plainTextToken;

        // إضافة التوكن للـ pharmacist
        $pharmacist->firebase_uid = $token;
        $pharmacist->save();

        // إذا أردت عرض التوكن في الكونسول (اختياري)
        echo "Pharmacist Token: " . $token . PHP_EOL;
    }
}
