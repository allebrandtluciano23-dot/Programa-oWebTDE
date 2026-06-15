<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.productId' => 'required|integer|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'cupomCode' => 'nullable|string',
        ]);

        $items = [];
        $subtotal = 0;

        foreach ($validated['items'] as $item) {
            $product = Product::find($item['productId']);

            $lineTotal = $product->price * $item['qty'];
            $subtotal += $lineTotal;

            $items[] = [
                'productId' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'qty' => $item['qty'],
                'image' => $product->image,
            ];
        }

        $freight = $subtotal >= 200 ? 0 : 25;

        $discount = 0;
        $cupom = $validated['cupomCode'] ?? null;

        if ($cupom && strtoupper($cupom) === 'URI10') {
            $discount = $subtotal * 0.10;
        }

        $total = $subtotal + $freight - $discount;

        return response()->json([
            'items' => $items,
            'subtotal' => round($subtotal, 2),
            'freight' => $freight,
            'discount' => round($discount, 2),
            'total' => round($total, 2),
        ]);
    }
}