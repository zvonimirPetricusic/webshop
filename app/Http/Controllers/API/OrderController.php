<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\OrderModifiers\OrderModifierInterface;
use App\Helper\OrderModifiers\TaxModifier;
use App\Helper\OrderModifiers\DiscountModifier;
use App\Helper\ProductDetails;
use App\Helper\Response;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $modifiers = [];

    public function addModifier(OrderModifierInterface $modifier)
    {
        $this->modifiers[] = $modifier;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $products = $request->input('products');
            $total_price = 0;
            $contract_list_id = null;
            $user_id = $request->query('user_id');
            $price_list_id = $request->query('price_list_id');

            $order = Order::create([
                'user_id' => $user_id,
                'total_price' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $user = User::find($user_id);
            if ($user && $user->contract_list_id) {
                $contract_list_id = $user->contract_list_id;
            }

            foreach ($products as $product) {
                $query = ProductDetails::getProductPrice($contract_list_id, $price_list_id);

                $p = $query->where('products.sku', $product['sku'])->first();
                if(!$p){
                    continue;
                }

                $quantity = $product['quantity'];
                $price = $p->effective_price;
                $total_price += $price * $quantity;

                OrderProduct::create([
                    'order_id' => $order->id,
                    'sku' => $p->sku,
                    'price' => $price,
                    'quantity' => $quantity
                ]);
            }

            $this->addModifier(new TaxModifier(0.25));

            if ($total_price > 100) {
                $this->addModifier(new DiscountModifier(0.10)); 
            }

            foreach ($this->modifiers as $modifier) {
                $total_price = $modifier->apply($total_price);

                $order->modifiers()->create([
                    'modifier_type' => $modifier->getType(),
                    'value' => $modifier->getValue()
                ]);
            }

            $order->total_price = $total_price;
            $order->save(); 

            DB::commit();

            return Response::success($order, 'Order created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::error('An error occurred!', 500);
        }
    }

}
