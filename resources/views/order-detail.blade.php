@extends('layouts.app')

@section('title', 'Pedido #' . $order->id . ' - Moltro')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="flex items-center gap-3 mb-8">
            <a href="/meus-pedidos" class="text-gray-400 hover:text-violet-500 transition">← Meus Pedidos</a>
            <span class="text-gray-300">/</span>
            <span class="text-gray-700 font-semibold">Pedido #{{ $order->id }}</span>
        </div>

        <!-- Status -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm mb-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400">Realizado em {{ $order->created_at->format('d/m/Y \à\s H:i') }}</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">
                        R$ {{ number_format($order->total, 2, ',', '.') }}
                    </p>
                </div>
                <span class="px-4 py-1.5 rounded-full text-sm font-semibold
                    @if($order->status === 'entregue') bg-green-100 text-green-700
                    @elseif($order->status === 'cancelado') bg-red-100 text-red-600
                    @elseif($order->status === 'enviado') bg-blue-100 text-blue-700
                    @else bg-yellow-100 text-yellow-700 @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <!-- Linha de progresso -->
            @php
                $steps = ['pendente' => 0, 'confirmado' => 1, 'enviado' => 2, 'entregue' => 3];
                $current = $steps[$order->status] ?? 0;
            @endphp
            @if ($order->status !== 'cancelado')
                <div class="mt-6">
                    <div class="flex items-center justify-between text-xs text-gray-400 mb-2">
                        @foreach(['Pendente', 'Confirmado', 'Enviado', 'Entregue'] as $i => $label)
                            <span class="{{ $i <= $current ? 'text-violet-500 font-semibold' : '' }}">{{ $label }}</span>
                        @endforeach
                    </div>
                    <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-violet-500 rounded-full transition-all"
                             style="width: {{ ($current / 3) * 100 }}%"></div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Itens -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm mb-5">
            <h2 class="font-bold text-lg mb-5">Itens do pedido</h2>
            <div class="space-y-4">
                @foreach ($order->items as $item)
                    <div class="flex items-center gap-4">
                        <img src="{{ $item->product_image ?? '' }}" alt="{{ $item->product_name }}"
                             class="w-16 h-16 rounded-xl object-cover bg-gray-100 shrink-0">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">{{ $item->product_name }}</p>
                            <p class="text-sm text-gray-400">Qtd: {{ $item->qty }}</p>
                        </div>
                        <p class="font-bold text-gray-900">
                            R$ {{ number_format($item->price * $item->qty, 2, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Resumo financeiro -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm mb-5">
            <h2 class="font-bold text-lg mb-4">Resumo</h2>
            <div class="space-y-2 text-sm text-gray-600">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span class="font-semibold text-gray-900">R$ {{ number_format($order->subtotal, 2, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Frete</span>
                    <span class="font-semibold text-gray-900">
                        {{ $order->freight == 0 ? 'Grátis' : 'R$ ' . number_format($order->freight, 2, ',', '.') }}
                    </span>
                </div>
                @if ($order->discount > 0)
                    <div class="flex justify-between text-green-600">
                        <span>Desconto</span>
                        <span class="font-semibold">- R$ {{ number_format($order->discount, 2, ',', '.') }}</span>
                    </div>
                @endif
                <div class="flex justify-between font-bold text-lg text-gray-900 border-t border-gray-100 pt-3 mt-2">
                    <span>Total</span>
                    <span>R$ {{ number_format($order->total, 2, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Pagamento e entrega -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <h2 class="font-bold mb-3">Pagamento</h2>
                <p class="text-sm text-gray-600">
                    {{ match($order->payment_method) {
                        'cartao' => 'Cartão de crédito',
                        'pix'    => 'Pix',
                        'boleto' => 'Boleto bancário',
                        default  => $order->payment_method,
                    } }}
                </p>
            </div>
            @if ($order->address)
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="font-bold mb-3">Endereço de entrega</h2>
                    <p class="text-sm text-gray-600">{{ $order->address }}</p>
                </div>
            @endif
        </div>

    </div>

@endsection
