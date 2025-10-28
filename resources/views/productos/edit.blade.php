@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Editar Producto</h1>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nombre" class="block text-lg font-medium">Nombre</label>
            <input type="text" name="nombre" class="w-full px-4 py-2 border rounded-md" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div class="mb-4">
            <label for="precio" class="block text-lg font-medium">Precio</label>
            <input type="number" step="0.01" name="precio" class="w-full px-4 py-2 border rounded-md" value="{{ old('precio', $producto->precio) }}" required>
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-lg font-medium">Stock</label>
            <input type="number" name="stock" class="w-full px-4 py-2 border rounded-md" value="{{ old('stock', $producto->stock) }}" required>
        </div>

        <div class="mb-4">
            <label for="categoria_id" class="block text-lg font-medium">Categoría</label>
            <select name="categoria_id" class="w-full px-4 py-2 border rounded-md" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="space-x-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">Actualizar</button>
            <a href="{{ route('productos.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md">Cancelar</a>
        </div>
    </form>
</div>
@endsection
