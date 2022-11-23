<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(20)->create()->each(function (Category $category) {
            Product::factory(1)->create([
                "category_id" => $category->id
            ])->each(function (Product $product) use ($category) {
                Option::factory(1)->create()->each(function (Option $option) use ($category, $product) {
                    ProductOption::factory(5)->create([
                        "product_id" => $product->id,
                        "option_id" => $option->id,
                    ]);
                    Order::factory(5)->create()->each(function (Order $order) use ($product) {
                        OrderProduct::factory(2)->create([
                            "order_id" => $order->id,
                            "product_id" => $product->id,
                        ]);
                    });
                });
            });
        });

         User::factory(5)->create();
    }
}
