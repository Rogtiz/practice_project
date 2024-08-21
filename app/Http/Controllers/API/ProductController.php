<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate($request->get('limit', 10));

        return response()->json($products);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }
}
