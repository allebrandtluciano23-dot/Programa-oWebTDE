<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featured = Product::latest()->take(4)->get();

        return view('home', ['featured' => $featured]);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $cat = $request->query('cat');

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
            ->paginate(12);

        return view('search', [
            'products' => $products,
            'query' => $query,
            'cat' => $cat,
        ]);
    }

    public function product($name, $id)
    {
        $product = Product::findOrFail($id);

        return view('product', ['product' => $product]);
    }

    public function cart()
    {
        return view('cart');
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function favorites()
    {
        return view('favorites');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }
}