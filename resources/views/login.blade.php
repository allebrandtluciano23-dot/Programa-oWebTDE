@extends('layouts.app')

@section('title', 'Entrar - SneakerStore')

@section('content')

    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Bem-vindo de volta</h1>
            <p class="text-gray-500 mt-2">Entre na sua conta para continuar</p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8">
            <form method="POST" action="#" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold mb-1">E-mail</label>
                    <input type="email" name="email" placeholder="seu@email.com" required
                           class="w-full border border-gray-300 rounded-full px-4 py-3 text-sm focus:outline-none focus:border-orange-400">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Senha</label>
                    <input type="password" name="password" placeholder="••••••••" required
                           class="w-full border border-gray-300 rounded-full px-4 py-3 text-sm focus:outline-none focus:border-orange-400">
                </div>

                <button type="submit"
                        class="w-full bg-orange-500 text-white font-semibold py-3 rounded-full hover:bg-orange-600 transition">
                    Entrar
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Não tem conta?
                <a href="#" class="text-orange-500 font-semibold hover:underline">Cadastre-se grátis</a>
            </p>
        </div>
    </div>

@endsection
