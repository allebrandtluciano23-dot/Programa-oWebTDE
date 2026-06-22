<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SneakerStore')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-60 bg-gray-900 text-white flex flex-col shrink-0">
            <div class="px-6 py-5 border-b border-gray-800">
                <a href="/" class="text-xl font-extrabold tracking-tight">
                    LUX<span class="text-violet-500">JOIAS</span>
                </a>
                <p class="text-xs text-gray-400 mt-1">Painel Admin</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
                <a href="/admin"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('admin') ? 'bg-violet-500 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                    Produtos
                </a>
                <a href="/admin/produtos/criar"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('admin/produtos/criar') ? 'bg-violet-500 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Novo Produto
                </a>
                <a href="/"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v9a1 1 0 001 1h4v-5h4v5h4a1 1 0 001-1v-9"/>
                    </svg>
                    Ver Loja
                </a>
            </nav>

            <div class="px-4 py-5 border-t border-gray-800">
                <p class="text-xs text-gray-400 mb-2">{{ Auth::user()->name }}</p>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit"
                            class="w-full text-sm text-left text-gray-400 hover:text-red-400 transition">
                        Sair →
                    </button>
                </form>
            </div>
        </aside>

        <!-- Conteúdo -->
        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
                <h1 class="text-lg font-bold">@yield('page-title', 'Admin')</h1>
                @yield('header-action')
            </header>

            <main class="flex-1 px-8 py-8">

                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3 mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
