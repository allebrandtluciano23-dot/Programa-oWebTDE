<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Moltro')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900">

    <!-- Header -->
    <header class="bg-white border-b border-violet-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-6">

            <!-- Logo -->
            <a href="/" class="text-2xl font-extrabold tracking-tight text-gray-900">
                MOL<span class="text-violet-400">TRO</span>
            </a>

            <!-- Nav -->
            <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-600">
                <a href="/" class="hover:text-violet-500 transition">Home</a>
                <a href="/busca" class="hover:text-violet-500 transition">Produtos</a>
                <a href="/busca?cat=correntes" class="hover:text-violet-500 transition">Correntes</a>
                <a href="/busca?cat=relogios" class="hover:text-violet-500 transition">Relógios</a>
                <a href="/busca?cat=pulseiras" class="hover:text-violet-500 transition">Pulseiras</a>
                <a href="/busca?cat=aneis" class="hover:text-violet-500 transition">Anéis</a>
            </nav>

            <!-- Barra de busca -->
            <form action="/busca" method="GET" class="hidden md:flex items-center border border-gray-300 rounded-full overflow-hidden">
                <input type="text" name="query" placeholder="Buscar..."
                    class="px-4 py-2 text-sm text-gray-900 focus:outline-none w-48">
                <button type="submit" class="bg-violet-500 px-4 py-2 text-white hover:bg-violet-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                </button>
            </form>

            <!-- Ícones -->
            <div class="flex items-center gap-5 text-gray-600">
                <a href="/favoritos" title="Favoritos" class="hover:text-violet-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                    </svg>
                </a>
                <a href="/carrinho" title="Carrinho" class="relative hover:text-violet-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span id="cart-badge" class="hidden absolute -top-2 -right-2 bg-violet-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center"></span>
                </a>
                @auth
                    <div class="flex items-center gap-3">
                        <a href="/meus-pedidos" class="text-sm text-gray-600 hidden md:inline hover:text-violet-500 transition">Meus Pedidos</a>
                        @if(Auth::user()->is_admin)
                            <a href="/admin" class="text-sm text-gray-600 hidden md:inline hover:text-violet-500 transition">Admin</a>
                        @endif
                        <span class="text-sm text-gray-600 hidden md:inline">Olá, {{ Auth::user()->name }}</span>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit"
                                    class="text-sm font-semibold bg-slate-700 text-white px-4 py-2 rounded-full hover:bg-red-400 transition">
                                Sair
                            </button>
                        </form>
                    </div>
                @else
                    <a href="/login" class="text-sm font-semibold bg-slate-700 text-white px-4 py-2 rounded-full hover:bg-violet-500 transition">
                        Entrar
                    </a>
                @endauth

                <!-- Hamburger (mobile) -->
                <button id="menu-btn" class="md:hidden text-gray-600 hover:text-violet-500 transition" aria-label="Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menu mobile -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white px-6 py-4 space-y-3 text-sm font-medium text-gray-700">
            <a href="/" class="block hover:text-violet-500">Home</a>
            <a href="/busca" class="block hover:text-violet-500">Todos os Produtos</a>
            <a href="/busca?cat=correntes" class="block hover:text-violet-500">Correntes</a>
            <a href="/busca?cat=relogios" class="block hover:text-violet-500">Relógios</a>
            <a href="/busca?cat=pulseiras" class="block hover:text-violet-500">Pulseiras</a>
            <a href="/busca?cat=aneis" class="block hover:text-violet-500">Anéis</a>
            <a href="/favoritos" class="block hover:text-violet-500">Favoritos</a>
            <a href="/carrinho" class="block hover:text-violet-500">Carrinho</a>
            @auth
                <a href="/meus-pedidos" class="block hover:text-violet-500">Meus Pedidos</a>
                @if(Auth::user()->is_admin)
                    <a href="/admin" class="block hover:text-violet-500">Admin</a>
                @endif
                <div class="pt-2 border-t border-gray-100">
                    <span class="text-gray-500 text-xs">Logado como {{ Auth::user()->name }}</span>
                    <form method="POST" action="/logout" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left text-red-500 font-semibold text-sm">Sair</button>
                    </form>
                </div>
            @else
                <a href="/login" class="block font-semibold text-violet-500">Entrar</a>
                <a href="/register" class="block text-gray-500">Criar conta</a>
            @endauth
        </div>
    </header>

    @yield('banner')

    <main class="max-w-7xl mx-auto px-6 py-10">
        @yield('content')
    </main>

    <footer class="bg-slate-800 text-white mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-extrabold mb-3">MOL<span class="text-violet-400">TRO</span></h3>
                <p class="text-gray-400 text-sm">Elegância e estilo em cada detalhe. Joias para todos os momentos.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Links</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/" class="hover:text-violet-400">Home</a></li>
                    <li><a href="/busca" class="hover:text-violet-400">Produtos</a></li>
                    <li><a href="/carrinho" class="hover:text-violet-400">Carrinho</a></li>
                    <li><a href="/favoritos" class="hover:text-violet-400">Favoritos</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Categorias</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/busca?cat=correntes" class="hover:text-violet-400">Correntes</a></li>
                    <li><a href="/busca?cat=relogios" class="hover:text-violet-400">Relógios</a></li>
                    <li><a href="/busca?cat=pulseiras" class="hover:text-violet-400">Pulseiras</a></li>
                    <li><a href="/busca?cat=pingentes" class="hover:text-violet-400">Pingentes</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-700 text-center py-4 text-sm text-gray-500">
            &copy; 2026 Moltro. Todos os direitos reservados.
        </div>
    </footer>


    <script>
        (function () {
            var cart = JSON.parse(localStorage.getItem('cart') || '[]');
            var count = cart.reduce(function(s, i){ return s + (i.qty || 1); }, 0);
            var badge = document.getElementById('cart-badge');
            if (badge && count > 0) { badge.textContent = count; badge.classList.remove('hidden'); }
        })();
        var menuBtn = document.getElementById('menu-btn');
        if (menuBtn) menuBtn.addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
