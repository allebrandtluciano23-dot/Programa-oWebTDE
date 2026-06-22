@extends('layouts.app')

@section('title', 'Carrinho - Moltro')

@section('content')

    <!-- Toast -->
    <div id="toast" class="hidden fixed top-6 right-6 bg-gray-900 text-white text-sm px-5 py-3 rounded-xl shadow-lg z-50 transition-all"></div>

    <h1 class="text-2xl font-bold mb-8">Seu Carrinho</h1>

    <div id="empty-msg" class="hidden text-center py-20 text-gray-400">
        <p class="text-5xl mb-4">🛒</p>
        <p class="text-lg font-semibold">Seu carrinho está vazio.</p>
        <a href="/busca" class="mt-4 inline-block text-violet-500 hover:underline">Continuar comprando</a>
    </div>

    <div id="cart-content" class="hidden grid grid-cols-1 md:grid-cols-3 gap-10">

        <div class="md:col-span-2 space-y-4" id="cart-items"></div>

        <div class="bg-gray-50 rounded-2xl p-6 h-fit border border-gray-100">
            <h2 class="text-lg font-bold mb-6">Resumo do pedido</h2>

            <div class="space-y-3 text-sm text-gray-600 mb-6">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span id="subtotal" class="font-semibold text-gray-900">R$ 0,00</span>
                </div>
                <div class="flex justify-between">
                    <span>Frete</span>
                    <span id="freight" class="font-semibold text-gray-900">R$ 0,00</span>
                </div>
                <div class="flex justify-between text-green-600">
                    <span>Desconto</span>
                    <span id="discount" class="font-semibold">- R$ 0,00</span>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4 mb-6">
                <div class="flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span id="total">R$ 0,00</span>
                </div>
            </div>

            <div class="flex gap-2 mb-4">
                <input type="text" id="cupom" placeholder="Cupom (ex: URI10)"
                       class="border border-gray-300 rounded-full px-4 py-2 text-sm flex-1 focus:outline-none focus:border-violet-400">
                <button id="apply-cupom" class="bg-gray-900 text-white px-4 py-2 rounded-full text-sm hover:bg-violet-500 transition">
                    Aplicar
                </button>
            </div>

            <a href="/checkout"
               class="block w-full bg-violet-500 text-white font-semibold py-3 rounded-full hover:bg-violet-600 transition text-center">
                Finalizar Compra
            </a>
        </div>
    </div>

    <script>
        function showToast(msg) {
            const t = document.getElementById('toast');
            t.textContent = msg;
            t.classList.remove('hidden');
            setTimeout(() => t.classList.add('hidden'), 2500);
        }

        async function loadCart() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const emptyMsg = document.getElementById('empty-msg');
            const content = document.getElementById('cart-content');

            if (cart.length === 0) {
                emptyMsg.classList.remove('hidden');
                content.classList.add('hidden');
                updateCartBadge(0);
                return;
            }

            emptyMsg.classList.add('hidden');
            content.classList.remove('hidden');

            const cupom = document.getElementById('cupom').value || null;

            try {
                const res = await fetch('/api/cart', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        items: cart.map(i => ({ productId: i.productId, qty: i.qty })),
                        cupomCode: cupom
                    })
                });

                if (!res.ok) { showToast('Erro ao carregar carrinho.'); return; }

                const data = await res.json();
                render(data, cart);
                updateCartBadge(cart.reduce((s, i) => s + i.qty, 0));
            } catch (e) {
                showToast('Erro de conexão. Tente novamente.');
            }
        }

        function render(data, cart) {
            const itemsContainer = document.getElementById('cart-items');
            itemsContainer.innerHTML = '';

            data.items.forEach(item => {
                const div = document.createElement('div');
                div.className = 'bg-white border border-gray-100 rounded-2xl p-4 flex items-center gap-4 shadow-sm';
                div.innerHTML = `
                    <div class="w-24 h-24 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                        ${item.image
                            ? `<img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover" loading="lazy">`
                            : `<div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">Sem imagem</div>`}
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">${item.name}</h3>
                        <p class="text-violet-500 font-bold mt-1">R$ ${item.price.toFixed(2).replace('.', ',')}</p>
                    </div>
                    <div class="flex items-center border border-gray-200 rounded-full overflow-hidden text-sm">
                        <button class="qty-btn px-3 py-1 hover:bg-gray-100" data-id="${item.productId}" data-action="dec">-</button>
                        <span class="px-3">${item.qty}</span>
                        <button class="qty-btn px-3 py-1 hover:bg-gray-100" data-id="${item.productId}" data-action="inc">+</button>
                    </div>
                    <button class="remove-btn text-gray-300 hover:text-red-500 ml-2 transition" data-id="${item.productId}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                `;
                itemsContainer.appendChild(div);
            });

            document.getElementById('subtotal').textContent = 'R$ ' + data.subtotal.toFixed(2).replace('.', ',');
            document.getElementById('freight').textContent = data.freight === 0 ? 'Grátis 🎉' : 'R$ ' + data.freight.toFixed(2).replace('.', ',');
            document.getElementById('discount').textContent = '- R$ ' + data.discount.toFixed(2).replace('.', ',');
            document.getElementById('total').textContent = 'R$ ' + data.total.toFixed(2).replace('.', ',');

            itemsContainer.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = parseInt(btn.dataset.id);
                    const action = btn.dataset.action;
                    const item = cart.find(i => i.productId === id);
                    if (action === 'inc') item.qty += 1;
                    if (action === 'dec') item.qty = Math.max(1, item.qty - 1);
                    localStorage.setItem('cart', JSON.stringify(cart));
                    showToast('Quantidade atualizada.');
                    loadCart();
                });
            });

            itemsContainer.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = parseInt(btn.dataset.id);
                    localStorage.setItem('cart', JSON.stringify(cart.filter(i => i.productId !== id)));
                    showToast('Item removido do carrinho.');
                    loadCart();
                });
            });
        }

        function updateCartBadge(count) {
            const badge = document.getElementById('cart-badge');
            if (!badge) return;
            badge.textContent = count;
            badge.classList.toggle('hidden', count === 0);
        }

        document.getElementById('apply-cupom').addEventListener('click', () => {
            showToast('Cupom aplicado!');
            loadCart();
        });

        loadCart();
    </script>

@endsection
