<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, Pharmacist};

class UserWithTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // استخدام firstOrCreate لضمان أن قيمة firebase_uid تكون فريدة
        $user = User::firstOrCreate([
            'firebase_uid' => '123456789', // يجب أن تكون هذه القيمة فريدة
        ], [
            'first_name' => 'client',
            'last_name' => 'name',
            'age' => 20,
            'gender' => 'male',
            'email' => 'clientemail@gmail.com',
            'password' => Hash::make('password123'),  // تعيين كلمة مرور
            'is_verified' => true,
        ]);
        
        // حذف أي توكنات سابقة
        $user->tokens()->delete();

        // إنشاء توكن جديد
        $usertoken = $user->createToken('client-token')->plainTextToken;

        // إضافة التوكن للمستخدم
        $user->firebase_uid = $usertoken;
        $user->save();

}}
