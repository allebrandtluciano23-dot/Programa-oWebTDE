@extends('layouts.admin')

@section('title', 'Produtos - Admin')
@section('page-title', 'Produtos')

@section('header-action')
    <a href="/admin/produtos/criar"
       class="bg-violet-500 text-white text-sm font-semibold px-5 py-2 rounded-full hover:bg-violet-600 transition">
        + Novo produto
    </a>
@endsection

@section('content')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 font-semibold text-gray-500">Imagem</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-500">Nome</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-500">Categoria</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-500">Preço</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-500">Estoque</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3">
                            <img src="{{ $product->image ?? 'https://placehold.co/56x56?text=?' }}"
                                 alt="{{ $product->name }}"
                                 class="w-14 h-14 object-cover rounded-xl bg-gray-100">
                        </td>
                        <td class="px-6 py-3 font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-3 text-gray-500 capitalize">{{ $product->category ?? '—' }}</td>
                        <td class="px-6 py-3 font-semibold text-violet-500">
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                {{ $product->stock }} un.
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3 justify-end">
                                <a href="/admin/produtos/{{ $product->id }}/editar"
                                   class="text-gray-500 hover:text-violet-500 transition font-medium">
                                    Editar
                                </a>
                                <form method="POST" action="/admin/produtos/{{ $product->id }}"
                                      onsubmit="return confirm('Remover {{ $product->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition font-medium">
                                        Remover
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            Nenhum produto cadastrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>

@endsection
