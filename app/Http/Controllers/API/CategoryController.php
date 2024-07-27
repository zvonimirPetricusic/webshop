<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Helper\Response;
use App\Helper\ProductDetails;

class CategoryController extends Controller
{
    public function listProducts(Request $request, Category $category)
    {
        $query = $category->products();

        $user_id = $request->query('user_id');
        $price_list_id = $request->query('price_list_id');
        $contract_list_id = null;
        if ($user_id) {
            $user = User::find($user_id);
            if ($user && $user->contract_list_id) {
                $contract_list_id = $user->contract_list_id;
            }
        }

        $query = ProductDetails::getProductPrice($contract_list_id, $price_list_id);

        $data = $query->paginate(10);

        $data = [
            'product_data' => $data->items(),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'per_page' => $data->perPage(),
            'total' => $data->total(),
            'prev_page_url' => $data->previousPageUrl(),
            'next_page_url' => $data->nextPageUrl()
        ];

        return Response::success($data, 'Data retrieved successfully');
    }

}
