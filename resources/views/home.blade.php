@extends('layouts.app')

@section('title', 'Home - Moltro')

@section('banner')
    <section class="relative overflow-hidden h-[520px] flex items-center bg-slate-800">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-violet-950 to-slate-800"></div>

        <div class="relative z-10 px-10 md:px-20 max-w-2xl">
            <span class="text-violet-500 text-sm font-semibold uppercase tracking-widest mb-3 block">Nova Coleção 2026</span>
            <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-5 leading-tight">
                Use Com<br><span class="text-violet-500">Elegância.</span>
            </h1>
            <p class="text-gray-300 text-lg mb-8">
                Correntes, relógios, pulseiras e muito mais para cada ocasião.
            </p>
            <div class="flex gap-4">
                <a href="/busca" class="bg-violet-500 text-white font-semibold px-7 py-3 rounded-full hover:bg-violet-600 transition">
                    Ver Coleção
                </a>
                <a href="/busca?cat=relogios" class="border border-white text-white font-semibold px-7 py-3 rounded-full hover:bg-white hover:text-gray-900 transition">
                    Relógios
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
                ['label' => 'Correntes',  'cat' => 'correntes',  'bg' => 'bg-yellow-100',  'text' => 'text-yellow-600'],
                ['label' => 'Cordões',    'cat' => 'cordoes',    'bg' => 'bg-violet-100',  'text' => 'text-violet-600'],
                ['label' => 'Relógios',   'cat' => 'relogios',   'bg' => 'bg-blue-100',    'text' => 'text-blue-600'],
                ['label' => 'Pulseiras',  'cat' => 'pulseiras',  'bg' => 'bg-pink-100',    'text' => 'text-pink-600'],
                ['label' => 'Pingentes',  'cat' => 'pingentes',  'bg' => 'bg-purple-100',  'text' => 'text-purple-600'],
                ['label' => 'Anéis',      'cat' => 'aneis',      'bg' => 'bg-green-100',   'text' => 'text-green-600'],
            ] as $category)
                <a href="/busca?cat={{ $category['cat'] }}" class="flex flex-col items-center group">
                    <div class="w-28 h-28 rounded-full {{ $category['bg'] }} flex items-center justify-center mb-3 group-hover:scale-105 transition-transform overflow-hidden">
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
            <a href="/busca" class="text-sm text-violet-500 font-semibold hover:underline">Ver todos →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($featured as $product)
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
    </section>

@endsection
