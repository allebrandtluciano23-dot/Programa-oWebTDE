@extends('layouts.app')

@section('title', 'Meus Pedidos - Moltro')

@section('content')

    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-8">Meus Pedidos</h1>

        @if ($orders->isEmpty())
            <div class="text-center py-20 text-gray-400">
                <p class="text-5xl mb-4">📦</p>
                <p class="text-lg font-semibold">Você ainda não fez nenhum pedido.</p>
                <a href="/busca" class="mt-4 inline-block text-violet-500 hover:underline">Explorar produtos</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <a href="/meus-pedidos/{{ $order->id }}"
                       class="block bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-xs text-gray-400">Pedido #{{ $order->id }}</span>
                                <p class="font-bold text-gray-900 mt-0.5">
                                    R$ {{ number_format($order->total, 2, ',', '.') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    @if($order->status === 'entregue') bg-green-100 text-green-700
                                    @elseif($order->status === 'cancelado') bg-red-100 text-red-600
                                    @elseif($order->status === 'enviado') bg-blue-100 text-blue-700
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $order->created_at->format('d/m/Y \à\s H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            @foreach ($order->items->take(4) as $item)
                                <img src="{{ $item->product_image ?? '' }}" alt="{{ $item->product_name }}"
                                     class="w-12 h-12 rounded-xl object-cover bg-gray-100">
                            @endforeach
                            @if ($order->items->count() > 4)
                                <span class="text-xs text-gray-400">+{{ $order->items->count() - 4 }} itens</span>
                            @endif
                        </div>

                        <p class="text-xs text-gray-400 mt-3">
                            {{ $order->items->count() }} {{ $order->items->count() === 1 ? 'item' : 'itens' }} ·
                            {{ match($order->payment_method) {
                                'cartao' => 'Cartão de crédito',
                                'pix'    => 'Pix',
                                'boleto' => 'Boleto',
                                default  => $order->payment_method,
                            } }}
                        </p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

@endsection
