<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.index', compact('products'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'nullable|string|max:100',
            'color'       => 'nullable|string|max:100',
            'size'        => 'nullable|string|max:100',
            'weight'      => 'nullable|numeric|min:0',
            'image'       => 'nullable|url',
        ]);

        Product::create($data);

        return redirect('/admin')->with('success', 'Produto criado com sucesso!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'nullable|string|max:100',
            'color'       => 'nullable|string|max:100',
            'size'        => 'nullable|string|max:100',
            'weight'      => 'nullable|numeric|min:0',
            'image'       => 'nullable|url',
        ]);

        $product->update($data);

        return redirect('/admin')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect('/admin')->with('success', 'Produto removido com sucesso!');
    }
}
