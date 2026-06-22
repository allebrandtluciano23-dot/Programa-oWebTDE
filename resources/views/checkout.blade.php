@extends('layouts.app')

@section('title', 'Pagamento - Moltro')

@section('content')

    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-8">Finalizar Compra</h1>

        <!-- Alerta de erro -->
        <div id="error-alert" class="hidden bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 mb-6"></div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- Formulário -->
            <div class="md:col-span-2 space-y-6">

                <!-- Dados pessoais -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="font-bold text-lg mb-5">Dados pessoais</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-1">Nome completo <span class="text-red-400">*</span></label>
                            <input type="text" id="customer_name" placeholder="João Silva"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">E-mail <span class="text-red-400">*</span></label>
                            <input type="email" id="customer_email" placeholder="seu@email.com"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Telefone</label>
                            <input type="tel" id="customer_phone" placeholder="(00) 00000-0000"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                    </div>
                </div>

                <!-- Endereço -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="font-bold text-lg mb-5">Endereço de entrega</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-1">CEP <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <input type="text" id="cep" placeholder="00000-000" maxlength="9"
                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                                <span id="cep-loading" class="hidden absolute right-3 top-3 text-gray-400 text-xs">Buscando...</span>
                            </div>
                            <p id="cep-error" class="hidden text-red-500 text-xs mt-1">CEP não encontrado.</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold mb-1">Rua <span class="text-red-400">*</span></label>
                            <input type="text" id="rua" placeholder="Rua das Joias"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Número <span class="text-red-400">*</span></label>
                            <input type="text" id="numero" placeholder="123"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Complemento</label>
                            <input type="text" id="complemento" placeholder="Apto, bloco..."
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Bairro</label>
                            <input type="text" id="bairro"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Cidade <span class="text-red-400">*</span></label>
                            <input type="text" id="cidade"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Estado</label>
                            <input type="text" id="estado" maxlength="2"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                    </div>
                </div>

                <!-- Pagamento -->
                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="font-bold text-lg mb-5">Forma de pagamento</h2>

                    <div class="flex gap-3 mb-6">
                        <button onclick="setPayment('cartao')" id="tab-cartao"
                                class="flex-1 py-2.5 rounded-xl text-sm font-semibold border-2 border-violet-500 text-violet-500 transition">
                            Cartão de crédito
                        </button>
                        <button onclick="setPayment('pix')" id="tab-pix"
                                class="flex-1 py-2.5 rounded-xl text-sm font-semibold border-2 border-gray-200 text-gray-500 transition">
                            Pix
                        </button>
                        <button onclick="setPayment('boleto')" id="tab-boleto"
                                class="flex-1 py-2.5 rounded-xl text-sm font-semibold border-2 border-gray-200 text-gray-500 transition">
                            Boleto
                        </button>
                    </div>

                    <!-- Cartão -->
                    <div id="form-cartao" class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold mb-1">Número do cartão</label>
                            <input type="text" placeholder="0000 0000 0000 0000" maxlength="19" id="card-number"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Nome no cartão</label>
                            <input type="text" id="card-name" placeholder="JOÃO SILVA"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1">Validade</label>
                                <input type="text" id="card-expiry" placeholder="MM/AA" maxlength="5"
                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1">CVV</label>
                                <input type="text" id="card-cvv" placeholder="123" maxlength="4"
                                       class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1">Parcelas</label>
                            <select id="parcelas" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400 bg-white">
                                <option value="1">1x sem juros</option>
                                <option value="2">2x sem juros</option>
                                <option value="3">3x sem juros</option>
                                <option value="6">6x sem juros</option>
                                <option value="12">12x com juros</option>
                            </select>
                        </div>
                    </div>

                    <!-- Pix -->
                    <div id="form-pix" class="hidden text-center py-6">
                        <div class="inline-block bg-gray-50 border border-gray-200 rounded-2xl p-6">
                            <div class="w-40 h-40 bg-gray-200 mx-auto rounded-xl flex items-center justify-center text-gray-400 text-sm mb-3">QR Code</div>
                            <p class="text-sm text-gray-600">Escaneie o QR Code ou copie a chave Pix abaixo</p>
                            <div class="flex items-center gap-2 mt-3">
                                <input type="text" value="00020126580014BR.GOV.BCB.PIX" readonly id="pix-key"
                                       class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-xs text-gray-500 bg-white">
                                <button onclick="document.getElementById('pix-key').select(); document.execCommand('copy'); this.textContent='Copiado!'; setTimeout(()=>this.textContent='Copiar',2000)"
                                        class="bg-gray-900 text-white text-xs px-3 py-2 rounded-lg hover:bg-violet-500 transition">
                                    Copiar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Boleto -->
                    <div id="form-boleto" class="hidden text-center py-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-sm text-gray-600 mb-4">O boleto será gerado após a confirmação do pedido.<br>Prazo de vencimento: <strong>3 dias úteis</strong>.</p>
                        <p class="text-xs text-gray-400">O pedido será confirmado após a compensação do pagamento.</p>
                    </div>
                </div>

            </div>

            <!-- Resumo -->
            <div class="space-y-4">
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-6 shadow-sm">
                    <h2 class="font-bold text-lg mb-5">Resumo do pedido</h2>
                    <div id="checkout-items" class="space-y-3 mb-5 text-sm"></div>

                    <div class="border-t border-gray-200 pt-4 space-y-2 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span id="co-subtotal" class="font-semibold text-gray-900" data-value="0">—</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Frete</span>
                            <span id="co-freight" class="font-semibold text-gray-900" data-value="0">—</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Desconto</span>
                            <span id="co-discount" class="font-semibold" data-value="0">—</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4 mt-3 flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span id="co-total" class="text-violet-500" data-value="0">—</span>
                    </div>
                </div>

                <button id="btn-confirmar" onclick="finalizarPedido()"
                        class="w-full bg-violet-500 text-white font-semibold py-3.5 rounded-full hover:bg-violet-600 transition text-base">
                    Confirmar pedido
                </button>

                <a href="/carrinho" class="block text-center text-sm text-gray-500 hover:text-violet-500 transition">
                    ← Voltar ao carrinho
                </a>
            </div>
        </div>
    </div>

    <!-- Modal de sucesso -->
    <div id="modal-success" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-10 max-w-sm w-full text-center shadow-2xl">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Pedido confirmado!</h2>
            <p class="text-gray-500 text-sm mb-6">Obrigado pela sua compra. Em breve você receberá um e-mail com os detalhes do pedido.</p>
            <a href="/meus-pedidos"
               class="block w-full bg-violet-500 text-white font-semibold py-3 rounded-full hover:bg-violet-600 transition">
                Ver meus pedidos
            </a>
        </div>
    </div>

    <script>
        let currentPayment = 'cartao';

        function showError(msg) {
            const el = document.getElementById('error-alert');
            el.textContent = msg;
            el.classList.remove('hidden');
            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function hideError() {
            document.getElementById('error-alert').classList.add('hidden');
        }

        function setPayment(method) {
            currentPayment = method;
            ['cartao', 'pix', 'boleto'].forEach(m => {
                document.getElementById('form-' + m).classList.add('hidden');
                const tab = document.getElementById('tab-' + m);
                tab.classList.remove('border-violet-500', 'text-violet-500');
                tab.classList.add('border-gray-200', 'text-gray-500');
            });
            document.getElementById('form-' + method).classList.remove('hidden');
            const active = document.getElementById('tab-' + method);
            active.classList.add('border-violet-500', 'text-violet-500');
            active.classList.remove('border-gray-200', 'text-gray-500');
        }

        async function loadSummary() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) { window.location.href = '/carrinho'; return; }

            try {
                const res = await fetch('/api/cart', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ items: cart.map(i => ({ productId: i.productId, qty: i.qty })) })
                });

                if (!res.ok) { showError('Erro ao carregar resumo do pedido.'); return; }

                const data = await res.json();

                const container = document.getElementById('checkout-items');
                container.innerHTML = '';
                data.items.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'flex justify-between items-center gap-2';
                    div.innerHTML = `
                        <div class="flex items-center gap-2">
                            ${item.image
                                ? `<img src="${item.image}" alt="${item.name}" class="w-10 h-10 rounded-lg object-cover bg-gray-100" loading="lazy">`
                                : `<div class="w-10 h-10 rounded-lg bg-gray-100"></div>`}
                            <span class="text-gray-700 leading-tight">${item.name} <span class="text-gray-400">x${item.qty}</span></span>
                        </div>
                        <span class="font-semibold text-gray-900 shrink-0">R$ ${(item.price * item.qty).toFixed(2).replace('.', ',')}</span>
                    `;
                    container.appendChild(div);
                });

                document.getElementById('co-subtotal').textContent = 'R$ ' + data.subtotal.toFixed(2).replace('.', ',');
                document.getElementById('co-subtotal').dataset.value = data.subtotal;
                document.getElementById('co-freight').textContent = data.freight === 0 ? 'Grátis 🎉' : 'R$ ' + data.freight.toFixed(2).replace('.', ',');
                document.getElementById('co-freight').dataset.value = data.freight;
                document.getElementById('co-discount').textContent = '- R$ ' + data.discount.toFixed(2).replace('.', ',');
                document.getElementById('co-discount').dataset.value = data.discount;
                document.getElementById('co-total').textContent = 'R$ ' + data.total.toFixed(2).replace('.', ',');
                document.getElementById('co-total').dataset.value = data.total;
            } catch (e) {
                showError('Erro de conexão. Verifique sua internet e tente novamente.');
            }
        }

        function validateForm() {
            const name  = document.getElementById('customer_name').value.trim();
            const email = document.getElementById('customer_email').value.trim();
            const rua   = document.getElementById('rua').value.trim();
            const num   = document.getElementById('numero').value.trim();
            const cidade = document.getElementById('cidade').value.trim();

            if (!name)   { showError('Informe seu nome completo.'); return false; }
            if (!email || !email.includes('@')) { showError('Informe um e-mail válido.'); return false; }
            if (!rua)    { showError('Informe o endereço de entrega.'); return false; }
            if (!num)    { showError('Informe o número do endereço.'); return false; }
            if (!cidade) { showError('Informe a cidade.'); return false; }
            return true;
        }

        async function finalizarPedido() {
            hideError();
            if (!validateForm()) return;

            const btn = document.getElementById('btn-confirmar');
            btn.disabled = true;
            btn.textContent = 'Processando...';

            const cart = JSON.parse(localStorage.getItem('cart') || '[]');

            const payload = {
                customer_name:  document.getElementById('customer_name').value.trim(),
                customer_email: document.getElementById('customer_email').value.trim(),
                customer_phone: document.getElementById('customer_phone').value.trim(),
                address: [
                    document.getElementById('rua').value,
                    document.getElementById('numero').value,
                    document.getElementById('complemento').value,
                    document.getElementById('bairro').value,
                    document.getElementById('cidade').value,
                    document.getElementById('estado').value,
                ].filter(Boolean).join(', '),
                payment_method: currentPayment,
                subtotal: parseFloat(document.getElementById('co-subtotal').dataset.value) || 0,
                freight:  parseFloat(document.getElementById('co-freight').dataset.value) || 0,
                discount: parseFloat(document.getElementById('co-discount').dataset.value) || 0,
                total:    parseFloat(document.getElementById('co-total').dataset.value) || 0,
                items: cart,
            };

            try {
                const res = await fetch('/orders', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify(payload),
                });

                if (!res.ok) {
                    const err = await res.json().catch(() => ({}));
                    showError(err.message || 'Erro ao confirmar pedido. Tente novamente.');
                    btn.disabled = false;
                    btn.textContent = 'Confirmar pedido';
                    return;
                }

                localStorage.removeItem('cart');
                document.getElementById('modal-success').classList.remove('hidden');
            } catch (e) {
                showError('Erro de conexão. Verifique sua internet e tente novamente.');
                btn.disabled = false;
                btn.textContent = 'Confirmar pedido';
            }
        }

        // Máscara cartão
        document.getElementById('card-number').addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').replace(/(.{4})/g, '$1 ').trim().slice(0, 19);
        });

        // Máscara validade
        document.getElementById('card-expiry').addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').replace(/^(\d{2})(\d)/, '$1/$2').slice(0, 5);
        });

        // Busca CEP com tratamento de erro
        document.getElementById('cep').addEventListener('blur', async function () {
            const cep = this.value.replace(/\D/g, '');
            const errEl = document.getElementById('cep-error');
            const loading = document.getElementById('cep-loading');
            errEl.classList.add('hidden');
            if (cep.length !== 8) return;

            loading.classList.remove('hidden');
            try {
                const res = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                const data = await res.json();
                if (data.erro) {
                    errEl.classList.remove('hidden');
                } else {
                    document.getElementById('rua').value    = data.logradouro ?? '';
                    document.getElementById('bairro').value = data.bairro ?? '';
                    document.getElementById('cidade').value = data.localidade ?? '';
                    document.getElementById('estado').value = data.uf ?? '';
                }
            } catch (e) {
                errEl.textContent = 'Não foi possível buscar o CEP. Preencha manualmente.';
                errEl.classList.remove('hidden');
            } finally {
                loading.classList.add('hidden');
            }
        });

        loadSummary();
    </script>

@endsection
