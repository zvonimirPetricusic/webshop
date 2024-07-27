<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContractListProduct;
use App\Models\ContractList;
use App\Models\Product;

class ContractListProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contract_lists = ContractList::factory()->count(5)->create();
        $products = Product::all();

        foreach ($contract_lists as $contract_list) {
            foreach ($products as $product) {
                ContractListProduct::create([
                    'sku' => $product->sku,
                    'price' => $product->price - rand(30, 40),
                    'contract_list_id' => $contract_list->id,
                ]);
            }
        }

    }
}
