<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Option;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductOption;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Category::factory(5)->create()->each(function (Category $category) {
            Product::factory(5)->create([
                "category_id" => $category->id
            ])->each(function (Product $product) use ($category) {
                Order::factory(1)->create()->each(function (Order $order) use ($product) {
                    OrderProduct::factory(1)->create([
                        "order_id" => $order->id,
                        "product_id" => $product->id,
                    ])->each(function (OrderProduct $orderProduct) use ($product) {
                        Option::factory(3)->create([
                            "product_id" => $product->id
                        ])->each(function (Option $option) use ($orderProduct) {
                            OrderProductOption::factory(3)->create([
                                "order_product_id" => $orderProduct->id,
                                "name" => $option->name
                            ]);
                        });

                    });
                });
            });
        });
        User::factory(5)->create();
    }
}
