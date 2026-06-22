@extends('layouts.app')

@section('title', 'Entrar - SneakerStore')

@section('content')

    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Bem-vindo de volta</h1>
            <p class="text-gray-500 mt-2">Entre na sua conta para continuar</p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 mb-5">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3 mb-5">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold mb-1">E-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" required
                           class="w-full border border-gray-300 rounded-full px-4 py-3 text-sm focus:outline-none focus:border-violet-400 @error('email') border-red-400 @enderror">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Senha</label>
                    <input type="password" name="password" placeholder="••••••••" required
                           class="w-full border border-gray-300 rounded-full px-4 py-3 text-sm focus:outline-none focus:border-violet-400">
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="accent-violet-500">
                    <label for="remember" class="text-sm text-gray-600">Lembrar de mim</label>
                </div>

                <button type="submit"
                        class="w-full bg-violet-500 text-white font-semibold py-3 rounded-full hover:bg-violet-600 transition">
                    Entrar
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Não tem conta?
                <a href="/register" class="text-violet-500 font-semibold hover:underline">Cadastre-se grátis</a>
            </p>
        </div>
    </div>

@endsection
