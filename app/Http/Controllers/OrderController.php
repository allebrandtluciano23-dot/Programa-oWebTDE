<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'    => 'required|string',
            'customer_email'   => 'required|email',
            'customer_phone'   => 'nullable|string',
            'address'          => 'nullable|string',
            'payment_method'   => 'required|in:cartao,pix,boleto',
            'subtotal'         => 'required|numeric',
            'freight'          => 'required|numeric',
            'discount'         => 'required|numeric',
            'total'            => 'required|numeric',
            'items'            => 'required|array|min:1',
            'items.*.productId'=> 'required|integer',
            'items.*.qty'      => 'required|integer|min:1',
        ]);

        $order = DB::transaction(function () use ($data) {
            $order = Order::create([
                'user_id'        => Auth::id(),
                'customer_name'  => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'] ?? null,
                'address'        => $data['address'] ?? null,
                'subtotal'       => $data['subtotal'],
                'freight'        => $data['freight'],
                'discount'       => $data['discount'],
                'total'          => $data['total'],
                'payment_method' => $data['payment_method'],
                'status'         => 'pendente',
            ]);

            foreach ($data['items'] as $item) {
                $product = Product::find($item['productId']);
                $order->items()->create([
                    'product_id'    => $item['productId'],
                    'product_name'  => $product?->name ?? 'Produto removido',
                    'product_image' => $product?->image,
                    'price'         => $product?->price ?? 0,
                    'qty'           => $item['qty'],
                ]);
            }

            return $order;
        });

        return response()->json(['message' => 'Pedido criado!', 'order_id' => $order->id], 201);
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items')
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('items')
            ->findOrFail($id);

        return view('order-detail', compact('order'));
    }
}
