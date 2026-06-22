@extends('layouts.app')

@section('title', 'Favoritos - Moltro')

@section('content')

    <h1 class="text-2xl font-bold mb-8">Meus Favoritos</h1>

    <div id="empty-msg" class="hidden text-center py-20 text-gray-400">
        <p class="text-5xl mb-4">🤍</p>
        <p class="text-lg font-semibold">Você ainda não tem favoritos.</p>
        <a href="/busca" class="mt-4 inline-block text-violet-500 hover:underline">Explorar produtos</a>
    </div>

    <div id="favorites-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>

    <script>
        async function loadFavorites() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const grid = document.getElementById('favorites-grid');
            const emptyMsg = document.getElementById('empty-msg');

            if (favorites.length === 0) {
                emptyMsg.classList.remove('hidden');
                return;
            }

            for (const id of favorites) {
                try {
                    const res = await fetch(`/api/product/${id}`);
                    if (!res.ok) continue;
                    const product = await res.json();
                    const slug = product.name.toLowerCase().replace(/\s+/g, '-');

                    const card = document.createElement('a');
                    card.href = `/p/${slug}/${product.id}`;
                    card.className = 'group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl transition-shadow';
                    card.innerHTML = `
                        <div class="bg-gray-50 h-48 overflow-hidden">
                            ${product.image
                                ? `<img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" loading="lazy">`
                                : `<div class="w-full h-full flex items-center justify-center text-gray-300 text-sm">Sem imagem</div>`}
                        </div>
                        <div class="p-4">
                            <span class="text-violet-500 text-xs font-semibold uppercase">${product.category ?? ''}</span>
                            <h3 class="font-semibold text-gray-900 mt-1">${product.name}</h3>
                            <p class="text-gray-900 font-bold mt-2">R$ ${parseFloat(product.price).toFixed(2).replace('.', ',')}</p>
                        </div>
                    `;
                    grid.appendChild(card);
                } catch (e) {
                    console.error('Erro ao carregar favorito', id, e);
                }
            }
        }

        loadFavorites();
    </script>

@endsection
