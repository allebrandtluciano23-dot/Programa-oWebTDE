<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SneakerStore')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900">

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between gap-6">

            <!-- Logo -->
            <a href="/" class="text-2xl font-extrabold tracking-tight text-gray-900">
                SNEAKER<span class="text-orange-500">STORE</span>
            </a>

            <!-- Nav -->
            <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-600">
                <a href="/" class="hover:text-orange-500 transition">Home</a>
                <a href="/busca" class="hover:text-orange-500 transition">Produtos</a>
                <a href="/busca?cat=corrida" class="hover:text-orange-500 transition">Corrida</a>
                <a href="/busca?cat=casual" class="hover:text-orange-500 transition">Casual</a>
                <a href="/busca?cat=basquete" class="hover:text-orange-500 transition">Basquete</a>
            </nav>

            <!-- Barra de busca -->
            <form action="/busca" method="GET" class="hidden md:flex items-center border border-gray-300 rounded-full overflow-hidden">
                <input type="text" name="query" placeholder="Buscar..."
                    class="px-4 py-2 text-sm text-gray-900 focus:outline-none w-48">
                <button type="submit" class="bg-orange-500 px-4 py-2 text-white hover:bg-orange-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                    </svg>
                </button>
            </form>

            <!-- Ícones -->
            <div class="flex items-center gap-5 text-gray-600">
                <a href="/favoritos" title="Favoritos" class="hover:text-orange-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                    </svg>
                </a>
                <a href="/carrinho" title="Carrinho" class="hover:text-orange-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </a>
                <a href="/login" class="text-sm font-semibold bg-gray-900 text-white px-4 py-2 rounded-full hover:bg-orange-500 transition">
                    Entrar
                </a>
            </div>
        </div>
    </header>

    @yield('banner')

    <main class="max-w-7xl mx-auto px-6 py-10">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-extrabold mb-3">SNEAKER<span class="text-orange-500">STORE</span></h3>
                <p class="text-gray-400 text-sm">Performance, conforto e estilo para todos os momentos.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Links</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/" class="hover:text-orange-400">Home</a></li>
                    <li><a href="/busca" class="hover:text-orange-400">Produtos</a></li>
                    <li><a href="/carrinho" class="hover:text-orange-400">Carrinho</a></li>
                    <li><a href="/favoritos" class="hover:text-orange-400">Favoritos</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Categorias</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="/busca?cat=corrida" class="hover:text-orange-400">Corrida</a></li>
                    <li><a href="/busca?cat=casual" class="hover:text-orange-400">Casual</a></li>
                    <li><a href="/busca?cat=basquete" class="hover:text-orange-400">Basquete</a></li>
                    <li><a href="/busca?cat=skate" class="hover:text-orange-400">Skate</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 text-center py-4 text-sm text-gray-500">
            &copy; 2026 SneakerStore. Todos os direitos reservados.
        </div>
    </footer>

</body>
</html>
