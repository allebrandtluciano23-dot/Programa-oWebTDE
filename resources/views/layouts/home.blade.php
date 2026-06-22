@extends('layouts.app')

@section('title', 'Home - SneakerStore')

@section('content')

    <!-- Banner -->
    <section class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg p-10 mb-10 text-center">
        <h1 class="text-4xl font-bold mb-2">Nova Coleção de Tênis</h1>
        <p class="text-lg">Performance, conforto e estilo para todos os momentos.</p>
        <a href="/busca" class="inline-block mt-4 bg-white text-orange-600 font-semibold px-6 py-2 rounded hover:bg-gray-100">
            Ver Produtos
        </a>
    </section>

    <!-- Produtos em destaque -->
    <h2 class="text-2xl font-bold mb-4">Destaques</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($featured as $product)
            <a href="/p/{{ \Illuminate\Support\Str::slug($product->name) }}/{{ $product->id }}"
               class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">
                <div class="bg-gray-100 h-40 rounded mb-3 flex items-center justify-center text-gray-400">
                    {{ $product->image }}
                </div>
                <h3 class="font-semibold">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500">{{ $product->category }}</p>
                <p class="text-orange-600 font-bold mt-2">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
            </a>
        @endforeach
    </div>

@endsection