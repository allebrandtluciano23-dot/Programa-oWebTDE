@extends('layouts.app')

@section('title', 'Busca - Moltro')

@section('banner')
    @if ($cat)
        <section class="relative overflow-hidden h-52 flex items-center bg-slate-800">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-violet-950 to-slate-800"></div>
            <div class="relative z-10 px-10 md:px-20">
                <span class="text-violet-500 text-xs font-semibold uppercase tracking-widest">Categoria</span>
                <h1 class="text-4xl font-extrabold text-white uppercase mt-1">{{ $cat }}</h1>
            </div>
        </section>
    @endif
@endsection

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold">
                @if ($query)
                    Resultados para "<span class="text-violet-500">{{ $query }}</span>"
                @else
                    Todos os produtos
                @endif
            </h2>
            <p class="text-sm text-gray-500">{{ $products->total() }} produtos encontrados</p>
        </div>
    </div>

    @if ($products->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <p class="text-5xl mb-4">🔍</p>
            <p class="text-lg font-semibold">Nenhum produto encontrado.</p>
            <a href="/busca" class="mt-4 inline-block text-violet-500 hover:underline">Ver todos os produtos</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10">
            @foreach ($products as $product)
                <a href="/p/{{ \Illuminate\Support\Str::slug($product->name) }}/{{ $product->id }}"
                   class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="bg-gray-50 h-48 flex items-center justify-center overflow-hidden">
                        @if ($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                        @else
                            <span class="text-gray-300 text-sm">Sem imagem</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <span class="text-violet-500 text-xs font-semibold uppercase">{{ $product->category }}</span>
                        <h3 class="font-semibold text-gray-900 mt-1">{{ $product->name }}</h3>
                        <p class="text-gray-500 text-sm">{{ $product->color }} · {{ $product->size }}</p>
                        <p class="text-gray-900 font-bold mt-2">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="flex justify-center">
            {{ $products->links() }}
        </div>
    @endif

@endsection
