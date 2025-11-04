@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Crear Producto</h1>

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="mb-4">
            <label for="nombre" class="block text-lg font-medium">Nombre</label>
            <input type="text" name="nombre" class="w-full px-4 py-2 border rounded-md" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-4">
            <label for="imagen" class="block text-lg font-medium">Imagen del Producto</label>
            <input type="file" name="imagen" accept="image/*" class="w-full px-4 py-2 border rounded-md">
        </div>

        <div class="mb-4">
            <label for="precio" class="block text-lg font-medium">Precio</label>
            <input type="number" step="0.01" name="precio" class="w-full px-4 py-2 border rounded-md" value="{{ old('precio') }}" required>
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-lg font-medium">Stock</label>
            <input type="number" name="stock" class="w-full px-4 py-2 border rounded-md" value="{{ old('stock', 0) }}" required>
        </div>

        <div class="mb-4">
            <label for="categoria_id" class="block text-lg font-medium">Categoría</label>
            <select name="categoria_id" class="w-full px-4 py-2 border rounded-md" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="space-x-4">
            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-md">Guardar</button>
            <a href="{{ route('productos.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md">Cancelar</a>
        </div>
    </form>
</div>
@endsection
