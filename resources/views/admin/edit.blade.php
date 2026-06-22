@extends('layouts.admin')

@section('title', 'Editar Produto - Admin')
@section('page-title', 'Editar Produto')

@section('content')

    <div class="max-w-2xl">
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl px-4 py-3 mb-6">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="/admin/produtos/{{ $product->id }}" class="space-y-5">
                @csrf
                @method('PUT')

                @include('admin._form', ['product' => $product])

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="bg-violet-500 text-white font-semibold px-6 py-2.5 rounded-full hover:bg-violet-600 transition">
                        Salvar alterações
                    </button>
                    <a href="/admin"
                       class="px-6 py-2.5 rounded-full border border-gray-300 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
