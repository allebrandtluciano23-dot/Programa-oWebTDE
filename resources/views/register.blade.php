@extends('layouts.app')

@section('title', 'Criar Conta - SneakerStore')

@section('content')

    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Crie sua conta</h1>
            <p class="text-gray-500 mt-2">É rápido, grátis e sem complicação</p>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-8">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 mb-5">
                    <ul class="space-y-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold mb-1">Nome completo</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="João Silva" required
                           class="w-full border border-gray-300 rounded-full px-4 py-3 text-sm focus:outline-none focus:border-violet-400 @error('name') border-red-400 @enderror">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">E-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="seu@email.com" required
                           class="w-full border border-gray-300 rounded-full px-4 py-3 text-sm focus:outline-none focus:border-violet-400 @error('email') border-red-400 @enderror">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Senha</label>
                    <input type="password" name="password" placeholder="Mínimo 6 caracteres" required
                           class="w-full border border-gray-300 rounded-full px-4 py-3 text-sm focus:outline-none focus:border-violet-400 @error('password') border-red-400 @enderror">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Confirmar senha</label>
                    <input type="password" name="password_confirmation" placeholder="Repita a senha" required
                           class="w-full border border-gray-300 rounded-full px-4 py-3 text-sm focus:outline-none focus:border-violet-400">
                </div>

                <button type="submit"
                        class="w-full bg-violet-500 text-white font-semibold py-3 rounded-full hover:bg-violet-600 transition">
                    Criar conta
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Já tem conta?
                <a href="/login" class="text-violet-500 font-semibold hover:underline">Entrar</a>
            </p>
        </div>
    </div>

@endsection
