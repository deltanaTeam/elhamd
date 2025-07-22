<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Pharmacy;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // إنشاء بيانات لصيدلية واحدة أو أكثر باستخدام Faker
        Pharmacy::create([
            'name' => [
                'ar' => $faker->word . ' ar',  // اسم الصيدلية باللغة العربية
                'en' => $faker->word . ' en',  // اسم الصيدلية باللغة الإنجليزية
            ],
        ]);

        // إذا كنت ترغب في إضافة أكثر من صيدلية، يمكن استخدام `factory` أو `create` بعدة مرات كما يلي:
        // Pharmacy::factory()->count(10)->create();
    }
}
