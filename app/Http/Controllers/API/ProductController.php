<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PriceListProduct;
use App\Models\ContractListProduct;
use App\Models\User;
use App\Http\Controllers\API\UserController;
use App\Helper\ProductDetails;
use App\Helper\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
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

    public function filterProducts(Request $request){
        $query = Product::query();
        $user_id = $request->query('user_id');
        $price_list_id = $request->query('price_list_id');
        $contract_list_id = null;

        $query = ProductDetails::getProductPrice($contract_list_id, $price_list_id);

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->query('title') . '%');
        }

        if ($request->has('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->query('category_id'));
            });
        }

        if ($request->has('min_price')) {
            $query->where('products.price', '>=', $request->query('min_price'));
        }

        if ($request->has('max_price')) {
            $query->where('products.price', '<=', $request->query('max_price'));
        }

        if ($request->has('sort_by')) {
            $sort_by = $request->query('sort_by');
            $sort_direction = $request->query('sort_direction', 'asc');

            if (in_array($sort_by, ['products.price', 'title'])) {
                $query->orderBy($sort_by, $sort_direction);
            }
        }

        if ($user_id) {
            $user = User::find($user_id);
            if ($user && $user->contract_list_id) {
                $contract_list_id = $user->contract_list_id;
            }
        }

        if ($request->has('sort_by') && $request->query('sort_by') == 'products.price') {
            $query->orderBy('effective_price', $request->query('sort_direction', 'asc'));
        }

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

    public function show(Request $request, string $id)
    {
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

        $data = $query->find($id);
        
        if($data){
            return Response::success($data, 'Data retrieved successfully');
        }else{
            return Response::error('Not found', 404);
        }

    }

}
