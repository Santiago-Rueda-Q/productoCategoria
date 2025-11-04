@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Editar Producto</h1>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- NOMBRE -->
        <div class="mb-4">
            <label for="nombre" class="block text-lg font-medium">Nombre</label>
            <input
                type="text"
                name="nombre"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400"
                value="{{ old('nombre', $producto->nombre) }}"
                required
            >
        </div>

        <!-- IMAGEN -->
        <div class="mb-4">
            <label for="imagen" class="block text-lg font-medium">Imagen del Producto</label>
            <input
                type="file"
                name="imagen"
                accept="image/*"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400"
            >

            @if($producto->imagen)
                <div class="mt-3">
                    <p class="text-gray-600 text-sm mb-2">Imagen actual:</p>
                    <div class="w-32 h-32 rounded-lg overflow-hidden border border-gray-300 shadow-sm bg-gray-50 flex items-center justify-center">
                        <img
                            src="{{ asset('storage/'.$producto->imagen) }}"
                            alt="Imagen actual"
                            class="object-cover w-full h-full"
                        >
                    </div>
                </div>
            @endif
        </div>

        <!-- PRECIO -->
        <div class="mb-4">
            <label for="precio" class="block text-lg font-medium">Precio</label>
            <input
                type="number"
                step="0.01"
                name="precio"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400"
                value="{{ old('precio', $producto->precio) }}"
                required
            >
        </div>

        <!-- STOCK -->
        <div class="mb-4">
            <label for="stock" class="block text-lg font-medium">Stock</label>
            <input
                type="number"
                name="stock"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400"
                value="{{ old('stock', $producto->stock) }}"
                required
            >
        </div>

        <!-- CATEGORÍA -->
        <div class="mb-4">
            <label for="categoria_id" class="block text-lg font-medium">Categoría</label>
            <select
                name="categoria_id"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400"
                required
            >
                @foreach($categorias as $categoria)
                    <option
                        value="{{ $categoria->id }}"
                        {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}
                    >
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- BOTONES -->
        <div class="space-x-4">
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md transition"
            >
                Actualizar
            </button>
            <a
                href="{{ route('productos.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md transition"
            >
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
