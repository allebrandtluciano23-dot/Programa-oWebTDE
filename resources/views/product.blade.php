@extends('layouts.app')

@section('title', $product->name . ' - Moltro')

@section('content')

    <div class="text-sm text-gray-400 mb-6">
        <a href="/" class="hover:text-violet-500">Home</a> /
        <a href="/busca?cat={{ $product->category }}" class="hover:text-violet-500">{{ $product->category }}</a> /
        <span class="text-gray-700">{{ $product->name }}</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

        <!-- Imagem -->
        <div class="bg-gray-50 rounded-2xl h-96 overflow-hidden border border-gray-100">
            @if ($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-300 text-sm">Sem imagem</div>
            @endif
        </div>

        <!-- Detalhes -->
        <div class="flex flex-col justify-center">
            <span class="text-violet-500 text-xs font-semibold uppercase tracking-widest mb-2">{{ $product->category }}</span>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $product->name }}</h1>

            <p class="text-3xl font-bold text-gray-900 mb-6">
                R$ {{ number_format($product->price, 2, ',', '.') }}
            </p>

            <p class="text-gray-600 mb-6 leading-relaxed">{{ $product->description }}</p>

            <ul class="grid grid-cols-2 gap-2 text-sm text-gray-600 mb-8">
                <li class="bg-gray-50 rounded-lg px-4 py-2"><strong>Material:</strong> {{ $product->color }}</li>
                <li class="bg-gray-50 rounded-lg px-4 py-2"><strong>Tamanho:</strong> {{ $product->size }}</li>
                <li class="bg-gray-50 rounded-lg px-4 py-2"><strong>Peso:</strong> {{ $product->weight }} kg</li>
            </ul>

            <div class="flex items-center gap-3 mb-6">
                <label class="font-medium text-sm">Quantidade:</label>
                <div class="flex items-center border border-gray-300 rounded-full overflow-hidden">
                    <button onclick="changeQty(-1)" class="px-4 py-2 hover:bg-gray-100 text-lg font-bold">-</button>
                    <input type="number" id="qty" value="1" min="1" max="{{ $product->stock }}"
                           class="w-12 text-center text-sm focus:outline-none border-none">
                    <button onclick="changeQty(1)" class="px-4 py-2 hover:bg-gray-100 text-lg font-bold">+</button>
                </div>
            </div>

            <div class="flex gap-4 items-center">
                <button id="add-to-cart"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->price }}"
                        data-image="{{ $product->image }}"
                        class="w-full bg-violet-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-violet-600 transition">
                    Adicionar ao carrinho
                </button>

                <button id="fav-btn" data-id="{{ $product->id }}"
                        class="p-3 border border-gray-300 rounded-full hover:border-violet-500 hover:text-violet-500 transition">
                    <svg id="fav-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                    </svg>
                </button>
            </div>

            <p id="add-msg" class="text-green-600 text-sm mt-4 hidden">✓ Produto adicionado ao carrinho!</p>

            <button id="buy-now"
                    data-id="{{ $product->id }}"
                    data-name="{{ $product->name }}"
                    data-price="{{ $product->price }}"
                    data-image="{{ $product->image }}"
                    class="w-full mt-3 border-2 border-gray-900 text-gray-900 font-semibold py-3 rounded-full text-center hover:bg-gray-900 hover:text-white transition block">
                Finalizar compra
            </button>
        </div>
    </div>

    <script>
        function changeQty(delta) {
            const input = document.getElementById('qty');
            input.value = Math.max(1, parseInt(input.value) + delta);
        }

        document.getElementById('add-to-cart').addEventListener('click', function () {
            const id = this.dataset.id;
            const qty = parseInt(document.getElementById('qty').value) || 1;
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const existing = cart.find(item => item.productId == id);
            if (existing) {
                existing.qty += qty;
            } else {
                cart.push({ productId: parseInt(id), qty: qty });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            const msg = document.getElementById('add-msg');
            msg.classList.remove('hidden');
            setTimeout(() => msg.classList.add('hidden'), 2000);
        });

        const favBtn = document.getElementById('fav-btn');
        const favIcon = document.getElementById('fav-icon');
        const favId = parseInt(favBtn.dataset.id);

        function refreshFavState() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            if (favorites.includes(favId)) {
                favIcon.setAttribute('fill', '#f97316');
                favIcon.setAttribute('stroke', '#f97316');
            } else {
                favIcon.setAttribute('fill', 'none');
                favIcon.setAttribute('stroke', 'currentColor');
            }
        }

        favBtn.addEventListener('click', function () {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            if (favorites.includes(favId)) {
                favorites = favorites.filter(id => id !== favId);
            } else {
                favorites.push(favId);
            }
            localStorage.setItem('favorites', JSON.stringify(favorites));
            refreshFavState();
        });

        refreshFavState();

        document.getElementById('buy-now').addEventListener('click', function () {
            const id = parseInt(this.dataset.id);
            const qty = parseInt(document.getElementById('qty').value) || 1;
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const existing = cart.find(item => item.productId === id);
            if (existing) {
                existing.qty += qty;
            } else {
                cart.push({ productId: id, qty: qty });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            window.location.href = '/checkout';
        });
    </script>

@endsection
