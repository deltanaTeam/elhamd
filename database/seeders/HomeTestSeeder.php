<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\{
    Brand, Category, Product, Offer, User, UserProductRating, Order, OrderItem
};
use Illuminate\Support\Facades\Hash;

class HomeTestSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // ====== Brands ======
        // Brand::factory()->count(5)->create([
        //     'active' => true,
        //     'position' => $faker->unique()->numberBetween(1, 10),
        // ]);
        //
        // // ====== Categories ======
        // Category::factory()->count(5)->create([
        //     'active' => true,
        //     'position' => $faker->unique()->numberBetween(1, 10),
        // ]);

        // ====== Products ======
        $brands = Brand::all();
        $categories = Category::all();

        $products = collect();

        foreach (range(1, 20) as $i) {
            
            $product = Product::create([
                'name->ar'        => $faker->word . ' ar' . $i,
                'name->en'        => $faker->word . ' en ' . $i,
                'generic_name' => $faker->word ."KLM" .$i ,
                'description->ar'        => $faker->sentence . ' ar' . $i,
                'description->en'        => $faker->sentence . ' en ' . $i,
                'price'       => $faker->randomFloat(2, 50, 500),
                'active'      => true,
                'show_home'   => true,
                'is_featured' => $faker->boolean(40),
                'brand_id'    => $brands->random()->id,
                'category_id' => $categories->random()->id,
                'pharmacy_id' => 1,
                'type->ar'    =>  'دواء',
                'type->en'    => 'medicine',

                'form->ar'        => 'أقراص',
                'form->en'        => 'tablets ',

                'strength'    => '500mg',
                'tax_rate'    => 5,
                'min_stock'   => 10,
                'quantity'    => 100 *$i,
                'batch_number'=> strtoupper($faker->bothify('BN###??')),
                'production_date' => now()->subMonths(rand(1, 12)),
                'expiry_date'     => now()->addMonths(rand(6, 24)),
                'position'        => $faker->numberBetween(1, 100),
            ]);

            // ====== Offers ======
            if ($faker->boolean(60)) {
                Offer::create([
                    'product_id'    => $product->id,
                    'pharmacy_id'   => 1,
                    'type'          => 'discount',
                    'discount_type' => 'percentage',
                    'value'         => $faker->randomFloat(2, 5, 30), // 5% - 30%
                    'start_date'    => now()->subDays(10),
                    'end_date'      => now()->addDays(10),
                    'is_active'     => true,
                    'title'         => 'خصم خاص',
                    'description'   => 'عرض مؤقت على هذا المنتج',
                    'min_quantity'  => 1,
                ]);
            }

            $products->push($product);

            // ====== Ratings ======
            foreach (range(1, 3) as $j) {
              $userId = User::inRandomOrder()->first()->id ?? 1;

                UserProductRating::updateOrCreate( [
                    'user_id' => $userId,
                    'product_id' => $product->id
                ],
                [
                    'rate' => $faker->numberBetween(3, 5),
                    'rate_text' => $faker->sentence,
                ]);
            }
        }

        // ====== Orders & OrderItems ======
        foreach (range(1, 20) as $i) {
            $order = Order::create([
                'user_id' => 1,
                'pharmacy_id' => 1,
                'status' => 'delivered',
                'subtotal' => 0,
                'order_discount' => 0,
                'total' => 0,
                'paid_from_wallet' => 0,
                'paid_by_card' => 0,
                'is_paid' => true,
                'payment_type' => 'wallet',
                'due_date' => now()->addDays(7),
                'paid_amount' => 0,
                'remaining_amount' => 0,
            ]);

            $subtotal = 0;
            $orderDiscount = 0;

            foreach ($products->random(rand(1, 4)) as $product) {
                $qty = rand(1, 5);
                $price = $product->price;
                $productSubtotal = $price * $qty;

                // check if product has offer
                $offer = $product->offer;
                $discount = 0;

                if ($offer && $offer->is_active && now()->between($offer->start_date, $offer->end_date)) {
                    if ($offer->discount_type === 'percentage') {
                        $discount = ($price * $offer->value / 100) * $qty;
                    } elseif ($offer->discount_type === 'fixed') {
                        $discount = $offer->value * $qty;
                    }
                }

                $total = $productSubtotal - $discount;

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'price'      => $price,
                    'quantity'   => $qty,
                    'discount'   => $discount,
                    'subtotal'   => $productSubtotal,
                    'total'      => $total,
                ]);

                $subtotal += $productSubtotal;
                $orderDiscount += $discount;
            }

            $order->update([
                'subtotal'       => $subtotal,
                'order_discount' => $orderDiscount,
                'total'          => $subtotal - $orderDiscount,
                'paid_amount'    => $subtotal - $orderDiscount,
            ]);
        }
    }
}
