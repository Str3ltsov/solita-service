<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartStatus;
use App\Models\Product;
use App\Models\User;
use App\Repositories\CartRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use DB;


class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for ($i=0; $i<=30; $i++){
            $this->createCart(2, 5, 5);
        }
    }

    public function createCart($userID, $maxProducts, $itemProductCount ) {
        $faker = Faker::create();
        $firstStatus = CartStatus::query()
            ->first();

        $firstAdmin = User::query()
            ->where('type', 1)
            ->first();

        $cart = new Cart([
            'user_id' => $userID,
            'code' => Hash::make($faker->password),
            'status_id' => $firstStatus->id,
            'admin_id' => $firstAdmin->id,
        ]);
        $cart->save();

        $count = rand(1,$maxProducts);
        for($i=1; $i <= $count; $i++) {
            $product = Product::find(rand(1,200));
            // if isset product
            if (null !== $product) {
                // getOrSet CartItem
                $cartItem = CartItem::query()
                    ->where([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                    ])
                    ->first();

                if (null === $cartItem) {
                    $cartItem = new CartItem([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                        'price_current' => $product->price,
                        'count' => rand(1,$itemProductCount),
                    ]);
                    $cartItem->save();
                }
                else {
                    $cartItem->increment('count', rand(1,$itemProductCount));
                    $cartItem->save();
                }
            }
        }
        $cartRepository = new CartRepository(app());
        $cartRepository->cartSum($cart);
    }
}
