<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $cat = $request->query('cat');
        $page = max((int) $request->query('page', 1), 1);
        $limit = max((int) $request->query('limit', 10), 1);

        $products = Product::query()
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q2) use ($query) {
                    $q2->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%")
                        ->orWhere('color', 'like', "%{$query}%")
                        ->orWhere('size', 'like', "%{$query}%");
                });
            })
            ->when($cat, function ($q) use ($cat) {
                $q->where('category', $cat);
            })
            ->paginate($limit, ['*'], 'page', $page);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'image' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}