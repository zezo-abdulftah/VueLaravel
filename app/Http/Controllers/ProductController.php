<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::orderBy('id', 'DESC');

        if ($request->has('search') and $request->search !='') {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        // Filter by minimum price (only if min_price is provided)
        if ($request->has('min_price') and $request->min_price !='') {
            $query->where('price', '>=', $request->input('min_price'));
        }

        // Filter by maximum price (only if max_price is provided)
        if ($request->has('max_price') and $request->max_price !='') {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Paginate the results
        $perPage = $request->input('per_page', 10); // Items per page (default: 10)
        $products = $query->paginate($perPage);

        return response()->json($products);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $product = Product::create($request->all());

        return response()->json($product, 201);
    }
}
