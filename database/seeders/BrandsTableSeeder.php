<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            [
                'name' => 'Brand 1',
                'position' => 1,
                'active' => true,
                'show_home' => true,
                'status' => 'approved',
                'reason' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Brand 2',
                'position' => 2,
                'active' => true,
                'show_home' => true,
                'status' => 'approved',
                'reason' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Brand 3',
                'position' => 3,
                'active' => false,
                'show_home' => true,
                'status' => 'pending',
                'reason' => 'Needs approval from admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // يمكنك إضافة المزيد من البيانات هنا
        ]);
    }
}
