@php $p = $product ?? null; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold mb-1">Nome <span class="text-red-500">*</span></label>
        <input type="text" name="name" value="{{ old('name', $p?->name) }}" required
               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold mb-1">Descrição</label>
        <textarea name="description" rows="3"
                  class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400 resize-none">{{ old('description', $p?->description) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Preço (R$) <span class="text-red-500">*</span></label>
        <input type="number" name="price" value="{{ old('price', $p?->price) }}" step="0.01" min="0" required
               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Estoque <span class="text-red-500">*</span></label>
        <input type="number" name="stock" value="{{ old('stock', $p?->stock ?? 0) }}" min="0" required
               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Categoria</label>
        <select name="category"
                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400 bg-white">
            <option value="">— Selecionar —</option>
            @foreach(['correntes','cordoes','relogios','pulseiras','pingentes','aneis'] as $cat)
                <option value="{{ $cat }}" {{ old('category', $p?->category) === $cat ? 'selected' : '' }}>
                    {{ ucfirst($cat) }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Material / Cor</label>
        <input type="text" name="color" value="{{ old('color', $p?->color) }}" placeholder="ex: Prata 925, Ouro 18K"
               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Tamanhos disponíveis</label>
        <input type="text" name="size" value="{{ old('size', $p?->size) }}" placeholder="ex: 45cm, 42mm, G/M/P"
               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
    </div>

    <div>
        <label class="block text-sm font-semibold mb-1">Peso (kg)</label>
        <input type="number" name="weight" value="{{ old('weight', $p?->weight) }}" step="0.01" min="0"
               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold mb-1">URL da imagem</label>
        <input type="url" name="image" value="{{ old('image', $p?->image) }}" placeholder="https://..."
               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-violet-400">
        @if($p?->image)
            <img src="{{ $p->image }}" alt="preview" class="mt-3 h-24 w-24 object-cover rounded-xl bg-gray-100">
        @endif
    </div>

</div>
