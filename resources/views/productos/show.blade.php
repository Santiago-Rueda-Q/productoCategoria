@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Detalle del Producto</h1>

    <div class="mb-4">
        <strong class="text-lg font-medium">ID:</strong> <span>{{ $producto->id }}</span>
    </div>

    <div class="mb-4">
        <strong class="text-lg font-medium">Nombre:</strong> <span>{{ $producto->nombre }}</span>
    </div>

    <div class="mb-4">
        <strong class="text-lg font-medium">Imagen:</strong>
        @if($producto->imagen)
            <img src="{{ asset('storage/'.$producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-48 rounded-md shadow mt-2">
        @else
            <span class="text-gray-500">Sin imagen</span>
        @endif
    </div>

    <div class="mb-4">
        <strong class="text-lg font-medium">Precio:</strong> <span>${{ number_format($producto->precio, 2) }}</span>
    </div>

    <div class="mb-4">
        <strong class="text-lg font-medium">Stock:</strong> <span>{{ $producto->stock }}</span>
    </div>

    <div class="mb-4">
        <strong class="text-lg font-medium">Categoría:</strong> <span>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</span>
    </div>

    <div class="space-x-4">
        <a href="{{ route('productos.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md">Volver</a>
        <a href="{{ route('productos.edit', $producto->id) }}" class="bg-yellow-500 text-white px-6 py-2 rounded-md">Editar</a>
    </div>
</div>
@endsection
