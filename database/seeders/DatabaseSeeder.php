<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $user = User::firstOrCreate([
       'first_name' =>'first name',
       'last_name' =>'last name',
       'age'=>20,
       'gender'=>"female",
       'email' =>'clientemail@gmail.com',
       'firebase_uid' => "123456789",
       'password' => Hash::make('user123'),
       'is_verified' => true,

     ]);
     $user->tokens()->delete();
     $usertoken = $user->createToken('client-token')->plainTextToken;
     $this->call([
      BrandsTableSeeder::class,
      CategoriesTableSeeder::class,
      PharmacySeeder::class,
      UserWithTokenSeeder::class,
        cater::class,HomeTestSeeder::class
    ]);
    }
}
