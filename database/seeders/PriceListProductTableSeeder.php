<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PriceListProduct;
use App\Models\PriceList;
use App\Models\Product;

class PriceListProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $price_lists = PriceList::factory()->count(5)->create();
        $products = Product::all();

        foreach ($price_lists as $price_list) {
            foreach ($products as $product) {
                PriceListProduct::create([
                    'sku' => $product->sku,
                    'price' => $product->price - rand(10, 30),
                    'price_list_id' => $price_list->id,
                ]);
            }
        }

    }
}
