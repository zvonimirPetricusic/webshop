<?php

namespace App\Helper;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductDetails
{
    public static function getProductPrice($contract_list_id = null, $price_list_id = null)
    {
        $query = Product::query();
        $effective_price = 'products.price AS effective_price';
    
        if ($contract_list_id) {
            $query->leftJoin('contract_list_products', 'products.sku', '=', 'contract_list_products.sku')
                  ->where('contract_list_products.contract_list_id', '=', $contract_list_id);
    
            $effective_price = 'COALESCE(contract_list_produ0cts.price, products.price) AS effective_price';
        }
    
        if ($price_list_id) {
            $query->leftJoin('price_list_products', 'products.sku', '=', 'price_list_products.sku')
                  ->where('price_list_products.price_list_id', '=', $price_list_id);
    
            if ($contract_list_id) {
                $effective_price = 'COALESCE(contract_list_products.price, price_list_products.price, products.price) AS effective_price';
            } else {
                $effective_price = 'COALESCE(price_list_products.price, products.price) AS effective_price';
            }
        }
    
        $query->select('products.*', DB::raw($effective_price))
              ->groupBy('products.sku', 'effective_price');
    
        return $query;
    }
    
}
