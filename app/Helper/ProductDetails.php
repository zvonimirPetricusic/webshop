<?php

namespace App\Helper;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductDetails
{
    public static function getProductPrice($contract_list_id, $price_list_id)
    {
        $query = Product::query();

        $query->leftJoin('contract_list_products', function ($join) use ($contract_list_id) {
            $join->on('products.sku', '=', 'contract_list_products.sku')
                 ->where('contract_list_products.contract_list_id', '=', $contract_list_id);
        });

        $query->leftJoin('price_list_products', function ($join) use ($price_list_id) {
            $join->on('products.sku', '=', 'price_list_products.sku')
                 ->where('price_list_products.price_list_id', '=', $price_list_id);
        });

        $query->select(
            'products.*',
            DB::raw('COALESCE(contract_list_products.price, price_list_products.price, products.price) AS effective_price')
        )->groupBy('products.sku', 'effective_price');

        return $query;
    }
}
