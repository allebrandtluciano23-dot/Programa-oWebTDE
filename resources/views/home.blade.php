@extends('layouts.app')

@section('title', 'Home - SneakerStore')

@section('banner')
    <section class="relative bg-gray-900 overflow-hidden h-[520px] flex items-center">
        {{-- TODO: adicionar <img src="URL" class="absolute inset-0 w-full h-full object-cover opacity-50"> --}}
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700"></div>

        <div class="relative z-10 px-10 md:px-20 max-w-2xl">
            <span class="text-orange-500 text-sm font-semibold uppercase tracking-widest mb-3 block">Nova Coleção 2026</span>
            <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-5 leading-tight">
                Pise Com<br><span class="text-orange-500">Estilo.</span>
            </h1>
            <p class="text-gray-300 text-lg mb-8">
                Os melhores tênis para corrida, casual e muito mais.
            </p>
            <div class="flex gap-4">
                <a href="/busca" class="bg-orange-500 text-white font-semibold px-7 py-3 rounded-full hover:bg-orange-600 transition">
                    Ver Coleção
                </a>
                <a href="/busca?cat=corrida" class="border border-white text-white font-semibold px-7 py-3 rounded-full hover:bg-white hover:text-gray-900 transition">
                    Corrida
                </a>
            </div>
        </div>
    </section>
@endsection

@section('content')

    <!-- Categorias -->
    <section class="mb-16">
        <h2 class="text-2xl font-bold mb-8">Categorias</h2>
        <div class="flex flex-wrap gap-8 justify-center">
            @foreach ([
                ['label' => 'Corrida', 'cat' => 'corrida', 'bg' => 'bg-orange-100', 'text' => 'text-orange-600'],
                ['label' => 'Casual', 'cat' => 'casual', 'bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
                ['label' => 'Trilha', 'cat' => 'trilha', 'bg' => 'bg-green-100', 'text' => 'text-green-600'],
                ['label' => 'Skate', 'cat' => 'skate', 'bg' => 'bg-purple-100', 'text' => 'text-purple-600'],
                ['label' => 'Basquete', 'cat' => 'basquete', 'bg' => 'bg-red-100', 'text' => 'text-red-600'],
                ['label' => 'Chuteiras', 'cat' => 'chuteiras', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-600'],
            ] as $category)
                <a href="/busca?cat={{ $category['cat'] }}" class="flex flex-col items-center group">
                    <div class="w-28 h-28 rounded-full {{ $category['bg'] }} flex items-center justify-center mb-3 group-hover:scale-105 transition-transform overflow-hidden">
                        {{-- TODO: trocar por <img src="URL" class="w-full h-full object-cover rounded-full"> --}}
                        <span class="{{ $category['text'] }} text-3xl font-bold">{{ strtoupper(substr($category['label'], 0, 1)) }}</span>
                    </div>
                    <span class="font-semibold text-sm uppercase tracking-wide">{{ $category['label'] }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Destaques -->
    <section>
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold">Destaques</h2>
            <a href="/busca" class="text-sm text-orange-500 font-semibold hover:underline">Ver todos →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($featured as $product)
                <a href="/p/{{ \Illuminate\Support\Str::slug($product->name) }}/{{ $product->id }}"
                   class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="bg-gray-50 h-48 flex items-center justify-center text-gray-300 text-sm">
                        {{-- TODO: <img src="{{ $product->image }}" class="h-40 object-contain"> --}}
                        {{ $product->image }}
                    </div>
                    <div class="p-4">
                        <span class="text-orange-500 text-xs font-semibold uppercase">{{ $product->category }}</span>
                        <h3 class="font-semibold text-gray-900 mt-1">{{ $product->name }}</h3>
                        <p class="text-gray-500 text-sm">{{ $product->color }} · Nº {{ $product->size }}</p>
                        <p class="text-gray-900 font-bold mt-2">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

@endsection
